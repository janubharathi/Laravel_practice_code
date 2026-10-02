@extends('layouts.app')

@section('title', 'New Post')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4 mb-3">New Post</h1>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input name="title" value="{{ old('title') }}"
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
                                @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Body</label>
                <textarea name="body" rows="6"
                          class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection