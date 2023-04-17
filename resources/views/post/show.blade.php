@extends('layouts.main')
@section('content')
    <h2 class="text-center">Сообщение</h2>
    <div class="w-50" style="margin:auto">
        <p>{{ $post->id }}. <b>{{ $post->title }}</b></p>
        <p>Содержимое: <b>{{ $post->content }}</b></p>
        <p>Изображение: <b>{{ $post->image }}</b></p>
        <p><a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">Изменить</a></p>
        <form action="{{ route('post.delete', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <p><button type="submit" class="btn btn-danger">Удалить</button></p>
        </form>
        <p><a href="{{ route('post.index') }}"><< Back</a></p>
    </div>
@endsection