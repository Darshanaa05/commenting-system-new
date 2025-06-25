@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        </div>
        <div class="col-6 float-left">
            <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Create New Post</a>
        </div>
    </div>

    <hr>

    <h4>Add a Comment</h4>
    <form method="POST" action="{{ route('comments.store') }}" class="mb-4">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="mb-2">
            <textarea name="content" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>

    <h4>Comments</h4>
    @foreach ($post->comments as $comment)
        @include('comments.partials.comment', ['comment' => $comment])
    @endforeach
</div>
@endsection
