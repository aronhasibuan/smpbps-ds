<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Progress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    
    protected $notifyService;

    // construct notifyservice
    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

    // create task
    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'namakegiatan' => 'required|string|max:255',
                'tenggat' => 'required|date',
                'penerimatugas_id' => 'required|array',
                'penerimatugas_id.*' => 'exists:users,id',
                'deskripsi' => 'required|array',
                'deskripsi.*' => 'string|max:1000',
                'volume' => 'required|array',
                'volume.*' => 'numeric',
                'attachment.*' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
                'satuan' => 'required|string|max:255',
            ]);

            $kegiatan = Kegiatan::create([
                'namakegiatan' => $validatedData['namakegiatan'],
                'slug' => '',
                'tenggat' => Carbon::parse($validatedData['tenggat'])->format('Y-m-d'),
                'pemberitugas_id' => Auth::id(),
            ]);

            $namakegiatan_slug = Str::slug($validatedData['namakegiatan']);
            $tanggal_dibuat = Carbon::now()->format('d-m-Y');
            $tanggal_tenggat = Carbon::parse($validatedData['tenggat'])->format('d-m-Y');
            $kegiatan->slug = "{$kegiatan->id}_{$namakegiatan_slug}_{$tanggal_dibuat}_{$tanggal_tenggat}";
            $kegiatan->save();
            $ketuatim = User::find(Auth::id());

            foreach ($validatedData['penerimatugas_id'] as $index => $penerimaId) {
                $penerima = User::find($penerimaId);
                $path = null;

                if ($request->hasFile('attachment') && isset($request->file('attachment')[$index])) {
                    $file = $request->file('attachment')[$index];
                    $path = $file->store('attachments', 'public');
                }
                
                $task = Task::create([
                    'namakegiatan' => $validatedData['namakegiatan'],
                    'slug' => '',
                    'kegiatan_id' => $kegiatan->id,
                    'deskripsi' => $validatedData['deskripsi'][$index],
                    'volume' => $validatedData['volume'][$index],
                    'satuan' => $validatedData['satuan'],
                    'tenggat' => Carbon::parse($validatedData['tenggat'])->format('Y-m-d'),
                    'pemberitugas_id' => Auth::id(),
                    'penerimatugas_id' => $penerimaId,
                    'attachment' => $path ? Storage::url($path) : null,
                ]);

                $task->slug = "{$task->id}_{$penerima->username}";
                $task->save();

                Progress::create([
                    'task_id' => $task->id,
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'progress' => 0,
                    'dokumentasi' => null,
                ]);

                if ($penerima && $penerima->no_hp) {
                    $pesan = "Halo {$penerima->name} 👋\n";
                    $pesan .= "Anda telah menerima *tugas baru* dari {$ketuatim->name}.\n\n";
                    $pesan .= "📌 *Nama Kegiatan*: {$validatedData['namakegiatan']}\n";
                    $pesan .= "📝 *Deskripsi Pekerjaan*: {$validatedData['deskripsi'][$index]}\n";
                    $pesan .= "📆 *Tenggat Waktu*: {$validatedData['tenggat']}\n";
                    $pesan .= "📦 *Jumlah Pekerjaan*: {$validatedData['volume'][$index]} {$validatedData['satuan']}\n\n";
                    $pesan .= "Silakan cek detail tugas dan mulai pengerjaan melalui sistem:\n";
                    $pesan .= "🌐 http://smpbps-ds.test/login\n\n";
                    $pesan .= "Jika ada pertanyaan, silakan hubungi pemberi tugas.\n";
                    $pesan .= "Semangat menjalankan tugas! 💪";
                    $this->notifyService->sendFonnteNotification($penerima->no_hp, $pesan);
                }
            }
            session()->flash('success', 'Kegiatan dan tugas berhasil ditambahkan.');
            return redirect('monitoringkegiatan');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
        return redirect()->back();
    }

    // update task
    public function update(Request $request, Task $task)
    {
        try{
            $validatedData = $request->validate([
                'deskripsi' => 'required|string',
                'volume' => ['required','integer', function ($attribute, $value, $fail) use ($task) {
                                    if ($value <= $task->progress) {
                                        $fail('Volume harus lebih besar dari progress saat ini');
                                    }
                                }
                            ],
                'attachment.*' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120'
            ]);

            $task->volume = $validatedData['volume'];
            $task->deskripsi = $validatedData['deskripsi'];

            if ($request->hasFile('attachment')) {
                if ($task->attachment) {
                    Storage::delete($task->attachment);
                }
                
                $path = $request->file('attachment')->store('public/task_attachments');
                $task->attachment = $path;
            }

            $task->save();
            session()->flash('updated', 'Tugas Berhasil Diperbarui');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error', 'Gagal memperbarui task: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // delete task
    public function destroy(Task $task)
    {
        $redirectUrl = route('kegiatan', $task->kegiatan);
        try {

            $task->progress()->delete();            
            if ($task->attachment) {
                Storage::delete($task->attachment);
            }
            $task->delete();
            
            return redirect($redirectUrl)->with('deleted', 'Tugas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus task: '.$e->getMessage());
        }
    }

    // update progress
    public function updateprogress(Request $request, $slug, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:' . ($task->latestprogress + 1) . '|max:' . $task->volume,
            'catatan' => 'nullable|string|max:1000',
            'dokumentasi' => 'nullable|file|mimes:jpg,png|max:5120'
        ]);

        $catatan = $request->catatan ?? 'Tidak ada catatan pada progress ini';
        $attachmentPath = $request->hasFile('dokumentasi') ? $request->file('dokumentasi')->store('attachments', 'public') : null;

        Progress::create([
            'task_id' => $id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'progress' => $request->quantity,
            'catatan' => $catatan,
            'dokumentasi' => $attachmentPath,
        ]);

        $task->latestprogress = $request->quantity;
    
        if ($task->volume == $request->quantity) {
            $task->active = false;
            $task->save();
            return redirect('home')->with('success', 'Tugas berhasil ditandai selesai!'); 
        } else{
            $task->save();
            return redirect()->back()->with('updated', 'Progress Berhasil Diperbarui');
        }
    }

    // mark kegiatan as done
    public function markkegiatanasdone($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            if (!$kegiatan->active) {
                return redirect()->back()->with('error', 'Kegiatan ini sudah ditandai selesai sebelumnya.');
            }

            $unfinishedTasks = $kegiatan->tasks()->where('active', true)->count();
            if ($unfinishedTasks > 0) {
                return redirect()->back()->with('error', 'Tidak dapat menandai kegiatan selesai karena masih ada tugas yang belum selesai.');
            }

            $kegiatan->active = false;
            $kegiatan->save();

            return redirect()->route('monitoringkegiatan')->with('success', 'Kegiatan berhasil ditandai selesai!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}