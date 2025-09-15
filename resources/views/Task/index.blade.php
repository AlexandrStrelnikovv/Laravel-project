@extends('Task.main')

@section('content')
<div class="task-content">
        <form action="{{ route('tasks.filter') }}" method="get" class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label" for="name">Имя задачи</label>
                <input class="form-control" type="text" name="name" value="{{  request('name') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label" for="priority">Приоритет</label>
                <select class="form-select" name="priority" id="priority">
                    <option hidden=""></option>
                    <option value="низкий">низкий</option>
                    <option value="средний">средний</option>
                    <option value="высокий">высокий</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label" for="status">Статус</label>
                <select class="form-select" name="status" id="status">
                    <option value="выполняется">выполняется</option>
                    <option value="выполнено">выполнено</option>
                </select>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <input class="btn btn-primary" type="submit" value="Поиск">
            </div>
        </form>

    <table class="task-table">
        <thead>
        <tr>
            <th>Имя задачи</th>
            <th>Текст задачи</th>
            <th>Приоритет</th>
            <th>Статус</th>
            <th>Действия</th>
            <th>Автор задачи</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>

                <td>{{ $task['name'] }}</td>
                <td>{{ $task['description'] }}</td>
                <td><span class="priority">{{ $task['priority'] }}</span></td>
                <td>{{ $task['status'] }}</td>
                <td>
                    <a class="done-link" href="{{ route('task.edit', ['id' => $task['id']]) }}">Редактировать</a>
                    <form method="POST" action="{{ route('tasks.completed', ['id' => $task['id']]) }}">
                        @csrf
                        @method('PUT')
                        <button class="button_done" type="submit">Выполнить</button>
                    </form>
                </td>
                <td><span >{{$task['executor']['name']}}</span></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
