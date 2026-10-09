@extends('layouts.blog')

@section('title', 'Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">All Posts</h1>

    <form method="GET" action="{{ route('posts.index') }}" class="d-flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control" placeholder="Search title...">
        <button class="btn btn-dark">Search</button>
        @if(request('search'))
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Clear</a>
        @endif
    </form>
</div>

@forelse($posts as $post)
    <div class="card mb-3 shadow-sm">
        <div class="row g-0">
            @if($post->image)
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $post->image) }}"
                         class="img-fluid rounded-start h-100 w-100"
                         style="object-fit: cover; max-height: 180px;"
                         alt="{{ $post->title }}">
                </div>
            @endif

            <div class="{{ $post->image ? 'col-md-9' : 'col-12' }}">
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
                    <small class="text-secondary">
                        By {{ $post->user->name ?? 'Unknown' }} · {{ $post->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">No posts found.</p>
@endforelse

{{ $posts->links() }}
@endsection