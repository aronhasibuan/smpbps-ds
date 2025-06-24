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
        
        $spi = ($pv != 0) ? ($ev / $pv) : 0;

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
                'pv' => $task->task_volume,
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
        $today = Carbon::today();

        if ($endDate->lessThan($startDate)) {
            return 0;
        }

        if ($today->lessThan($startDate)) {
            return 0; 
        }

        if ($today->greaterThan($endDate)) {
            return $task->task_volume; 
        }

        $totalDuration = $startDate->diffInDays($endDate) + 1;
        $elapsedDays = $startDate->diffInDays($today) + 1;

        $plannedProgress = abs($elapsedDays / $totalDuration);

        return ceil($plannedProgress * $task->task_volume);
    }

}