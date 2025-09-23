<?php

namespace App\Services;

use App\Filters\TaskFilter;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TaskService
{
    public function getTasks(int $userId, array $filter)
    {
        if (empty($filter)) {
            $tasks = Task::where('executor_user_id', $userId)
                ->where('status', '!=', 'выполнено')
                ->with('executor')
                ->with('created_user')
                ->get();
        } else {

            $tasks = TaskFilter::apply(
                Task::where('executor_user_id', $userId)->with('executor')->with('created_user'),
                $filter
            );
        }

        return $tasks;
    }

}
