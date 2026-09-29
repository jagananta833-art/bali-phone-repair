@extends('layouts.admin')

@section('page_title', ($item->exists ? 'Edit' : 'Add').' Blog Post')
@section('page_subtitle', 'Create helpful article content with clean publishing and SEO controls.')

@section('content')
<form method="post" action="{{ $item->exists ? route('admin.posts.update', $item) : route('admin.posts.store') }}" class="form-card">
    @csrf
    @if($item->exists) @method('put') @endif

    <section class="form-section">
        <h2>Basic Information</h2>
        <p class="help">Title, category, slug, and excerpt used in blog listings and previews.</p>
        <div class="form-grid">
            <label>Category
                <select name="category_id">
                    <option value="">None</option>
                    @foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $item->category_id) == $category->id)>{{ $category->name }}</option>@endforeach
                </select>
                @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Title
                <input name="title" value="{{ old('title', $item->title) }}" required>
                @error('title')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Slug
                <input name="slug" value="{{ old('slug', $item->slug) }}">
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Publish Date
                <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($item->published_at)->format('Y-m-d\TH:i')) }}">
                @error('published_at')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Excerpt
                <textarea name="excerpt" required>{{ old('excerpt', $item->excerpt) }}</textarea>
                @error('excerpt')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Content</h2>
        <p class="help">Keep guidance practical and specific. HTML is allowed for structured headings and lists.</p>
        <label>Content (HTML allowed)
            <textarea class="content-area" name="content" required>{{ old('content', $item->content) }}</textarea>
            @error('content')<span class="field-error">{{ $message }}</span>@enderror
        </label>
    </section>

    <section class="form-section">
        <h2>Image</h2>
        <p class="help">Set a featured image filename when the article has a suitable visual asset.</p>
        <label>Featured Image Filename
            <input name="featured_image" value="{{ old('featured_image', $item->featured_image) }}">
            @error('featured_image')<span class="field-error">{{ $message }}</span>@enderror
        </label>
        <label>Featured Image Alt Text
            <input name="featured_image_alt" value="{{ old('featured_image_alt', $item->featured_image_alt) }}">
            @error('featured_image_alt')<span class="field-error">{{ $message }}</span>@enderror
        </label>
    </section>

    <section class="form-section">
        <h2>SEO</h2>
        <p class="help">Use a unique title and description. Canonical can be left blank for the default article URL.</p>
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
            <label class="full">Canonical URL
                <input name="canonical_url" value="{{ old('canonical_url', $item->canonical_url) }}">
                @error('canonical_url')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Publishing</h2>
        <p class="help">Draft posts are not public and should not appear in indexable public feeds.</p>
        <label class="check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? false) ? 'checked' : '' }}> Published</label>
    </section>

    <div class="form-actions">
        <a class="btn-secondary" href="{{ route('admin.posts.index') }}">Cancel</a>
        <button class="btn-secondary" name="intent" value="draft" type="submit">Save Draft</button>
        <button class="btn-secondary" name="intent" value="save" type="submit">Save</button>
        <button class="btn" name="intent" value="publish" type="submit">Publish</button>
    </div>
</form>
@endsection
