<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    
    public function create(Request $request){
        $pemberitugas_id = Auth::user()->id;
        try {
            // Validasi data
            $validatedData = $request->validate([
                'namakegiatan' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:1000',
                'volume' => 'required|numeric',
                'satuan' => 'required|string|max:255',
                'tenggat' => 'required|date',
                'pemberitugas_id' => 'required',
                'penerimatugas_id' => 'required',
                'importance_id' => 'required|exists:importances,id',
                'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,jpg,png|max:5120',
            ]);



            // Simpan data
            $task = Task::create([
                'namakegiatan' => $validatedData['namakegiatan'],
                'slug' => "TaskPertama",
                'deskripsi' => $validatedData['deskripsi'],
                'volume' => $validatedData['volume'],
                'satuan' => $validatedData['satuan'],
                'tenggat' => $validatedData['tenggat'],
                'pemberitugas_id' => $pemberitugas_id,
                'penerimatugas_id' => $validatedData['penerimatugas_id'],
                'importance_id' => $validatedData['importance_id'],
                'attachment' => $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null,
            ]);

            // Berhasil
            return response()->json([
                'success' => true,
                'message' => 'Task berhasil disimpan!',
                'task' => $task,
            ], 201);

        } catch (\Exception $e) {
            // Gagal
            return response()->json([
                'success' => false,
                'pemberitugas:' => $pemberitugas_id,
                'message' => 'Terjadi kesalahan saat menyimpan task.',
                'error' => $e->getMessage(), // Opsional: untuk debugging
            ], 500);
        }
    }
}
