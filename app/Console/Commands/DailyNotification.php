<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Services\NotifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi Harian Pekerjaan Aktif';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $tasks = Task::where('active', true)->get()->groupBy('penerimatugas_id');

        foreach ($tasks as $penerimatugas_id => $taskList) {
            $user = User::find($penerimatugas_id);
            
            if (!$user || !$user->no_hp) {
                continue;
            }

            $prioritasUtama = $taskList->sortBy('tenggat')->first();

            $pesan = "Halo {$user->name} 👋\n";
            $pesan .= "Berikut adalah *pengingat harian* Anda terkait tugas yang masih perlu diselesaikan hari ini. 📅\n\n";

            $pesan .= "🔥 *Prioritas Utama (Deadline Terdekat):*\n";
            $pesan .= "1️⃣ *{$prioritasUtama->namakegiatan}*\n";
            $pesan .= "🗓️ Tenggat: {$prioritasUtama->tenggat}\n";
            $pesan .= "📝 Deskripsi: {$prioritasUtama->tenggat}\n\n";

            $pesan .= "📋 *Tugas Lainnya:*\n";
            $i = 2;
            foreach ($taskList as $task) {
                $pesan .= "{$i}️⃣ *{$task->namakegiatan}* – Tenggat: {$task->tenggat}\n";
                $i++;
            }

            $pesan .= "\n🌐 Silakan cek dan kelola semua tugas Anda di sistem:\n";
            $pesan .= "http://smpbps-ds.test/login\n\n";
            $pesan .= "Tetap semangat dan jangan lupa tandai tugas yang sudah selesai ya! ✅";

            $this->notifyService->sendFonnteNotification($user->no_hp, $pesan);
        }
    }


    public function __construct(protected NotifyService $notifyService)
    {
        parent::__construct();
    }
}
