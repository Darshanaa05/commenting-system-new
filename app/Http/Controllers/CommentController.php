<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ]);

        $depth = 1;

        if ($request->filled('parent_comment_id')) {
            $parentComment = Comment::find($request->parent_comment_id);

            // Check depth
            if ($parentComment->depth >= 3) {
                return back()->with('error', 'Max reply depth reached.');
            }

            $depth = $parentComment->depth + 1;
        }

        Comment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'depth' => $depth,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
