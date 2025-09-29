<?php

namespace App\Http\Controllers;

use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\Models\User;
use App\Services\TaskService;
use App\Services\UserService;
use App\Services\ValidateService;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Filters\TaskFilter;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected TaskService $taskService;
    public function __construct(TaskService $taskService )
    {
        $this->taskService = $taskService;
    }
    public function index(Request $request)
    {
        $user = UserService::getUser();
        $filter = $request->all();

        $tasks = $this->taskService->getTasks($user['id'], $filter);

        return view('task.index', compact('tasks', 'user'));

    }

    public function create()
    {
        $user = UserService::getUser();
        $executors = UserService::getUsers();
        return view('task.create', compact('executors', 'user'));
    }

    public function store(Request $request) {
        $validate = ValidateService::ValidateTask($request);
        $userId = UserService::getUserId();
        if(!$validate['success'])
            {
                return redirect()->back()->withErrors($validate['errors'])->withInput();
            }
        $TaskDTO = CreateTaskDTO::fromArray($validate['validData']);
        $this->taskService->createTask($TaskDTO, $userId);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $user = UserService::getUser();
        $task = $this->taskService->getTask($id);
        return view('task.edit', compact('task', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validate = ValidateService::ValidateUpdatedTask($request);
        if(!$validate['success'])
        {
            return redirect()->back()->withErrors($validate['errors'])->withInput();
        }
        $taskDTO = UpdateTaskDTO::fromArray($validate['validData']);
        $taskUpdated = TaskService::updateTask($id, $taskDTO);
        return redirect()->route('tasks.index');
    }

    public function completed($id)
    {
        TaskService::completedTask($id);
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $user = UserService::getUser();
        $tasks = TaskService::getTask($user['id']);
        return view('task.tasks', compact('tasks', 'user'));
    }

}
