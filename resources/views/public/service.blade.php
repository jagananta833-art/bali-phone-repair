@extends('layouts.public')
@php
    use App\Support\HtmlSanitizer;
    use App\Support\MediaDimensions;

    $primaryImage = $service->image ?: 'service-optimized.jpg';
    $primaryImageDimensions = MediaDimensions::forPublicAsset('assets/bali-phone-repair/'.$primaryImage);
    $whatsappNumber = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $whatsappText = rawurlencode('Hi Bali Phone Repair, I would like to ask about '.$service->name.'.');
    $servicePhone = trim((string) ($siteSettings['phone'] ?? ''));
    $servicePhoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', $servicePhone)
        ? '+'.preg_replace('/\D+/', '', $servicePhone)
        : null;
    $serviceUrl = route('services.show', $service);
@endphp

@section('title', $service->meta_title ?: $service->name.' | Bali Phone Repair')
@section('description', $service->meta_description ?: $service->short_description)
@section('canonical', $serviceUrl)
@section('robots', $service->is_indexable ? 'index,follow' : 'noindex,follow')
@section('image', asset('assets/bali-phone-repair/'.$primaryImage))
@section('analytics_page_type', 'service')
@section('analytics_content_id', $service->id)
@section('analytics_content_slug', $service->slug)
@section('analytics_service_id', $service->id)
@section('analytics_service_slug', $service->slug)
@section('analytics_service_name', $service->name)

@section('content')
<main>
    <section class="section inner-hero compact">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('services.index') }}">Services</a>
                <span>/</span>
                <span aria-current="page">{{ $service->name }}</span>
            </nav>
            <p class="eyebrow">{{ $service->focus_keyword ?: 'Repair service' }}</p>
            <h1>{{ $service->name }}</h1>
            <p class="hero-text">{{ $service->short_description }}</p>
        </div>
    </section>

    <section class="section detail-section">
        <div class="inner-wrap service-main">
            <article class="inner-card content-body">
                <img
                    class="service-main-image"
                    src="{{ asset('assets/bali-phone-repair/'.$primaryImage) }}"
                    alt="{{ $service->image_alt ?: $service->name }}"
                    @if($primaryImageDimensions)
                        width="{{ $primaryImageDimensions['width'] }}"
                        height="{{ $primaryImageDimensions['height'] }}"
                    @endif
                    decoding="async">
                {!! HtmlSanitizer::clean($service->content) !!}
            </article>

            <aside class="inner-card side-cta service-summary" aria-labelledby="service-contact-heading">
                <p class="eyebrow">Contact</p>
                <h2 id="service-contact-heading">Ask about {{ $service->name }}</h2>
                <a
                    class="btn btn-primary"
                    href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappText }}"
                    target="_blank"
                    rel="noreferrer"
                    data-analytics-event="whatsapp_click"
                    data-analytics-location="service_sidebar"
                    data-analytics-service-slug="{{ $service->slug }}">WhatsApp</a>
                @if($servicePhoneTel)
                    <a
                        class="btn btn-secondary"
                        href="tel:{{ $servicePhoneTel }}"
                        data-analytics-event="phone_call_click"
                        data-analytics-location="service_sidebar">Call {{ $servicePhone }}</a>
                @endif
                <x-public.outlet
                    :business-name="$siteSettings['business_name'] ?? 'Bali Phone Repair'"
                    :address="$siteSettings['address'] ?? ''"
                    :phone="$servicePhone"
                    :opening-hours="$siteSettings['opening_hours'] ?? null"
                    :map-url="$siteSettings['google_maps'] ?? null"
                    analytics-location="service_sidebar" />
            </aside>
        </div>
    </section>

    @if($service->faqs->isNotEmpty())
        <section class="section faq detail-section" aria-labelledby="service-faq-heading">
            <div class="faq-intro">
                <p class="eyebrow">FAQ</p>
                <h2 id="service-faq-heading">Questions about {{ $service->name }}</h2>
            </div>
            <div class="faq-list">
                @foreach($service->faqs as $faq)
                    <details>
                        <summary>{{ $faq->question }}</summary>
                        <p>{{ $faq->answer }}</p>
                    </details>
                @endforeach
            </div>
        </section>
    @endif

    @if($service->relatedServices->isNotEmpty())
        <section class="section detail-section" aria-labelledby="related-services-heading">
            <div class="inner-wrap">
                <div class="section-heading">
                    <p class="eyebrow">Related services</p>
                    <h2 id="related-services-heading">Other relevant services</h2>
                </div>
                <div class="service-list">
                    @foreach($service->relatedServices as $relatedService)
                        <article class="service-card photo-service-card">
                            <b>{{ $relatedService->name }}</b>
                            <p>{{ $relatedService->short_description }}</p>
                            <a
                                class="footer-emphasis"
                                href="{{ route('services.show', $relatedService) }}"
                                data-analytics-event="related_service_click"
                                data-analytics-location="related_services"
                                data-analytics-source-type="service"
                                data-analytics-source-id="{{ $service->id }}"
                                data-analytics-target-service-id="{{ $relatedService->id }}"
                                data-analytics-link-position="{{ $loop->iteration }}">Open service</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($service->serviceAreas->isNotEmpty())
        <section class="section detail-section" aria-labelledby="service-areas-heading">
            <div class="inner-wrap inner-card">
                <p class="eyebrow">Available in Bali</p>
                <h2 id="service-areas-heading">Available service areas</h2>
                <div class="link-list">
                    @foreach($service->serviceAreas as $area)
                        <a
                            href="{{ route('locations.show', $area) }}"
                            data-analytics-event="service_location_click"
                            data-analytics-location="service_areas"
                            data-analytics-source-service-id="{{ $service->id }}"
                            data-analytics-target-location-id="{{ $area->id }}"
                            data-analytics-link-position="{{ $loop->iteration }}">
                            <span>{{ $service->name }} in {{ $area->name }}</span>
                            <span aria-hidden="true">→</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>

@push('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    '@id' => $serviceUrl.'#service',
    'name' => $service->name,
    'description' => $service->meta_description ?: $service->short_description,
    'image' => asset('assets/bali-phone-repair/'.$primaryImage),
    'provider' => ['@id' => url('/').'#localbusiness'],
    'areaServed' => $service->serviceAreas->map(fn ($area) => [
        '@type' => 'AdministrativeArea',
        'name' => $area->name,
    ])->values()->all(),
    'url' => $serviceUrl,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => route('services.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $service->name, 'item' => $serviceUrl],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@if($service->faqs->isNotEmpty())
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $service->faqs->map(fn ($faq) => [
        '@type' => 'Question',
        'name' => $faq->question,
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq->answer],
    ])->values()->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
@endpush
@endsection
