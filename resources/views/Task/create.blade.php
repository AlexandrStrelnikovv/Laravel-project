@extends('task.main')

@section('content')
    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="task-content">
            <div class="task-create">
                <div>
                    <input class="card-title" type="text" name="name" placeholder="Название задачи">
                </div>
                <div>
                    <input class="card-title" type="text" name="description" placeholder="Текст задачи">
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
                    <label>Исполнитель</label>
                    <select class="form-select" name="executor_user_id">
                        <option value="" hidden=""></option>
                        @foreach($executors as $executor)
                            <option value="{{$executor['id']}}">{{ $executor['name'] }}</option>
                        @endforeach
                    </select>

                </div>
                <div>
                    <input type="submit" class="btn btn-success btn-sm">
                </div>
            </div>
        </div>
    </form>
@endsection
