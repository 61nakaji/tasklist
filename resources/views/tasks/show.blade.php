@extends('layouts.app')

@section('content')

    <h1>id = {{ $tasklist -> id}} のタスク詳細ページ</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>{{ $tasklist->id }}</th>
        </tr>
        <tr>
            <td>タスク名</td>
            <td>{{ $tasklist->content }}</td>
        </tr>
        <tr>
            <td>進捗</td>
            <td>{{ $tasklist->status }}％</td>
        </tr>
    </table>
    
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $tasklist->id], ['class' => 'btn btn-default']) !!}
    
    
    {!! Form::model($tasklist, ['route' => ['tasks.destroy', $tasklist->id], 'method'=> 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection