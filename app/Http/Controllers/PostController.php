<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //
   public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->only('title', 'content'));

        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {
        $post = Post::with('comments.replies')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

}
