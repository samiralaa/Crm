<?php

namespace App\Services;

use App\Queries\TasksQueries;

/**
 * Class TasksService
 *
 * Service class for handling operations related to the TasksModel.
 */
class TasksService
{
    /**
     * Load all completed tasks with percentage.
     *
     * @return string
     */
    public function loadCompletedTasks(): string
    {
        $countCompletedTasks = TasksQueries::getCountCompleted();
        $countAllTasks = TasksQueries::countAll();
    
        $percentage = $countAllTasks > 0 ? round(($countCompletedTasks / $countAllTasks) * 100) : 0;
    
        return $countCompletedTasks . ' (' . $percentage . '%)';
    }
    
    

    /**
     * Load all uncompleted tasks with percentage.
     *
     * @return string A string representing the number of uncompleted tasks and their percentage of the total tasks.
     */
    public function loadUncompletedTasks(): string
    {
        $uncompletedTasksCount = TasksQueries::getAllUncompletedTasks();
        $countAllTasks = TasksQueries::countAll();

        $percentage = round(($uncompletedTasksCount / $countAllTasks) * 100);

        return $uncompletedTasksCount . ' (' . $percentage .  '%)';
    }

    /**
     * Format tasks for display.
     *
     * @return array
     */
    public function formatTasks(): array
    {
        $tasks = TasksQueries::getAllForFormat();

        $arrayWithFormattedTasks = [];

        foreach ($tasks as $key => $task) {
            $nameTask = substr($task->name, 0, 70);
            $nameTask .= '[..]';

            $arrayWithFormattedTasks[$key] = [
                'id' => $task->id,
                'name' => $nameTask,
                'duration' => $task->duration,
                'created_at' => $task->created_at
            ];
        }

        return $arrayWithFormattedTasks;
    }
}
