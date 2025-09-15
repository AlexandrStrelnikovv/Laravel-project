@extends('Task.main')

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
                <select class="card-title" name="priority">
                    <option value="низкий">низкий</option>
                    <option value="высокий">средний</option>
                    <option value="срочный">высокий</option>
                </select>
            </div>
            <div>
                <label>Исполнитель</label>
                <select class="form-select" name="executor_user_id">
                    <option value="" hidden=""></option>
                    @foreach($users as $user)
                        <option value="{{$user['id']}}">{{ $user['name'] }}</option>
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
