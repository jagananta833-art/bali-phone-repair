@extends('layouts.admin')

@section('page_title', 'Locations')
@section('page_subtitle', 'Manage verified location pages without creating automatic service-location combinations.')

@section('content')
<div class="section-head">
    <div>
        <h2>Local SEO Locations</h2>
        <p>Only publish and index records with owner-approved, location-specific facts.</p>
    </div>
    <a class="btn" href="{{ route('admin.locations.create') }}">Add New Location</a>
</div>

<div class="table-tools">
    <input class="admin-search" data-admin-search="#locations-table" placeholder="Search locations...">
</div>

<div class="table-card admin-table-scroll">
    @if($items->isEmpty())
        <div class="empty-state">No location records yet.</div>
    @else
        <table id="locations-table">
            <thead><tr><th>Name</th><th>Slug</th><th>Status</th><th>Updated</th><th></th></tr></thead>
            <tbody>
                @foreach($items as $location)
                    <tr data-search-row>
                        <td><strong>{{ $location->name }}</strong><br><span class="muted">{{ $location->description }}</span></td>
                        <td>{{ $location->slug }}</td>
                        <td><span class="status {{ $location->is_published ? 'published' : '' }}">{{ $location->is_published ? ($location->is_indexable ? 'Published' : 'Published · noindex') : 'Draft' }}</span></td>
                        <td>{{ optional($location->updated_at)->format('d M Y') }}</td>
                        <td class="actions-cell">
                            <a class="btn-secondary" href="{{ route('admin.locations.edit', $location) }}">Edit</a>
                            @if($location->is_published)<a class="btn-secondary" href="{{ route('locations.show', $location) }}" target="_blank" rel="noreferrer">View</a>@endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
