@php
    $assetBase = 'assets/bali-phone-repair/';
    $businessName = $siteSettings['business_name'] ?? 'Bali Phone Repair';
    $whatsapp = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
    $phone = $siteSettings['phone'] ?? '+6281929164999';
    $phoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', trim($phone))
        ? '+'.preg_replace('/\D+/', '', $phone)
        : null;
    $email = $siteSettings['email'] ?? 'hello@baliphonerepair.com';
    $title = 'Book Your Repair Now - Get More Benefit at Our Partners | Bali Phone Repair';
    $description = 'Servis HP, MacBook, dan laptop di Bali Phone Repair dan nikmati berbagai benefit eksklusif di UMKM mitra kami di Bali: Puco Rooftop, Puri Canggu Rooms, dan Warung Dangin.';
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
  <meta property="og:image" content="{{ asset('assets/images/partners/puco-rooftop.webp') }}" />
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

    /* Section Typography matching Homepage */
    .section-eyebrow-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #fffbeb;
      color: #b45309;
      border: 1px solid rgba(217, 119, 6, 0.25);
      font-size: 13px;
      font-weight: 800;
      padding: 5px 14px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .section-main-title {
      font-size: clamp(28px, 4vw, 42px);
      font-weight: 800;
      color: var(--color-gray-900);
      letter-spacing: -0.03em;
      margin: 12px 0 14px;
      line-height: 1.25;
    }
    .section-main-subtitle {
      font-size: 16px;
      color: var(--color-gray-600);
      line-height: 1.6;
      max-width: 760px;
      margin: 0 auto;
    }

    /* Partner Card Style matching Physical Workshops */
    .partner-card {
      background: #ffffff;
      border: 1px solid var(--color-gray-200);
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .partner-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 20px -5px rgba(0,0,0,0.08);
      border-color: #cbd5e1;
    }

    @media (max-width: 900px) {
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

  <!-- HEADER (MATCHING HOMEPAGE) -->
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

  <main style="padding-top: 68px;">
    <!-- HERO SECTION (CLEAN & BRIGHT) -->
    <section style="padding: 50px 20px 40px; text-align: center; background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); border-bottom: 1px solid var(--color-gray-200);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="font-size: 13px; color: var(--color-gray-600); margin-bottom: 16px;">
          <a href="{{ route('home') }}" style="color: var(--primary-blue); font-weight: 600;">Home</a>
          <span style="margin: 0 6px;">/</span>
          <span>Partners</span>
        </div>
        <span class="section-eyebrow-pill">
          <i class="fa-solid fa-handshake"></i> Verified Local Partners
        </span>
        <h1 class="section-main-title">
          Book your repair now <br>
          <span style="color: var(--primary-blue);">Get more benefit at our Partners</span>
        </h1>
        <p class="section-main-subtitle">
          Kami bermitra dengan bisnis dan UMKM lokal terkemuka di Bali untuk memberikan nilai tambah bagi setiap pelanggan Bali Phone Repair. Sambil menunggu servis perangkat Anda selesai, nikmati promo spesial, ruang tunggu eksklusif, hingga voucher menarik di mitra pilihan kami.
        </p>
      </div>
    </section>

    <!-- PARTNERS GRID SECTION -->
    <section style="padding: 60px 20px; background: #f8fafc; border-bottom: 1px solid var(--color-gray-200);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">

          <!-- Partner 1: Puco Rooftop -->
          <article class="partner-card">
            <div>
              <div style="background: #0f172a; border-radius: 14px; height: 180px; display: flex; align-items: center; justify-content: center; padding: 16px; margin-bottom: 18px; position: relative;">
                <img src="{{ asset('assets/images/partners/puco-rooftop.webp') }}" alt="Puco Rooftop logo" style="max-height: 100%; max-width: 100%; object-fit: contain;" loading="lazy" decoding="async">
                <span style="position: absolute; top: 10px; right: 10px; background: rgba(56, 189, 248, 0.2); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.35); font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 999px;">
                  Chill &amp; Wait Spot
                </span>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.75rem; font-weight: 700; color: #2563eb; background: #eff6ff; padding: 4px 10px; border-radius: 999px;">Cafe &amp; Rooftop</span>
                <span style="font-size: 0.8rem; color: var(--color-gray-600); font-weight: 600;">📍 Bali</span>
              </div>
              <h2 style="font-size: 1.35rem; font-weight: 700; color: var(--color-gray-900); margin: 6px 0 10px;">Puco Rooftop</h2>
              <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin-bottom: 16px;">
                Nikmati suasana rooftop yang estetik dengan aneka hidangan kopi dan makanan lezat sambil menunggu pengerjaan servis perangkat Anda.
              </p>
            </div>
            <div>
              <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 12px 14px; font-size: 0.875rem; color: #15803d; font-weight: 600; margin-bottom: 16px;">
                🎁 <strong>Customer Benefit:</strong> Tempat Nyaman Menunggu Servis &amp; Diskon F&amp;B
              </div>
              <a href="https://wa.me/{{ $whatsapp }}?text=Halo%20Bali%20Phone%20Repair%2C%20saya%20tertarik%20dengan%20benefit%20partner%20Puco%20Rooftop" target="_blank" rel="noreferrer" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box; background: #2563eb; color: #ffffff; padding: 11px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; transition: background .2s ease;">
                <i class="fa-brands fa-whatsapp"></i> Tanya Info Benefit Puco Rooftop
              </a>
            </div>
          </article>

          <!-- Partner 2: Puri Canggu Rooms -->
          <article class="partner-card">
            <div>
              <div style="background: #f1f5f9; border-radius: 14px; height: 180px; display: flex; align-items: center; justify-content: center; padding: 16px; margin-bottom: 18px; position: relative; border: 1px solid #e2e8f0;">
                <img src="{{ asset('assets/images/partners/puri-canggu-rooms.webp') }}" alt="Puri Canggu Rooms logo" style="max-height: 100%; max-width: 100%; object-fit: contain;" loading="lazy" decoding="async">
                <span style="position: absolute; top: 10px; right: 10px; background: rgba(37, 99, 235, 0.15); color: #2563eb; border: 1px solid rgba(37, 99, 235, 0.3); font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 999px;">
                  Stay &amp; Repair
                </span>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.75rem; font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 999px;">Boutique Stay</span>
                <span style="font-size: 0.8rem; color: var(--color-gray-600); font-weight: 600;">📍 Canggu, Bali</span>
              </div>
              <h2 style="font-size: 1.35rem; font-weight: 700; color: var(--color-gray-900); margin: 6px 0 10px;">Puri Canggu Rooms</h2>
              <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin-bottom: 16px;">
                Akomodasi tenang dan nyaman di pusat Canggu. Tamu yang menginap mendapatkan akses panggilan teknisi Bali Phone Repair langsung ke kamar.
              </p>
            </div>
            <div>
              <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 12px 14px; font-size: 0.875rem; color: #1d4ed8; font-weight: 600; margin-bottom: 16px;">
                🎁 <strong>Customer Benefit:</strong> Layanan Home Service Prioritas &amp; Promo Stay
              </div>
              <a href="https://wa.me/{{ $whatsapp }}?text=Halo%20Bali%20Phone%20Repair%2C%20saya%20tertarik%20dengan%20benefit%20partner%20Puri%20Canggu%20Rooms" target="_blank" rel="noreferrer" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box; background: #0f172a; color: #ffffff; padding: 11px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; transition: background .2s ease;">
                <i class="fa-brands fa-whatsapp"></i> Tanya Info Benefit Puri Canggu
              </a>
            </div>
          </article>

          <!-- Partner 3: Warung Dangin -->
          <article class="partner-card">
            <div>
              <div style="background: #0f172a; border-radius: 14px; height: 180px; display: flex; align-items: center; justify-content: center; padding: 16px; margin-bottom: 18px; position: relative;">
                <img src="{{ asset('assets/images/partners/warung-dangin.webp') }}" alt="Warung Dangin logo" style="max-height: 100%; max-width: 100%; object-fit: contain;" loading="lazy" decoding="async">
                <span style="position: absolute; top: 10px; right: 10px; background: rgba(234, 88, 12, 0.2); color: #f97316; border: 1px solid rgba(234, 88, 12, 0.35); font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 999px;">
                  Dining Benefit
                </span>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 0.75rem; font-weight: 700; color: #ea580c; background: #fff7ed; padding: 4px 10px; border-radius: 999px;">Kuliner Bali</span>
                <span style="font-size: 0.8rem; color: var(--color-gray-600); font-weight: 600;">📍 Bali</span>
              </div>
              <h2 style="font-size: 1.35rem; font-weight: 700; color: var(--color-gray-900); margin: 6px 0 10px;">Warung Dangin</h2>
              <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin-bottom: 16px;">
                Sajian kuliner khas Bali dengan cita rasa otentik bumbu warisan. Tunjukkan nota/chat servis BPR untuk klaim keuntungan spesial saat bersantap.
              </p>
            </div>
            <div>
              <div style="background: #fff7ed; border: 1px solid #fed7aa; border-radius: 10px; padding: 12px 14px; font-size: 0.875rem; color: #c2410c; font-weight: 600; margin-bottom: 16px;">
                🎁 <strong>Customer Benefit:</strong> Voucher Diskon Makanan Khusus Customer BPR
              </div>
              <a href="https://wa.me/{{ $whatsapp }}?text=Halo%20Bali%20Phone%20Repair%2C%20saya%20tertarik%20dengan%20benefit%20partner%20Warung%20Dangin" target="_blank" rel="noreferrer" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box; background: #2563eb; color: #ffffff; padding: 11px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; transition: background .2s ease;">
                <i class="fa-brands fa-whatsapp"></i> Tanya Info Benefit Warung Dangin
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>

    <!-- 3 STEPS HOW IT WORKS (CLEAN WHITE) -->
    <section style="padding: 60px 20px; background: #ffffff; border-bottom: 1px solid var(--color-gray-200);">
      <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <span class="section-eyebrow-pill">
          <i class="fa-solid fa-circle-check"></i> Simple &amp; Easy
        </span>
        <h2 class="section-main-title" style="margin-top: 10px;">3 Langkah Mudah Klaim Keuntungan</h2>
        <p class="section-main-subtitle" style="margin-bottom: 40px;">
          Cukup tunjukkan bukti pengerjaan servis dari Bali Phone Repair saat berkunjung ke mitra kami.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; text-align: left;">
          <div style="background: #f8fafc; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 24px;">
            <div style="font-size: 32px; font-weight: 900; color: #2563eb; margin-bottom: 8px;">01</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Book Your Repair</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Hubungi tim teknisi kami lewat WhatsApp atau kunjungi workshop fisik BPR di Canggu atau Denpasar untuk servis perangkat Anda.
            </p>
          </div>

          <div style="background: #f8fafc; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 24px;">
            <div style="font-size: 32px; font-weight: 900; color: #2563eb; margin-bottom: 8px;">02</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Simpan Bukti Servis</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Simpan bukti invoice resmi atau chat konfirmasi pengerjaan yang diberikan oleh tim teknisi Bali Phone Repair.
            </p>
          </div>

          <div style="background: #f8fafc; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 24px;">
            <div style="font-size: 32px; font-weight: 900; color: #2563eb; margin-bottom: 8px;">03</div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Tunjukkan di Mitra Kami</h3>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; line-height: 1.6; margin: 0;">
              Datang ke Puco Rooftop, Puri Canggu Rooms, atau Warung Dangin dan tunjukkan bukti servis untuk menikmati benefit langsung.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA BANNER (MATCHING HOMEPAGE BOTTOM CTA) -->
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
