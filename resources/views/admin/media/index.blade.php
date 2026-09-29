@extends('layouts.admin')

@section('page_title', 'Media')
@section('page_subtitle', 'Upload and reference image assets for CMS-managed pages.')

@section('content')
<form method="post" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="form-card">
    @csrf
    <section class="form-section">
        <h2>Upload Media</h2>
        <p class="help">Allowed formats: JPG, PNG, and WebP. Use descriptive alt text when possible.</p>
        <div class="form-grid">
            <label>Image
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required>
                @error('image')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Alt Text
                <input name="alt_text" value="{{ old('alt_text') }}">
                @error('alt_text')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>
    <div class="form-actions">
        <button class="btn" type="submit">Upload Media</button>
    </div>
</form>

<div class="section-head" style="margin-top:28px">
    <div>
        <h2>Library</h2>
        <p>Recently uploaded files available to CMS content.</p>
    </div>
</div>
@if($items->isEmpty())
    <div class="admin-card empty-state">No media uploads yet.</div>
@else
    <div class="media-grid">
        @foreach($items as $item)
            <article class="admin-card media-card">
                <img src="{{ asset('storage/'.$item->path) }}" alt="{{ $item->alt_text }}" loading="lazy">
                <p><strong>{{ $item->alt_text ?: 'Untitled image' }}</strong></p>
                <p class="muted">{{ $item->path }}</p>
            </article>
        @endforeach
    </div>
@endif
@endsection
