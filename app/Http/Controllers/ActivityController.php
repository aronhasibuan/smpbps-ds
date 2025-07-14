<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'activity_name' => 'required|string',
            'activity_unit' => 'required|string',
            'activity_end' => 'required|date',
        ]);
        $activity = Activity::findOrFail($id);
        if ($validatedData['activity_end'] < $activity->activity_start) {
            session()->flash('error', 'Tenggat kegiatan tidak boleh kurang dari tanggal mulai kegiatan');
            return redirect()->back();
        }
        $activity->activity_name = $validatedData['activity_name'];
        $activity->activity_unit = $validatedData['activity_unit'];
        $activity->activity_end = $validatedData['activity_end'];
        $activity->save();         
        session()->flash('updated', 'Kegiatan berhasil diperbarui');
        return redirect()->back();   
    }

    // mark kegiatan as done
    public function mark_activity_as_done($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->activity_active_status = false;
        $activity->save();
        return redirect()->route('activities-monitoring-page')->with('success', 'Kegiatan berhasil ditandai selesai!');
    }
}