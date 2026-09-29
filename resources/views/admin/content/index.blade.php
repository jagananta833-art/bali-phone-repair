@extends('layouts.admin')

@section('page_title', $config['label'])
@section('page_subtitle', 'Manage reusable content blocks used across the public website.')

@section('content')
<div class="section-head">
    <div>
        <h2>{{ $config['label'] }}</h2>
        <p>Keep this content concise so frontend layouts remain stable.</p>
    </div>
    <a class="btn" href="{{ route('admin.content.create', $resource) }}">Add New</a>
</div>

<div class="table-tools">
    <input class="admin-search" data-admin-search="#content-table" placeholder="Search {{ strtolower($config['label']) }}...">
</div>

<div class="table-card admin-table-scroll">
    @if($items->isEmpty())
        <div class="empty-state">No {{ strtolower($config['label']) }} items yet.</div>
    @else
        <table id="content-table">
            <thead><tr><th>Name</th><th>Status</th><th>Updated</th><th></th></tr></thead>
            <tbody>
                @foreach($items as $item)
                    <tr data-search-row>
                        <td><strong>{{ $item->name ?? $item->question }}</strong></td>
                        <td><span class="status {{ isset($item->is_published) && $item->is_published ? 'published' : '' }}">{{ isset($item->is_published) ? ($item->is_published ? 'Published' : 'Draft') : '-' }}</span></td>
                        <td>{{ optional($item->updated_at)->format('d M Y') }}</td>
                        <td class="actions-cell">
                            <a class="btn-secondary" href="{{ route('admin.content.edit', [$resource, $item->id]) }}">Edit</a>
                            <form method="post" action="{{ route('admin.content.destroy', [$resource, $item->id]) }}">@csrf @method('delete')<button class="btn-secondary" type="submit">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
