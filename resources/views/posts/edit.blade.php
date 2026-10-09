@extends('layouts.blog')

@section('title', 'Edit Post')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4 mb-3">Edit Post</h1>

        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input name="title" value="{{ old('title', $post->title) }}"
                       class="form-control @error('title') is-invalid @enderror">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Select --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @selected(old('category_id', $post->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                @if($post->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current image"
                             class="img-thumbnail" style="max-height: 150px;">
                        <div class="form-text">Choose a new file only if you want to replace this one.</div>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Body</label>
                <textarea name="body" rows="6"
                          class="form-control @error('body') is-invalid @enderror">{{ old('body', $post->body) }}</textarea>
                @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection