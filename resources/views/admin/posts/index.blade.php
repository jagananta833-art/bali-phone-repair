@extends('layouts.admin')

@section('page_title', 'Blog Posts')
@section('page_subtitle', 'Manage published guides, drafts, categories, and SEO metadata.')

@section('content')
<div class="section-head">
    <div>
        <h2>Posts</h2>
        <p>Published posts can appear in /blog, RSS, sitemap, and related article blocks.</p>
    </div>
    <a class="btn" href="{{ route('admin.posts.create') }}">Add New Blog Post</a>
</div>

<div class="table-tools">
    <input class="admin-search" data-admin-search="#posts-table" placeholder="Search posts...">
</div>

<div class="table-card admin-table-scroll">
    @if($items->isEmpty())
        <div class="empty-state">No blog posts yet. Create a useful repair guide.</div>
    @else
        <table id="posts-table">
            <thead><tr><th>Title</th><th>Category</th><th>Status</th><th>Date</th><th></th></tr></thead>
            <tbody>
                @foreach($items as $x)
                    <tr data-search-row>
                        <td><strong>{{ $x->title }}</strong><br><span class="muted">{{ $x->excerpt }}</span></td>
                        <td>{{ $x->category?->name ?? '-' }}</td>
                        <td><span class="status {{ $x->is_published ? 'published' : '' }}">{{ $x->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>{{ optional($x->published_at)->format('d M Y') }}</td>
                        <td class="actions-cell">
                            <a class="btn-secondary" href="{{ route('admin.posts.edit', $x) }}">Edit</a>
                            @if($x->is_published)<a class="btn-secondary" href="{{ route('posts.show', $x) }}" target="_blank" rel="noreferrer">View</a>@endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
