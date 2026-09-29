@extends('layouts.public')
@section('title', 'Device Repair Services in Bali | Bali Phone Repair')
@section('description', 'Browse iPhone, Android, iPad, laptop, MacBook, and data recovery services from Bali Phone Repair.')
@section('canonical', route('services.index'))
@section('content')
<main>
    <section class="section inner-hero compact">
        <div class="inner-wrap">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Services</span></div>
            <p class="eyebrow">Repair services</p>
            <h1>Device repair services in Bali</h1>
            <p class="hero-text">Choose a service page for device-specific repair guidance, common symptoms, diagnostics, WhatsApp booking, and related support areas.</p>
        </div>
    </section>
    <section class="section services-list-section">
        <div class="inner-wrap">
            <div class="service-list">
                @foreach($services as $service)
                    <article class="service-card photo-service-card">
                        <img src="{{ asset('assets/bali-phone-repair/'.($service->image ?: 'service-optimized.jpg')) }}" alt="{{ $service->image_alt ?: $service->name }}" width="900" height="900" loading="lazy" decoding="async">
                        <span class="service-icon icon-screen" aria-hidden="true"></span>
                        <b>{{ $service->name }}</b>
                        <p>{{ $service->short_description }}</p>
                        <a class="footer-emphasis" href="{{ route('services.show', $service) }}">Open service</a>
                    </article>
                @endforeach
            </div>
            {{ $services->links() }}
        </div>
    </section>
    <section class="section split">
        <div class="inner-card">
            <p class="eyebrow">Bali coverage</p>
            <h2>Service support by area</h2>
            <p>Share your location when contacting us so the team can confirm service options, timing, and the most practical next step.</p>
            <div class="area-tags">
                @foreach($areas as $area)<span>{{ $area->name }}</span>@endforeach
            </div>
        </div>
        <div class="inner-card">
            <p class="eyebrow">Need help now?</p>
            <h2>Ask for an estimate</h2>
            <p>Send device model, issue, photos, and location by WhatsApp.</p>
            <a class="btn btn-primary" href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999') }}" target="_blank" rel="noreferrer" data-analytics-event="whatsapp_click" data-analytics-location="services_footer">Chat WhatsApp</a>
        </div>
    </section>
</main>
@push('schema')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],['@type'=>'ListItem','position'=>2,'name'=>'Services','item'=>route('services.index')]]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
