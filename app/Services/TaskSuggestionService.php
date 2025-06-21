<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;

class TaskSuggestionService
{

    public function getTaskSuggestion($user)
    {
        $EVMService = new EVMService();
        $maxDailyCapacity = 1.5;
        $currentTotalPercentage = 0;
        $filteredTasks = collect();

        $tasks = Task::where('user_member_id', $user->id)->where('status_id', 2)->get();

        foreach ($tasks as $task){
            $task->spi_data = $EVMService->calculateSPI($task);
            $task->volumesuggestion = ceil($this->getRemainingVolume($task));
            $task->volumesuggestionpercentage = $task->volumesuggestion / $task->task_volume;
        }

        $tasks = $tasks->sortBy(function($task) {
                return $task->spi_data['spi'];
        })->values();

        foreach ($tasks as $task) {
        if (($currentTotalPercentage + $task->volumesuggestionpercentage) <= $maxDailyCapacity) {
            $currentTotalPercentage += $task->volumesuggestionpercentage;
            $filteredTasks->push($task);
        } else {
            break;
        }
    }

        return $filteredTasks;
    }

    public function getRemainingVolume($task)
    {
        $remainingvolume = $task->task_volume - $task->task_latest_progress;
        $taskperday = $this->getTaskPerDay($task);

        if($task->spi_data['status'] === 'Terlambat'){
            return $remainingvolume;
        } elseif($task->spi_data['status'] === 'Progress Lambat'){
            return $task->spi_data['pv'] - $task->task_latest_progress;
        } elseif($task->spi_data['status'] === 'Progress On Time'){
            return $taskperday;
        } elseif($task->spi_data['status'] === 'Progress Cepat' && $remainingvolume < $taskperday){
            return $remainingvolume;
        } else{
            return $taskperday;
        }
    }

    public function getTaskPerDay($task)
    {
        $startDate = Carbon::parse($task->activity->activity_start);
        $endDate = Carbon::parse($task->activity->activity_end);

        $totalDuration = $startDate->diffInDays($endDate) + 1;

        $plannedProgress = 1 / $totalDuration;

        return $plannedProgress * $task->task_volume;
    }
}