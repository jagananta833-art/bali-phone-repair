@php
    $assetBase = 'assets/bali-phone-repair/';
    $businessName = $siteSettings['business_name'] ?? 'Bali Phone Repair';
    $whatsapp = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $phone = $siteSettings['phone'] ?? '+6281929164999';
    $phoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', trim($phone))
        ? '+'.preg_replace('/\D+/', '', $phone)
        : null;
    $email = $siteSettings['email'] ?? 'hello@baliphonerepair.com';
    $title = 'Our Verified Partners - Book Your Repair Now, Get More Benefit at Our Partners | Bali Phone Repair';
    $description = 'Verified Bali Phone Repair partners: Puco Rooftop, Puri Canggu Rooms, and Warung Dangin. Enjoy exclusive coworking perks, stay cashback vouchers, and dining discounts.';
    $canonical = route('partners.index');
@endphp
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>{{ $title }}</title>
  <meta name="description" content="{{ $description }}" />
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
  <link rel="canonical" href="{{ $canonical }}" />
  <meta name="author" content="jagananta833-art" />
  <meta name="copyright" content="Bali Phone Repair &bull; Exclusively Maintained by jagananta833-art" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="{{ $businessName }}" />
  <meta property="og:title" content="{{ $title }}" />
  <meta property="og:description" content="{{ $description }}" />
  <meta property="og:url" content="{{ $canonical }}" />
  <meta property="og:image" content="{{ asset('assets/images/partners/puco-rooftop.webp') }}" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{ $title }}" />
  <meta name="twitter:description" content="{{ $description }}" />
  <meta name="twitter:image" content="{{ asset('assets/images/partners/puco-rooftop.webp') }}" />
  @include('public.partials.analytics-head')
  <link rel="icon" type="image/jpeg" href="{{ asset($assetBase.'logo-optimized.jpg') }}?v=20260711-favicon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset($assetBase.'styles-improved.css') }}?v=partners-v3" />

  <style>
    :root {
      --primary-gold: #D4A346;
      --gold-gradient: linear-gradient(135deg, #F5D061 0%, #D4A346 50%, #B8860B 100%);
      --gold-gradient-hover: linear-gradient(135deg, #FAE292 0%, #E5B24E 50%, #C69214 100%);
      --primary-accent: #b45309;
      --primary-accent-hover: #92400e;
      --color-dark: #0f172a;
      --color-gray-900: #111827;
      --color-gray-800: #1f2937;
      --color-gray-700: #374151;
      --color-gray-600: #4b5563;
      --color-gray-200: #e5e7eb;
      --color-gray-100: #f3f4f6;
      --color-gray-50: #f9fafb;
    }

    body {
      margin: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background-color: #ffffff;
      color: var(--color-gray-900);
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
      border-bottom: 1px solid var(--color-gray-200);
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
    }
    .brand-logo-img {
      width: 42px;
      height: 42px;
      border-radius: 8px;
      object-fit: cover;
    }
    .brand-text-block strong {
      display: block;
      font-size: 15px;
      font-weight: 800;
      color: var(--color-gray-900);
      line-height: 1.2;
    }
    .brand-text-block small {
      display: block;
      font-size: 12px;
      color: var(--color-gray-600);
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
      color: var(--primary-accent);
    }
    .header-right-actions {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .header-wa-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 14px;
      font-weight: 700;
      color: #059669;
    }
    .btn-quote-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--gold-gradient);
      color: #0f172a;
      padding: 9px 18px;
      border-radius: 999px;
      font-weight: 700;
      font-size: 13.5px;
      box-shadow: 0 4px 14px rgba(212, 163, 70, 0.35);
      transition: all .2s ease;
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
      font-size: 24px;
      cursor: pointer;
      color: var(--color-gray-900);
    }

    /* Reference Style Layout Elements */
    .partner-top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--color-gray-200);
      margin-bottom: 40px;
    }
    .partner-top-tag-left {
      font-size: 15px;
      font-weight: 800;
      color: #1e3a34;
      letter-spacing: 2.5px;
      text-transform: uppercase;
    }
    .partner-top-tag-right {
      font-size: 14px;
      font-weight: 700;
      color: #1e3a34;
      letter-spacing: 1.5px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .partner-split-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
    }
    .partner-left-content h1 {
      font-size: clamp(28px, 3.8vw, 42px);
      font-weight: 900;
      color: var(--color-gray-900);
      line-height: 1.2;
      margin: 0 0 16px;
      letter-spacing: -0.03em;
    }
    .partner-lifestyle-lead {
      font-size: 18px;
      font-weight: 800;
      color: var(--color-gray-900);
      line-height: 1.45;
      margin: 0 0 18px;
    }
    .partner-body-p {
      font-size: 15px;
      color: var(--color-gray-700);
      line-height: 1.7;
      margin: 0 0 16px;
    }

    /* Right Column: 3-Partner Canvas */
    .partner-trio-canvas {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      padding: 24px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }
    .partner-trio-canvas-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-bottom: 14px;
      margin-bottom: 16px;
      border-bottom: 1px solid #f1f5f9;
      flex-wrap: wrap;
      gap: 8px;
    }
    .trio-badge-top {
      font-size: 12.5px;
      font-weight: 800;
      color: #1e3a34;
      letter-spacing: 1px;
      text-transform: uppercase;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .trio-perks-status {
      font-size: 12px;
      font-weight: 700;
      color: #059669;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .partner-trio-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .partner-trio-item {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 14px 16px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      transition: all .2s ease;
    }
    .partner-trio-item:hover {
      background: #ffffff;
      border-color: #cbd5e1;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
      transform: translateY(-2px);
    }
    .partner-trio-logo {
      width: 64px;
      height: 64px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }
    .partner-trio-logo.dark-bg {
      background: #0f172a;
    }
    .partner-trio-logo.light-bg {
      background: #f1f5f9;
    }
    .partner-trio-logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .partner-trio-logo img.img-contain {
      object-fit: contain;
      padding: 6px;
    }
    .partner-trio-detail {
      flex: 1;
      min-width: 0;
    }
    .partner-trio-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
      flex-wrap: wrap;
      margin-bottom: 2px;
    }
    .partner-trio-meta strong {
      font-size: 15.5px;
      font-weight: 800;
      color: var(--color-gray-900);
    }
    .partner-tag-pill {
      font-size: 11px;
      font-weight: 700;
      padding: 2px 9px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: .03em;
    }
    .tag-chill {
      background: #0f172a;
      color: #ffffff;
    }
    .tag-stay {
      background: #f1f5f9;
      color: #1e293b;
      border: 1px solid #cbd5e1;
    }
    .tag-dine {
      background: #fffbeb;
      color: #b45309;
      border: 1px solid #fde68a;
    }
    .partner-trio-sub {
      font-size: 12.5px;
      color: var(--color-gray-600);
      margin: 0 0 6px;
    }
    .partner-trio-perk {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 600;
      color: #047857;
      background: #ecfdf5;
      border: 1px solid #a7f3d0;
      padding: 3px 10px;
      border-radius: 6px;
      max-width: 100%;
    }
    .partner-trio-perk span {
      white-space: normal;
    }
    .partner-trio-canvas-footer {
      margin-top: 16px;
      padding-top: 12px;
      border-top: 1px dashed var(--color-gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 11.5px;
      color: var(--color-gray-600);
      flex-wrap: wrap;
      gap: 6px;
    }
    .trio-claim-hint {
      font-weight: 700;
      color: #059669;
    }

    /* Detailed 3-Partner Cards Section */
    .partner-cards-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
      margin-top: 36px;
    }
    .partner-full-card {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 18px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
      padding: 28px;
      display: flex;
      flex-direction: column;
      transition: all .25s ease;
    }
    .partner-full-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
      border-color: #cbd5e1;
    }
    .pcard-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 18px;
      padding-bottom: 16px;
      border-bottom: 1px solid #f1f5f9;
    }
    .pcard-logo-box {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      flex-shrink: 0;
      border: 1px solid #e2e8f0;
    }
    .pcard-logo-box.dark { background: #0f172a; }
    .pcard-logo-box.light { background: #f8fafc; }
    .pcard-logo-box img { width: 100%; height: 100%; object-fit: cover; }
    .pcard-logo-box img.contain { object-fit: contain; padding: 6px; }
    .pcard-title h3 {
      font-size: 18px;
      font-weight: 800;
      color: var(--color-gray-900);
      margin: 0 0 4px;
    }
    .pcard-title span {
      font-size: 13px;
      color: var(--color-gray-500);
    }
    .pcard-perk-box {
      background: #fffdf5;
      border: 1px solid #fde68a;
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 16px;
    }
    .pcard-perk-box strong {
      display: block;
      font-size: 12px;
      font-weight: 800;
      color: #b45309;
      text-transform: uppercase;
      letter-spacing: .03em;
      margin-bottom: 4px;
    }
    .pcard-perk-box p {
      margin: 0;
      font-size: 13.5px;
      font-weight: 600;
      color: #92400e;
      line-height: 1.5;
    }
    .pcard-desc {
      font-size: 14px;
      color: var(--color-gray-600);
      line-height: 1.6;
      margin: 0 0 20px;
      flex-grow: 1;
    }
    .pcard-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 11px;
      border-radius: 999px;
      font-size: 13.5px;
      font-weight: 700;
      box-sizing: border-box;
      border: 1px solid var(--color-gray-200);
      background: var(--color-gray-50);
      color: var(--color-gray-800);
      transition: all .2s;
    }
    .pcard-action:hover {
      background: #e2e8f0;
      color: #0f172a;
    }

    @media (max-width: 980px) {
      .partner-split-grid {
        grid-template-columns: 1fr;
        gap: 36px;
      }
      .partner-cards-grid {
        grid-template-columns: 1fr;
      }
      .nav-links-desktop { display: none; }
      .nav-links-desktop.show-mobile {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 68px;
        left: 0;
        right: 0;
        background: #ffffff;
        padding: 20px;
        border-bottom: 1px solid var(--color-gray-200);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        gap: 16px;
      }
      .mobile-menu-btn { display: block; }
    }
  </style>
</head>
<body>
  @include('public.partials.analytics-body')

  <!-- HEADER -->
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
        <a href="{{ route('home') }}#how-it-works">How It Works</a>
        <a href="{{ route('home') }}#faq">FAQ</a>
        <a href="{{ route('blog') }}">Blog</a>
        <a class="active" href="{{ route('partners.index') }}" style="color: var(--primary-accent);">Partner</a>
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
    <!-- TOP EDITORIAL SPLIT SECTION (EXACT REFERENCE DESIGN) -->
    <section style="padding: 44px 20px 60px; max-width: 1240px; margin: 0 auto;">
      <!-- TOP META BAR: OUR PARTNERS // MORE BENEFITS -->
      <div class="partner-top-bar">
        <span class="partner-top-tag-left">OUR PARTNERS</span>
        <span class="partner-top-tag-right">🍀 // MORE BENEFITS</span>
      </div>

      <div class="partner-split-grid">
        <!-- LEFT COLUMN: EDITORIAL LIFESTYLE COPY -->
        <div class="partner-left-content">
          <h1>
            Book your repair now <br>
            <span style="color: #b45309;">Get more benefit at our Partners</span>
          </h1>

          <p class="partner-lifestyle-lead">
            More than a repair — it's a lifestyle full of perks.
          </p>

          <p class="partner-body-p">
            At <strong>Bali Phone Repair</strong>, we believe that community goes beyond our workshop walls. That's why we've partnered with verified local lifestyle spots, cafes, and boutique stays across Bali to bring extra benefits for our clients.
          </p>

          <p class="partner-body-p">
            From exclusive discounts and complimentary treats, to priority villa service and customer-only dining privileges, our 3 official partnerships are designed to make your Bali journey even more rewarding while your device is being expertly restored.
          </p>

          <p class="partner-body-p">
            Because choosing Bali Phone Repair means staying connected to a bigger ecosystem — <strong>where quality, collaboration, and good vibes never stop.</strong>
          </p>

          <div style="margin-top: 28px; display: flex; gap: 14px; flex-wrap: wrap;">
            <a class="btn-quote-pill" href="https://wa.me/{{ $whatsapp }}?text=Hi%20Bali%20Phone%20Repair%2C%20I%20would%20like%20to%20know%20more%20about%20Partner%20Perks" target="_blank" rel="noreferrer" style="padding: 12px 24px; font-size: 14px;">
              <i class="fa-brands fa-whatsapp" style="font-size: 1.1em;"></i>
              <span>Claim Partner Perks via WhatsApp</span>
            </a>
            <a href="{{ route('home') }}#locations" style="display: inline-flex; align-items: center; gap: 6px; background: var(--color-gray-100); color: var(--color-gray-900); padding: 12px 20px; border-radius: 999px; font-weight: 700; font-size: 14px; border: 1px solid var(--color-gray-200);">
              <i class="fa-solid fa-location-dot" style="color: #b45309;"></i> Find Workshops
            </a>
          </div>
        </div>

        <!-- RIGHT COLUMN: 3 VERIFIED PARTNERS CANVAS (ONLY THE 3 ACTUAL PARTNERS) -->
        <div>
          <div class="partner-trio-canvas">
            <div class="partner-trio-canvas-header">
              <span class="trio-badge-top"><i class="fa-solid fa-handshake"></i> Official Verified Partners (3)</span>
              <span class="trio-perks-status"><i class="fa-solid fa-circle-check"></i> Active Customer Perks</span>
            </div>

            <div class="partner-trio-list">
              <!-- Partner 1: Puco Rooftop -->
              <div class="partner-trio-item">
                <div class="partner-trio-logo dark-bg">
                  <img src="{{ asset('assets/images/partners/puco-rooftop.webp') }}" alt="Puco Rooftop" />
                </div>
                <div class="partner-trio-detail">
                  <div class="partner-trio-meta">
                    <strong>Puco Rooftop</strong>
                    <span class="partner-tag-pill tag-chill">Co-Working Space</span>
                  </div>
                  <p class="partner-trio-sub">Cafe, Rooftop Lounge &amp; Coworking &bull; Bali</p>
                  <div class="partner-trio-perk">
                    <i class="fa-solid fa-gift"></i>
                    <span>Spacious Coworking space while you work remotely from Bali.</span>
                  </div>
                </div>
              </div>

              <!-- Partner 2: Puri Canggu Rooms -->
              <div class="partner-trio-item">
                <div class="partner-trio-logo light-bg">
                  <img src="{{ asset('assets/images/partners/puri-canggu-rooms.webp') }}" alt="Puri Canggu Rooms" />
                </div>
                <div class="partner-trio-detail">
                  <div class="partner-trio-meta">
                    <strong>Puri Canggu Rooms</strong>
                    <span class="partner-tag-pill tag-stay">Stay</span>
                  </div>
                  <p class="partner-trio-sub">Boutique Stay &amp; Villa Rooms &bull; Canggu</p>
                  <div class="partner-trio-perk">
                    <i class="fa-solid fa-gift"></i>
                    <span>Affordable stay in Canggu. Cashback Voucher</span>
                  </div>
                </div>
              </div>

              <!-- Partner 3: Warung Dangin -->
              <div class="partner-trio-item">
                <div class="partner-trio-logo dark-bg">
                  <img src="{{ asset('assets/images/partners/warung-dangin.webp') }}" alt="Warung Dangin" class="img-contain" />
                </div>
                <div class="partner-trio-detail">
                  <div class="partner-trio-meta">
                    <strong>Warung Dangin</strong>
                    <span class="partner-tag-pill tag-dine">Dining Benefit</span>
                  </div>
                  <p class="partner-trio-sub">Authentic Balinese Culinary &amp; Restaurant</p>
                  <div class="partner-trio-perk">
                    <i class="fa-solid fa-gift"></i>
                    <span>Authentic dining discount voucher for BPR clients</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="partner-trio-canvas-footer">
              <span>✨ Exclusive for Bali Phone Repair clients</span>
              <span class="trio-claim-hint">Show repair invoice / chat to claim</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DETAILED 3 PARTNER CARDS SHOWCASE -->
    <section style="padding: 50px 20px 70px; background: #ffffff; border-top: 1px solid var(--color-gray-200);">
      <div style="max-width: 1240px; margin: 0 auto;">
        <div style="text-align: center; max-width: 720px; margin: 0 auto 36px;">
          <span class="section-eyebrow-pill" style="display: inline-flex; align-items: center; gap: 6px; background: #fffbeb; color: #b45309; border: 1px solid rgba(217, 119, 6, 0.25); font-size: 13px; font-weight: 800; padding: 5px 14px; border-radius: 999px;">
            <i class="fa-solid fa-star"></i> Verified Partners
          </span>
          <h2 style="font-size: clamp(26px, 3.5vw, 36px); font-weight: 800; color: var(--color-gray-900); margin: 12px 0 8px;">
            Official Partners &amp; Exclusive Perks
          </h2>
          <p style="color: var(--color-gray-600); font-size: 15.5px; margin: 0;">
            Visit our official partners in Bali to enjoy exclusive perks and privileges whenever you repair your device with BPR.
          </p>
        </div>

        <div class="partner-cards-grid">
          <!-- Card 1: Puco Rooftop -->
          <article class="partner-full-card">
            <div class="pcard-header">
              <div class="pcard-logo-box dark">
                <img src="{{ asset('assets/images/partners/puco-rooftop.webp') }}" alt="Puco Rooftop" />
              </div>
              <div class="pcard-title">
                <h3>Puco Rooftop</h3>
                <span>Cafe, Lounge &amp; Coworking &bull; Bali</span>
              </div>
            </div>
            <div class="pcard-perk-box">
              <strong><i class="fa-solid fa-laptop"></i> Coworking &amp; Remote Work</strong>
              <p>Spacious Coworking space while you work remotely from Bali.</p>
            </div>
            <p class="pcard-desc">
              Enjoy an aesthetic rooftop atmosphere with specialty coffee, high-speed Wi-Fi, and delicious dining while your device is being serviced.
            </p>
            <a class="pcard-action" href="https://wa.me/{{ $whatsapp }}?text=Hi%20BPR%2C%20I%20would%20like%20to%20know%20more%20about%20Puco%20Rooftop%20perks" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp" style="color: #059669;"></i> Ask Puco Perks
            </a>
          </article>

          <!-- Card 2: Puri Canggu Rooms -->
          <article class="partner-full-card">
            <div class="pcard-header">
              <div class="pcard-logo-box light">
                <img src="{{ asset('assets/images/partners/puri-canggu-rooms.webp') }}" alt="Puri Canggu Rooms" />
              </div>
              <div class="pcard-title">
                <h3>Puri Canggu Rooms</h3>
                <span>Boutique Stay &bull; Canggu, Bali</span>
              </div>
            </div>
            <div class="pcard-perk-box">
              <strong><i class="fa-solid fa-bed"></i> Stay Benefit</strong>
              <p>Affordable stay in Canggu. Cashback Voucher</p>
            </div>
            <p class="pcard-desc">
              Peaceful and comfortable boutique accommodation in central Canggu. Guests enjoy priority on-site mobile technician dispatch straight to their room within 30–60 minutes.
            </p>
            <a class="pcard-action" href="https://wa.me/{{ $whatsapp }}?text=Hi%20BPR%2C%20I%20need%20a%20repair%20service%20at%20Puri%20Canggu%20Rooms" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp" style="color: #059669;"></i> Book Service to Puri Canggu
            </a>
          </article>

          <!-- Card 3: Warung Dangin -->
          <article class="partner-full-card">
            <div class="pcard-header">
              <div class="pcard-logo-box dark">
                <img src="{{ asset('assets/images/partners/warung-dangin.webp') }}" alt="Warung Dangin" class="contain" />
              </div>
              <div class="pcard-title">
                <h3>Warung Dangin</h3>
                <span>Authentic Balinese Culinary &amp; Restaurant</span>
              </div>
            </div>
            <div class="pcard-perk-box">
              <strong><i class="fa-solid fa-utensils"></i> Dining Privilege</strong>
              <p>Authentic Balinese dining discount voucher exclusively for BPR clients.</p>
            </div>
            <p class="pcard-desc">
              Traditional Balinese culinary dishes crafted with rich heritage recipes. Simply show your BPR repair invoice or WhatsApp chat confirmation to claim your dining discount.
            </p>
            <a class="pcard-action" href="https://wa.me/{{ $whatsapp }}?text=Hi%20BPR%2C%20I%20would%20like%20to%20claim%20Warung%20Dangin%20dining%20voucher" target="_blank" rel="noreferrer">
              <i class="fa-brands fa-whatsapp" style="color: #059669;"></i> Claim Dining Voucher
            </a>
          </article>
        </div>
      </div>
    </section>

    <!-- 3 SIMPLE STEPS TO CLAIM -->
    <section style="padding: 60px 20px; background: #f8fafc; border-top: 1px solid var(--color-gray-200); border-bottom: 1px solid var(--color-gray-200);">
      <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <span class="section-eyebrow-pill" style="display: inline-flex; align-items: center; gap: 6px; background: #fffbeb; color: #b45309; border: 1px solid rgba(217, 119, 6, 0.25); font-size: 13px; font-weight: 800; padding: 5px 14px; border-radius: 999px;">
          <i class="fa-solid fa-circle-check"></i> Simple &amp; Rewarding
        </span>
        <h2 style="font-size: clamp(24px, 3.5vw, 34px); font-weight: 800; color: var(--color-gray-900); margin: 12px 0 10px;">
          How to Claim Your Partner Perks
        </h2>
        <p style="color: var(--color-gray-600); font-size: 16px; margin: 0 0 36px;">
          Just 3 simple steps to enjoy exclusive perks across our Bali partner network.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; text-align: left;">
          <div style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 26px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);">
            <div style="font-size: 32px; font-weight: 900; color: #d4a346; margin-bottom: 8px;">01</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Book Your Repair</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Contact our technician team on WhatsApp or visit our walk-in workshops in Canggu or Denpasar for your device repair.
            </p>
          </div>

          <div style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 26px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);">
            <div style="font-size: 32px; font-weight: 900; color: #d4a346; margin-bottom: 8px;">02</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Keep Your Repair Confirmation</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Keep the official invoice or WhatsApp service confirmation message provided by our technician team.
            </p>
          </div>

          <div style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 26px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);">
            <div style="font-size: 32px; font-weight: 900; color: #d4a346; margin-bottom: 8px;">03</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Present at Our Partner Locations</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Visit Puco Rooftop, Puri Canggu Rooms, or Warung Dangin and present your repair confirmation to unlock immediate discounts and privileges.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- BOTTOM CTA BANNER -->
    <section style="background: #0f172a; color: #ffffff; padding: 60px 20px; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: clamp(26px, 3.5vw, 36px); font-weight: 800; color: #ffffff; margin: 0 0 12px; letter-spacing: -0.02em;">
          Own a Local Business or Brand in Bali?
        </h2>
        <p style="color: #94a3b8; font-size: 16px; line-height: 1.6; margin: 0 0 24px;">
          Partner with Bali Phone Repair's active client community. Gain verified customer exposure and mutually rewarding cross-promotional benefits.
        </p>
        <a href="https://wa.me/{{ $whatsapp }}?text=Hi%20Bali%20Phone%20Repair%2C%20I%20am%20interested%20in%20becoming%20a%20partner" target="_blank" rel="noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: var(--gold-gradient); color: #0f172a; padding: 13px 28px; border-radius: 999px; font-weight: 700; font-size: 15px; box-shadow: 0 6px 16px rgba(212, 163, 70, 0.35);">
          <i class="fa-brands fa-whatsapp" style="font-size: 1.2em;"></i>
          <span>Contact Us for Partnership</span>
        </a>
      </div>
    </section>
  </main>

  @include('public.partials.footer')

  <!-- Floating WhatsApp Button -->
  <a class="floating-wa-btn" href="https://wa.me/{{ $whatsapp }}?text=Hi!%20I%20have%20a%20question%20about%20partner%20benefits." target="_blank" rel="noreferrer" aria-label="Chat on WhatsApp" data-analytics-event="whatsapp_click" data-analytics-location="floating">
    <i class="fa-brands fa-whatsapp" style="font-size: 1.4em;"></i>
    <span>Chat WhatsApp</span>
  </a>

  <script src="{{ asset($assetBase.'script-improved.js') }}" defer></script>
</body>
</html>
