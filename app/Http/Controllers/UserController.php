<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\NotifyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $notifyService;

    // construct notifyservice
    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

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

            $pesan = "Halo {$validatedData['name']} 👋\n";
            $pesan .= "Selamat! Anda telah berhasil terdaftar dalam sistem kami. 🎉\n\n";
            $pesan .= "Berikut detail akun Anda:\n";
            $pesan .= "📧 Email: {$validatedData['email']}\n";
            $pesan .= "🔑 Silakan login menggunakan email dan password yang telah Anda daftarkan.\n\n";
            $pesan .= "Untuk mulai menggunakan sistem, silakan kunjungi:\n";
            $pesan .= "🌐 http://smpbps-ds.test/login\n\n";
            $pesan .= "Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.\n";
            $pesan .= "Terima kasih! 😊";

            $this->notifyService->sendFonnteNotification($validatedData['no_hp'], $pesan);
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

    public function updategeneral(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatepassword(Request $request, User $user)
    {
        $request->validate([
            'currentpassword'       => 'required',
            'newpassword'           => 'required|string|min:8',
            'confirmnewpassword'    => 'required|same:newpassword',
        ]);

        if (!Hash::check($request->currentpassword, $user->password)) {
            return redirect()->route('profilepassword')->with('error', 'Password saat ini salah.');
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->route('profilepassword')->with('success', 'Password berhasil diperbarui.');
    }
}