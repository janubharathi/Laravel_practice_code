<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $request->user()->posts()->create($request->validated());

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        $post->update($request->validated());

        return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }
}