<?php

namespace App\Http\Controllers;

use App\Models\Progress;

class ProgressController extends Controller
{
    public function approve_progress($id)
    {
        $progress = Progress::findOrFail($id);

        $progress->progress_acceptance = 1;
        $progress->save();

        $task = $progress->task;
        $task->task_latest_progress = $progress->progress_amount;
        $task->save();

        session()->flash('success', 'Progress telah disetujui.');
        return redirect()->back();
    }

    public function reject_progress($id)
    {
        $progress = Progress::findOrFail($id);

        $progress->delete();

        session()->flash('success', 'Progress telah ditolak.');
        return redirect()->back();
    }
}