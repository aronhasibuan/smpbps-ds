<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Task;
use Carbon\Carbon;

class EVMService
{
    // Menghitung SPI Task
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

    // Menghitung Planned Value Task
    public function calculatePlannedValue(Task $task)
    {
        $startDate = Carbon::parse($task->activity->activity_start);
        $endDate = Carbon::parse($task->activity->activity_end);
        $today = Carbon::today();

        if ($today->greaterThan($endDate)) {
            return $task->task_volume; 
        }

        $totalDuration = $startDate->diffInDays($endDate) + 1;
        $elapsedDays = $startDate->diffInDays($today) + 1;

        $plannedProgress = abs($elapsedDays / $totalDuration);

        return ceil($plannedProgress * $task->task_volume);
    }

    // Menghitung SPI Activity
    public function calculateActivitySPI(Activity $activity): array
    {
        $totalEV = 0;
        $totalPV = 0;
        $today = Carbon::today()->startOfDay();
        $activityEnd = Carbon::parse($activity->activity_end)->endOfDay();

        foreach($activity->tasks as $task){
            $totalEV += $task->task_latest_progress;
            $totalPV += $this->calculatePlannedValue($task);
        }

        $spi = ($totalEV / $totalPV);
        $progressPercentage = $activity->total_progress;

        if ($totalEV == $activity->tasks->sum('task_volume')) {
            return [
                'spi' => 1,
                'ev' => $totalEV,
                'pv' => $totalPV,
                'progressPercentage' => $progressPercentage,
                'status' => 'Selesai',
                'color' => 'blue'
            ];
        } elseif ($today->greaterThan($activityEnd)) {
            return [
                'spi' => $spi,
                'ev' => $totalEV,
                'pv' => $totalPV,
                'progressPercentage' => $progressPercentage,
                'status' => 'Terlambat',
                'color' => 'black'
            ];
        } elseif ($spi < 1) {
            return [
                'spi' => $spi,
                'ev' => $totalEV,
                'pv' => $totalPV,
                'progressPercentage' => $progressPercentage,
                'status' => 'Progress Lambat',
                'color' => 'red'
            ];
        } elseif ($spi == 1) {
            return [
                'spi' => $spi,
                'ev' => $totalEV,
                'pv' => $totalPV,
                'progressPercentage' => $progressPercentage,
                'status' => 'Progress On Time',
                'color' => 'yellow'
            ];
        } elseif ($spi > 1) {
            return [
                'spi' => $spi,
                'ev' => $totalEV,
                'pv' => $totalPV,
                'progressPercentage' => $progressPercentage,
                'status' => 'Progress Cepat',
                'color' => 'green'
            ];
        }

        return [
            'spi' => $spi,
            'ev' => $totalEV,
            'pv' => $totalPV,
            'status' => 'Tidak Diketahui',
            'color' => 'gray'
        ];
    }
}