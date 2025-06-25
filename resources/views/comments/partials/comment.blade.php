<div class="ms-{{ $comment->depth * 3 }} mt-3 border-start ps-3">
    <div class="card mb-2">
        <div class="card-body py-2">
            <p class="mb-1">{{ $comment->content }}</p>

            @if ($comment->depth < 3)
                <form method="POST" action="{{ route('comments.store') }}" class="mt-2">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                    <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                    <div class="mb-2">
                        <textarea name="content" class="form-control" placeholder="Reply..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Reply</button>
                </form>
            @endif
        </div>
    </div>

    {{-- Render nested replies recursively --}}
    @foreach ($comment->replies as $reply)
        @include('comments.partials.comment', ['comment' => $reply])
    @endforeach
</div>
