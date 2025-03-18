<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    
    protected $notifyService;

    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'namakegiatan' => 'required|string|max:255',
                'deskripsi' => 'required|array',
                'deskripsi.*' => 'string|max:1000',
                'volume' => 'required|array',
                'volume.*' => 'numeric',
                'satuan' => 'required|string|max:255',
                'tenggat' => 'required|date',
                'penerimatugas_id' => 'required|array',
                'penerimatugas_id.*' => 'exists:users,id',
                'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
            ]);

            $attachmentPath = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null;

            foreach ($validatedData['penerimatugas_id'] as $index => $penerimaId) {
                $lastTaskId = Task::latest('id')->first()->id ?? 0;
                $newTaskId = $lastTaskId + 1;

                $judulSlug = Str::slug($validatedData['namakegiatan']);
                $tanggalDibuat = Carbon::now()->format('d-m-Y');
                $tanggalTenggat = Carbon::parse($validatedData['tenggat'])->format('d-m-Y');
                $slug = "{$newTaskId}_{$judulSlug}_{$tanggalDibuat}_{$tanggalTenggat}";

            
                Task::create([
                    'namakegiatan' => $validatedData['namakegiatan'],
                    'slug' => $slug,
                    'deskripsi' => $validatedData['deskripsi'][$index],
                    'volume' => $validatedData['volume'][$index],
                    'satuan' => $validatedData['satuan'],
                    'tenggat' => Carbon::parse($validatedData['tenggat'])->format('Y-m-d'),
                    'pemberitugas_id' => Auth::id(),
                    'penerimatugas_id' => $penerimaId,
                    'attachment' => $attachmentPath,
                ]);

                $penerima = User::find($penerimaId);
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

    public function update(Request $request, Task $task){
        // Validasi input
        $validatedData = $request->validate([
            'namakegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'volume' => 'required|integer|min:1',
            'tenggat' => 'required|date',
        ]);

        // Update data tugas
        $task->update($validatedData);

        // Redirect ke halaman monitoring dengan pesan sukses
        session()->flash('updated', 'Tugas Berhasil Diperbarui');
        return redirect()->back();
    }


    public function destroy(Task $task){
        $task->delete();
        return redirect('/monitoring')->with('deleted', 'Tugas berhasil dihapus');
    }

    public function markAsDone($id){
        $task = Task::findOrFail($id);
        $task->active = false;
        $task->progress = $task->volume;
        $task->save();

        return redirect('home')->with('success', 'Tugas berhasil ditandai selesai!');
    }

    public function getActiveTasks()
    {
        $tasks = User::where('role', 'anggotatim') // Filter hanya anggota tim
            ->leftJoin('tasks', 'users.id', '=', 'tasks.penerimatugas_id')
            ->select('users.name as nama', DB::raw('COUNT(tasks.id) as jumlah_tugas'))
            ->where(function ($query) {
                $query->where('tasks.active', 1)
                      ->orWhereNull('tasks.active'); // Termasuk pegawai tanpa tugas
            })
            ->groupBy('users.id', 'users.name')
            ->get();

        return response()->json($tasks);
    }
}