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
        if (Auth::check())
        {
            return redirect(route('login'));
        }

        $user = Auth::user();
        $userId = $user->id;

        $filter = $request->all();
        if (empty($filter)) {
            $tasks = Task::where('executor_user_id', $userId)
                ->where('status', '!=', 'выполнено')
                ->with('executor')
                ->get();
        } else {

            $tasks = TaskFilter::apply(
                Task::where('executor_user_id', $userId)->with('executor'),
                $filter
            );
        }

        return view('task.index', compact('tasks', 'user'));

    }

    public function create()
    {
        $users = User::all()->toArray();
        return view('task.create', compact('users'));
    }

    public function store(Request $request) {
        $data = $request->array();
        $data['created_userId'] = '1';
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::find($id)->toArray();
        return view('task.edit', compact('task'));
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

    }

}
