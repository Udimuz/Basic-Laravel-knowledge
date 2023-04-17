@extends('layouts.main')
@section('content')
    <h2 class="text-center">Новое сообщение</h2>
    <div class="w-50" style="margin:auto">
    <form action="{{ route('post.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок:</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Введите заголовок">
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Содержимое:</label>
            <textarea name="content" class="form-control" id="content" placeholder="Текст сообщения">{{ old('content') }}</textarea>
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="text" name="image" class="form-control" id="image" placeholder="Введите адрес картинки">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
    </div>
@endsection