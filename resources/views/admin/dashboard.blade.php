@extends('layouts.admin')

@section('page_title', 'Dashboard')
@section('page_subtitle', 'Operational overview for published content, SEO basics, and recent edits.')

@section('content')
<div class="admin-card" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;border-left:4px solid {{ $license['valid'] ? '#22c55e' : '#ef4444' }};">
    <div>
        <div style="font-size:12px;text-transform:uppercase;letter-spacing:1px;font-weight:700;color:{{ $license['valid'] ? '#22c55e' : '#ef4444' }};">
            System License &bull; {{ $license['valid'] ? 'Active (Operational)' : 'Expired (Action Required)' }}
        </div>
        <div style="font-size:15px;color:#1e293b;margin-top:4px;font-weight:600;">
            @if ($license['valid'])
                Aktif hingga {{ $license['expires_at'] ? $license['expires_at']->format('d M Y') : '-' }} &bull; Sisa {{ $license['days_left'] }} hari operasional
            @else
                Lisensi tidak aktif atau habis: {{ $license['reason'] }}
            @endif
        </div>
    </div>
    <div>
        <a href="{{ route('license.renew') }}" class="btn-secondary" style="font-size:13px;padding:8px 14px;">Kelola / Perpanjang Lisensi</a>
    </div>
</div>

<div class="admin-grid">
    @foreach([
        'Total Services' => $counts['services'],
        'Pages' => $counts['pages'],
        'Blog Posts' => $counts['posts'],
        'FAQs' => $counts['faqs'],
        'Testimonials' => $counts['testimonials'],
        'Service Areas' => $counts['areas'],
    ] as $label => $value)
        <article class="admin-card metric-card">
            <b>{{ $value }}</b>
            <span>{{ $label }}</span>
        </article>
    @endforeach
</div>

<div class="section-head" style="margin-top:28px">
    <div>
        <h2>Quick Actions</h2>
        <p>Common CMS tasks without digging through menus.</p>
    </div>
</div>
<div class="quick-actions">
    <a class="btn" href="{{ route('admin.services.create') }}">Add New Service</a>
    <a class="btn" href="{{ route('admin.posts.create') }}">Add New Blog Post</a>
    <a class="btn-secondary" href="{{ route('admin.homepage.index') }}">Edit Homepage (Per-Layer)</a>
    <a class="btn-secondary" href="{{ route('admin.media.index') }}">Upload Media</a>
    <a class="btn-secondary" href="{{ route('admin.settings.edit') }}#contact-information">Edit Contact Info</a>
    <a class="btn-secondary" href="{{ route('home') }}" target="_blank" rel="noreferrer">View Website</a>
</div>

<div class="admin-grid two" style="margin-top:28px">
    <section class="admin-card">
        <div class="section-head">
            <div>
                <h2>Recent Posts</h2>
                <p>Latest article edits.</p>
            </div>
            <a class="btn-secondary" href="{{ route('admin.posts.index') }}">Manage</a>
        </div>
        @forelse($recentPosts as $post)
            <p><a href="{{ route('admin.posts.edit', $post) }}"><strong>{{ $post->title }}</strong></a><br><span class="muted">{{ $post->is_published ? 'Published' : 'Draft' }} - {{ $post->updated_at?->diffForHumans() }}</span></p>
        @empty
            <div class="empty-state">No blog posts yet.</div>
        @endforelse
    </section>

    <section class="admin-card">
        <div class="section-head">
            <div>
                <h2>Recent Services</h2>
                <p>Latest service page edits.</p>
            </div>
            <a class="btn-secondary" href="{{ route('admin.services.index') }}">Manage</a>
        </div>
        @forelse($recentServices as $service)
            <p><a href="{{ route('admin.services.edit', $service) }}"><strong>{{ $service->name }}</strong></a><br><span class="muted">{{ $service->is_published ? 'Published' : 'Draft' }} - {{ $service->updated_at?->diffForHumans() }}</span></p>
        @empty
            <div class="empty-state">No services yet.</div>
        @endforelse
    </section>
</div>

<div class="admin-grid" style="margin-top:28px">
    <section class="admin-card">
        <h2>Website Status</h2>
        <p><span class="status published">Public routes active</span></p>
        <p class="muted">Homepage, services, blog, about, contact, RSS, robots, and sitemap are managed by Laravel routes.</p>
    </section>

    <section class="admin-card">
        <h2>SEO Status</h2>
        @php
            $seoReady = !empty($settings['default_meta_title']) && !empty($settings['default_meta_description']);
        @endphp
        <p><span class="status {{ $seoReady ? 'published' : '' }}">{{ $seoReady ? 'Default metadata set' : 'Default metadata incomplete' }}</span></p>
        <p class="muted">Per-page titles, descriptions, canonicals, schema, sitemap, RSS, and noindex admin rules are available.</p>
    </section>

    <section class="admin-card">
        <h2>Last Updated Content</h2>
        @if($lastUpdated)
            <p><strong>{{ class_basename($lastUpdated) }}</strong></p>
            <p class="muted">{{ $lastUpdated->updated_at?->format('d M Y H:i') }}</p>
        @else
            <p class="muted">No content has been updated yet.</p>
        @endif
    </section>
</div>
@endsection
