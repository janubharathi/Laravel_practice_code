<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->latest()->paginate(10);

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['category', 'user']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = $request->user()->posts()->create($data);

        return (new PostResource($post->load(['category', 'user'])))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, Post $post)
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'title'       => 'sometimes|required|max:255',
            'body'        => 'sometimes|required',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $post->update($data);

        return new PostResource($post->load(['category', 'user']));
    }

    public function destroy(Request $request, Post $post)
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}