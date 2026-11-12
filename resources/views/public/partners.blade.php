@php
    $assetBase = 'assets/bali-phone-repair/';
    $businessName = $siteSettings['business_name'] ?? 'Bali Phone Repair';
    $whatsapp = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $phone = $siteSettings['phone'] ?? '+6281929164999';
    $phoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', trim($phone))
        ? '+'.preg_replace('/\D+/', '', $phone)
        : null;
    $email = $siteSettings['email'] ?? 'hello@baliphonerepair.com';
    $title = 'Our Partners - Book Your Repair Now, Get More Benefit at Our Partners | Bali Phone Repair';
    $description = 'Jaringan mitra resmi UMKM Bali Phone Repair. Dapatkan benefit eksklusif di Puco Rooftop, Puri Canggu Rooms, Warung Dangin, dan mitra gaya hidup terkemuka di Bali.';
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
  <meta name="copyright" content="Bali Phone Repair • Exclusively Maintained by jagananta833-art" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="{{ $businessName }}" />
  <meta property="og:title" content="{{ $title }}" />
  <meta property="og:description" content="{{ $description }}" />
  <meta property="og:url" content="{{ $canonical }}" />
  <meta property="og:image" content="{{ asset('assets/images/partners/ecosystem-partners-grid.webp') }}" />
  <meta name="twitter:card" content="summary_large_image" />

  @include('public.partials.analytics-head')
  <link rel="icon" type="image/jpeg" href="{{ asset($assetBase.'logo-optimized.jpg') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset($assetBase.'styles-improved.css') }}?v={{ time() }}" />

  <style>
    :root {
      --primary-gold: #D4A346;
      --primary-blue: #2563eb;
      --color-gray-900: #0f172a;
      --color-gray-700: #334155;
      --color-gray-600: #475569;
      --color-gray-200: #e2e8f0;
      --color-gray-100: #f8fafc;
      --color-white: #ffffff;
      --accent-green: #1e3a34;
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

    /* Sticky Navigation Header (Identical to Homepage) */
    .top-header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      background: rgba(255, 255, 255, 0.98);
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
      font-size: 16px;
      font-weight: 800;
      color: var(--color-gray-900);
      line-height: 1.2;
    }
    .brand-text-block small {
      display: block;
      font-size: 11px;
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
      color: var(--primary-blue);
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
      background: linear-gradient(135deg, #F5D061 0%, #D4A346 50%, #B8860B 100%);
      color: #0f172a;
      padding: 9px 18px;
      border-radius: 999px;
      font-weight: 700;
      font-size: 13px;
      box-shadow: 0 4px 10px rgba(212, 163, 70, 0.25);
      transition: transform .2s ease;
    }
    .btn-quote-pill:hover {
      transform: translateY(-1px);
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
    .partner-hero-section {
      padding: 110px 20px 60px;
      max-width: 1240px;
      margin: 0 auto;
    }
    .partner-top-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 36px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--color-gray-200);
    }
    .partner-top-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--accent-green);
      letter-spacing: 2px;
      text-transform: uppercase;
    }
    .partner-top-perks {
      font-size: 14px;
      font-weight: 700;
      color: var(--accent-green);
      letter-spacing: 1px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
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
    .partner-logo-canvas {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 20px;
      padding: 24px;
      box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
      position: relative;
    }
    .partner-featured-strip {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 1px solid #f1f5f9;
      flex-wrap: wrap;
    }
    .pill-partner-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 14px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 700;
      box-shadow: 0 2px 5px rgba(0,0,0,0.04);
    }

    @media (max-width: 900px) {
      .partner-split-grid {
        grid-template-columns: 1fr;
        gap: 36px;
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
        <a class="active" href="{{ route('partners.index') }}" style="color: var(--primary-blue);">Partner</a>
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
    <!-- REFERENCE-MATCHING PARTNER SHOWCASE SECTION -->
    <section class="partner-hero-section">
      <!-- TOP BAR (EXACT REFERENCE: OUR PARTNERS // MORE BENEFITS) -->
      <div class="partner-top-meta">
        <span class="partner-top-title">OUR PARTNERS</span>
        <span class="partner-top-perks">🍀 // MORE BENEFITS</span>
      </div>

      <div class="partner-split-grid">
        <!-- LEFT COLUMN: EDITORIAL NARRATIVE -->
        <div class="partner-left-content">
          <h1>
            Book your repair now <br>
            <span style="color: var(--primary-blue);">Get more benefit at our Partners</span>
          </h1>

          <p class="partner-lifestyle-lead">
            More than a repair — it's a lifestyle full of perks.
          </p>

          <p class="partner-body-p">
            At <strong>Bali Phone Repair</strong>, we believe that community goes beyond our workshop walls. That's why we've partnered with amazing local brands, wellness studios, boutique stays, and lifestyle spots across Bali to bring extra benefits for our clients.
          </p>

          <p class="partner-body-p">
            From exclusive discounts and complimentary treats, to special invitations and customer-only experiences, our partnerships are designed to make your Bali journey even more rewarding — inside and outside our hubs, while your device is being expertly restored.
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
              <i class="fa-solid fa-location-dot" style="color: var(--primary-blue);"></i> Find Workshops
            </a>
          </div>
        </div>

        <!-- RIGHT COLUMN: CLEAN LOGO GRID BOARD (EXACT REFERENCE ARRANGEMENT) -->
        <div>
          <div class="partner-logo-canvas">
            <!-- Featured Key Partners Spotlight Badges -->
            <div class="partner-featured-strip">
              <span class="pill-partner-badge" style="background: #0f172a; color: #ffffff;">
                <img src="{{ asset('assets/images/partners/puco-rooftop.webp') }}" alt="Puco Rooftop" style="width: 22px; height: 22px; border-radius: 50%; object-fit: cover;" />
                Puco Rooftop &bull; Cafe &amp; Cowork
              </span>
              <span class="pill-partner-badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe;">
                <img src="{{ asset('assets/images/partners/puri-canggu-rooms.webp') }}" alt="Puri Canggu Rooms" style="width: 22px; height: 22px; border-radius: 4px; object-fit: cover;" />
                Puri Canggu &bull; Rooms &amp; Stay
              </span>
              <span class="pill-partner-badge" style="background: #0f172a; color: #f59e0b;">
                <img src="{{ asset('assets/images/partners/warung-dangin.webp') }}" alt="Warung Dangin" style="height: 14px; width: auto; object-fit: contain;" />
                Warung Dangin &bull; Bali Resto
              </span>
            </div>

            <!-- Crisp Logo Grid Layout matching Reference -->
            <div style="background: #ffffff; padding: 12px 8px; border-radius: 12px;">
              <img src="{{ asset('assets/images/partners/ecosystem-partners-grid.webp') }}" alt="Bali Phone Repair UMKM Partner Network - Puri Canggu, Warung Dangin, Indodax, Deskimo, Canggu Studio, Vault, Villa Youlas, Boho, Bookspace, Levera, Dentiq, Surf Bali Hub, Alchemy" style="width: 100%; height: auto; display: block; border-radius: 8px;" loading="lazy" decoding="async">
            </div>

            <div style="margin-top: 16px; padding-top: 14px; border-top: 1px dashed var(--color-gray-200); display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: var(--color-gray-600);">
              <span>✨ Official Verified Ecosystem</span>
              <span style="font-weight: 700; color: #059669;"><i class="fa-solid fa-circle-check"></i> Active Customer Benefits</span>
            </div>
          </div>
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
          Cara Mudah Klaim Keuntungan di Mitra Kami
        </h2>
        <p style="color: var(--color-gray-600); font-size: 16px; margin: 0 0 36px;">
          Cukup 3 langkah praktis untuk menikmati fasilitas spesial di seluruh jaringan mitra BPR.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; text-align: left;">
          <div style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 26px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);">
            <div style="font-size: 32px; font-weight: 900; color: #2563eb; margin-bottom: 8px;">01</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Book Your Repair</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Hubungi tim teknisi kami lewat WhatsApp atau kunjungi workshop fisik BPR di Canggu atau Denpasar untuk servis perangkat Anda.
            </p>
          </div>

          <div style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 26px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);">
            <div style="font-size: 32px; font-weight: 900; color: #2563eb; margin-bottom: 8px;">02</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Simpan Bukti Servis</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Simpan bukti invoice resmi atau chat konfirmasi pengerjaan yang diberikan oleh tim teknisi Bali Phone Repair.
            </p>
          </div>

          <div style="background: #ffffff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 26px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);">
            <div style="font-size: 32px; font-weight: 900; color: #2563eb; margin-bottom: 8px;">03</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Tunjukkan di Mitra Kami</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Datang ke lokasi mitra pilihan Anda di Bali dan tunjukkan bukti servis untuk menikmati diskon, promo santap, atau privilege langsung.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- BOTTOM CTA BANNER -->
    <section style="background: #0f172a; color: #ffffff; padding: 60px 20px; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: clamp(26px, 3.5vw, 36px); font-weight: 800; color: #ffffff; margin: 0 0 12px; letter-spacing: -0.02em;">
          Punya Bisnis atau UMKM di Bali?
        </h2>
        <p style="color: #94a3b8; font-size: 16px; line-height: 1.6; margin: 0 0 24px;">
          Mari berkolaborasi bersama jaringan pelanggan setia Bali Phone Repair. Dapatkan eksposur komunitas dan cross-benefit saling menguntungkan.
        </p>
        <a href="https://wa.me/{{ $whatsapp }}?text=Halo%20Admin%20BPR%2C%20saya%20tertarik%20mengajukan%20kemitraan%20UMKM" target="_blank" rel="noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #F5D061 0%, #D4A346 50%, #B8860B 100%); color: #0f172a; padding: 13px 28px; border-radius: 999px; font-weight: 700; font-size: 15px; box-shadow: 0 6px 16px rgba(212, 163, 70, 0.35);">
          <i class="fa-brands fa-whatsapp" style="font-size: 1.2em;"></i>
          <span>Hubungi Kami untuk Kemitraan</span>
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
