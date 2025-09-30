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
    protected UserService $userService;
    protected ValidateService $validateService;
    public function __construct(TaskService $taskService, UserService $userService, ValidateService $validateService )
    {
        $this->taskService = $taskService;
        $this->userService = $userService;
        $this->validateService = $validateService;
    }
    public function index(Request $request)
    {
        $user = $this->userService->getUser();
        $filter = $request->all();

        $tasks = $this->taskService->getTasks($user['id'], $filter);

        return view('task.index', compact('tasks', 'user'));

    }

    public function create()
    {
        $user = $this->userService->getUser();
        $executors = $this->userService->getUsers();
        return view('task.create', compact('executors', 'user'));
    }

    public function store(Request $request) {
        $validate = $this->validateService->ValidateTask($request);
        $userId = $this->userService->getUserId();
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
        $user = $this->userService->getUser();
        $task = $this->taskService->getTask($id);
        $data =
            [
              'user' => $user,
              'task' => $task,
            ];
        return view('task.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->validateService->ValidateUpdatedTask($request);
        if(!$validate['success'])
        {
            return redirect()->back()->withErrors($validate['errors'])->withInput();
        }
        $taskDTO = UpdateTaskDTO::fromArray($validate['validData']);
        $taskUpdated = $this->taskService->updateTask($id, $taskDTO);
        return redirect()->route('tasks.index');
    }

    public function completed($id)
    {
        $this->taskService->completedTask($id);
        return redirect()->route('tasks.index');
    }

    public function getMyTasks()
    {
        $user = $this->userService->getUser();
        $tasks = $this->taskService->getTask($user['id']);
        return view('task.tasks', compact('tasks', 'user'));
    }

}
