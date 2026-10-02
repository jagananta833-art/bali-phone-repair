@extends('layouts.public')
@php
    use App\Support\HtmlSanitizer;
    use App\Support\MediaDimensions;

    $postUrl = $post->canonical_url ?: route('posts.show', $post);
    $postImage = $post->featured_image
        ? asset('assets/bali-phone-repair/'.$post->featured_image)
        : asset('assets/bali-phone-repair/logo-optimized.jpg');
    $postImageDimensions = $post->featured_image
        ? MediaDimensions::forPublicAsset('assets/bali-phone-repair/'.$post->featured_image)
        : null;

    $plainContent = trim(preg_replace('/\s+/', ' ', strip_tags((string) $post->content)));
    $wordCount = str_word_count($plainContent);
    $readingMinutes = max(1, (int) ceil($wordCount / 220));

    $whatsappNumber = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $whatsappText = rawurlencode('Hi Bali Phone Repair, I need help after reading: '.$post->title.'.');

    $phone = trim((string) ($siteSettings['phone'] ?? ''));
    $phoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', $phone)
        ? '+'.preg_replace('/\D+/', '', $phone)
        : null;

    $publishedAt = $post->published_at;
    $updatedAt = $post->updated_at;
    $authorName = $post->author_name ?? $post->author ?? $post->user->name ?? 'Administrator';
    $businessName = $siteSettings['business_name'] ?? 'Bali Phone Repair';
@endphp

@section('title', $post->meta_title ?: $post->title.' | Bali Phone Repair')
@section('description', $post->meta_description ?: $post->excerpt)
@section('canonical', $postUrl)
@section('og_type', 'article')
@section('image', $postImage)
@section('analytics_page_type', 'article')
@section('analytics_content_id', $post->id)
@section('analytics_content_slug', $post->slug)
@section('analytics_article_id', $post->id)
@section('analytics_article_slug', $post->slug)
@section('analytics_category_slug', $post->category?->slug)
@section('analytics_author_id', $post->user_id)

@section('content')
<main>
    <article class="section inner-hero">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('blog') }}">Blog</a>
                <span>/</span>
                <span aria-current="page">{{ $post->title }}</span>
            </nav>

            <p class="eyebrow">{{ $post->category?->name ?? 'Repair guide' }}</p>
            <h1>{{ $post->title }}</h1>
            <p class="hero-text">{{ $post->excerpt }}</p>

            <div class="article-meta" aria-label="Article information">
                <span>By {{ $post->author_name ?? $post->author ?? $post->user->name ?? 'Administrator' }}</span>
                @if($publishedAt)
                    <span>Published {{ $publishedAt->format('d M Y') }}</span>
                @endif
                @if($updatedAt && (!$publishedAt || !$updatedAt->isSameDay($publishedAt)))
                    <span>Updated {{ $updatedAt->format('d M Y') }}</span>
                @endif
                <span>{{ $readingMinutes }} min read</span>
            </div>
        </div>
    </article>

    <section class="section">
        <div class="inner-wrap inner-grid">
            <article class="inner-card content-body">
                @if($post->featured_image)
                    <img
                        src="{{ asset('assets/bali-phone-repair/'.$post->featured_image) }}"
                        alt="{{ $post->featured_image_alt ?: $post->title }}"
                        @if($postImageDimensions)
                            width="{{ $postImageDimensions['width'] }}"
                            height="{{ $postImageDimensions['height'] }}"
                        @endif
                        decoding="async">
                @endif

                {!! HtmlSanitizer::clean($post->content) !!}

                <section class="article-final-cta" aria-labelledby="article-final-cta-heading">
                    <p class="eyebrow">Need professional help?</p>
                    <h2 id="article-final-cta-heading">Ask a Bali Phone Repair technician</h2>
                    <p>Send your device model, issue, photos, and location so our team can suggest the next practical step.</p>
                    <div class="article-cta-actions">
                        <a
                            class="btn btn-primary"
                            href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappText }}"
                            target="_blank"
                            rel="noreferrer"
                            data-analytics-event="article_cta_click"
                            data-analytics-location="article_bottom"
                            data-analytics-article-id="{{ $post->id }}"
                            data-analytics-article-slug="{{ $post->slug }}"
                            data-analytics-cta-type="whatsapp">Chat on WhatsApp</a>

                        @if($phoneTel)
                            <a
                                class="btn btn-secondary"
                                href="tel:{{ $phoneTel }}"
                                data-analytics-event="article_cta_click"
                                data-analytics-location="article_bottom"
                                data-analytics-article-id="{{ $post->id }}"
                                data-analytics-article-slug="{{ $post->slug }}"
                                data-analytics-cta-type="phone">Call {{ $phone }}</a>
                        @endif
                    </div>
                </section>
            </article>

            <aside class="inner-card side-cta" aria-labelledby="article-help-heading">
                <p class="eyebrow">Need repair help?</p>
                <h2 id="article-help-heading">Ask a technician</h2>
                <p>Send your model, issue, photos, and location for a practical next step.</p>

                <a
                    class="btn btn-primary"
                    href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappText }}"
                    target="_blank"
                    rel="noreferrer"
                    data-analytics-event="article_cta_click"
                    data-analytics-location="article_sidebar"
                    data-analytics-article-id="{{ $post->id }}"
                    data-analytics-article-slug="{{ $post->slug }}"
                    data-analytics-cta-type="whatsapp">Chat on WhatsApp</a>

                @if($phoneTel)
                    <a
                        class="btn btn-secondary"
                        href="tel:{{ $phoneTel }}"
                        data-analytics-event="article_cta_click"
                        data-analytics-location="article_sidebar"
                        data-analytics-article-id="{{ $post->id }}"
                        data-analytics-article-slug="{{ $post->slug }}"
                        data-analytics-cta-type="phone">Call {{ $phone }}</a>
                @endif
            </aside>
        </div>
    </section>

    @if($related->isNotEmpty())
        <section class="section" aria-labelledby="related-articles-heading">
            <div class="inner-wrap">
                <p class="eyebrow">Related articles</p>
                <h2 id="related-articles-heading">Continue reading</h2>

                <div class="post-grid">
                    @foreach($related as $item)
                        <article class="inner-card post-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->excerpt }}</p>
                            <a
                                class="footer-emphasis"
                                href="{{ route('posts.show', $item) }}"
                                data-analytics-event="related_article_click"
                                data-analytics-location="related_articles"
                                data-analytics-source-type="article"
                                data-analytics-source-id="{{ $post->id }}"
                                data-analytics-target-article-id="{{ $item->id }}"
                                data-analytics-link-position="{{ $loop->iteration }}">Read article</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>

@push('styles')
<style>
.article-meta{display:flex;flex-wrap:wrap;gap:8px 18px;margin-top:18px;color:var(--muted);font-size:14px}.article-meta span{display:inline-flex;align-items:center}.article-final-cta{margin-top:34px;padding:26px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.04)}.article-final-cta h2{margin-top:6px}.article-cta-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:18px}@media(max-width:640px){.article-cta-actions{display:grid}.article-cta-actions .btn{width:100%}}

/* Styling Khusus GEO & AI Citations */
.content-body .geo-summary{padding:18px 22px;margin:24px 0 30px;background:#f8fafc;border:1px solid #e2e8f0;border-left:4px solid var(--admin-gold, #D4A346);border-radius:0 12px 12px 0;font-size:16.5px;line-height:1.75;color:#1e293b}
.content-body .geo-summary strong{color:#854d0e;display:inline-block;margin-right:4px}
.content-body .faq-section{margin:36px 0;padding:24px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:16px}
.content-body .faq-section h3{margin-top:0;color:#0f172a;font-size:19px}
.content-body .faq-section p{margin-bottom:16px;color:#334155}
.content-body .faq-section p:last-child{margin-bottom:0}
.content-body table{width:100%;border-collapse:collapse;margin:28px 0;border-radius:12px;overflow:hidden;border:1px solid #e2e8f0;background:#ffffff}
.content-body th{background:#f1f5f9;color:#0f172a;font-weight:750;text-align:left;padding:12px 16px;border-bottom:2px solid #cbd5e1;font-size:14px}
.content-body td{padding:12px 16px;border-bottom:1px solid #f1f5f9;color:#334155;font-size:14.5px;line-height:1.6}
.content-body tr:hover td{background:#f8fafc}
</style>
@endpush

@push('schema')
@php
    $articleSchema = array_filter([
        '@'.'context' => 'https://schema.org',
        '@'.'type' => 'Article',
        '@'.'id' => $postUrl.'#article',
        'headline' => $post->title,
        'description' => $post->meta_description ?: $post->excerpt,
        'image' => [$postImage],
        'url' => $postUrl,
        'mainEntityOfPage' => [
            '@'.'type' => 'WebPage',
            '@'.'id' => $postUrl,
        ],
        'author' => [
            '@'.'type' => $post->author ? 'Person' : 'Organization',
            'name' => $post->author_name ?? $post->author ?? $post->user->name ?? 'Administrator',
        ],
        'publisher' => [
            '@'.'type' => 'Organization',
            '@'.'id' => url('/').'#localbusiness',
            'name' => $businessName,
            'logo' => [
                '@'.'type' => 'ImageObject',
                'url' => asset('assets/bali-phone-repair/logo-optimized.jpg'),
            ],
        ],
        'datePublished' => $publishedAt?->toAtomString(),
        'dateModified' => $updatedAt?->toAtomString(),
        'articleSection' => $post->category?->name,
        'inLanguage' => 'en',
        'wordCount' => $wordCount,
    ], fn ($value) => $value !== null && $value !== '');

    $breadcrumbSchema = [
        '@'.'context' => 'https://schema.org',
        '@'.'type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@'.'type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
            ['@'.'type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog')],
            ['@'.'type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => $postUrl],
        ],
    ];

    // Ekstraksi pertanyaan dan jawaban untuk FAQPage schema
    $faqItems = [];
    if (preg_match_all('/<h[34][^>]*>(.*?\?)<\/h[34]>\s*<p[^>]*>(.*?)<\/p>/is', $post->content, $faqMatches, PREG_SET_ORDER)) {
        foreach ($faqMatches as $fm) {
            $q = trim(strip_tags($fm[1]));
            $a = trim(strip_tags($fm[2]));
            if ($q && $a && strlen($q) > 8 && strlen($a) > 10) {
                $faqItems[] = [
                    '@type' => 'Question',
                    'name' => $q,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $a,
                    ],
                ];
            }
        }
    }
@endphp

<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@if(!empty($faqItems))
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $faqItems,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
@endpush
@endsection
