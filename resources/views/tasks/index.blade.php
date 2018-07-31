@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($tasklist) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>タスク名</th>
                <th>進捗</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasklist as $task)
            <tr>
                <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                <td>{{ $task->content }}</td>
                <td>進捗{{ $task->status }}％</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    
    {!! link_to_route('tasks.create', '新規タスクの登録', null, ['class' => 'btn btn-primary']) !!}

@endsection