@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">All Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Create New Post</a>

    <ul class="list-group">
        @foreach ($posts as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
