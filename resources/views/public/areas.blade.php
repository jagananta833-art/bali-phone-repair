@extends('layouts.public')
@section('title', 'Bali Service Areas & Mobile Repair Coverage | Bali Phone Repair')
@section('description', 'Service area information for Bali Phone Repair across Denpasar, Canggu, Seminyak, Ubud, Kuta, Sanur, Uluwatu, and nearby Bali areas.')
@section('canonical', route('areas.index'))
@section('analytics_page_type', 'location')
@section('analytics_location_slug', 'service-areas')
@section('analytics_location_type', 'service_area_hub')
@section('content')
<main>
    <section class="section inner-hero">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Service Areas</span>
            </nav>
            <span class="section-eyebrow-pill"><i class="fa-solid fa-map-location-dot"></i> Island-Wide Coverage</span>
            <h1>Service Areas Across Bali</h1>
            <p class="hero-text">Fast walk-in workshops and mobile on-site villa service across Canggu, Seminyak, Denpasar, Ubud, Kuta, Sanur, Uluwatu, and surrounding areas.</p>
        </div>
    </section>

    <section class="section">
        <div class="inner-wrap">
            <div class="area-grid">
                @foreach($areas as $area)
                    <article class="inner-card" id="{{ $area->slug }}">
                        <span class="section-eyebrow-pill" style="font-size: 11px; padding: 2px 10px; margin-bottom: 8px;"><i class="fa-solid fa-location-dot"></i> Area Hub</span>
                        <h2>{{ $area->name }}</h2>
                        <p>{{ $area->description }}</p>
                        <a class="footer-emphasis" href="{{ route('locations.show', $area) }}" data-analytics-event="location_service_click" data-analytics-location="service_area_hub" data-analytics-location-id="{{ $area->id }}" data-analytics-location-slug="{{ $area->slug }}">
                            View {{ $area->name }} Services →
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" style="padding-top: 0;">
        <div class="inner-wrap inner-card">
            <span class="section-eyebrow-pill"><i class="fa-solid fa-screwdriver-wrench"></i> Fast Dispatch</span>
            <h2>Common Repair Services by Area</h2>
            <p>Our technicians carry specialized mobile diagnostic and repair tools directly to your accommodation.</p>
            <div class="link-list">
                @foreach($services as $service)
                    <a href="{{ route('services.show', $service) }}" data-analytics-event="related_service_click" data-analytics-location="service_areas" data-analytics-source-type="location_hub" data-analytics-target-service-id="{{ $service->id }}" data-analytics-link-position="{{ $loop->iteration }}">
                        <span>{{ $service->name }}</span>
                        <span>→</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</main>
@push('schema')
<script type="application/ld+json">{!! json_encode(['@'.'context'=>'https://schema.org','@'.'type'=>'BreadcrumbList','itemListElement'=>[['@'.'type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],['@'.'type'=>'ListItem','position'=>2,'name'=>'Service Areas','item'=>route('areas.index')]]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
