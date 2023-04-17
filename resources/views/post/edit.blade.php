@extends('layouts.main')
@section('content')
    <h2 class="text-center">Изменить сообщение</h2>
    <div class="w-50" style="margin:auto">
    <form action="{{ route('post.update', $post->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок:</label>
            <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="title" placeholder="Введите заголовок">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Содержимое:</label>
            <textarea name="content" class="form-control" id="content" placeholder="Текст сообщения">{{ $post->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="text" name="image" value="{{ $post->image }}" class="form-control" id="image" placeholder="Введите адрес картинки">
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
    </div>
@endsection