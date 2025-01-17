<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    
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

            $judulSlug = Str::slug($validatedData['namakegiatan']); 
            $tanggalDibuat = Carbon::now()->format('d-m-Y'); 
            $tanggalTenggat = Carbon::parse($validatedData['tenggat'])->format('d-m-Y');
            $slug = "{$judulSlug}_{$tanggalDibuat}_{$tanggalTenggat}";

            // Simpan data
            $task = Task::create([
                'namakegiatan' => $validatedData['namakegiatan'],
                'slug' => "$slug",
                'deskripsi' => $validatedData['deskripsi'],
                'volume' => $validatedData['volume'],
                'satuan' => $validatedData['satuan'],
                'tenggat' => $validatedData['tenggat'],
                'pemberitugas_id' => Auth::id(),
                'penerimatugas_id' => $validatedData['penerimatugas_id'],
                'attachment' => $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null,
            ]);
            session()->flash('success', 'Data Berhasil Ditambahkan.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal Menambahkan Data');
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

}