@php
    $assetBase = 'assets/bali-phone-repair/';
    $businessName = $siteSettings['business_name'] ?? 'Bali Phone Repair';
    $whatsapp = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $phone = $siteSettings['phone'] ?? '+6281929164999';
    $phoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', trim($phone))
        ? '+'.preg_replace('/\D+/', '', $phone)
        : null;
    $email = $siteSettings['email'] ?? 'hello@baliphonerepair.com';
    $openingHours = $siteSettings['opening_hours'] ?? 'Mo-Sa 09:00-21:00';
    $address = $siteSettings['address'] ?? 'Jl. Pulau Misol No.106, Dauh Puri Kauh, Denpasar, Bali 80113';
    $defaultTitle = 'Phone, iPhone, Samsung & MacBook Repair Bali | Bali Phone Repair';
    $title = !empty($siteSettings['default_meta_title']) && !str_contains($siteSettings['default_meta_title'], 'Rental Device')
        ? $siteSettings['default_meta_title']
        : $defaultTitle;
    $defaultDesc = 'Professional iPhone, Samsung, Android, MacBook & laptop repair in Bali. Certified walk-in workshops in Canggu & Denpasar, same-day screen & battery replacement, plus fast on-site villa service across Bali.';
    $description = !empty($siteSettings['default_meta_description']) && !str_contains($siteSettings['default_meta_description'], 'jual beli')
        ? $siteSettings['default_meta_description']
        : $defaultDesc;
    $ogTitle = 'Phone, iPhone, Samsung & MacBook Repair Bali | Bali Phone Repair';
    $ogDescription = 'Fast professional phone & laptop repair across Bali. Walk-in workshops in Canggu & Denpasar, plus 30-60 min on-site villa repair service.';
    $ogImage = asset($assetBase.'android-buy-sell-optimized.jpg');
    $fallbackFaqs = collect([
        ['question' => 'Do you come to my location in Bali?', 'answer' => 'Yes! Our mobile technicians come directly to your villa, hotel, cafe, or coworking space anywhere in Bali including Canggu, Seminyak, Kuta, Ubud, Uluwatu, and Sanur.'],
        ['question' => 'How long does a typical repair take?', 'answer' => 'Most screen and battery replacements take between 30 to 60 minutes and are completed right on the spot.'],
        ['question' => 'What device models do you repair?', 'answer' => 'We repair all iPhone models (from iPhone 7 to 16 Pro Max), Samsung Galaxy, Google Pixel, Android devices, as well as MacBook Air, MacBook Pro, and Windows laptops.'],
        ['question' => 'Do you provide a warranty on repairs?', 'answer' => 'Yes, we provide up to 60-day warranty on replacement parts and labor. If you experience any issues, we will make it right.'],
        ['question' => 'Is my personal data safe during repair?', 'answer' => 'Absolutely. We fix your device right in front of you at your villa or hotel. Your personal photos, data, and passwords remain completely private.'],
        ['question' => 'What payment methods do you accept?', 'answer' => 'We accept Cash (IDR, USD, EUR, AUD), Bank Transfer, Wise, Credit/Debit Cards, GoPay, OVO, and Dana upon satisfactory testing of your device.'],
        ['question' => 'How does MacBook rental work?', 'answer' => 'Simply message us on WhatsApp with your rental duration, preferred specs (M1, M2, or Intel), and your villa address. We deliver directly to you with a simple deposit.'],
    ]);
    $homepageFaqs = isset($faqs) && $faqs->isNotEmpty()
        ? $faqs->map(fn ($faq) => ['question' => $faq->question, 'answer' => $faq->answer])->values()
        : $fallbackFaqs;
    $fallbackTestimonials = collect([
        ['initials' => 'JM', 'name' => 'Jake M.', 'area' => 'Canggu', 'quote' => 'Dropped my iPhone in the pool at our villa. These guys arrived within 45 minutes and saved my phone and all my travel photos. Absolute lifesavers!'],
        ['initials' => 'SL', 'name' => 'Sophie L.', 'area' => 'Seminyak', 'quote' => 'Cracked my screen on day 2 of my Bali holiday. They came directly to my hotel in Seminyak and replaced it in 30 minutes. Looks brand new!'],
        ['initials' => 'MB', 'name' => 'Marco B.', 'area' => 'Ubud', 'quote' => 'My iPhone battery was dying by lunchtime. The technician replaced it at my Airbnb in Ubud and now it easily lasts the entire day. Top notch service.'],
    ]);
    $homepageTestimonials = $fallbackTestimonials;
@endphp<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>{{ $title }}</title>
  <meta name="description" content="{{ $description }}" />
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
  <link rel="canonical" href="{{ url()->current() }}" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="{{ $businessName }}" />
  <meta property="og:title" content="{{ $ogTitle }}" />
  <meta property="og:description" content="{{ $ogDescription }}" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:image" content="{{ $ogImage }}" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{ $ogTitle }}" />
  <meta name="twitter:description" content="{{ $ogDescription }}" />
  <meta name="twitter:image" content="{{ $ogImage }}" />
  @include('public.partials.analytics-head')
  <link rel="icon" type="image/jpeg" href="{{ asset($assetBase.'logo-optimized.jpg') }}?v=20260711-favicon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset($assetBase.'styles-improved.css') }}?v={{ time() }}" />

  <style>
    /* -------------------------------------------------------------
       MODERN UI REDESIGN - REFERENCE: iphonerepairbali.com
       Ensures immediate cache-free rendering across all devices & tunnels
    ------------------------------------------------------------- */
    :root {
      --primary-gold: #D4A346;
      --primary-gold-hover: #C69214;
      --gold-gradient: linear-gradient(135deg, #F5D061 0%, #D4A346 50%, #B8860B 100%);
      --gold-gradient-hover: linear-gradient(135deg, #FAE292 0%, #E5B24E 50%, #C69214 100%);
      --color-dark: #0f172a;
      --color-dark-banner: #0b0f19;
      --color-gray-900: #111827;
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
      background-color: var(--color-white);
      color: var(--color-gray-900);
      -webkit-font-smoothing: antialiased;
      line-height: 1.5;
    }

    a { text-decoration: none; color: inherit; }

    /* Sticky Navigation Header */
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
    .brand-text-block h1,
    .brand-text-block strong {
      font-size: 15px;
      font-weight: 700;
      color: var(--color-gray-900);
      line-height: 1.2;
      display: block;
      margin: 0;
    }
    .brand-text-block p,
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
    .nav-links-desktop a:hover {
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

    /* Hero Section (Enlarged Title + Photo Background Slideshow) */
    .hero-container {
      background: #0b0f19;
      padding: 120px 20px 60px;
      position: relative;
      overflow: hidden;
      color: #ffffff;
      text-align: center;
    }
    .hero-bg-slider {
      position: absolute;
      inset: 0;
      z-index: 1;
      overflow: hidden;
      pointer-events: none;
    }
    .hero-bg-slide {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center 50%;
      opacity: 1;
      transform: scale(1);
    }
    .hero-bg-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(11, 15, 25, 0.30) 0%, rgba(15, 23, 42, 0.48) 100%);
    }
    .hero-content {
      max-width: 960px;
      margin: 0 auto;
      position: relative;
      z-index: 3;
    }
    .hero-slider-indicators {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-top: 22px;
      position: relative;
      z-index: 4;
    }
    .hero-indicator-dot {
      width: 28px;
      height: 5px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.45);
      border: none;
      cursor: pointer;
      padding: 0;
      transition: all 0.3s ease;
    }
    .hero-indicator-dot.active {
      background: var(--primary-gold);
      width: 44px;
      box-shadow: 0 0 12px rgba(212, 163, 70, 0.75);
    }
    .hero-location-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(15, 23, 42, 0.78);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.35);
      color: #ffffff;
      font-size: 13.5px;
      font-weight: 700;
      padding: 6px 18px;
      border-radius: 999px;
      margin-bottom: 22px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
    }
    .hero-headline {
      font-size: clamp(38px, 6.2vw, 72px);
      font-weight: 900;
      line-height: 1.05;
      color: #ffffff;
      letter-spacing: -0.035em;
      margin: 0 0 18px;
      text-shadow: 0 3px 18px rgba(0, 0, 0, 0.92), 0 1px 4px rgba(0, 0, 0, 0.95);
    }
    .hero-description {
      font-size: clamp(16px, 2vw, 20px);
      color: #ffffff;
      line-height: 1.6;
      max-width: 700px;
      margin: 0 auto 30px;
      text-shadow: 0 2px 14px rgba(0, 0, 0, 0.9);
    }
    .hero-cta-buttons {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      flex-wrap: wrap;
      margin-bottom: 44px;
    }
    .btn-hero-quote {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: var(--gold-gradient);
      color: #0b0f19 !important;
      font-size: 16px;
      font-weight: 800;
      padding: 14px 34px;
      border-radius: 14px;
      box-shadow: 0 10px 28px rgba(212, 163, 70, 0.4);
      transition: all .2s ease;
    }
    .btn-hero-quote:hover {
      background: var(--gold-gradient-hover);
      transform: translateY(-2px);
      box-shadow: 0 14px 34px rgba(212, 163, 70, 0.55);
    }
    .btn-hero-view-services {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: rgba(255, 255, 255, 0.88);
      font-size: 15px;
      font-weight: 700;
      padding: 14px 24px;
      border-radius: 14px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.18);
      transition: all .2s ease;
    }
    .btn-hero-view-services:hover {
      background: rgba(255, 255, 255, 0.14);
      color: #ffffff;
    }

    /* 3 Horizontal Photos Grid */
    .hero-photos-trio {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      max-width: 980px;
      margin: 0 auto;
    }
    .hero-photo-card {
      position: relative;
      aspect-ratio: 4 / 3;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.22);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.4);
      background: #111827;
      margin: 0;
    }
    .hero-photo-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform .4s ease;
    }
    .hero-photo-card:hover img {
      transform: scale(1.05);
    }
    .hero-photo-tag {
      position: absolute;
      bottom: 10px;
      left: 10px;
      background: rgba(15, 23, 42, 0.78);
      backdrop-filter: blur(6px);
      color: #ffffff;
      font-size: 11.5px;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* 4-Item Trust Bar */
    .trust-bar-section {
      background: #ffffff;
      border-bottom: 1px solid #e5e7eb;
      padding: 24px 20px;
    }
    .trust-bar-inner {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }
    .trust-item {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .trust-icon-box {
      width: 46px;
      height: 46px;
      border-radius: 12px;
      background: #fffbeb;
      color: #d97706;
      border: 1px solid rgba(217, 119, 6, 0.22);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }
    .trust-text h4 {
      font-size: 15px;
      font-weight: 700;
      color: var(--color-gray-900);
      margin: 0 0 2px;
    }
    .trust-text p {
      font-size: 13px;
      color: var(--color-gray-600);
      margin: 0;
    }

    /* Section Headings */
    .section-standard {
      padding: 80px 20px;
    }
    .section-head-center {
      text-align: center;
      max-width: 720px;
      margin: 0 auto 40px;
    }
    .section-eyebrow-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #fffbeb;
      color: #b45309;
      border: 1px solid rgba(217, 119, 6, 0.22);
      font-size: 13px;
      font-weight: 800;
      padding: 4px 14px;
      border-radius: 999px;
      margin-bottom: 12px;
      text-transform: uppercase;
      letter-spacing: .05em;
    }
    .section-main-title {
      font-size: clamp(30px, 4vw, 44px);
      font-weight: 800;
      color: var(--color-gray-900);
      letter-spacing: -0.03em;
      margin: 0 0 12px;
    }
    .section-main-subtitle {
      font-size: 17px;
      color: var(--color-gray-600);
      line-height: 1.6;
      margin: 0;
    }

    /* Filter Category Pills */
    .category-pills-row {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 44px;
    }
    .category-pills-row button {
      padding: 10px 20px;
      border-radius: 999px;
      font-size: 14px;
      font-weight: 700;
      border: 1px solid var(--color-gray-200);
      background: var(--color-gray-50);
      color: var(--color-gray-700);
      cursor: pointer;
      transition: all .2s ease;
    }
    .category-pills-row button:hover {
      background: #e5e7eb;
      color: var(--color-gray-900);
    }
    .category-pills-row button.active {
      background: var(--color-gray-900);
      color: #ffffff;
      border-color: var(--color-gray-900);
      box-shadow: 0 4px 14px rgba(17, 24, 39, 0.25);
    }

    /* Service Cards 3-Column Grid */
    .services-cards-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 26px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .service-item-card {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
      transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .service-item-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.09);
      border-color: #cbd5e1;
    }
    .service-card.hidden {
      display: none !important;
    }
    .card-photo-wrapper {
      position: relative;
      aspect-ratio: 4 / 3;
      overflow: hidden;
      background: var(--color-gray-100);
    }
    .card-photo-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform .45s ease;
    }
    .service-item-card:hover .card-photo-wrapper img {
      transform: scale(1.06);
    }
    .badge-duration {
      position: absolute;
      top: 14px;
      left: 14px;
      background: rgba(255, 255, 255, 0.94);
      backdrop-filter: blur(6px);
      color: var(--color-gray-900);
      font-size: 12px;
      font-weight: 800;
      padding: 5px 12px;
      border-radius: 999px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
      z-index: 2;
    }
    .badge-status-dark {
      position: absolute;
      top: 14px;
      right: 14px;
      background: var(--color-gray-900);
      color: #ffffff;
      font-size: 12px;
      font-weight: 800;
      padding: 5px 12px;
      border-radius: 999px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      z-index: 2;
    }
    .badge-status-red {
      position: absolute;
      top: 14px;
      right: 14px;
      background: #e11d48;
      color: #ffffff;
      font-size: 12px;
      font-weight: 800;
      padding: 5px 12px;
      border-radius: 999px;
      box-shadow: 0 2px 8px rgba(225, 29, 72, 0.35);
      z-index: 2;
    }
    .card-text-body {
      padding: 24px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .card-service-title {
      font-size: 19px;
      font-weight: 700;
      color: var(--color-gray-900);
      margin: 0 0 6px;
    }
    .card-price-text {
      font-size: 19px;
      font-weight: 800;
      color: var(--color-gray-900);
      margin: 0 0 12px;
    }
    .card-explanation {
      font-size: 14px;
      color: var(--color-gray-600);
      line-height: 1.6;
      margin: 0 0 22px;
      flex: 1;
    }
    .btn-card-whatsapp {
      width: 100%;
      background: var(--gold-gradient);
      color: #0b0f19 !important;
      font-size: 14px;
      font-weight: 800;
      padding: 12px 20px;
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all .2s ease;
      box-shadow: 0 4px 14px rgba(212, 163, 70, 0.3);
      box-sizing: border-box;
    }
    .btn-card-whatsapp:hover {
      background: var(--gold-gradient-hover);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(212, 163, 70, 0.45);
    }

    /* How It Works Section */
    .how-it-works-bg {
      background: var(--color-gray-50);
      border-top: 1px solid var(--color-gray-200);
      border-bottom: 1px solid var(--color-gray-200);
      padding: 80px 20px;
    }
    .steps-trio-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .step-box-card {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      padding: 38px 28px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.03);
      position: relative;
    }
    .step-icon-wrapper {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 68px;
      height: 68px;
      background: var(--color-gray-100);
      color: var(--color-gray-900);
      border-radius: 18px;
      font-size: 28px;
      margin-bottom: 22px;
    }
    .step-badge-number {
      position: absolute;
      top: -8px;
      right: -8px;
      width: 28px;
      height: 28px;
      background: var(--color-gray-900);
      color: #ffffff;
      font-size: 13px;
      font-weight: 800;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .step-box-card h3 {
      font-size: 18px;
      font-weight: 700;
      color: var(--color-gray-900);
      margin: 0 0 10px;
    }
    .step-box-card p {
      font-size: 14px;
      color: var(--color-gray-600);
      line-height: 1.6;
      margin: 0;
    }

    /* Coverage Areas Section */
    .coverage-areas-section {
      background: #ffffff;
      padding: 70px 20px;
      text-align: center;
    }
    .areas-pill-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      max-width: 900px;
      margin: 0 auto 24px;
    }
    .area-badge-link {
      background: var(--color-gray-100);
      color: var(--color-gray-700);
      padding: 9px 20px;
      border-radius: 999px;
      font-size: 14px;
      font-weight: 600;
      transition: all .2s ease;
    }
    .area-badge-link:hover {
      background: var(--color-gray-200);
      color: var(--color-gray-900);
      transform: translateY(-1px);
    }

    /* Customer Reviews / Testimonials Grid */
    .reviews-section-bg {
      background: var(--color-gray-50);
      border-top: 1px solid var(--color-gray-200);
      border-bottom: 1px solid var(--color-gray-200);
      padding: 80px 20px;
    }
    .reviews-grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .review-card-box {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      padding: 28px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .stars-row {
      display: flex;
      gap: 4px;
      color: #f59e0b;
      margin-bottom: 14px;
      font-size: 15px;
    }
    .review-quote {
      font-size: 14.5px;
      color: var(--color-gray-700);
      line-height: 1.65;
      margin: 0 0 20px;
      font-style: italic;
    }
    .review-author-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .review-avatar-letter {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--color-gray-100);
      color: var(--color-gray-700);
      font-weight: 800;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .review-author-info strong {
      display: block;
      font-size: 14px;
      font-weight: 700;
      color: var(--color-gray-900);
    }
    .review-author-info span {
      display: block;
      font-size: 12px;
      color: #d97706;
      font-weight: 700;
    }

    /* Pricing Quick Overview */
    .pricing-table-container {
      max-width: 820px;
      margin: 0 auto;
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }
    .pricing-table-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 24px;
      border-bottom: 1px solid var(--color-gray-100);
      transition: background .2s ease;
    }
    .pricing-table-row:last-child {
      border-bottom: none;
    }
    .pricing-table-row:hover {
      background: var(--color-gray-50);
    }
    .pricing-service-title {
      font-size: 15px;
      font-weight: 700;
      color: var(--color-gray-900);
      margin: 0;
    }
    .pricing-service-duration {
      font-size: 12.5px;
      color: var(--color-gray-500);
      margin: 2px 0 0;
    }
    .pricing-price-tag {
      font-size: 16px;
      font-weight: 800;
      color: var(--color-gray-900);
      text-align: right;
    }

    /* Device Buy/Sell & Rental Sections */
    .extra-services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .extra-card {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.04);
      display: flex;
      flex-direction: column;
    }
    .extra-card-media {
      aspect-ratio: 16 / 10;
      position: relative;
      overflow: hidden;
    }
    .extra-card-media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }
    .extra-card-body {
      padding: 22px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .extra-card-badge {
      font-size: 12px;
      font-weight: 700;
      color: #d97706;
      text-transform: uppercase;
      letter-spacing: .04em;
      margin-bottom: 6px;
    }
    .extra-card-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--color-gray-900);
      margin: 0 0 8px;
    }
    .extra-card-desc {
      font-size: 13.5px;
      color: var(--color-gray-600);
      line-height: 1.6;
      margin: 0 0 16px;
      flex: 1;
    }

    /* FAQ Section */
    .faq-container {
      max-width: 800px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .faq-item-card {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 16px;
      overflow: hidden;
      transition: border-color .2s ease;
    }
    .faq-item-card summary {
      padding: 18px 24px;
      font-size: 15.5px;
      font-weight: 700;
      color: var(--color-gray-900);
      cursor: pointer;
      list-style: none;
      display: flex;
      align-items: center;
      justify-content: space-between;
      user-select: none;
    }
    .faq-item-card summary::-webkit-details-marker {
      display: none;
    }
    .faq-item-card summary::after {
      content: "+";
      font-size: 20px;
      font-weight: 600;
      color: var(--color-gray-500);
      transition: transform .2s ease;
    }
    .faq-item-card[open] summary::after {
      content: "−";
    }
    .faq-item-card p {
      padding: 0 24px 20px;
      font-size: 14.5px;
      color: var(--color-gray-600);
      line-height: 1.65;
      margin: 0;
    }

    /* Bottom CTA Banner */
    .bottom-cta-banner {
      background: var(--color-dark);
      padding: 80px 20px;
      text-align: center;
      color: #ffffff;
    }
    .bottom-cta-inner {
      max-width: 720px;
      margin: 0 auto;
    }
    .bottom-cta-inner h2 {
      font-size: clamp(30px, 4vw, 44px);
      font-weight: 800;
      margin: 0 0 14px;
      letter-spacing: -0.03em;
    }
    .bottom-cta-inner p {
      font-size: 17px;
      color: #cbd5e1;
      line-height: 1.6;
      margin: 0 0 32px;
    }

    /* Floating WhatsApp Button */
    .floating-wa-btn {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 999;
      background: var(--gold-gradient);
      color: #0b0f19 !important;
      padding: 12px 22px;
      border-radius: 999px;
      font-weight: 800;
      font-size: 14.5px;
      display: inline-flex;
      align-items: center;
      gap: 9px;
      box-shadow: 0 8px 24px rgba(212, 163, 70, 0.45);
      transition: all .25s ease;
    }
    .floating-wa-btn:hover {
      background: var(--gold-gradient-hover);
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(212, 163, 70, 0.6);
    }

    /* Responsive Breakpoints */
    @media (min-width: 1440px) {
      .hero-bg-slide {
        background-position: center 48%;
      }
    }
    @media (max-width: 1024px) {
      .services-cards-grid,
      .steps-trio-grid,
      .reviews-grid-3,
      .extra-services-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .trust-bar-inner {
        grid-template-columns: repeat(2, 1fr);
      }
      .hero-bg-slide {
        background-position: center 50%;
      }
      .nav-links-desktop {
        display: none;
      }
      .nav-links-desktop.show-mobile {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 68px;
        left: 0;
        right: 0;
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
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
        border-bottom: 1px solid #f3f4f6;
      }
      .nav-links-desktop.show-mobile a:last-child {
        border-bottom: none;
      }
      .mobile-menu-btn {
        display: block;
      }
    }
    @media (max-width: 680px) {
      .services-cards-grid,
      .steps-trio-grid,
      .reviews-grid-3,
      .extra-services-grid,
      .trust-bar-inner,
      .hero-photos-trio {
        grid-template-columns: 1fr;
      }
      .hero-container {
        padding: 100px 16px 50px;
      }
      .hero-bg-slide {
        background-position: center 50%;
      }
      .top-header-inner {
        padding: 0 16px;
      }
      .header-wa-link {
        display: none;
      }
      .floating-wa-btn span {
        display: none;
      }
      .floating-wa-btn {
        padding: 14px;
        border-radius: 50%;
      }
    }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "Organization",
        "@id": "{{ url('/') }}#organization",
        "name": "{{ $businessName }}",
        "legalName": "Bali Phone Repair & Technology Care",
        "url": "{{ url('/') }}",
        "logo": "{{ asset($assetBase.'logo-optimized.jpg') }}",
        "email": "{{ $email }}",
        "telephone": "{{ $phone }}",
        "sameAs": [
          "https://wa.me/{{ $whatsapp }}"
        ]
      },
      {
        "@type": ["LocalBusiness", "MobilePhoneStore"],
        "@id": "{{ url('/') }}#business",
        "name": "{{ $businessName }}",
        "url": "{{ url('/') }}",
        "image": "{{ $ogImage }}",
        "description": "Professional electronics repair service in Bali specializing in iPhone, Samsung, MacBook, iPad, and Android repair with certified walk-in workshops in Canggu and Denpasar, plus on-site villa service.",
        "telephone": "{{ $phone }}",
        "email": "{{ $email }}",
        "priceRange": "$$",
        "hasMap": "https://maps.google.com/?q=Bali+Phone+Repair+Denpasar",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Jl. Pulau Misol No.106, Dauh Puri Kauh",
          "addressLocality": "Denpasar",
          "addressRegion": "Bali",
          "postalCode": "80113",
          "addressCountry": "ID"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": -8.6784,
          "longitude": 115.2075
        },
        "openingHoursSpecification": [
          {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "opens": "09:00",
            "closes": "21:00"
          },
          {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Sunday"],
            "opens": "09:00",
            "closes": "18:00"
          }
        ],
        "areaServed": [
          { "@type": "AdministrativeArea", "name": "Canggu" },
          { "@type": "AdministrativeArea", "name": "Pererenan" },
          { "@type": "AdministrativeArea", "name": "Berawa" },
          { "@type": "AdministrativeArea", "name": "Seminyak" },
          { "@type": "AdministrativeArea", "name": "Kuta" },
          { "@type": "AdministrativeArea", "name": "Ubud" },
          { "@type": "AdministrativeArea", "name": "Sanur" },
          { "@type": "AdministrativeArea", "name": "Denpasar" },
          { "@type": "AdministrativeArea", "name": "Jimbaran" },
          { "@type": "AdministrativeArea", "name": "Uluwatu" }
        ],
        "subOrganization": [
          {
            "@type": ["LocalBusiness", "MobilePhoneStore"],
            "@id": "{{ url('/') }}#branch-ismart-canggu",
            "name": "iSmart Canggu (Bali Phone Repair)",
            "alternateName": "iSmart Canggu Workshop",
            "url": "{{ route('areas.show', 'canggu') }}",
            "telephone": "{{ $phone }}",
            "priceRange": "$$",
            "description": "iSmart Canggu is a certified Bali Phone Repair branch serving tourists, expats, and digital nomads in Canggu, Berawa, Batu Bolong, and Pererenan with walk-in repairs and rapid mobile villa technician dispatch.",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Jl. Raya Canggu, Kerobokan",
              "addressLocality": "Canggu / Kerobokan",
              "addressRegion": "Bali",
              "postalCode": "80361",
              "addressCountry": "ID"
            },
            "hasMap": "https://maps.google.com/?q=iSmart+Canggu+Bali",
            "openingHoursSpecification": [
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "opens": "09:00",
                "closes": "20:00"
              },
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Sunday"],
                "opens": "10:00",
                "closes": "18:00"
              }
            ]
          },
          {
            "@type": ["LocalBusiness", "MobilePhoneStore"],
            "@id": "{{ url('/') }}#branch-bale-bali",
            "name": "Bale Bali (Central Workshop & Lab)",
            "alternateName": "Bale Bali - Bali Phone Repair Headquarter",
            "url": "{{ route('areas.show', 'denpasar') }}",
            "telephone": "{{ $phone }}",
            "priceRange": "$$",
            "description": "Bale Bali is the flagship central workshop of Bali Phone Repair in Denpasar, equipped with precision micro-soldering, ultrasonic cleaning tanks, and extensive spare parts stock.",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Jl. Pulau Misol No. 106, Dauh Puri Kauh",
              "addressLocality": "Denpasar",
              "addressRegion": "Bali",
              "postalCode": "80113",
              "addressCountry": "ID"
            },
            "hasMap": "https://maps.google.com/?q=Bali+Phone+Repair+Jl+Pulau+Misol+106+Denpasar",
            "openingHoursSpecification": [
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "opens": "09:00",
                "closes": "21:00"
              },
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Sunday"],
                "opens": "09:00",
                "closes": "18:00"
              }
            ]
          },
          {
            "@type": ["LocalBusiness", "MobilePhoneStore"],
            "@id": "{{ url('/') }}#branch-ismart-teuku-umar",
            "name": "iSmart Teuku Umar",
            "alternateName": "iSmart Teuku Umar (Tech Strip Branch)",
            "url": "{{ route('areas.show', 'denpasar') }}",
            "telephone": "{{ $phone }}",
            "priceRange": "$$",
            "description": "iSmart Teuku Umar is a Bali Phone Repair branch located in Denpasar's primary electronics tech street, specializing in laser rear glass separation, logic board repair, and screen replacement.",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Jl. Teuku Umar No. 241, Dauh Puri Kauh",
              "addressLocality": "Denpasar Barat",
              "addressRegion": "Bali",
              "postalCode": "80113",
              "addressCountry": "ID"
            },
            "hasMap": "https://maps.google.com/?q=iSmart+Teuku+Umar+Denpasar",
            "openingHoursSpecification": [
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "opens": "09:00",
                "closes": "21:00"
              }
            ]
          }
        ]
      }
    ]
  }
  </script>
</head>
<body data-page-type="home">
  @include('public.partials.analytics-body')

  <!-- Clean Fixed Header (Reference: iphonerepairbali.com) -->
  <header class="top-header">
    <div class="top-header-inner">
      <a class="brand-group" href="{{ route('home') }}" aria-label="Bali Phone Repair">
        <img class="brand-logo-img" src="{{ asset($assetBase.'logo-optimized.jpg') }}" alt="Bali Phone Repair" width="42" height="42" />
        <div class="brand-text-block">
          <strong>Bali Phone Repair</strong>
          <small>We Come to Your Villa or Hotel</small>
        </div>
      </a>

      <nav class="nav-links-desktop" aria-label="Main navigation">
        <a href="{{ route('services.show', 'iphone-repair-bali') }}">iPhone</a>
        <a href="{{ route('services.show', 'macbook-repair-bali') }}">MacBook</a>
        <a href="{{ route('services.show', 'android-repair-bali') }}">Android</a>
        <a href="{{ route('areas.index') }}">Areas</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#faq">FAQ</a>
        <a href="{{ route('blog') }}">Blog</a>
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

  <main>
    <!-- Hero Section (Enlarged Title + Photo Background Slideshow + 3 Horizontal Photos) -->
    <section class="hero-container">
      @php
        $heroBgImg = !empty($siteSettings['hero_bg_image']) ? $siteSettings['hero_bg_image'] : ($assetBase.'hero-bg-slide3.jpg');
        $heroCard1Img = !empty($siteSettings['hero_card1_image']) ? $siteSettings['hero_card1_image'] : ($assetBase.'teknisi1-optimized.jpg');
        $heroCard2Img = !empty($siteSettings['hero_card2_image']) ? $siteSettings['hero_card2_image'] : ($assetBase.'teknisia1-optimized.jpg');
        $heroCard3Img = !empty($siteSettings['hero_card3_image']) ? $siteSettings['hero_card3_image'] : ($assetBase.'teknisib1-optimized.jpg');
      @endphp
      <div class="hero-bg-slider" aria-hidden="true">
        <div class="hero-bg-slide active" style="background-image: url('{{ asset($heroBgImg) }}?v={{ time() }}');"></div>
        <div class="hero-bg-overlay"></div>
      </div>
      <div class="hero-content">
        <div class="hero-location-badge">
          <i class="fa-solid fa-location-dot"></i> {{ $siteSettings['hero_location_badge'] ?? 'We come to you across Bali' }}
        </div>
        <h1 class="hero-headline">
          {{ $siteSettings['hero_title'] ?? 'Fast & Professional Device Repair in Bali' }}
        </h1>
        <p class="hero-description">
          {{ $siteSettings['hero_description'] ?? 'Cracked screen? Dead battery? Water damage? Our certified mobile technicians come directly to your villa, hotel, or anywhere in Bali. Same-day repairs with warranty.' }}
        </p>
        <div class="hero-cta-buttons">
          <a class="btn-hero-quote" href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode($siteSettings['hero_cta_message'] ?? 'Hi! I need a phone repair in Bali. Can you help?') }}" target="_blank" rel="noreferrer">
            <i class="fa-brands fa-whatsapp" style="font-size: 1.2em;"></i> {{ $siteSettings['hero_cta_text'] ?? 'Get a Free Quote' }}
          </a>
          <a class="btn-hero-view-services" href="#services">
            View Services &amp; Prices <i class="fa-solid fa-arrow-down"></i>
          </a>
        </div>

        <!-- 3 Horizontal Technician Photos -->
        <div class="hero-photos-trio" aria-label="Our Certified Technicians in Bali">
          <figure class="hero-photo-card">
            <img src="{{ asset($heroCard1Img) }}" alt="Bali Phone Repair technician" width="675" height="506" />
            <span class="hero-photo-tag"><i class="fa-solid {{ $siteSettings['hero_card1_tag_icon'] ?? 'fa-certificate' }}"></i> {{ $siteSettings['hero_card1_tag'] ?? 'Certified Tech' }}</span>
          </figure>
          <figure class="hero-photo-card">
            <img src="{{ asset($heroCard2Img) }}" alt="Bali Phone Repair precision tools" width="675" height="506" />
            <span class="hero-photo-tag"><i class="fa-solid {{ $siteSettings['hero_card2_tag_icon'] ?? 'fa-screwdriver-wrench' }}"></i> {{ $siteSettings['hero_card2_tag'] ?? 'OEM Parts' }}</span>
          </figure>
          <figure class="hero-photo-card">
            <img src="{{ asset($heroCard3Img) }}" alt="Bali Phone Repair mobile service" width="675" height="506" />
            <span class="hero-photo-tag"><i class="fa-solid {{ $siteSettings['hero_card3_tag_icon'] ?? 'fa-shield-halved' }}"></i> {{ $siteSettings['hero_card3_tag'] ?? '30-60 Day Warranty' }}</span>
          </figure>
        </div>

      </div>
    </section>

    <!-- 4-Item Trust Bar (Directly below hero, like iphonerepairbali.com) -->
    <section class="trust-bar-section">
      <div class="trust-bar-inner">
        <div class="trust-item">
          <div class="trust-icon-box"><i class="fa-solid {{ $siteSettings['trust1_icon'] ?? 'fa-bolt' }}"></i></div>
          <div class="trust-text">
            <h4>{{ $siteSettings['trust1_title'] ?? 'Same-Day Repair' }}</h4>
            <p>{{ $siteSettings['trust1_subtitle'] ?? 'Most repairs in 30-60 mins' }}</p>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon-box"><i class="fa-solid {{ $siteSettings['trust2_icon'] ?? 'fa-shield-halved' }}"></i></div>
          <div class="trust-text">
            <h4>{{ $siteSettings['trust2_title'] ?? '30 to 60-Day Warranty' }}</h4>
            <p>{{ $siteSettings['trust2_subtitle'] ?? 'Full coverage on parts & labor' }}</p>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon-box"><i class="fa-solid {{ $siteSettings['trust3_icon'] ?? 'fa-motorcycle' }}"></i></div>
          <div class="trust-text">
            <h4>{{ $siteSettings['trust3_title'] ?? 'We Come to You' }}</h4>
            <p>{{ $siteSettings['trust3_subtitle'] ?? 'Villa, hotel, or cafe anywhere in Bali' }}</p>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon-box"><i class="fa-solid {{ $siteSettings['trust4_icon'] ?? 'fa-screwdriver-wrench' }}"></i></div>
          <div class="trust-text">
            <h4>{{ $siteSettings['trust4_title'] ?? 'Quality Parts' }}</h4>
            <p>{{ $siteSettings['trust4_subtitle'] ?? 'OEM & premium grade components' }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- "Our Repair Services" Section (Direct Match to iphonerepairbali.com) -->
    <section class="section-standard" id="services">
      <div class="section-head-center">
        <span class="section-eyebrow-pill"><i class="fa-solid fa-wrench"></i> {{ $siteSettings['services_eyebrow'] ?? 'What We Fix' }}</span>
        <h2 class="section-main-title">{{ $siteSettings['services_title'] ?? 'Our Repair Services' }}</h2>
        <p class="section-main-subtitle">{{ $siteSettings['services_subtitle'] ?? 'Professional phone and laptop repairs at your location. All prices include parts, labor, and travel.' }}</p>
      </div>

      <!-- Filter Tabs -->
      <div class="category-pills-row" role="tablist" aria-label="Repair service categories">
        <button class="active" data-filter="all">All Repairs (6)</button>
        <button data-filter="iphone">iPhone (3)</button>
        <button data-filter="android">Samsung &amp; Android (3)</button>
        <button data-filter="macbook">MacBook &amp; Laptop (2)</button>
        <button data-filter="software">Software (1)</button>
      </div>

      <!-- 3-Column Service Cards Grid -->
      <div class="services-cards-grid">
        <!-- Card 1: Screen Replacement -->
        <article class="service-card service-item-card" data-category="iphone android">
          <div class="card-photo-wrapper">
            <img src="{{ asset($assetBase.'change-screen-optimized.jpg') }}" alt="iPhone Screen Repair in Bali" width="900" height="675" loading="lazy" decoding="async" />
            <span class="badge-duration">30-60 min</span>
            <span class="badge-status-dark">Popular</span>
          </div>
          <div class="card-text-body">
            <h3 class="card-service-title">iPhone Screen Repair</h3>
            <div class="card-price-text">Rp 500.000 - 1.500.000</div>
            <p class="card-explanation">Cracked or shattered iPhone screen? We replace it on the spot at your villa or hotel with high-quality screens. All iPhone models supported.</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20iPhone%20Screen%20Repair.%20Rp%20500.000%20-%20Rp%201.500.000.%20Can%20you%20come%20to%20my%20location%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> Book Repair
            </a>
          </div>
        </article>

        <!-- Card 2: Battery Replacement -->
        <article class="service-card service-item-card" data-category="iphone android macbook">
          <div class="card-photo-wrapper">
            <img src="{{ asset($assetBase.'replace-the-battery-optimized.jpg') }}" alt="iPhone Battery Replacement in Bali" width="900" height="675" loading="lazy" decoding="async" />
            <span class="badge-duration">20-40 min</span>
            <span class="badge-status-dark">Popular</span>
          </div>
          <div class="card-text-body">
            <h3 class="card-service-title">iPhone Battery Replacement</h3>
            <div class="card-price-text">Rp 400.000 - 800.000</div>
            <p class="card-explanation">Battery draining fast or phone shutting down? We replace your battery with a premium cell so it lasts all day again.</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20iPhone%20Battery%20Replacement.%20Rp%20400.000%20-%20Rp%20800.000.%20Can%20you%20come%20to%20my%20location%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> Book Repair
            </a>
          </div>
        </article>

        <!-- Card 3: Charging Port Repair -->
        <article class="service-card service-item-card" data-category="iphone android">
          <div class="card-photo-wrapper">
            <img src="{{ asset($assetBase.'charging-problem-optimized.jpg') }}" alt="Charging Port Repair in Bali" width="900" height="675" loading="lazy" decoding="async" />
            <span class="badge-duration">20-30 min</span>
            <span class="badge-status-dark">Quick Fix</span>
          </div>
          <div class="card-text-body">
            <h3 class="card-service-title">Charging Port Repair</h3>
            <div class="card-price-text">Rp 300.000</div>
            <p class="card-explanation">Phone not charging or cable keeps falling out? We clean or replace your charging port so your phone charges reliably again.</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20Charging%20Port%20Repair.%20Rp%20300.000.%20Can%20you%20come%20to%20my%20location%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> Book Repair
            </a>
          </div>
        </article>

        <!-- Card 4: Water Damage Recovery -->
        <article class="service-card service-item-card" data-category="iphone android macbook">
          <div class="card-photo-wrapper">
            <img src="{{ asset($assetBase.'hit-by-water-optimized.jpg') }}" alt="Water Damage Recovery in Bali" width="900" height="675" loading="lazy" decoding="async" />
            <span class="badge-duration">Immediate</span>
            <span class="badge-status-red">Urgent Rescue</span>
          </div>
          <div class="card-text-body">
            <h3 class="card-service-title">Water Damage Recovery</h3>
            <div class="card-price-text">Rp 500.000</div>
            <p class="card-explanation">Dropped your phone in the pool or ocean? Time is critical. We perform professional ultrasonic board recovery to save your phone and data.</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20Water%20Damage%20Recovery.%20Rp%20500.000.%20Can%20you%20come%20to%20my%20location%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> Book Repair
            </a>
          </div>
        </article>

        <!-- Card 5: MacBook & Laptop Repair -->
        <article class="service-card service-item-card" data-category="macbook">
          <div class="card-photo-wrapper">
            <img src="{{ asset($assetBase.'keyboard-trackpad-fan-optimized.jpg') }}" alt="MacBook and Laptop Repair in Bali" width="900" height="675" loading="lazy" decoding="async" />
            <span class="badge-duration">45-90 min</span>
            <span class="badge-status-dark">MacBook / Laptop</span>
          </div>
          <div class="card-text-body">
            <h3 class="card-service-title">MacBook Keyboard &amp; Fan Repair</h3>
            <div class="card-price-text">Rp 600.000 - 1.400.000</div>
            <p class="card-explanation">Sticky keys, unresponsive trackpad clicks, overheating CPU, or noisy fans. Genuine replacement parts and thermal service.</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20MacBook%20or%20Laptop%20Repair.%20Can%20you%20come%20to%20my%20location%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> Book Repair
            </a>
          </div>
        </article>

        <!-- Card 6: Software & Data Recovery -->
        <article class="service-card service-item-card" data-category="software">
          <div class="card-photo-wrapper">
            <img src="{{ asset($assetBase.'software-dan-data-optimized.jpg') }}" alt="Software and Data Recovery in Bali" width="900" height="675" loading="lazy" decoding="async" />
            <span class="badge-duration">15-30 min</span>
            <span class="badge-status-dark">Software &amp; OS</span>
          </div>
          <div class="card-text-body">
            <h3 class="card-service-title">Software Fix &amp; Data Recovery</h3>
            <div class="card-price-text">Rp 200.000 - 500.000</div>
            <p class="card-explanation">Phone frozen, crashing, or stuck on the Apple logo? We diagnose software issues, restore data, and perform clean factory resets.</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20Software%20Fix%20or%20Data%20Recovery.%20Can%20you%20come%20to%20my%20location%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> Book Repair
            </a>
          </div>
        </article>
      </div>
    </section>

    <!-- "How It Works" Section (Direct Match to iphonerepairbali.com) -->
    <section class="how-it-works-bg" id="how-it-works">
      <div class="section-head-center">
        <h2 class="section-main-title">{{ $siteSettings['how_title'] ?? 'How It Works' }}</h2>
        <p class="section-main-subtitle">{{ $siteSettings['how_subtitle'] ?? 'Get your phone fixed in 3 simple steps' }}</p>
      </div>

      <div class="steps-trio-grid">
        <div class="step-box-card">
          <div class="step-icon-wrapper">
            <i class="{{ $siteSettings['step1_icon'] ?? 'fa-brands fa-whatsapp' }}"></i>
            <span class="step-badge-number">1</span>
          </div>
          <h3>{{ $siteSettings['step1_title'] ?? 'Describe the Issue' }}</h3>
          <p>{{ $siteSettings['step1_desc'] ?? 'Send us a WhatsApp message describing your phone problem. Include your phone model if you can.' }}</p>
        </div>

        <div class="step-box-card">
          <div class="step-icon-wrapper">
            <i class="{{ $siteSettings['step2_icon'] ?? 'fa-solid fa-calendar-check' }}"></i>
            <span class="step-badge-number">2</span>
          </div>
          <h3>{{ $siteSettings['step2_title'] ?? 'Get a Quote & Schedule' }}</h3>
          <p>{{ $siteSettings['step2_desc'] ?? 'We reply with a price quote and available time slots. Most repairs can be done the same day.' }}</p>
        </div>

        <div class="step-box-card">
          <div class="step-icon-wrapper">
            <i class="{{ $siteSettings['step3_icon'] ?? 'fa-solid fa-circle-check' }}"></i>
            <span class="step-badge-number">3</span>
          </div>
          <h3>{{ $siteSettings['step3_title'] ?? 'We Fix It On-Site' }}</h3>
          <p>{{ $siteSettings['step3_desc'] ?? 'Our technician arrives at your location with all parts and tools. You pay only after testing your phone.' }}</p>
        </div>
      </div>
    </section>

    <!-- Coverage Areas Section (Reference: iphonerepairbali.com) -->
    <section class="coverage-areas-section" id="locations">
      <div class="section-head-center">
        <h2 class="section-main-title">We Cover All of Bali</h2>
        <p class="section-main-subtitle">Our technicians travel to your villa, hotel, or home in any of these areas</p>
      </div>

      <div class="areas-pill-container">
        <a class="area-badge-link" href="{{ route('areas.index') }}">Canggu</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Seminyak</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Kuta</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Ubud</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Denpasar</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Sanur</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Legian</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Kerobokan</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Jimbaran</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Uluwatu</a>
        <a class="area-badge-link" href="{{ route('areas.index') }}">Nusa Dua</a>
      </div>
    </section>

    <!-- Customer Reviews / Testimonials (Reference: iphonerepairbali.com) -->
    <section class="reviews-section-bg" id="reviews">
      <div class="section-head-center">
        <h2 class="section-main-title">{{ $siteSettings['reviews_title'] ?? 'What Our Customers Say' }}</h2>
        <p class="section-main-subtitle">{{ $siteSettings['reviews_subtitle'] ?? 'Real reviews from travelers and locals across Bali' }}</p>
      </div>

      <div class="reviews-grid-3">
        @foreach($homepageTestimonials as $testimonial)
        <div class="review-card-box">
          <div>
            <div class="stars-row">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <p class="review-quote">&ldquo;{{ $testimonial['quote'] }}&rdquo;</p>
          </div>
          <div class="review-author-row">
            <div class="review-avatar-letter">{{ $testimonial['initials'] }}</div>
            <div class="review-author-info">
              <strong>{{ $testimonial['name'] }}</strong>
              <span>{{ $testimonial['area'] }} - Verified</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>

    <!-- Transparent Pricing Overview (Reference: iphonerepairbali.com) -->
    <section class="section-standard" id="pricing">
      <div class="section-head-center">
        <h2 class="section-main-title">{{ $siteSettings['pricing_title'] ?? 'Transparent Pricing' }}</h2>
        <p class="section-main-subtitle">{{ $siteSettings['pricing_subtitle'] ?? 'All prices include parts, labor, and travel to your location. No hidden fees.' }}</p>
      </div>

      <div class="pricing-table-container">
        <div class="pricing-table-row">
          <div>
            <h3 class="pricing-service-title">{{ $siteSettings['pricing_row1_title'] ?? 'iPhone Screen Repair' }}</h3>
            <p class="pricing-service-duration">{{ $siteSettings['pricing_row1_duration'] ?? '30-60 min turnaround' }}</p>
          </div>
          <div class="pricing-price-tag">{{ $siteSettings['pricing_row1_price'] ?? 'Rp 500.000 - 1.500.000' }}</div>
        </div>
        <div class="pricing-table-row">
          <div>
            <h3 class="pricing-service-title">{{ $siteSettings['pricing_row2_title'] ?? 'iPhone Battery Replacement' }}</h3>
            <p class="pricing-service-duration">{{ $siteSettings['pricing_row2_duration'] ?? '20-40 min turnaround' }}</p>
          </div>
          <div class="pricing-price-tag">{{ $siteSettings['pricing_row2_price'] ?? 'Rp 400.000 - 800.000' }}</div>
        </div>
        <div class="pricing-table-row">
          <div>
            <h3 class="pricing-service-title">{{ $siteSettings['pricing_row3_title'] ?? 'Charging Port Repair' }}</h3>
            <p class="pricing-service-duration">{{ $siteSettings['pricing_row3_duration'] ?? '20-30 min turnaround' }}</p>
          </div>
          <div class="pricing-price-tag">{{ $siteSettings['pricing_row3_price'] ?? 'Rp 300.000' }}</div>
        </div>
        <div class="pricing-table-row">
          <div>
            <h3 class="pricing-service-title">{{ $siteSettings['pricing_row4_title'] ?? 'Water Damage Recovery' }}</h3>
            <p class="pricing-service-duration">{{ $siteSettings['pricing_row4_duration'] ?? '60-120 min ultrasonic clean' }}</p>
          </div>
          <div class="pricing-price-tag">{{ $siteSettings['pricing_row4_price'] ?? 'Rp 500.000' }}</div>
        </div>
        <div class="pricing-table-row">
          <div>
            <h3 class="pricing-service-title">{{ $siteSettings['pricing_row5_title'] ?? 'Samsung Screen Repair' }}</h3>
            <p class="pricing-service-duration">{{ $siteSettings['pricing_row5_duration'] ?? '30-60 min turnaround' }}</p>
          </div>
          <div class="pricing-price-tag">{{ $siteSettings['pricing_row5_price'] ?? 'Rp 400.000 - 1.200.000' }}</div>
        </div>
        <div class="pricing-table-row">
          <div>
            <h3 class="pricing-service-title">{{ $siteSettings['pricing_row6_title'] ?? 'MacBook Keyboard & Fan Repair' }}</h3>
            <p class="pricing-service-duration">{{ $siteSettings['pricing_row6_duration'] ?? '45-90 min turnaround' }}</p>
          </div>
          <div class="pricing-price-tag">{{ $siteSettings['pricing_row6_price'] ?? 'Rp 600.000 - 1.400.000' }}</div>
        </div>
      </div>
    </section>

    <!-- Additional Services: Device Trade-in / Buy & Sell + MacBook Rental -->
    <section class="section-standard" style="background: var(--color-gray-50); border-top: 1px solid var(--color-gray-200); border-bottom: 1px solid var(--color-gray-200);">
      <div class="section-head-center">
        <h2 class="section-main-title">{{ $siteSettings['extra_title'] ?? 'Device Trade & MacBook Rental' }}</h2>
        <p class="section-main-subtitle">{{ $siteSettings['extra_subtitle'] ?? 'Need to buy/sell a device or rent a MacBook while in Bali? We have you covered.' }}</p>
      </div>

      <div class="extra-services-grid">
        <article class="extra-card" id="jual-beli">
          <div class="extra-card-media">
            <img src="{{ !empty($siteSettings['extra_card1_image']) ? asset($siteSettings['extra_card1_image']) : asset($assetBase.'iphone-buy-sell-optimized.jpg') }}" alt="iPhone buy and sell in Bali" loading="lazy" decoding="async" />
          </div>
          <div class="extra-card-body">
            <span class="extra-card-badge">{{ $siteSettings['extra_card1_badge'] ?? 'Buy & Sell' }}</span>
            <h3 class="extra-card-title">{{ $siteSettings['extra_card1_title'] ?? 'iPhone Buy & Sell' }}</h3>
            <p class="extra-card-desc">{{ $siteSettings['extra_card1_desc'] ?? 'Upgrade your phone or get instant cash for your used iPhone with fair market evaluations.' }}</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20would%20like%20to%20sell%20or%20trade-in%20my%20iPhone." target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> {{ $siteSettings['extra_card1_btn'] ?? 'Check Value' }}
            </a>
          </div>
        </article>

        <article class="extra-card" id="rental">
          <div class="extra-card-media">
            <img src="{{ !empty($siteSettings['extra_card2_image']) ? asset($siteSettings['extra_card2_image']) : asset($assetBase.'macbook-m1-optimized.jpg') }}" alt="MacBook Pro M1 rental in Bali" loading="lazy" decoding="async" />
          </div>
          <div class="extra-card-body">
            <span class="extra-card-badge">{{ $siteSettings['extra_card2_badge'] ?? 'Daily / Weekly' }}</span>
            <h3 class="extra-card-title">{{ $siteSettings['extra_card2_title'] ?? 'MacBook Pro M1/M2 Rental' }}</h3>
            <p class="extra-card-desc">{{ $siteSettings['extra_card2_desc'] ?? 'Perfect for developers, designers, remote work, and urgent replacement laptops delivered to your villa.' }}</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20would%20like%20to%20rent%20a%20MacBook%20in%20Bali." target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> {{ $siteSettings['extra_card2_btn'] ?? 'Rent MacBook' }}
            </a>
          </div>
        </article>

        <article class="extra-card">
          <div class="extra-card-media">
            <img src="{{ !empty($siteSettings['extra_card3_image']) ? asset($siteSettings['extra_card3_image']) : asset($assetBase.'costumer-documentation-optimized.jpg') }}" alt="Home service documentation in Bali" loading="lazy" decoding="async" />
          </div>
          <div class="extra-card-body">
            <span class="extra-card-badge">{{ $siteSettings['extra_card3_badge'] ?? 'Home Care Service' }}</span>
            <h3 class="extra-card-title">{{ $siteSettings['extra_card3_title'] ?? 'Villa & Hotel Home Care' }}</h3>
            <p class="extra-card-desc">{{ $siteSettings['extra_card3_desc'] ?? 'No need to travel in Bali traffic. Our technician brings all diagnostic equipment and OEM parts directly to you.' }}</p>
            <a class="btn-card-whatsapp" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20Can%20a%20technician%20come%20to%20my%20villa%3F" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp"></i> {{ $siteSettings['extra_card3_btn'] ?? 'Book Home Care' }}
            </a>
          </div>
        </article>
      </div>
    </section>

    <!-- Verified Physical Workshops & Service Branches (High GEO & ChatGPT Citation Weight) -->
    <section class="section-standard" id="locations" style="background: var(--color-gray-100); border-top: 1px solid var(--color-gray-200); border-bottom: 1px solid var(--color-gray-200);">
      <div class="section-head-center">
        <span class="section-eyebrow-pill"><i class="fa-solid fa-location-dot"></i> Walk-In Workshops & Hubs</span>
        <h2 class="section-main-title">Our Physical Workshops & Service Locations in Bali</h2>
        <p class="section-main-subtitle">Bali Phone Repair operates certified physical walk-in workshops and mobile technician dispatch across South Bali. Visit our branches or book an on-site villa service.</p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; max-width: 1200px; margin: 0 auto; padding: 0 16px;">
        <!-- Card 1: iSmart Canggu -->
        <article style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; flex-direction: column;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-gray-900); margin: 0;">📍 iSmart Canggu</h3>
            <span style="font-size: 0.75rem; font-weight: 700; color: #2563eb; background: #eff6ff; padding: 4px 10px; border-radius: 999px;">Canggu Hub</span>
          </div>
          <p style="color: var(--color-gray-700); font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">
            Jl. Raya Canggu, Kerobokan, Badung, Bali
          </p>
          <p style="color: var(--color-gray-600); font-size: 0.875rem; line-height: 1.5; flex-grow: 1; margin-bottom: 16px;">
            <strong>iSmart Canggu is a certified Bali Phone Repair branch</strong> conveniently positioned for tourists, expats, and digital nomads in Canggu, Berawa, Batu Bolong, and Pererenan. Walk-ins welcome for express same-day repairs or schedule an in-villa technician visit.
          </p>
          <div style="font-size: 0.85rem; color: var(--color-gray-700); margin-bottom: 6px;">
            ⏰ <strong>Hours:</strong> Mon–Sat: 09:00–20:00 | Sun: 10:00–18:00
          </div>
          <div style="font-size: 0.85rem; color: var(--color-gray-700); margin-bottom: 16px;">
            🛵 <strong>Service:</strong> Walk-in Workshop • In-Villa Service • Courier Pickup
          </div>
          <div style="display: flex; gap: 8px;">
            <a href="https://wa.me/{{ $whatsapp }}?text=Hi%20iSmart%20Canggu%2C%20I%20need%20repair%20assistance" target="_blank" rel="noreferrer" style="flex: 1; text-align: center; background: #2563eb; color: #ffffff; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
              <i class="fa-brands fa-whatsapp"></i> Chat Canggu
            </a>
            <a href="{{ route('areas.show', 'canggu') }}" style="text-align: center; background: var(--color-gray-100); color: var(--color-gray-900); padding: 10px 14px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none; border: 1px solid var(--color-gray-200);">
              Area Info
            </a>
          </div>
        </article>

        <!-- Card 2: Bale Bali Denpasar -->
        <article style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; flex-direction: column;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-gray-900); margin: 0;">📍 Bale Bali Central Lab</h3>
            <span style="font-size: 0.75rem; font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 999px;">Main Workshop</span>
          </div>
          <p style="color: var(--color-gray-700); font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">
            Jl. Pulau Misol No. 106, Dauh Puri Kauh, Denpasar, Bali 80113
          </p>
          <p style="color: var(--color-gray-600); font-size: 0.875rem; line-height: 1.5; flex-grow: 1; margin-bottom: 16px;">
            <strong>Bale Bali is the flagship central workshop of Bali Phone Repair</strong>, housing high-grade diagnostic benches, ultrasonic liquid damage restoration tanks, and extensive spare parts stock for iPhones, MacBooks, and Android flagships.
          </p>
          <div style="font-size: 0.85rem; color: var(--color-gray-700); margin-bottom: 6px;">
            ⏰ <strong>Hours:</strong> Mon–Sat: 09:00–21:00 | Sun: 09:00–18:00
          </div>
          <div style="font-size: 0.85rem; color: var(--color-gray-700); margin-bottom: 16px;">
            🛵 <strong>Service:</strong> Walk-in Workshop • Advanced Diagnostics • Data Recovery
          </div>
          <div style="display: flex; gap: 8px;">
            <a href="https://wa.me/{{ $whatsapp }}?text=Hi%20Bale%20Bali%20Workshop%2C%20I%20have%20a%20device%20repair%20inquiry" target="_blank" rel="noreferrer" style="flex: 1; text-align: center; background: #0f172a; color: #ffffff; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
              <i class="fa-brands fa-whatsapp"></i> Chat Workshop
            </a>
            <a href="{{ route('areas.show', 'denpasar') }}" style="text-align: center; background: var(--color-gray-100); color: var(--color-gray-900); padding: 10px 14px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none; border: 1px solid var(--color-gray-200);">
              Area Info
            </a>
          </div>
        </article>

        <!-- Card 3: iSmart Teuku Umar -->
        <article style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; flex-direction: column;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-gray-900); margin: 0;">📍 iSmart Teuku Umar</h3>
            <span style="font-size: 0.75rem; font-weight: 700; color: #9333ea; background: #faf5ff; padding: 4px 10px; border-radius: 999px;">Tech Corridor</span>
          </div>
          <p style="color: var(--color-gray-700); font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">
            Jl. Teuku Umar No. 241, Dauh Puri Kauh, Denpasar Barat, Bali
          </p>
          <p style="color: var(--color-gray-600); font-size: 0.875rem; line-height: 1.5; flex-grow: 1; margin-bottom: 16px;">
            <strong>iSmart Teuku Umar is a Bali Phone Repair branch</strong> in Bali’s premier gadget corridor. Specializing in precision logic board micro-soldering, back glass laser separation, and iPad screen laminating.
          </p>
          <div style="font-size: 0.85rem; color: var(--color-gray-700); margin-bottom: 6px;">
            ⏰ <strong>Hours:</strong> Mon–Sat: 09:00–21:00
          </div>
          <div style="font-size: 0.85rem; color: var(--color-gray-700); margin-bottom: 16px;">
            🛵 <strong>Service:</strong> Walk-in Workshop • Board Micro-Soldering • Laser Glass
          </div>
          <div style="display: flex; gap: 8px;">
            <a href="https://wa.me/{{ $whatsapp }}?text=Hi%20iSmart%20Teuku%20Umar%2C%20I%20need%20board%20or%20screen%20repair" target="_blank" rel="noreferrer" style="flex: 1; text-align: center; background: #0f172a; color: #ffffff; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">
              <i class="fa-brands fa-whatsapp"></i> Chat Teuku Umar
            </a>
            <a href="{{ route('areas.show', 'denpasar') }}" style="text-align: center; background: var(--color-gray-100); color: var(--color-gray-900); padding: 10px 14px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none; border: 1px solid var(--color-gray-200);">
              Area Info
            </a>
          </div>
        </article>
      </div>
    </section>

    <!-- Frequently Asked Questions (Reference: iphonerepairbali.com) -->
    <section class="section-standard" id="faq">
      <div class="section-head-center">
        <h2 class="section-main-title">{{ $siteSettings['faq_title'] ?? 'Frequently Asked Questions' }}</h2>
        <p class="section-main-subtitle">{{ $siteSettings['faq_subtitle'] ?? 'Everything you need to know about our Bali mobile repair service' }}</p>
      </div>

      <div class="faq-container">
        @foreach($homepageFaqs as $faq)
        <details class="faq-item-card">
          <summary>{{ $faq['question'] }}</summary>
          <p>{{ $faq['answer'] }}</p>
        </details>
        @endforeach
      </div>
    </section>

    <!-- Bottom CTA Banner (Reference: iphonerepairbali.com) -->
    <section class="bottom-cta-banner">
      <div class="bottom-cta-inner">
        <h2>{{ $siteSettings['cta_title'] ?? 'Need Your Phone Fixed?' }}</h2>
        <p>{{ $siteSettings['cta_description'] ?? 'Send us a message on WhatsApp. We will reply with a quote and can usually come the same day to your villa or hotel.' }}</p>
        <a class="btn-hero-quote" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20a%20phone%20repair%20in%20Bali.%20Can%20you%20help%3F" target="_blank" rel="noreferrer">
          <i class="fa-brands fa-whatsapp" style="font-size: 1.2em;"></i> {{ $siteSettings['cta_btn_text'] ?? 'Get a Free Quote' }}
        </a>
      </div>
    </section>
  </main>

  @include('public.partials.footer')

  <!-- Floating WhatsApp Button with Notification Badge -->
  <a class="floating-wa-btn" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20need%20a%20device%20repair%20in%20Bali.%20Can%20you%20help%3F" target="_blank" rel="noreferrer" aria-label="Chat on WhatsApp" data-analytics-event="whatsapp_click" data-analytics-location="floating">
    <i class="fa-brands fa-whatsapp" style="font-size: 1.4em;"></i>
    <span>Chat WhatsApp</span>
  </a>

  <script src="{{ asset($assetBase.'script-improved.js') }}?v=20260715-footer-map-points" defer></script>
  <script>
    let currentHeroSlideIndex = 0;
    function switchHeroSlide(index) {
      const slides = document.querySelectorAll('.hero-bg-slide');
      const dots = document.querySelectorAll('.hero-indicator-dot');
      if (!slides.length) return;
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });
      currentHeroSlideIndex = index;
    }

    document.addEventListener('DOMContentLoaded', () => {
      const slides = document.querySelectorAll('.hero-bg-slide');
      if (slides.length > 1) {
        setInterval(() => {
          const nextIndex = (currentHeroSlideIndex + 1) % slides.length;
          switchHeroSlide(nextIndex);
        }, 5000);
      }
    });
  </script>
</body>
</html>
