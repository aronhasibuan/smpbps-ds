<?php

namespace App\Http\Controllers;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // create team
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255|unique:teams,team_name',
            'team_description' => 'required|string|max:1000',
        ]);

        $team = Team::create([
            'team_name' => $validatedData['team_name'],
            'team_description' => $validatedData['team_description'],
        ]);

        return redirect()->route('team-list-page')->with('success', 'Berhasil Menambahkan Tim.');
    }
}