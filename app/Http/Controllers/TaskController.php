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
    public function create(Request $request){
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
                'attachment' => 'file',
                'satuan' => 'required|string|max:255',
            ]);

            $kegiatanid = Kegiatan::latest('id')->first()->id ?? 0;
            $newkegiatanid = $kegiatanid + 1;
            $namakegiatan_slug = Str::slug($validatedData['namakegiatan']);
            $tanggal_dibuat = Carbon::now()->format('d-m-Y');
            $tanggal_tenggat = Carbon::parse($validatedData['tenggat'])->format('d-m-Y');
            $kegiatan_slug = "{$newkegiatanid}_{$namakegiatan_slug}_{$tanggal_dibuat}_{$tanggal_tenggat}";

            Kegiatan::create([
                'namakegiatan' => $validatedData['namakegiatan'],
                'slug' => $kegiatan_slug,
                'tenggat' => Carbon::parse($validatedData['tenggat'])->format('Y-m-d'),
                'pemberitugas_id' => Auth::id(),
            ]);

            foreach ($validatedData['penerimatugas_id'] as $index => $penerimaId) {
                $lastTaskId = Task::latest('id')->first()->id ?? 0;
                $newTaskId = $lastTaskId + 1;
                $penerima = User::find($penerimaId);
                $slug = "{$newTaskId}_{$penerima->username}";
                
                if ($request->hasFile('attachment') && isset($request->file('attachment')[$index])) {
                    $file = $request->file('attachment')[$index];
                    $path = $file->store('attachments', 'public');
                }
                
                Task::create([
                    'namakegiatan' => $validatedData['namakegiatan'],
                    'slug' => $slug,
                    'kegiatan_id' => $newkegiatanid,
                    'deskripsi' => $validatedData['deskripsi'][$index],
                    'volume' => $validatedData['volume'][$index],
                    'satuan' => $validatedData['satuan'],
                    'tenggat' => Carbon::parse($validatedData['tenggat'])->format('Y-m-d'),
                    'pemberitugas_id' => Auth::id(),
                    'penerimatugas_id' => $penerimaId,
                    'attachment' => Storage::url($path),
                ]);

                Progress::create([
                    'task_id' => $newTaskId,
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'progress' => 0,
                    'dokumentasi' => null,
                ]);

                if ($penerima && $penerima->no_hp) {
                    $pesanNotifikasi = "Halo {$penerima->name}. Anda telah menerima tugas baru dalam kegiatan {$validatedData['namakegiatan']}. Silakan cek http://smpbps-ds.test/login untuk info lebih lanjut.";
                    $this->notifyService->sendFonnteNotification($penerima->no_hp, $pesanNotifikasi);
                }
            }
            session()->flash('success', 'Kegiatan dan tugas berhasil ditambahkan.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
        return redirect()->back();
    }

    // update task
    public function update(Request $request, Task $task){
        $validatedData = $request->validate([
            'namakegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'volume' => 'required|integer|min:1',
            'tenggat' => 'required|date',
        ]);

        $task->update($validatedData);

        session()->flash('updated', 'Tugas Berhasil Diperbarui');
        return redirect()->back();
    }

    // delete task
    public function destroy(Task $task){
        $task->delete();
        return redirect('/monitoring')->with('deleted', 'Tugas berhasil dihapus');
    }

    // update progress
    public function updateprogress(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:' . ($task->latestprogress + 1) . '|max:' . $task->volume,
            'dokumentasi' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120'
        ]);

        $attachmentPath = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null;

        Progress::create([
            'task_id' => $id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'progress' => $request->quantity,
            'dokumentasi' => $attachmentPath,
        ]);

        $task->latestprogress = $request->quantity;
    
        if ($task->volume == $request->quantity) {
            $task->active = false;
            $task->save();
            return redirect('home')->with('success', 'Tugas berhasil ditandai selesai!'); 
        }

        $task->save();

        session()->flash('updated', 'Progress Berhasil Diperbarui');
        return redirect()->back();
    }

    public function getActiveTasks()
    {
        $tasks = User::where('role', 'anggotatim')
            ->leftJoin('tasks', 'users.id', '=', 'tasks.penerimatugas_id')
            ->select('users.name as nama', DB::raw('COUNT(tasks.id) as jumlah_tugas'))
            ->where(function ($query) {
                $query->where('tasks.active', 1)
                      ->orWhereNull('tasks.active');
            })
            ->groupBy('users.id', 'users.name')
            ->get();

        return response()->json($tasks);
    }
}