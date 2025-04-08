<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function update(Request $request, Kegiatan $kegiatan){
        try{
            $validatedData = $request->validate([
                'namakegiatan' => 'required|string',
                'tenggat' => 'required|date',
            ]);

            $kegiatan->namakegiatan = $validatedData['namakegiatan'];
            $kegiatan->tenggat = $validatedData['tenggat'];
            $kegiatan->save();

            $kegiatan->tasks()->update([
                'namakegiatan' => $validatedData['namakegiatan'],
                'tenggat' => $validatedData['tenggat'],
            ]);
                        
            session()->flash('updated', 'Kegiatan dan semua tugas terkait berhasil diperbarui');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error', 'Gagal memperbarui Kegiatan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
