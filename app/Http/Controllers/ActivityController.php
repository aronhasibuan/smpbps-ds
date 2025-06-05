<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function update(Request $request, Activity $activity){
        try{
            $validatedData = $request->validate([
                'activity_name' => 'required|string',
                'activity_end' => 'required|date',
            ]);

            $activity->activity_name = $validatedData['activity_name'];
            $activity->activity_end = $validatedData['activity_end'];
            $activity->save();
                        
            session()->flash('updated', 'Kegiatan berhasil diperbarui');
            return redirect()->back();
        }catch (\Exception $e){
            session()->flash('error', 'Gagal memperbarui Kegiatan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
