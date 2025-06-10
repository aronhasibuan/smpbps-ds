<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;

class EVMService
{
    public function calculateSPI($task)
    {
        $ev = $task->task_latest_progress; 
        $pv = $this->calculatePlannedValue($task);
        
        $spi = ($pv != 0) ? floor(($ev / $pv) * 10) / 10 : 0;

        if($ev == $task->task_volume) {
            return [
                'spi' => 1,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Selesai',
                'color' => 'blue' 
            ]; 
        }
        elseif (Carbon::parse($task->activity->activity_end)->isPast()) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Terlambat',
                'color' => 'black'
            ];
        }
        elseif ($spi < 1 && $ev < $task->task_volume) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Progress Lambat',
                'color' => 'red'
            ];
        } elseif ($spi == 1 && $ev < $task->task_volume) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Progress On Time',
                'color' => 'yellow'
            ];
        } elseif ($spi > 1 && $ev < $task->task_volume) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Progress Cepat',
                'color' => 'green'
            ];
        }
    }

    public function calculatePlannedValue(Task $task)
    {
        $startDate = Carbon::parse($task->activity->activity_start);
        $endDate = Carbon::parse($task->activity->activity_end);
        $today = Carbon::now();

        if ($today->lessThan($startDate)) {
            return 0; 
        }

        if ($today->greaterThan($endDate)) {
            return $task->task_volume; 
        }

        $totalDuration = $endDate->diffInDays($startDate);
        $elapsedDays = $today->diffInDays($startDate);

        $plannedProgress = $elapsedDays / $totalDuration;

        return $plannedProgress * $task->task_volume;
    }

}