@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<h1 class="h3 mb-3">All Posts</h1>

@forelse($posts as $post)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <span class="badge bg-primary mb-2">
                {{ $post->category->name ?? 'Uncategorized' }}
            </span>
            <h5 class="card-title">
                <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                    {{ $post->title }}
                </a>
            </h5>
            <p class="card-text text-muted">{{ Str::limit($post->body, 120) }}</p>
            <small class="text-secondary">{{ $post->created_at->diffForHumans() }}</small>
        </div>
    </div>
@empty
    <p class="text-muted">No posts yet.</p>
@endforelse
@endsection