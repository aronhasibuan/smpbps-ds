<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;

class Evaluation_EVMService
{
    public function calculateSPI($task, $task_progress_date, $task_progress_amount)
    {
        $ev = $task_progress_amount; 
        $pv = $this->calculatePlannedValue($task, $task_progress_date);
        
        $spi = ($pv != 0) ? ($ev / $pv) : 0;

        if($ev == $task->task_volume) {
            return [
                'spi' => 1,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Selesai',
                'color' => 'blue', 
                'poin' => 1.00
            ]; 
        }
        elseif (Carbon::parse($task_progress_date)->gt(Carbon::parse($task->activity->activity_end))) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $task->task_volume,
                'status' => 'Terlambat',
                'color' => 'black',
                'poin' => 0.00
            ];
        }
        elseif ($spi < 1 && $ev < $task->task_volume) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Progress Lambat',
                'color' => 'red',
                'poin' => 0.25
            ];
        } elseif ($spi == 1 && $ev < $task->task_volume) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Progress On Time',
                'color' => 'yellow',
                'poin' => 0.50
            ];
        } elseif ($spi > 1 && $ev < $task->task_volume) {
            return [
                'spi' => $spi,
                'ev' => $ev,
                'pv' => $pv,
                'status' => 'Progress Cepat',
                'color' => 'green',
                'poin' => 0.75
            ];
        }
    }

    public function calculatePlannedValue(Task $task, $task_progress_date)
    {
        $startDate = Carbon::parse($task->activity->activity_start);
        $endDate = Carbon::parse($task->activity->activity_end);

        if ($endDate->lessThan($startDate)) {
            return 0;
        }

        if ($task_progress_date->lessThan($startDate)) {
            return 0; 
        }

        if ($task_progress_date->greaterThan($endDate)) {
            return $task->task_volume; 
        }

        $totalDuration = $startDate->diffInDays($endDate) + 1;
        $elapsedDays = $startDate->diffInDays($task_progress_date) + 1;

        $plannedProgress = abs($elapsedDays / $totalDuration);

        return ceil($plannedProgress * $task->task_volume);
    }

}