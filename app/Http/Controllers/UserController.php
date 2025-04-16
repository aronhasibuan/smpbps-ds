<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // create user
    public function create(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|string|in:ketuatim,anggotatim',
                'password' => 'required|string|min:8',
                'no_hp' => 'required|string|max:15',
            ]);
    
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
                'password' => bcrypt($validatedData['password']),
                'no_hp' => $validatedData['no_hp'],
            ]);
            return redirect('administrator')->with('success', 'Berhasil Menambahkan Pengguna.');

        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }

    // update user
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:administrator,ketuatim,anggotatim',
            'no_hp' => 'required|string|max:15',
        ]);

        $user->update($validatedData);

        return redirect()->route('administrator')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('administrator')->with('success', 'Pengguna berhasil dihapus.');
    }
}