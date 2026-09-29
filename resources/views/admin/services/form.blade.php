@extends('layouts.admin')

@section('page_title', ($item->exists ? 'Edit' : 'Add').' Service')
@section('page_subtitle', 'Keep content useful, crawlable, and specific to the repair service.')

@section('content')
<form method="post" action="{{ $item->exists ? route('admin.services.update', $item) : route('admin.services.store') }}" class="form-card">
    @csrf
    @if($item->exists) @method('put') @endif

    <section class="form-section">
        <h2>Basic Information</h2>
        <p class="help">Name, slug, and summary used in listings, metadata fallbacks, and internal links.</p>
        <div class="form-grid">
            <label>Name
                <input name="name" value="{{ old('name', $item->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Slug
                <input name="slug" value="{{ old('slug', $item->slug) }}" placeholder="iphone-repair-bali">
                <small>Use lowercase words separated by hyphens.</small>
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Short Description
                <textarea name="short_description" required>{{ old('short_description', $item->short_description) }}</textarea>
                @error('short_description')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Content</h2>
        <p class="help">Write service-specific detail. Avoid unsupported promises, fixed pricing, or copied text.</p>
        <label>Content (HTML allowed)
            <textarea class="content-area" name="content" required>{{ old('content', $item->content) }}</textarea>
            @error('content')<span class="field-error">{{ $message }}</span>@enderror
        </label>
    </section>

    <section class="form-section">
        <h2>Image</h2>
        <p class="help">Use an existing filename from public/assets/bali-phone-repair or uploaded media path.</p>
        <label>Image Filename
            <input name="image" value="{{ old('image', $item->image) }}" placeholder="service-optimized.jpg">
            @error('image')<span class="field-error">{{ $message }}</span>@enderror
        </label>
        <label>Image Alt Text
            <input name="image_alt" value="{{ old('image_alt', $item->image_alt) }}" placeholder="Short description of the service image">
            @error('image_alt')<span class="field-error">{{ $message }}</span>@enderror
        </label>
    </section>

    <section class="form-section">
        <h2>SEO</h2>
        <p class="help">Each service should have a unique title and description.</p>
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
        <h2>Service Relationships</h2>
        <p class="help">Select only verified, relevant records. Hold Ctrl/Cmd to select more than one option.</p>
        <div class="form-grid">
            <label>Visible FAQs
                @php($selectedFaqs = array_map('intval', old('faq_ids', $item->exists ? $item->faqs->pluck('id')->all() : [])))
                <select name="faq_ids[]" multiple size="6">
                    @foreach($faqs as $faq)
                        <option value="{{ $faq->id }}" @selected(in_array($faq->id, $selectedFaqs, true))>
                            {{ $faq->question }}{{ $faq->is_published ? '' : ' (draft)' }}
                        </option>
                    @endforeach
                </select>
                @error('faq_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('faq_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Related Services
                @php($selectedServices = array_map('intval', old('related_service_ids', $item->exists ? $item->relatedServices->pluck('id')->all() : [])))
                <select name="related_service_ids[]" multiple size="6">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @selected(in_array($service->id, $selectedServices, true))>
                            {{ $service->name }}{{ $service->is_published && $service->is_indexable ? '' : ' (not public/indexable)' }}
                        </option>
                    @endforeach
                </select>
                @error('related_service_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('related_service_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Relevant Service Areas
                @php($selectedAreas = array_map('intval', old('service_area_ids', $item->exists ? $item->serviceAreas->pluck('id')->all() : [])))
                <select name="service_area_ids[]" multiple size="6">
                    @foreach($serviceAreas as $area)
                        <option value="{{ $area->id }}" @selected(in_array($area->id, $selectedAreas, true))>
                            {{ $area->name }}{{ $area->is_published ? '' : ' (draft)' }}
                        </option>
                    @endforeach
                </select>
                @error('service_area_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('service_area_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Publishing</h2>
        <p class="help">Draft pages stay out of public listings and sitemap rules.</p>
        <div class="form-grid">
            <label>Sort Order
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                @error('sort_order')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? true) ? 'checked' : '' }}> Published</label>
            <label class="check"><input type="checkbox" name="is_indexable" value="1" {{ old('is_indexable', $item->is_indexable ?? true) ? 'checked' : '' }}> Indexable and included in public listings/sitemap</label>
        </div>
    </section>

    <div class="form-actions">
        <a class="btn-secondary" href="{{ route('admin.services.index') }}">Cancel</a>
        <button class="btn-secondary" name="intent" value="draft" type="submit">Save Draft</button>
        <button class="btn-secondary" name="intent" value="save" type="submit">Save</button>
        <button class="btn" name="intent" value="publish" type="submit">Publish</button>
    </div>
</form>
@endsection
