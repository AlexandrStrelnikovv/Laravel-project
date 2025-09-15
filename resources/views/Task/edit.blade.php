@extends('Task.main')

@section('content')
<div class="container mt-4">
    <form action="{{ route('task.update', ['id' => $task['id']]) }}" method="post">
    @csrf
    @method('PUT')
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <div>
                                <label>Имя</label>
                                <input type="text" name="name" value="{{ $task['name'] }}">
                            </div>
                            <div>
                                <label>Текст</label>
                                <input type="text" name="description" value="{{ $task['description'] }}">
                            </div>
                            <div>
                                <label>Приоритет</label>
                                <select class="card-title" name="priority">
                                    <option value="низкий">низкий</option>
                                    <option value="высокий">высокий</option>
                                    <option value="срочный">срочный</option>
                                </select>
                            </div>
                            <div><input type="submit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
