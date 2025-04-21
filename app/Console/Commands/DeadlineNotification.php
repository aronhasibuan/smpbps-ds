<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Services\NotifyService;
use Illuminate\Console\Command;

class DeadlineNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deadline-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi Deadline Satu Hari';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('active', true)->get();

        // Tentukan batas deadline (besok)
        $besok = Carbon::tomorrow()->toDateString();

        foreach ($tasks as $task) {
            // Jika deadline bukan besok, skip
            if ($task->tenggat != $besok) {
                continue;
            }

            // Ambil data user berdasarkan penerimatugas_id
            $user = User::find($task->penerimatugas_id);
            if (!$user || !$user->no_hp) {
                continue;
            }

            // Format pesan pengingat
            $pesan = "Halo {$user->name} 👋\n";
            $pesan .= "Pengingat! ⏰ Anda memiliki tugas yang akan segera *mencapai tenggat waktu*.\n\n";
            $pesan .= "📌 *Nama Kegiatan*: {$task->namakegiatan}";
            $pesan .= "📆 *Tenggat Waktu*: {$task->tenggat}";
            $pesan .= "📝 *Deskripsi*: {$task->deskripsi}";
            $pesan .= "Mohon segera ditindaklanjuti agar tidak melewati batas waktu yang ditentukan.\n";
            $pesan .= "🌐 Cek tugas di: http://smpbps-ds.test/login\n\n";
            $pesan .= "Jika sudah diselesaikan, harap update statusnya di sistem.\n";
            $pesan .= "Terima kasih dan semangat terus! 💪";
            
            $this->notifyService->sendFonnteNotification($user->no_hp, $pesan);
        }
    }

    public function __construct(protected NotifyService $notifyService)
    {
        parent::__construct();
    }
}
