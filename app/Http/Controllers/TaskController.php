<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TaskService;
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
        $user = Auth::user();
        $userId = Auth::user()->id;
        $filter = $request->all();
        $tasks = $this->taskService->getTasks($userId, $filter);

        return view('task.index', compact('tasks', 'user'));

    }

    public function create()
    {
        $user = Auth::user();
        $executors = User::all()->toArray();
        return view('task.create', compact('executors', 'user'));
    }

    public function store(Request $request) {
        $data = $request->array();
        $data['created_user_Id'] = '1';
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $task = Task::find($id);
        return view('task.edit', compact('task', 'user'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->all());
        return redirect()->route('tasks.index');
    }

    public function completed($id)
    {
        $task = Task::find($id);
        $task->status = 'выполнено';
        $task->save();
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $user = Auth::user();
        $tasks = Task::where('created_user_Id', $id)->get();
        return view('task.mytasks', compact('tasks', 'user'));
    }

}
