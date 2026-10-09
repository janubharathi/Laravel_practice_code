@extends('layouts.blog')

@section('title', $post->title)

@section('content')
<div class="card shadow-sm">
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top"
             style="max-height: 400px; object-fit: cover;" alt="{{ $post->title }}">
    @endif

    <div class="card-body">
        <span class="badge bg-primary mb-2">
            {{ $post->category->name ?? 'Uncategorized' }}
        </span>
        <h1 class="h3">{{ $post->title }}</h1>
        <small class="text-secondary">
            By {{ $post->user->name ?? 'Unknown' }} · {{ $post->created_at->format('d M Y') }}
        </small>

        <p class="mt-3">{!! nl2br(e($post->body)) !!}</p>

        <div class="d-flex gap-2">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>

            @auth
                @if(auth()->id() === $post->user_id)
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>

                    <form method="POST" action="{{ route('posts.destroy', $post) }}"
                          onsubmit="return confirm('Delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection