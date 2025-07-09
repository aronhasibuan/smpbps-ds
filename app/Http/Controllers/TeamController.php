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

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255|unique:teams,team_name,' . $team->id,
            'team_description' => 'required|string|max:1000',
        ]);

        $team->update([
            'team_name' => $validatedData['team_name'],
            'team_description' => $validatedData['team_description'],
        ]);

        return redirect()->route('team-list-page')->with('success', 'Berhasil Memperbarui Tim.');
    }
}