@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <span class="badge bg-primary mb-2">
            {{ $post->category->name ?? 'Uncategorized' }}
        </span>
        <h1 class="h3">{{ $post->title }}</h1>
        <small class="text-secondary">{{ $post->created_at->format('d M Y') }}</small>

        <p class="mt-3">{!! nl2br(e($post->body)) !!}</p>

        <div class="d-flex gap-2">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>

            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                  onsubmit="return confirm('Delete this post?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection