@php
    $assetBase = 'assets/bali-phone-repair/';
    $businessName = $siteSettings['business_name'] ?? 'Bali Phone Repair';
    $whatsapp = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $phone = $siteSettings['phone'] ?? '+6281929164999';
    $phoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', trim($phone))
        ? '+'.preg_replace('/\D+/', '', $phone)
        : null;
    $email = $siteSettings['email'] ?? 'hello@baliphonerepair.com';
    $title = trim($__env->yieldContent('title', $siteSettings['default_meta_title'] ?? $businessName));
    $description = trim($__env->yieldContent('description', $siteSettings['default_meta_description'] ?? 'Device repair, home service, buy and sell, and MacBook rental in Bali.'));
    $canonical = trim($__env->yieldContent('canonical', url()->current()));
    $ogType = trim($__env->yieldContent('og_type', 'website'));
    $image = trim($__env->yieldContent('image', asset($assetBase.'android-buy-sell-optimized.jpg')));
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="@yield('robots', 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1')">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="msvalidate.01" content="FAD0AF8AFEA125617B8475FC5EFFA76F">
    <link rel="alternate" type="application/rss+xml" title="Bali Phone Repair Blog" href="{{ route('rss') }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:image" content="{{ $image }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $image }}">
    @include('public.partials.analytics-head')
    <link rel="icon" type="image/jpeg" href="{{ asset($assetBase.'logo-optimized.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset($assetBase.'styles-improved.css') }}?v=inner-pages">
    <style>
        .inner-hero{min-height:auto;display:block;padding-top:34px;padding-bottom:34px}.inner-hero.compact{padding-top:28px;padding-bottom:24px}.inner-hero .eyebrow a{color:inherit}.inner-wrap{width:min(1120px,calc(100% - 36px));margin:0 auto}.inner-grid{display:grid;grid-template-columns:minmax(0,1fr) 340px;gap:28px;align-items:start}.inner-card{border:1px solid var(--line);border-radius:var(--radius);background:linear-gradient(180deg,rgba(255,255,255,.08),rgba(255,255,255,.035));box-shadow:var(--shadow);padding:28px}.inner-card h2,.inner-card h3{color:#fff;letter-spacing:-.035em}.content-body{color:#dce3ef}.content-body p,.content-body li{color:#cbd5e1}.content-body a{color:var(--primary);font-weight:800}.content-body img{width:100%;border-radius:18px;border:1px solid var(--line);margin:0 0 24px}.breadcrumb{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px;color:var(--muted);font-size:14px}.breadcrumb a{color:var(--primary);font-weight:800}.services-list-section{padding-top:24px}.service-list{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}.service-list .service-card{height:100%;min-height:342px;display:flex;flex-direction:column}.service-list .service-card img{width:100%;aspect-ratio:4/3;object-fit:cover}.service-list .service-card p{flex:1}.side-cta{position:sticky;top:120px}.side-cta .btn{width:100%;margin-top:14px}.link-list{display:grid;gap:10px;margin-top:16px}.link-list a{display:flex;justify-content:space-between;gap:12px;padding:12px 14px;border:1px solid var(--line);border-radius:14px;background:rgba(255,255,255,.045);color:#fff;font-weight:800}.link-list a:hover{border-color:rgba(74,222,128,.55);color:var(--primary)}.post-grid,.detail-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}.detail-grid.two{grid-template-columns:repeat(2,minmax(0,1fr))}.post-card{min-height:260px}.area-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}.faq-block details{margin-bottom:12px}.footer .footer-logo{color:#fff}.site-header .nav a[aria-current="page"]{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.22)}.service-main{display:grid;grid-template-columns:minmax(0,1fr) 360px;gap:28px;align-items:start}.service-main-image{width:100%;border-radius:18px;border:1px solid var(--line);aspect-ratio:16/10;object-fit:cover}.service-summary{display:grid;gap:14px}.service-summary .btn{width:100%}.detail-section{padding-top:34px;padding-bottom:34px}.detail-list{margin:0;padding-left:20px}.detail-list li{margin:9px 0;color:#cbd5e1}.process-list{counter-reset:steps;display:grid;gap:14px}.process-list article{position:relative;padding-left:48px}.process-list article:before{counter-increment:steps;content:counter(steps);position:absolute;left:0;top:0;display:grid;place-items:center;width:32px;height:32px;border-radius:50%;background:var(--primary);color:#04120a;font-weight:900}.final-cta{text-align:center}.final-cta .btn{margin-top:12px}@media(max-width:980px){.inner-grid,.service-list,.post-grid,.area-grid,.detail-grid,.detail-grid.two{grid-template-columns:1fr 1fr}.service-main{grid-template-columns:1fr}.side-cta{position:static}}@media(max-width:640px){.inner-grid,.service-list,.post-grid,.area-grid,.detail-grid,.detail-grid.two{grid-template-columns:1fr}.inner-card{padding:22px}.inner-hero,.inner-hero.compact{padding-top:24px;padding-bottom:22px}.site-header{position:sticky}.services-list-section{padding-top:8px}.service-main{gap:18px}.detail-section{padding-top:24px;padding-bottom:24px}.btn,.footer-btn{width:100%;justify-content:center}}
    </style>
    @stack('styles')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@'.'type' => 'LocalBusiness',
            '@'.'id' => url('/').'#localbusiness',
            'name' => $businessName,
            'url' => url('/'),
            'image' => asset($assetBase.'android-buy-sell-optimized.jpg'),
            'telephone' => $phone,
            'email' => $email,
            'address' => $siteSettings['address'] ?? 'Bali, Indonesia',
            'openingHours' => (!empty($siteSettings['opening_hours']) && !str_contains($siteSettings['opening_hours'], 'Mo-Sa')) ? $siteSettings['opening_hours'] : 'Mo-Su 09:00-21:00',
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @stack('schema')
</head>
<body
    data-page-type="@yield('analytics_page_type', 'page')"
    data-content-id="@yield('analytics_content_id')"
    data-content-slug="@yield('analytics_content_slug')"
    data-analytics-service-id="@yield('analytics_service_id')"
    data-analytics-service-slug="@yield('analytics_service_slug')"
    data-analytics-service-name="@yield('analytics_service_name')"
    data-analytics-article-id="@yield('analytics_article_id')"
    data-analytics-article-slug="@yield('analytics_article_slug')"
    data-analytics-category-slug="@yield('analytics_category_slug')"
    data-analytics-author-id="@yield('analytics_author_id')"
    data-analytics-location-id="@yield('analytics_location_id')"
    data-analytics-location-slug="@yield('analytics_location_slug')"
    data-analytics-location-type="@yield('analytics_location_type')">
@include('public.partials.analytics-body')
<header class="site-header" id="top">
    <a class="brand" href="{{ route('home') }}" aria-label="Bali Phone Repair">
        <img class="brand-logo" src="{{ asset($assetBase.'logo-optimized.jpg') }}" alt="Bali Phone Repair logo" width="320" height="320">
        <span><strong>Bali Phone Repair</strong><small>Repair - Trade - Rental</small></span>
    </a>
    <nav class="nav" aria-label="Main navigation">
        <a href="{{ route('services.show', 'iphone-repair-bali') }}">iPhone</a>
        <a href="{{ route('services.show', 'macbook-repair-bali') }}">MacBook</a>
        <a href="{{ route('services.show', 'android-repair-bali') }}">Android</a>
        <a href="{{ route('areas.index') }}">Areas</a>
        <a href="{{ route('home') }}#how-it-works">How It Works</a>
        <a href="{{ route('home') }}#faq">FAQ</a>
        <a href="{{ route('blog') }}">Blog</a>
        <details class="nav-explore">
            <summary>More</summary>
            <div class="nav-dropdown">
                <a href="{{ route('services.index') }}">All Services</a>
                <a href="{{ route('home') }}#jual-beli">Buy &amp; Sell</a>
                <a href="{{ route('home') }}#rental">MacBook Rental</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </details>
    </nav>
    <a class="header-cta" href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noreferrer" aria-label="Chat on WhatsApp" data-analytics-event="whatsapp_click" data-analytics-location="header"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
    <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false">&#9776;</button>
</header>
@yield('content')
@include('public.partials.footer')
<script src="{{ asset($assetBase.'script-improved.js') }}" defer></script>
</body>
</html>
