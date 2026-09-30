@extends('layouts.public')
@php
    use App\Support\HtmlSanitizer;
    use App\Support\MediaDimensions;

    $heroImage = $location->hero_image ?: 'service-optimized.jpg';
    $heroDimensions = MediaDimensions::forPublicAsset('assets/bali-phone-repair/'.$heroImage);
    $canonicalUrl = route('locations.show', $location);
    $phone = trim((string) $location->phone);
    $phoneTel = preg_match('/^\+?[0-9][0-9\s().-]{5,39}$/', $phone)
        ? (str_starts_with($phone, '+') ? '+' : '').preg_replace('/\D+/', '', $phone)
        : null;
    $whatsapp = preg_replace('/\D+/', '', (string) $location->whatsapp);
    $directionsQuery = $location->latitude !== null && $location->longitude !== null
        ? $location->latitude.','.$location->longitude
        : trim((string) $location->address);
    $directionsUrl = $directionsQuery !== ''
        ? 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($directionsQuery)
        : null;
@endphp

@section('title', $location->meta_title ?: $location->name.' | Bali Phone Repair')
@section('description', $location->meta_description ?: $location->description)
@section('canonical', $canonicalUrl)
@section('robots', $location->is_indexable ? 'index,follow' : 'noindex,follow')
@section('image', asset('assets/bali-phone-repair/'.$heroImage))
@section('analytics_page_type', 'location')
@section('analytics_content_id', $location->id)
@section('analytics_content_slug', $location->slug)
@section('analytics_location_id', $location->id)
@section('analytics_location_slug', $location->slug)
@section('analytics_location_type', 'service_location')

@section('content')
<main class="location-page">
    <section class="section inner-hero compact">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a><span>/</span>
                <a href="{{ route('areas.index') }}">Locations</a><span>/</span>
                <span aria-current="page">{{ $location->name }}</span>
            </nav>
            <p class="eyebrow">Location</p>
            <h1>{{ $location->name }}</h1>
            <p class="hero-text">{{ $location->description }}</p>
        </div>
    </section>

    <section class="section detail-section">
        <div class="inner-wrap service-main">
            <article class="inner-card content-body">
                <img class="service-main-image"
                    src="{{ asset('assets/bali-phone-repair/'.$heroImage) }}"
                    alt="{{ $location->hero_image_alt ?: $location->name }}"
                    @if($heroDimensions) width="{{ $heroDimensions['width'] }}" height="{{ $heroDimensions['height'] }}" @endif
                    decoding="async">
                {!! HtmlSanitizer::clean($location->long_description) !!}
                @if($location->service_radius)
                    <h2>Service radius</h2>
                    <p>{{ $location->service_radius }}</p>
                @endif
            </article>

            <aside class="inner-card side-cta service-summary" aria-labelledby="location-contact-heading">
                <p class="eyebrow">Contact and location</p>
                <h2 id="location-contact-heading">{{ $location->name }}</h2>
                @if($location->address)<p><strong>Address</strong><br>{{ $location->address }}@if($location->postcode), {{ $location->postcode }}@endif</p>@endif
                @if($location->opening_hours)<p><strong>Opening hours</strong><br>{{ $location->opening_hours }}</p>@endif
                @if($whatsapp)
                    <a class="btn btn-primary" href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noreferrer"
                        data-analytics-event="location_whatsapp_click" data-analytics-location="location_sidebar"
                        data-analytics-location-id="{{ $location->id }}" data-analytics-location-slug="{{ $location->slug }}">WhatsApp</a>
                @endif
                @if($phoneTel)
                    <a class="btn btn-secondary" href="tel:{{ $phoneTel }}"
                        data-analytics-event="location_call_click" data-analytics-location="location_sidebar"
                        data-analytics-location-id="{{ $location->id }}" data-analytics-location-slug="{{ $location->slug }}">Call {{ $phone }}</a>
                @endif
                @if($directionsUrl)
                    <a class="footer-emphasis" href="{{ $directionsUrl }}" target="_blank" rel="noreferrer"
                        data-analytics-event="location_direction_click" data-analytics-location="location_sidebar"
                        data-analytics-location-id="{{ $location->id }}" data-analytics-location-slug="{{ $location->slug }}">Get directions</a>
                @endif
                @if($location->email)<a href="mailto:{{ $location->email }}">{{ $location->email }}</a>@endif
            </aside>
        </div>
    </section>

    @if($location->map_embed_url)
        <section class="section detail-section" aria-labelledby="location-map-heading">
            <div class="inner-wrap">
                <h2 id="location-map-heading">Map</h2>
                <iframe class="location-map" src="{{ $location->map_embed_url }}" title="Map for {{ $location->name }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    @endif

    @if(collect($location->gallery)->isNotEmpty())
        <section class="section detail-section" aria-labelledby="location-gallery-heading">
            <div class="inner-wrap">
                <h2 id="location-gallery-heading">Location gallery</h2>
                <div class="detail-grid">
                    @foreach($location->gallery as $image)
                        @php
                            $dimensions = MediaDimensions::forPublicAsset('assets/bali-phone-repair/'.$image['path']);
                        @endphp
                        <img class="location-gallery-image" src="{{ asset('assets/bali-phone-repair/'.$image['path']) }}" alt="{{ $image['alt'] }}"
                            @if($dimensions) width="{{ $dimensions['width'] }}" height="{{ $dimensions['height'] }}" @endif loading="lazy">
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($location->services->isNotEmpty())
        <section class="section detail-section" aria-labelledby="location-services-heading">
            <div class="inner-wrap">
                <p class="eyebrow">Services</p>
                <h2 id="location-services-heading">Services connected to {{ $location->name }}</h2>
                <div class="service-list">
                    @foreach($location->services as $service)
                        <article class="inner-card service-card">
                            <h3>{{ $service->name }}</h3>
                            <p>{{ $service->short_description }}</p>
                            <a href="{{ route('services.show', $service) }}"
                                data-analytics-event="location_service_click" data-analytics-location="location_services"
                                data-analytics-location-id="{{ $location->id }}" data-analytics-location-slug="{{ $location->slug }}"
                                data-analytics-target-service-id="{{ $service->id }}" data-analytics-link-position="{{ $loop->iteration }}">View service</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($location->faqs->isNotEmpty())
        <section class="section faq detail-section" aria-labelledby="location-faq-heading">
            <div class="faq-intro"><p class="eyebrow">FAQ</p><h2 id="location-faq-heading">Questions about {{ $location->name }}</h2></div>
            <div class="faq-list">
                @foreach($location->faqs as $faq)<details><summary>{{ $faq->question }}</summary><p>{{ $faq->answer }}</p></details>@endforeach
            </div>
        </section>
    @endif

    @if($location->nearbyLocations->isNotEmpty())
        <section class="section detail-section" aria-labelledby="nearby-locations-heading">
            <div class="inner-wrap"><p class="eyebrow">Nearby locations</p><h2 id="nearby-locations-heading">Other verified locations</h2>
                <div class="link-list">@foreach($location->nearbyLocations as $nearby)<a href="{{ route('locations.show', $nearby) }}"><span>{{ $nearby->name }}</span><span>→</span></a>@endforeach</div>
            </div>
        </section>
    @endif

    @if($location->relatedArticles->isNotEmpty())
        <section class="section detail-section" aria-labelledby="location-articles-heading">
            <div class="inner-wrap"><p class="eyebrow">Related articles</p><h2 id="location-articles-heading">Helpful reading</h2>
                <div class="detail-grid">@foreach($location->relatedArticles as $article)<article class="inner-card post-card"><h3>{{ $article->title }}</h3><p>{{ $article->excerpt }}</p><a href="{{ route('posts.show', $article) }}" data-analytics-event="related_article_click" data-analytics-location="location_articles" data-analytics-target-article-id="{{ $article->id }}" data-analytics-link-position="{{ $loop->iteration }}">Read article</a></article>@endforeach</div>
            </div>
        </section>
    @endif
</main>
@push('styles')
<style>
.location-page .section{content-visibility:visible}.location-map{width:100%;min-height:380px;border:0;border-radius:18px}.location-gallery-image{width:100%;height:auto;aspect-ratio:4/3;object-fit:cover;border-radius:18px}
</style>
@endpush
@push('schema')
@php
    $localBusiness = array_filter([
        '@'.'context' => 'https://schema.org',
        '@'.'type' => 'LocalBusiness',
        '@'.'id' => $canonicalUrl.'#localbusiness',
        'name' => $location->name,
        'url' => $canonicalUrl,
        'image' => asset('assets/bali-phone-repair/'.$heroImage),
        'telephone' => $phone ?: null,
        'email' => $location->email ?: null,
        'address' => $location->address ? array_filter([
            '@'.'type' => 'PostalAddress',
            'streetAddress' => $location->address,
            'postalCode' => $location->postcode ?: null,
            'addressRegion' => 'Bali',
            'addressCountry' => 'ID',
        ]) : null,
        'geo' => $location->latitude !== null && $location->longitude !== null ? [
            '@'.'type' => 'GeoCoordinates',
            'latitude' => (float) $location->latitude,
            'longitude' => (float) $location->longitude,
        ] : null,
        'openingHours' => $location->opening_hours ?: null,
    ], fn ($value) => $value !== null && $value !== '');
    $breadcrumbSchema = [
        '@'.'context' => 'https://schema.org',
        '@'.'type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@'.'type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
            ['@'.'type' => 'ListItem', 'position' => 2, 'name' => 'Locations', 'item' => route('areas.index')],
            ['@'.'type' => 'ListItem', 'position' => 3, 'name' => $location->name, 'item' => $canonicalUrl],
        ],
    ];
    $faqSchema = [
        '@'.'context' => 'https://schema.org',
        '@'.'type' => 'FAQPage',
        'mainEntity' => $location->faqs->map(fn ($faq) => [
            '@'.'type' => 'Question',
            'name' => $faq->question,
            'acceptedAnswer' => ['@'.'type' => 'Answer', 'text' => $faq->answer],
        ])->values(),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($localBusiness, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@if($location->faqs->isNotEmpty())
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
@endpush
@endsection
