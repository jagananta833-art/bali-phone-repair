@extends('layouts.admin')

@section('page_title', ($item->exists ? 'Edit' : 'Add').' '.$config['label'])
@section('page_subtitle', 'Edit structured CMS content without changing approved frontend layouts.')

@section('content')
<form method="post" action="{{ $item->exists ? route('admin.content.update', [$resource, $item->id]) : route('admin.content.store', $resource) }}" class="form-card">
    @csrf
    @if($item->exists) @method('put') @endif

    <section class="form-section">
        <h2>Basic Information</h2>
        <p class="help">Content from this form feeds public pages and homepage blocks through existing layout slots.</p>
        <div class="form-grid">
            @foreach($config['fields'] as $field)
                @if($field === 'is_published')
                    <label class="check full"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? true) ? 'checked' : '' }}> Published</label>
                @elseif(in_array($field, ['description', 'answer', 'quote', 'meta_description'], true))
                    <label class="full">{{ str($field)->replace('_', ' ')->title() }}
                        <textarea name="{{ $field }}">{{ old($field, $item->{$field}) }}</textarea>
                        @error($field)<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                @else
                    <label>{{ str($field)->replace('_', ' ')->title() }}
                        <input name="{{ $field }}" value="{{ old($field, $item->{$field}) }}">
                        @error($field)<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                @endif
            @endforeach
        </div>
    </section>

    <div class="form-actions">
        <a class="btn-secondary" href="{{ route('admin.content.index', $resource) }}">Cancel</a>
        <button class="btn" type="submit">Save</button>
    </div>
</form>
@endsection
