@extends('Task.main')

@section('content')
<div class="task-content">
    <table class="task-table">
        <thead>
        <tr>
            <th>Имя задачи</th>
            <th>Текст задачи</th>
            <th>Приоритет</th>
            <th>Статус</th>
            <th>Действия</th>
            <th>Автор задачи</th>
            <th>Исполнитель задачи</th>
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
                        @if($user['id'] === $task['executor_user_id'])
                            <button class="button_done" type="submit">Выполнить</button>
                        @endif
                    </form>
                </td>
                <td><span>{{ $task['executor']['name']  }}</span></td>
                <td><span>{{ $task['created_user']['name']  }}</span></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
