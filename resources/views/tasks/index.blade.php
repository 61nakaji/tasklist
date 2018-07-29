@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($tasklist) > 0)
        <ul>
            @foreach ($tasklist as $task)
                <li>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!} : {{ $task->content }} : 進捗{{ $task->status }}％</li>
            @endforeach
        </ul>
    @endif
    
    {!! link_to_route('tasks.create', '新規タスクの登録') !!}

@endsection