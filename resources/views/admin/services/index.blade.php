@extends('layouts.admin')

@section('page_title', 'Services')
@section('page_subtitle', 'Manage public service listing and individual SEO service pages.')

@section('content')
<div class="section-head">
    <div>
        <h2>Service Pages</h2>
        <p>These pages power /services and /services/{slug}.</p>
    </div>
    <a class="btn" href="{{ route('admin.services.create') }}">Add New Service</a>
</div>

<div class="table-tools">
    <input class="admin-search" data-admin-search="#services-table" placeholder="Search services...">
</div>

<div class="table-card admin-table-scroll">
    @if($items->isEmpty())
        <div class="empty-state">No services yet. Add the first service page.</div>
    @else
        <table id="services-table">
            <thead><tr><th>Name</th><th>Slug</th><th>Status</th><th>Updated</th><th></th></tr></thead>
            <tbody>
                @foreach($items as $x)
                    <tr data-search-row>
                        <td><strong>{{ $x->name }}</strong><br><span class="muted">{{ $x->short_description }}</span></td>
                        <td>{{ $x->slug }}</td>
                        <td><span class="status {{ $x->is_published ? 'published' : '' }}">{{ $x->is_published ? ($x->is_indexable ? 'Published' : 'Published · noindex') : 'Draft' }}</span></td>
                        <td>{{ optional($x->updated_at)->format('d M Y') }}</td>
                        <td class="actions-cell">
                            <a class="btn-secondary" href="{{ route('admin.services.edit', $x) }}">Edit</a>
                            <a class="btn-secondary" href="{{ route('services.show', $x) }}" target="_blank" rel="noreferrer">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
