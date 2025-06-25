<div class="ml-{{ $comment->depth * 4 }} mt-2 border-l-2 pl-2">
    <p>{{ $comment->content }}</p>

    @if ($comment->depth < 3)
        <form method="POST" action="{{ route('comments.store') }}" class="mt-1">
            @csrf
            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
            <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
            <textarea name="content" required placeholder="Reply..."></textarea>
            <button type="submit">Reply</button>
        </form>
    @endif

    @foreach ($comment->replies as $reply)
        @include('comments.partials.comment', ['comment' => $reply])
    @endforeach
</div>
