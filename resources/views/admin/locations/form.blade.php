@extends('layouts.admin')

@section('page_title', ($item->exists ? 'Edit' : 'Add').' Location')
@section('page_subtitle', 'Use only verified local facts and original location-specific content.')

@section('content')
<form method="post" action="{{ $item->exists ? route('admin.locations.update', $item) : route('admin.locations.store') }}" class="form-card">
    @csrf
    @if($item->exists) @method('put') @endif

    <section class="form-section">
        <h2>Basic Information</h2>
        <div class="form-grid">
            <label>Name
                <input name="name" value="{{ old('name', $item->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Slug
                <input name="slug" value="{{ old('slug', $item->slug) }}" placeholder="verified-location-slug">
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Short Description
                <textarea name="description" required>{{ old('description', $item->description) }}</textarea>
                @error('description')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Long Description (HTML allowed)
                <textarea class="content-area" name="long_description">{{ old('long_description', $item->long_description) }}</textarea>
                @error('long_description')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Media</h2>
        <div class="form-grid">
            <label>Hero Image Filename
                <input name="hero_image" value="{{ old('hero_image', $item->hero_image) }}" placeholder="service-optimized.jpg">
                @error('hero_image')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Hero Image Alt Text
                <input name="hero_image_alt" value="{{ old('hero_image_alt', $item->hero_image_alt) }}">
                @error('hero_image_alt')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Gallery
                <textarea name="gallery" placeholder="image.jpg | Descriptive alt text">{{ old('gallery', collect($item->gallery ?? [])->map(fn ($image) => ($image['path'] ?? '').' | '.($image['alt'] ?? ''))->implode("\n")) }}</textarea>
                <small>One image per line: safe image path | alt text.</small>
                @error('gallery')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Verified Contact and Location Facts</h2>
        <p class="help">Leave unknown values empty. Do not copy another outlet's facts without approval.</p>
        <div class="form-grid">
            <label class="full">Address
                <textarea name="address">{{ old('address', $item->address) }}</textarea>
                @error('address')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Postcode
                <input name="postcode" value="{{ old('postcode', $item->postcode) }}">
                @error('postcode')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Opening Hours
                <input name="opening_hours" value="{{ old('opening_hours', $item->opening_hours) }}">
                @error('opening_hours')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Phone
                <input name="phone" value="{{ old('phone', $item->phone) }}">
                @error('phone')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>WhatsApp
                <input name="whatsapp" value="{{ old('whatsapp', $item->whatsapp) }}">
                @error('whatsapp')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Email
                <input type="email" name="email" value="{{ old('email', $item->email) }}">
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Service Radius
                <input name="service_radius" value="{{ old('service_radius', $item->service_radius) }}">
                @error('service_radius')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Latitude
                <input name="latitude" value="{{ old('latitude', $item->latitude) }}">
                @error('latitude')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Longitude
                <input name="longitude" value="{{ old('longitude', $item->longitude) }}">
                @error('longitude')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Google Maps Embed URL
                <input name="map_embed_url" value="{{ old('map_embed_url', $item->map_embed_url) }}">
                @error('map_embed_url')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>SEO</h2>
        <div class="form-grid">
            <label>SEO Title
                <input name="meta_title" value="{{ old('meta_title', $item->meta_title) }}">
                @error('meta_title')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="full">Meta Description
                <textarea name="meta_description">{{ old('meta_description', $item->meta_description) }}</textarea>
                @error('meta_description')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Relationships</h2>
        <p class="help">Select only explicit, relevant records. Hold Ctrl/Cmd to select multiple options.</p>
        <div class="form-grid">
            <label>FAQs
                @php($selectedFaqs = array_map('intval', old('faq_ids', $item->exists ? $item->faqs->pluck('id')->all() : [])))
                <select name="faq_ids[]" multiple size="6">@foreach($faqs as $faq)<option value="{{ $faq->id }}" @selected(in_array($faq->id, $selectedFaqs, true))>{{ $faq->question }}{{ $faq->is_published ? '' : ' (draft)' }}</option>@endforeach</select>
                @error('faq_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('faq_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Related Services
                @php($selectedServices = array_map('intval', old('service_ids', $item->exists ? $item->services->pluck('id')->all() : [])))
                <select name="service_ids[]" multiple size="6">@foreach($services as $service)<option value="{{ $service->id }}" @selected(in_array($service->id, $selectedServices, true))>{{ $service->name }}{{ $service->is_published && $service->is_indexable ? '' : ' (not public/indexable)' }}</option>@endforeach</select>
                @error('service_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('service_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Nearby Locations
                @php($selectedLocations = array_map('intval', old('nearby_location_ids', $item->exists ? $item->nearbyLocations->pluck('id')->all() : [])))
                <select name="nearby_location_ids[]" multiple size="6">@foreach($locations as $location)<option value="{{ $location->id }}" @selected(in_array($location->id, $selectedLocations, true))>{{ $location->name }}{{ $location->is_published && $location->is_indexable ? '' : ' (not public/indexable)' }}</option>@endforeach</select>
                @error('nearby_location_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('nearby_location_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Related Articles
                @php($selectedArticles = array_map('intval', old('related_article_ids', $item->exists ? $item->relatedArticles->pluck('id')->all() : [])))
                <select name="related_article_ids[]" multiple size="6">@foreach($articles as $article)<option value="{{ $article->id }}" @selected(in_array($article->id, $selectedArticles, true))>{{ $article->title }}{{ $article->is_published ? '' : ' (draft)' }}</option>@endforeach</select>
                @error('related_article_ids')<span class="field-error">{{ $message }}</span>@enderror
                @error('related_article_ids.*')<span class="field-error">{{ $message }}</span>@enderror
            </label>
        </div>
    </section>

    <section class="form-section">
        <h2>Publishing</h2>
        <div class="form-grid">
            <label>Sort Order
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                @error('sort_order')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label class="check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? false) ? 'checked' : '' }}> Published</label>
            <label class="check"><input type="checkbox" name="is_indexable" value="1" {{ old('is_indexable', $item->is_indexable ?? false) ? 'checked' : '' }}> Indexable and included in public listings/sitemap</label>
        </div>
    </section>

    <div class="form-actions">
        <a class="btn-secondary" href="{{ route('admin.locations.index') }}">Cancel</a>
        <button class="btn-secondary" name="intent" value="draft" type="submit">Save Draft</button>
        <button class="btn-secondary" name="intent" value="save" type="submit">Save</button>
        <button class="btn" name="intent" value="publish" type="submit">Publish</button>
    </div>
</form>
@endsection
