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

    // create employee
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_full_name' => 'required|string|max:255',
            'user_nickname' => 'required|string|max:255|unique:users,user_nickname',
            'user_role' => 'required|string|in:ketuatim,anggotatim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'user_whatsapp_number' => 'required|string|max:15',
        ]);
        $user = User::create([
            'team_id' => $validatedData['team_id'],
            'user_full_name' => $validatedData['user_full_name'],
            'user_nickname' => $validatedData['user_nickname'],
            'user_role' => $validatedData['user_role'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'user_whatsapp_number' => $validatedData['user_whatsapp_number'],
        ]);
        $pesan = "Halo {$validatedData['user_full_name']} 👋\n";
        $pesan .= "Selamat! Anda telah berhasil terdaftar dalam sistem kami. 🎉\n\n";
        $pesan .= "Berikut detail akun Anda:\n";
        $pesan .= "📧 Email: {$validatedData['email']}\n";
        $pesan .= "🔑 Silakan login menggunakan email dan password yang telah Anda daftarkan.\n\n";
        $pesan .= "Untuk mulai menggunakan sistem, silakan kunjungi:\n";
        $pesan .= "🌐 http://smpbps-ds.test/login\n\n";
        $pesan .= "Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.\n";
        $pesan .= "Terima kasih! 😊";
        $this->notifyService->sendFonnteNotification($validatedData['user_whatsapp_number'], $pesan);
        return redirect()->route('employee-list-page')->with('success', 'Berhasil Menambahkan Pengguna.');
    }

    // update employee
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'user_full_name' => 'required|string|max:255',
            'team_id' => 'required|exists:teams,id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'user_role' => 'required|string|in:administrator,ketuatim,anggotatim',
            'user_whatsapp_number' => 'required|string|max:15',
        ]);
        $user->update($validatedData);
        return redirect()->route('employee-list-page')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // delete employee
    public function delete(User $user)
    {
        $targetMemberId = 3;
        if($user->user_role == 'ketuatim'){
            return redirect()->route('employee-list-page')->with('error', 'Maaf, anda tidak dapat menghapus akun ketua tim.');
        } else {
            $user->tasks()->each(function ($task) {
                $task->progress()->delete();
                $task->evaluation()->delete();
                $task->objection()->delete();
                $task->delete();
            });
            $user->delete();
            return redirect()->route('employee-list-page')->with('success', 'Pengguna berhasil dihapus.');
        }
    }

    // update password
    public function update_password(Request $request, User $user)
    {
        $request->validate([
            'currentpassword'       => 'required',
            'newpassword'           => 'required|string|min:8',
            'confirmnewpassword'    => 'required|same:newpassword',
        ]);

        if (!Hash::check($request->currentpassword, $user->password)) {
            return redirect()->route('profile-page')->with('error', 'Password saat ini salah.');
        } else{
            $user->password = Hash::make($request->newpassword);
            $user->save();  
            return redirect()->route('profile-page')->with('success', 'Password berhasil diperbarui.');
        }
    }
}