<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Filters\TaskFilter;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() === false)
        {
            return redirect(route('login'));
        }

        $user = Auth::user();
        $userId = Auth::user()->id;

        $filter = $request->all();
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
        $data['created_userId'] = '1';
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
        $tasks = Task::where('created_userId', $id)->get();
        return view('task.mytasks', compact('tasks', 'user'));
    }

}
