<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'activity_name' => 'required|string',
            'activity_end' => 'required|date',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->activity_name = $validatedData['activity_name'];
        $activity->activity_end = $validatedData['activity_end'];
        $activity->save();
                    
        session()->flash('updated', 'Kegiatan berhasil diperbarui');
        return redirect()->back();   
    }

    // mark kegiatan as done
    public function mark_activity_as_done($id)
    {
        $activity = Activity::findOrFail($id);

        if (!$activity->activity_active_status) {
            return redirect()->back()->with('error', 'Kegiatan ini sudah ditandai selesai sebelumnya.');
        }

        $unfinishedTasks = $activity->tasks()->where('status_id', 2)->count();
        if ($unfinishedTasks > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menandai kegiatan selesai karena masih ada tugas yang belum selesai.');
        }

        $activity->activity_active_status = false;
        $activity->save();

        return redirect()->route('activities-monitoring-page')->with('success', 'Kegiatan berhasil ditandai selesai!');
    }
}