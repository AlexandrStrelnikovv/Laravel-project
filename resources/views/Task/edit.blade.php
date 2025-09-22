@extends('task.main')

@section('content')
    <div class="task-content">
        <form action="{{ route('task.update', ['id' => $task['id']]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="task-content">
                <div class="task-create">
                    <div>
                        <input class="card-title" type="text" name="name" placeholder="{{ $task['name'] }}">
                    </div>
                    <div>
                        <input class="card-title" type="text" name="description" placeholder="{{ $task['description'] }}">
                    </div>
                    <div>
                        <label>Приоритет</label>
                        <select class="card-title" name="priority">
                            <option value="низкий">низкий</option>
                            <option value="средний">средний</option>
                            <option value="высокий">высокий</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success btn-sm">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
