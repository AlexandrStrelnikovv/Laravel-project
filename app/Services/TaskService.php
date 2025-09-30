<?php

namespace App\Services;

use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\Filters\TaskFilter;
use App\Models\Task;


class TaskService
{
    public function getTasks(int $userId, array $filter = [])
    {
        if (empty($filter)) {
            $tasks = Task::where('executor_user_id', $userId)
                ->where('status', '!=', 'выполнено')
                ->with('executor')
                ->with('created_user')
                ->get();
            return $tasks;
        } else {

            $tasks = TaskFilter::apply(
                Task::where('executor_user_id', $userId)->with('executor')->with('created_user'),
                $filter
            );
            return $tasks;
        }
    }

    public function createTask(CreateTaskDTO $TaskDTO, int $userID)
    {
        $task = Task::create([
            'name' => $TaskDTO->name,
            'description' => $TaskDTO->description,
            'priority' => $TaskDTO->priority,
            'created_user_Id' => $userID,
            'executor_user_id' => $TaskDTO->executor_user_id,
        ]);
        return true;
    }

    public function updateTask(int $id, UpdateTaskDTO $taskDTO)
    {
        $task = Task::find($id);
        $task->update(
            [
                'name' => $taskDTO->name,
                'description' => $taskDTO->description,
                'priority' => $taskDTO->priority,
            ]
        );
        return true;
    }

    public function completedTask(int $id)
    {
        $task = Task::find($id);
        $task->status = 'выполнено';
        $task->save();
        return true;
    }

}
