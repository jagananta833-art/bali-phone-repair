@extends('layouts.public')
@section('title', 'Bali Service Areas | Bali Phone Repair')
@section('description', 'Service area information for Bali Phone Repair across Denpasar, Canggu, Seminyak, Ubud, Kuta, Sanur, and nearby Bali areas.')
@section('canonical', route('areas.index'))
@section('analytics_page_type', 'location')
@section('analytics_location_slug', 'service-areas')
@section('analytics_location_type', 'service_area_hub')
@section('content')
<main>
    <section class="section inner-hero">
        <div class="inner-wrap">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Service Areas</span></div>
            <p class="eyebrow">Bali coverage</p>
            <h1>Service areas in Bali</h1>
            <p class="hero-text">Share your area when contacting Bali Phone Repair so the team can confirm timing, device handling, and whether home care is practical.</p>
        </div>
    </section>
    <section class="section">
        <div class="inner-wrap">
            <div class="area-grid">
                @foreach($areas as $area)
                    <article class="inner-card" id="{{ $area->slug }}">
                        <p class="eyebrow">Area</p>
                        <h2>{{ $area->name }}</h2>
                        <p>{{ $area->description }}</p>
                        <a class="footer-emphasis" href="{{ route('locations.show', $area) }}" data-analytics-event="location_service_click" data-analytics-location="service_area_hub" data-analytics-location-id="{{ $area->id }}" data-analytics-location-slug="{{ $area->slug }}">View {{ $area->name }}</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section">
        <div class="inner-wrap inner-card">
            <p class="eyebrow">Services by area</p>
            <h2>Common repair requests</h2>
            <div class="link-list">@foreach($services as $service)<a href="{{ route('services.show', $service) }}" data-analytics-event="related_service_click" data-analytics-location="service_areas" data-analytics-source-type="location_hub" data-analytics-target-service-id="{{ $service->id }}" data-analytics-link-position="{{ $loop->iteration }}"><span>{{ $service->name }}</span><span>→</span></a>@endforeach</div>
        </div>
    </section>
</main>
@push('schema')
<script type="application/ld+json">{!! json_encode(['@'.'context'=>'https://schema.org','@'.'type'=>'BreadcrumbList','itemListElement'=>[['@'.'type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],['@'.'type'=>'ListItem','position'=>2,'name'=>'Service Areas','item'=>route('areas.index')]]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
