@extends('layouts.public')
@section('title', 'Device Repair Services in Bali | Bali Phone Repair')
@section('description', 'Browse iPhone, Android, iPad, laptop, MacBook, and data recovery services from Bali Phone Repair.')
@section('canonical', route('services.index'))
@section('content')
<main>
    <section class="section inner-hero compact">
        <div class="inner-wrap">
            <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Services</span></nav>
            <span class="section-eyebrow-pill"><i class="fa-solid fa-wrench"></i> Repair Services</span>
            <h1>Device Repair Services in Bali</h1>
            <p class="hero-text">Professional on-demand repair solutions for iPhone, MacBook, Android, iPad, and Windows laptops across Bali with certified walk-in workshops and mobile villa dispatch.</p>
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
    <section class="section">
        <div class="inner-wrap split">
            <div class="inner-card">
                <span class="section-eyebrow-pill"><i class="fa-solid fa-map-pin"></i> Bali Coverage</span>
                <h2>Service support by area</h2>
                <p>Share your location when contacting us so the team can confirm service options, timing, and the most practical next step.</p>
                <div class="area-tags">
                    @foreach($areas as $area)<span>{{ $area->name }}</span>@endforeach
                </div>
            </div>
            <div class="inner-card">
                <span class="section-eyebrow-pill"><i class="fa-solid fa-calculator"></i> Need help now?</span>
                <h2>Ask for an estimate</h2>
                <p>Send your device model, issue, photos, and location via WhatsApp for an immediate free diagnostic estimate.</p>
                <a class="btn btn-primary" href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999') }}" target="_blank" rel="noreferrer" data-analytics-event="whatsapp_click" data-analytics-location="services_footer"><i class="fa-brands fa-whatsapp"></i> Chat WhatsApp</a>
            </div>
        </div>
    </section>
</main>
@push('schema')
<script type="application/ld+json">{!! json_encode(['@'.'context'=>'https://schema.org','@'.'type'=>'BreadcrumbList','itemListElement'=>[['@'.'type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],['@'.'type'=>'ListItem','position'=>2,'name'=>'Services','item'=>route('services.index')]]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
