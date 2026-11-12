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
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="@yield('robots', 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1')">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="author" content="jagananta833-art">
    <meta name="publisher" content="jagananta833-art">
    <meta name="generator" content="Engineered by jagananta833-art">
    <meta name="copyright" content="Bali Phone Repair &bull; Exclusively Maintained by jagananta833-art">
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
    <link rel="icon" type="image/jpeg" href="{{ asset($assetBase.'logo-optimized.jpg') }}?v=20260711-favicon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset($assetBase.'styles-improved.css') }}?v=theme-sync-v1">
    <style>
        :root {
            --primary-gold: #D4A346;
            --primary-gold-hover: #C69214;
            --gold-gradient: linear-gradient(135deg, #F5D061 0%, #D4A346 50%, #B8860B 100%);
            --gold-gradient-hover: linear-gradient(135deg, #FAE292 0%, #E5B24E 50%, #C69214 100%);
            --color-dark: #0f172a;
            --color-dark-banner: #0b0f19;
            --color-gray-900: #111827;
            --color-gray-800: #1f2937;
            --color-gray-700: #374151;
            --color-gray-600: #4b5563;
            --color-gray-500: #6b7280;
            --color-gray-200: #e5e7eb;
            --color-gray-100: #f3f4f6;
            --color-gray-50: #f9fafb;
            --color-white: #ffffff;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--color-white) !important;
            color: var(--color-gray-900) !important;
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
            padding-top: 68px;
        }

        a { text-decoration: none; color: inherit; }

        /* Sticky Navigation Header (Identical to Homepage) */
        .top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid #e5e7eb;
            height: 68px;
        }
        .top-header-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand-group {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .brand-logo-img {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .brand-text-block strong {
            font-size: 15px;
            font-weight: 700;
            color: var(--color-gray-900);
            line-height: 1.2;
            display: block;
            margin: 0;
        }
        .brand-text-block small {
            font-size: 12px;
            color: var(--color-gray-500);
            margin: 0;
            display: block;
        }
        .nav-links-desktop {
            display: flex;
            align-items: center;
            gap: 22px;
        }
        .nav-links-desktop a {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-gray-700);
            transition: color .2s ease;
        }
        .nav-links-desktop a:hover,
        .nav-links-desktop a.active {
            color: var(--color-gray-900);
        }
        .header-right-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .header-wa-link {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-gray-700);
            transition: color .2s ease;
        }
        .header-wa-link i {
            color: #d4a346;
            font-size: 16px;
        }
        .header-wa-link:hover {
            color: #b45309;
        }
        .btn-quote-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--gold-gradient);
            color: #0b0f19 !important;
            font-size: 13.5px;
            font-weight: 800;
            padding: 8px 18px;
            border-radius: 999px;
            transition: all .2s ease;
            box-shadow: 0 4px 14px rgba(212, 163, 70, 0.35);
        }
        .btn-quote-pill:hover {
            background: var(--gold-gradient-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 163, 70, 0.5);
        }
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 22px;
            color: var(--color-gray-900);
            cursor: pointer;
            padding: 6px;
        }

        /* Inner Page Layout & Components (Light, Cohesive Theme) */
        .inner-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }
        .inner-hero {
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
            border-bottom: 1px solid var(--color-gray-200);
            padding: 44px 0 38px;
        }
        .inner-hero.compact {
            padding: 34px 0 28px;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 14px;
            font-size: 13.5px;
            color: var(--color-gray-500);
        }
        .breadcrumb a {
            color: var(--color-gray-600);
            transition: color .2s ease;
        }
        .breadcrumb a:hover {
            color: var(--color-gray-900);
        }
        .breadcrumb span[aria-current="page"] {
            color: var(--color-gray-900);
            font-weight: 600;
        }
        .eyebrow,
        .section-eyebrow-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fffbeb;
            color: #b45309;
            border: 1px solid rgba(217, 119, 6, 0.22);
            font-size: 12px;
            font-weight: 800;
            padding: 4px 14px;
            border-radius: 999px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .inner-hero h1 {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            color: var(--color-gray-900);
            letter-spacing: -0.03em;
            line-height: 1.2;
            margin: 0 0 12px;
        }
        .hero-text {
            font-size: 16px;
            color: var(--color-gray-600);
            max-width: 760px;
            line-height: 1.6;
            margin: 0;
        }

        /* Section Styling */
        .section {
            padding: 48px 0;
            box-sizing: border-box;
        }
        .inner-card {
            background: #ffffff;
            border: 1px solid var(--color-gray-200);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 28px;
            color: var(--color-gray-800);
            box-sizing: border-box;
        }
        .inner-card h2,
        .inner-card h3 {
            color: var(--color-gray-900);
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-top: 0;
        }
        .inner-card p {
            color: var(--color-gray-600);
            line-height: 1.65;
        }
        .inner-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 32px;
            align-items: start;
        }

        /* Grids for Blog, Services, Areas */
        .post-grid,
        .service-list,
        .area-grid,
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }
        .detail-grid.two {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .post-card,
        .service-card {
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border: 1px solid var(--color-gray-200);
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: all .25s ease;
            height: 100%;
            box-sizing: border-box;
            padding: 24px;
        }
        .service-card {
            padding: 0;
        }
        .service-card img {
            width: 100%;
            aspect-ratio: 16/10;
            object-fit: cover;
            border-bottom: 1px solid var(--color-gray-200);
        }
        .service-card b,
        .service-card p,
        .service-card .footer-emphasis {
            padding: 0 20px;
        }
        .service-card b {
            font-size: 17px;
            font-weight: 800;
            color: var(--color-gray-900);
            margin-top: 16px;
        }
        .service-card p {
            margin: 8px 0 16px;
            flex: 1;
        }
        .service-card .footer-emphasis {
            margin-bottom: 20px;
        }
        .post-card:hover,
        .service-card:hover,
        .area-grid .inner-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }
        .post-card h2,
        .post-card h3 {
            font-size: 19px;
            line-height: 1.35;
            margin: 10px 0 12px;
        }
        .post-card h2 a,
        .post-card h3 a {
            color: var(--color-gray-900);
            transition: color .2s;
        }
        .post-card h2 a:hover,
        .post-card h3 a:hover {
            color: #b45309;
        }
        .post-card p {
            font-size: 14.5px;
            color: var(--color-gray-600);
            line-height: 1.6;
            margin: 0 0 16px;
            flex-grow: 1;
        }
        .footer-emphasis {
            color: #b45309;
            font-weight: 700;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
        }
        .footer-emphasis:hover {
            color: #92400e;
            gap: 9px;
        }

        /* Buttons & Actions */
        .btn,
        .btn-primary {
            background: var(--gold-gradient);
            color: #0b0f19 !important;
            font-weight: 800;
            border-radius: 999px;
            padding: 12px 26px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all .2s ease;
            box-shadow: 0 4px 14px rgba(212, 163, 70, 0.35);
            font-size: 14px;
        }
        .btn-primary:hover {
            background: var(--gold-gradient-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 163, 70, 0.5);
        }
        .btn-secondary {
            background: #f3f4f6;
            color: #1f2937 !important;
            font-weight: 700;
            border-radius: 999px;
            padding: 12px 24px;
            border: 1px solid var(--color-gray-200);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all .2s ease;
            font-size: 14px;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
            color: #111827 !important;
        }

        /* Content Body / Editorial Articles */
        .content-body {
            color: var(--color-gray-800);
            font-size: 16px;
            line-height: 1.75;
        }
        .content-body p {
            color: var(--color-gray-700);
            margin: 0 0 18px;
        }
        .content-body h2 {
            color: var(--color-gray-900);
            font-size: 24px;
            font-weight: 800;
            margin: 36px 0 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--color-gray-100);
        }
        .content-body h3 {
            color: var(--color-gray-900);
            font-size: 20px;
            font-weight: 700;
            margin: 26px 0 12px;
        }
        .content-body a {
            color: #b45309;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .content-body img {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--color-gray-200);
            margin: 0 0 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            object-fit: cover;
        }
        .content-body blockquote {
            border-left: 4px solid var(--primary-gold);
            background: #fffbeb;
            padding: 16px 20px;
            border-radius: 0 12px 12px 0;
            margin: 24px 0;
            color: #92400e;
            font-style: italic;
        }

        /* Sidebar CTA & Service Main */
        .service-main {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 32px;
            align-items: start;
        }
        .service-main-image {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--color-gray-200);
            aspect-ratio: 16/10;
            object-fit: cover;
            margin-bottom: 24px;
        }
        .side-cta {
            position: sticky;
            top: 92px;
            background: #f9fafb;
            border: 1px solid var(--color-gray-200);
            border-radius: 16px;
            padding: 24px;
        }
        .side-cta .btn {
            width: 100%;
            margin-top: 12px;
            box-sizing: border-box;
        }
        .link-list {
            display: grid;
            gap: 10px;
            margin-top: 16px;
        }
        .link-list a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border: 1px solid var(--color-gray-200);
            border-radius: 12px;
            background: #ffffff;
            color: var(--color-gray-800);
            font-weight: 700;
            transition: all .2s ease;
        }
        .link-list a:hover {
            border-color: var(--primary-gold);
            background: #fffdf5;
            color: #b45309;
            transform: translateX(3px);
        }

        /* FAQ details */
        .faq-block details,
        .faq-list details {
            border: 1px solid var(--color-gray-200);
            border-radius: 14px;
            background: #ffffff;
            padding: 16px 20px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: all .2s;
        }
        .faq-block details[open],
        .faq-list details[open] {
            border-color: var(--primary-gold);
            box-shadow: 0 4px 16px rgba(212, 163, 70, 0.12);
        }
        .faq-block summary,
        .faq-list summary {
            font-weight: 700;
            color: var(--color-gray-900);
            cursor: pointer;
            list-style: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15.5px;
        }
        .faq-block details p,
        .faq-list details p {
            color: var(--color-gray-600);
            margin: 12px 0 0;
            line-height: 1.6;
            font-size: 14.5px;
        }

        /* Area Tags */
        .area-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }
        .area-tags span {
            background: #f3f4f6;
            color: var(--color-gray-700);
            border: 1px solid var(--color-gray-200);
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 999px;
            display: inline-block;
        }

        /* Outlet address component */
        .outlet-details {
            font-style: normal;
            display: grid;
            gap: 6px;
            font-size: 14px;
            color: var(--color-gray-600);
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--color-gray-200);
        }
        .outlet-details strong {
            color: var(--color-gray-900);
        }
        .outlet-details a {
            color: #b45309;
            font-weight: 600;
        }

        /* Responsive Breakpoints */
        @media (max-width: 980px) {
            .nav-links-desktop { display: none; }
            .nav-links-desktop.show-mobile {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 68px;
                left: 0;
                right: 0;
                background: #ffffff;
                border-bottom: 1px solid var(--color-gray-200);
                padding: 16px 24px;
                gap: 12px;
                box-shadow: 0 12px 28px rgba(0,0,0,0.12);
                z-index: 999;
            }
            .nav-links-desktop.show-mobile a {
                font-size: 15px;
                font-weight: 600;
                color: var(--color-gray-800);
                padding: 8px 0;
                border-bottom: 1px solid var(--color-gray-100);
            }
            .nav-links-desktop.show-mobile a:last-child {
                border-bottom: none;
            }
            .mobile-menu-btn { display: block; }
            .inner-grid,
            .service-main {
                grid-template-columns: 1fr;
            }
            .post-grid,
            .service-list,
            .area-grid,
            .detail-grid,
            .detail-grid.two {
                grid-template-columns: repeat(2, 1fr);
            }
            .side-cta {
                position: static;
            }
        }
        @media (max-width: 640px) {
            .post-grid,
            .service-list,
            .area-grid,
            .detail-grid,
            .detail-grid.two {
                grid-template-columns: 1fr;
            }
            .inner-card {
                padding: 20px;
            }
            .inner-hero {
                padding: 34px 0 24px;
            }
            .btn,
            .btn-primary,
            .btn-secondary {
                width: 100%;
            }
        }
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

<header class="top-header" id="top">
    <div class="top-header-inner">
        <a class="brand-group" href="{{ route('home') }}" aria-label="Bali Phone Repair">
            <img class="brand-logo-img" src="{{ asset($assetBase.'logo-optimized.jpg') }}" alt="Bali Phone Repair" width="42" height="42">
            <div class="brand-text-block">
                <strong>Bali Phone Repair</strong>
                <small>We Come to Your Villa or Hotel</small>
            </div>
        </a>

        <nav class="nav-links-desktop" aria-label="Main navigation">
            <a href="{{ route('services.show', 'iphone-repair-bali') }}" {{ request()->is('*iphone*') ? 'class=active' : '' }}>iPhone</a>
            <a href="{{ route('services.show', 'macbook-repair-bali') }}" {{ request()->is('*macbook*') ? 'class=active' : '' }}>MacBook</a>
            <a href="{{ route('services.show', 'android-repair-bali') }}" {{ request()->is('*android*') ? 'class=active' : '' }}>Android</a>
            <a href="{{ route('areas.index') }}" {{ request()->routeIs('areas.*') || request()->routeIs('locations.*') ? 'class=active' : '' }}>Areas</a>
            <a href="{{ route('home') }}#how-it-works">How It Works</a>
            <a href="{{ route('home') }}#faq">FAQ</a>
            <a href="{{ route('blog') }}" {{ request()->routeIs('blog') || request()->routeIs('posts.*') ? 'class=active' : '' }}>Blog</a>
            <a href="{{ route('partners.index') }}" {{ request()->routeIs('partners.*') ? 'class=active' : '' }}>Partner</a>
        </nav>

        <div class="header-right-actions">
            <a class="header-wa-link" href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noreferrer">
                <i class="fa-solid fa-phone" style="font-size: 13px;"></i> WhatsApp
            </a>
            <a class="btn-quote-pill" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20a%20device%20repair%20in%20Bali.%20Can%20you%20help%3F" target="_blank" rel="noreferrer" data-analytics-event="whatsapp_click" data-analytics-location="header">
                <i class="fa-brands fa-whatsapp"></i>
                <span>Get a Quote</span>
            </a>
            <button class="mobile-menu-btn" type="button" aria-label="Toggle menu" onclick="document.querySelector('.nav-links-desktop').classList.toggle('show-mobile')">&#9776;</button>
        </div>
    </div>
</header>

@yield('content')

@include('public.partials.footer')
<script src="{{ asset($assetBase.'script-improved.js') }}" defer></script>
</body>
</html>
