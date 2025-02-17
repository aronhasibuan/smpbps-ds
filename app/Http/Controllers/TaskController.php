<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
                'deskripsi' => 'required|string|max:1000',
                'volume' => 'required|numeric',
                'satuan' => 'required|string|max:255',
                'tenggat' => 'required|date',
                'penerimatugas_id' => 'required',
                'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
            ]);

            // Ambil ID terakhir dan tambah 1
            $lastTaskId = Task::latest('id')->first()->id ?? 0;
            $newTaskId = $lastTaskId + 1;

            $judulSlug = Str::slug($validatedData['namakegiatan']);
            $tanggalDibuat = Carbon::now()->format('d-m-Y');
            $tanggalTenggat = Carbon::parse($validatedData['tenggat'])->format('d-m-Y');
            $slug = "{$newTaskId}_{$judulSlug}_{$tanggalDibuat}_{$tanggalTenggat}";

            // Simpan data
            $task = Task::create([
                'namakegiatan' => $validatedData['namakegiatan'],
                'slug' => $slug,
                'deskripsi' => $validatedData['deskripsi'],
                'volume' => $validatedData['volume'],
                'satuan' => $validatedData['satuan'],
                'tenggat' => $validatedData['tenggat'],
                'pemberitugas_id' => Auth::id(),
                'penerimatugas_id' => $validatedData['penerimatugas_id'],
                'attachment' => $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null,
            ]);

            // Notify Pegawai
            $namakegiatan = $validatedData['namakegiatan'];
            $penerimatugas = User::find($validatedData['penerimatugas_id']);
            if ($penerimatugas && $penerimatugas->no_hp) {
                $pesannotifikasi = "Halo ".$penerimatugas->name.". Anda telah menerima tugas baru pada kegiatan ".$validatedData['namakegiatan'].". Silahkan cek http://smpbps-ds.test/login untuk info selengkapnya";
                $responseCode = $this->notifyService->sendFonnteNotification($penerimatugas->no_hp, $pesannotifikasi);
            }
            session()->flash('success', 'Data Berhasil Ditambahkan.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal Menambahkan Data: ' . $e->getMessage());
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
}