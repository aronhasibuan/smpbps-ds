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
                Log::error("User dengan ID $penerimatugas_id tidak memiliki nomor HP.");
                continue;
            }

            $message = "Semangat Pagi! Daftar tugas aktif milik Anda:\n";
            foreach ($taskList as $task) {
                $message .= "- {$task->namakegiatan}\n";
            }

            Log::info("Mengirim pesan ke {$user->no_hp} dengan isi:\n$message");
            $this->notifyService->sendFonnteNotification($user->no_hp, $message);
        }
    }


    public function __construct(protected NotifyService $notifyService)
    {
        parent::__construct();
    }
}
