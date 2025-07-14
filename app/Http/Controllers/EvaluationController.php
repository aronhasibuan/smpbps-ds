<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Progress;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function create(Request $request, $id)
    {
        $progress = Progress::findOrFail($id);
        $task = $progress->task;
        $request->validate([
            'evaluation_tidiness' => 'required',
            'evaluation_comprehensiveness' => 'required',
        ]);
        Evaluation::class::create([
            'task_id' => $task->id,
            'evaluation_tidiness' => $request->evaluation_tidiness,
            'evaluation_comprehensiveness' => $request->evaluation_comprehensiveness,
        ]);
        $progress->progress_acceptance = 1;
        $progress->save();
        $task->status_id = 1;
        $task->save();
        return redirect()->back()->with('success', 'Penilaian tugas berhasil dibuat.');
    }
}
