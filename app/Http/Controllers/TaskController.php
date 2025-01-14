<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            return redirect()->route('monitoring')->with('message', 'Tugas berhasil disimpan!');
    } catch (\Exception $e) {
        return redirect()->route('monitoring')->with('message', 'Terjadi kesalahan saat menyimpan tugas: ' . $e->getMessage());
        }
    }
}