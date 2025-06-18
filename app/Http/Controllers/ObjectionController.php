<?php

namespace App\Http\Controllers;

use App\Models\Objection;
use Illuminate\Http\Request;

class ObjectionController extends Controller
{
    public function create(Request $request, $user_role, $task_slug, $id)
    {
        $request->validate([
            'objection_reason' => 'required|string|max:1000',
        ]);

        Objection::create([
            'task_id' => $id,
            'objection_reason' => $request->objection_reason,
            'objection_status' => 'Tertunda'
        ]);

        return redirect()->back()->with('updated', 'Keberatan berhasil diajukan!');
    }
}
