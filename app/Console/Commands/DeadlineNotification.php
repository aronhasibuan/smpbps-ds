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
            $message = "🔔 Pengingat! Tugas '{$task->namakegiatan}' harus diselesaikan sebelum besok ({$task->tenggat}). Segera selesaikan ya! 💪";
            $this->notifyService->sendFonnteNotification($user->no_hp, $message);
        }
    }

    public function __construct(protected NotifyService $notifyService)
    {
        parent::__construct();
    }
}
