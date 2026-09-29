@extends('layouts.admin')

@section('page_title', 'Pages')
@section('page_subtitle', 'Manage indexable static pages such as About, Contact, policy, and terms.')

@section('content')
<div class="section-head">
    <div>
        <h2>Pages</h2>
        <p>Published pages are available through clean lowercase URL slugs.</p>
    </div>
    <a class="btn" href="{{ route('admin.pages.create') }}">Add New Page</a>
</div>

<div class="table-tools">
    <input class="admin-search" data-admin-search="#pages-table" placeholder="Search pages...">
</div>

<div class="table-card admin-table-scroll">
    @if($items->isEmpty())
        <div class="empty-state">No pages yet.</div>
    @else
        <table id="pages-table">
            <thead><tr><th>Title</th><th>Slug</th><th>Status</th><th>Updated</th><th></th></tr></thead>
            <tbody>
                @foreach($items as $x)
                    <tr data-search-row>
                        <td><strong>{{ $x->title }}</strong><br><span class="muted">{{ $x->excerpt }}</span></td>
                        <td>{{ $x->slug }}</td>
                        <td><span class="status {{ $x->is_published ? 'published' : '' }}">{{ $x->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>{{ optional($x->updated_at)->format('d M Y') }}</td>
                        <td class="actions-cell">
                            <a class="btn-secondary" href="{{ route('admin.pages.edit', $x) }}">Edit</a>
                            @if($x->is_published)<a class="btn-secondary" href="{{ route('pages.show', $x->slug) }}" target="_blank" rel="noreferrer">View</a>@endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
