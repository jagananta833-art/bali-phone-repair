@extends('layouts.admin')

@section('page_title', ($item->exists ? 'Edit' : 'Add').' Page')
@section('page_subtitle', 'Use clear content blocks and unique metadata for static SEO pages.')

@section('content')
<form method="post" action="{{ $item->exists ? route('admin.pages.update', $item) : route('admin.pages.store') }}" class="form-card">
    @csrf
    @if($item->exists) @method('put') @endif

    <section class="form-section">
        <h2>Basic Information</h2>
        <p class="help">The title and slug define the public page URL and listing labels.</p>
        <div class="form-grid">
            <label>Title
                <input name="title" value="{{ old('title', $item->title) }}" required>
                @error('title')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Slug
                <input name="slug" value="{{ old('slug', $item->slug) }}">
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Excerpt
                <textarea name="excerpt">{{ old('excerpt', $item->excerpt) }}</textarea>
                @error('excerpt')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Content</h2>
        <p class="help">HTML is allowed for headings, paragraphs, links, and structured lists.</p>
        <label>Content
            <textarea class="content-area" name="content" required>{{ old('content', $item->content) }}</textarea>
            @error('content')<span class="field-error">{{ $message }}</span>@enderror
        </label>
    </section>

    <section class="form-section">
        <h2>Image</h2>
        <p class="help">Optional featured image fields for pages that need a visual preview.</p>
        <div class="form-grid">
            <label>Featured Image Filename
                <input name="featured_image" value="{{ old('featured_image', $item->featured_image) }}">
                @error('featured_image')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Featured Image Alt Text
                <input name="featured_image_alt" value="{{ old('featured_image_alt', $item->featured_image_alt) }}">
                @error('featured_image_alt')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>SEO</h2>
        <p class="help">Keep metadata specific so pages do not compete with one another.</p>
        <div class="form-grid">
            <label>SEO Title
                <input name="meta_title" value="{{ old('meta_title', $item->meta_title) }}">
                @error('meta_title')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Focus Keyword
                <input name="focus_keyword" value="{{ old('focus_keyword', $item->focus_keyword) }}">
                @error('focus_keyword')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Meta Description
                <textarea name="meta_description">{{ old('meta_description', $item->meta_description) }}</textarea>
                @error('meta_description')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Publishing</h2>
        <p class="help">Draft pages remain hidden from public visitors.</p>
        <label class="check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? true) ? 'checked' : '' }}> Published</label>
    </section>

    <div class="form-actions">
        <a class="btn-secondary" href="{{ route('admin.pages.index') }}">Cancel</a>
        <button class="btn-secondary" name="intent" value="draft" type="submit">Save Draft</button>
        <button class="btn-secondary" name="intent" value="save" type="submit">Save</button>
        <button class="btn" name="intent" value="publish" type="submit">Publish</button>
    </div>
</form>
@endsection
