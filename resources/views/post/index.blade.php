@extends('layouts.main')
@section('content')
    <h2 class="text-center">Сообщения</h2>
    <table class="table table-bordered border-primary">
        <thead>
        <tr class="table-secondary">
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Image</th>
            <th scope="col" class="text-center">Likes</th>
            <th scope="col" class="text-center">Published</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <th scope="row" class="text-center">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->image }}</td>
                <td class="text-center">{{ $post->likes }}</td>
                <td class="text-center">{{ $post->is_published }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection