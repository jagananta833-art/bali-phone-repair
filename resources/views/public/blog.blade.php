@extends('layouts.public')

@section('title', 'Device Repair Blog & Tech Guides Bali | Bali Phone Repair')
@section('description', 'Practical repair guides, troubleshooting tips, and maintenance advice for iPhone, Android, MacBook, laptops, battery, screen, and water damage in Bali.')
@section('canonical', request()->fullUrl())

@section('content')
<main>
    <section class="section inner-hero">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span aria-current="page">Blog</span>
            </nav>

            <span class="section-eyebrow-pill"><i class="fa-solid fa-book-open"></i> Tech Guides & Care Journal</span>
            <h1>Device Repair & Tech Guides in Bali</h1>
            <p class="hero-text">
                Practical repair guides, troubleshooting tips, maintenance advice,
                and professional solutions for iPhone, Android, MacBook, and Windows laptops across Bali.
            </p>

            @if($categories->isNotEmpty())
                <div class="category-filter-bar">
                    <span class="cat-pill active">All Topics</span>
                    @foreach($categories as $category)
                        <span class="cat-pill">{{ $category->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="section blog-section">
        <div class="inner-wrap">
            <div class="post-grid">
                @foreach($posts as $post)
                    @php
                        $thumb = $post->featured_image
                            ? asset('assets/bali-phone-repair/'.$post->featured_image)
                            : asset('assets/bali-phone-repair/android-buy-sell-optimized.jpg');
                        $plainText = trim(preg_replace('/\s+/', ' ', strip_tags((string) $post->content)));
                        $readTime = max(1, (int) ceil(str_word_count($plainText) / 220));
                    @endphp
                    <article class="inner-card blog-card">
                        <a href="{{ route('posts.show', $post) }}" class="blog-card-thumb-link" tabindex="-1" aria-hidden="true">
                            <img class="blog-card-thumb"
                                 src="{{ $thumb }}"
                                 alt="{{ $post->featured_image_alt ?: $post->title }}"
                                 loading="lazy"
                                 width="600"
                                 height="340">
                        </a>

                        <div class="blog-card-body">
                            <div class="blog-card-meta-top">
                                <span class="blog-badge">{{ $post->category?->name ?? 'Repair Guide' }}</span>
                                <span class="read-time"><i class="fa-regular fa-clock"></i> {{ $readTime }} min read</span>
                            </div>

                            <h2 class="blog-card-title">
                                <a href="{{ route('posts.show', $post) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <p class="blog-card-excerpt">{{ $post->excerpt }}</p>

                            <div class="blog-card-footer">
                                <div class="blog-author-meta">
                                    <small>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}</small>
                                </div>
                                <a class="blog-read-link" href="{{ route('posts.show', $post) }}">
                                    Read guide <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $posts->links() }}
            </div>

            <!-- Bottom Support CTA Banner -->
            <div class="blog-cta-banner">
                <div class="blog-cta-content">
                    <span class="section-eyebrow-pill"><i class="fa-solid fa-screwdriver-wrench"></i> Need Immediate Help?</span>
                    <h3>Have a Broken Screen, Water Damage, or Battery Issue?</h3>
                    <p>Our certified technicians can diagnose the problem and come directly to your villa, hotel, cafe, or coworking space anywhere in South Bali within 30–60 minutes.</p>
                </div>
                <div class="blog-cta-action">
                    <a class="btn-quote-pill" href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999') }}?text=Hi!%20I%20have%20an%20issue%20with%20my%20device%20and%20need%20a%20repair%20quote." target="_blank" rel="noreferrer">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>Chat Technician on WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

@push('styles')
<style>
.category-filter-bar {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 24px;
}
.cat-pill {
    background: #ffffff;
    border: 1px solid var(--color-gray-200);
    color: var(--color-gray-700);
    font-size: 13px;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 999px;
    cursor: default;
    transition: all .2s ease;
}
.cat-pill.active {
    background: var(--color-gray-900);
    color: #ffffff;
    border-color: var(--color-gray-900);
}

.blog-section {
    padding-top: 36px;
}
.blog-card {
    padding: 0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    border-radius: 16px;
    background: #ffffff;
    border: 1px solid var(--color-gray-200);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
}
.blog-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
}
.blog-card-thumb-link {
    display: block;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: #f1f5f9;
}
.blog-card-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s ease;
}
.blog-card:hover .blog-card-thumb {
    transform: scale(1.04);
}
.blog-card-body {
    padding: 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.blog-card-meta-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 12px;
}
.blog-badge {
    background: #fffbeb;
    color: #b45309;
    border: 1px solid rgba(217, 119, 6, 0.22);
    font-size: 11.5px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: .04em;
}
.read-time {
    font-size: 12px;
    color: var(--color-gray-500);
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.blog-card-title {
    font-size: 18px;
    font-weight: 800;
    line-height: 1.35;
    margin: 0 0 10px;
}
.blog-card-title a {
    color: var(--color-gray-900);
    transition: color .2s ease;
}
.blog-card-title a:hover {
    color: #b45309;
}
.blog-card-excerpt {
    font-size: 14px;
    color: var(--color-gray-600);
    line-height: 1.6;
    margin: 0 0 18px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.blog-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--color-gray-100);
}
.blog-author-meta small {
    color: var(--color-gray-500);
    font-size: 12.5px;
    font-weight: 500;
}
.blog-read-link {
    font-size: 13.5px;
    font-weight: 700;
    color: #b45309;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap .2s ease, color .2s;
}
.blog-read-link:hover {
    color: #92400e;
    gap: 9px;
}

/* Bottom CTA Banner */
.blog-cta-banner {
    margin-top: 60px;
    background: linear-gradient(135deg, #0b0f19 0%, #1e293b 100%);
    border-radius: 20px;
    padding: 38px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    color: #ffffff;
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.15);
}
.blog-cta-content {
    max-width: 680px;
}
.blog-cta-content h3 {
    font-size: 24px;
    font-weight: 800;
    margin: 10px 0 10px;
    color: #ffffff;
}
.blog-cta-content p {
    font-size: 15px;
    color: #cbd5e1;
    line-height: 1.6;
    margin: 0;
}
.blog-cta-action {
    flex-shrink: 0;
}
.blog-cta-action .btn-quote-pill {
    padding: 12px 26px;
    font-size: 15px;
}

@media (max-width: 860px) {
    .blog-cta-banner {
        flex-direction: column;
        align-items: flex-start;
        padding: 30px 24px;
        gap: 22px;
    }
    .blog-cta-action {
        width: 100%;
    }
    .blog-cta-action .btn-quote-pill {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

@push('schema')
@php
$collectionSchema=[
'@'.'context'=>'https://schema.org',
'@'.'type'=>'CollectionPage',
'name'=>'Device Repair Blog',
'url'=>request()->fullUrl(),
'mainEntity'=>[
'@'.'type'=>'ItemList',
'itemListElement'=>$posts->values()->map(fn($p,$i)=>[
'@'.'type'=>'ListItem',
'position'=>$i+1,
'url'=>route('posts.show',$p),
'name'=>$p->title,
])->all(),
],
];
$breadcrumbSchema=[
'@'.'context'=>'https://schema.org',
'@'.'type'=>'BreadcrumbList',
'itemListElement'=>[
['@'.'type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],
['@'.'type'=>'ListItem','position'=>2,'name'=>'Blog','item'=>route('blog')],
]
];
@endphp

<script type="application/ld+json">{!! json_encode($collectionSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
