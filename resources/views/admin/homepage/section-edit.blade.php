@extends('layouts.admin')

@section('page_title', 'Edit ' . $info['title'])
@section('page_subtitle', $info['description'])

@push('styles')
<style>
    .section-header-box {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }
    .back-nav {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #854d0e;
        font-weight: 800;
        font-size: 13.5px;
        margin-bottom: 8px;
        transition: transform 0.16s ease;
    }
    .back-nav:hover {
        transform: translateX(-3px);
    }
    .layer-switcher {
        display: flex;
        gap: 6px;
        overflow-x: auto;
        padding-bottom: 10px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--admin-line);
    }
    .layer-switch-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: #ffffff;
        border: 1px solid var(--admin-line-strong);
        border-radius: 9px;
        color: #475569;
        font-size: 12.5px;
        font-weight: 750;
        white-space: nowrap;
        transition: all 0.16s ease;
    }
    .layer-switch-btn:hover, .layer-switch-btn.is-active {
        background: linear-gradient(135deg, rgba(245, 208, 97, 0.22), rgba(212, 163, 70, 0.12));
        border-color: var(--admin-gold);
        color: #854d0e;
    }
    .layer-switch-btn.is-active {
        box-shadow: 0 4px 12px rgba(212, 163, 70, 0.2);
    }
    .section-location-banner {
        padding: 16px 20px;
        background: #f8fafc;
        border: 1px solid var(--admin-line);
        border-left: 4px solid var(--admin-gold);
        border-radius: 0 12px 12px 0;
        margin-bottom: 28px;
    }
    .section-location-banner strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        margin-bottom: 3px;
    }
    .section-location-banner p {
        margin: 0;
        color: var(--admin-muted);
        font-size: 13px;
        font-style: italic;
    }
    .image-preview-box {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 16px;
        background: #f8fafc;
        border: 1px solid var(--admin-line);
        border-radius: 12px;
        margin-top: 8px;
    }
    .image-preview-thumb {
        width: 100px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--admin-line-strong);
        background: #e2e8f0;
    }
    .image-preview-info {
        font-size: 12.5px;
        color: var(--admin-muted);
        line-height: 1.4;
    }
    .image-preview-info strong {
        color: #0f172a;
        display: block;
        font-size: 13px;
        margin-bottom: 2px;
    }
    .collection-notice {
        padding: 14px 18px;
        background: #fefce8;
        border: 1px solid #fef08a;
        border-radius: 12px;
        color: #854d0e;
        font-size: 13.5px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')

<!-- Header Back & View on Website -->
<div class="section-header-box">
    <div>
        <a class="back-nav" href="{{ route('admin.homepage.index') }}">← Kembali Pilih Layer Lain</a>
        <h1 style="margin:0 0 6px;font-size:24px;color:#0f172a;font-weight:800">{{ $info['title'] }}</h1>
        <p style="margin:0;color:var(--admin-muted);font-size:14px">{{ $info['description'] }}</p>
    </div>
    <div style="display:flex;gap:10px;align-items:center">
        <a class="btn-secondary" href="{{ route('home') }}{{ $info['anchor'] ? '#'.$info['anchor'] : '' }}" target="_blank" rel="noreferrer">
            Lihat di Website ↗
        </a>
    </div>
</div>

<!-- Switcher Antar Layer -->
<div class="layer-switcher">
    @foreach($sections as $sKey => $sVal)
        <a class="layer-switch-btn {{ $sKey === $section ? 'is-active' : '' }}" href="{{ route('admin.homepage.sections.edit', $sKey) }}">
            {{ $sVal['layer_tag'] }}: {{ Str::limit($sVal['title'], 20) }}
        </a>
    @endforeach
</div>

@if(session('ok'))
    <div class="flash">
        <strong>✓ Berhasil!</strong> {{ session('ok') }}
    </div>
@endif

@if($errors->any())
    <div class="error">
        <strong>Terjadi Kesalahan:</strong>
        <ul style="margin:6px 0 0 18px;padding:0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Location Banner Quote -->
<div class="section-location-banner">
    <strong>Anda sedang mengedit {{ $info['layer_tag'] }}</strong>
    <p>“{{ $info['example'] }}”</p>
</div>

@if(isset($info['collection_route']))
    <div class="collection-notice">
        <span>Ingin menambah atau mengedit item detail pada bagian ini?</span>
        <a class="btn-secondary" style="min-height:34px;font-size:12px;padding:0 12px" href="{{ route($info['collection_route'], $info['collection_param'] ?? null) }}">
            {{ $info['collection_label'] }} →
        </a>
    </div>
@endif

<form method="post" action="{{ route('admin.homepage.sections.update', $section) }}" enctype="multipart/form-data" class="form-card">
    @csrf
    @method('put')

    {{-- ================================================================= --}}
    {{-- LAYER 1: HERO --}}
    {{-- ================================================================= --}}
    @if($section === 'hero')
        <section class="form-section">
            <h2>Headline &amp; Background Utama</h2>
            <p class="help">Kelola foto background mobil layanan dan teks penawaran utama di hero section.</p>
            <div class="form-grid">
                <div class="full">
                    <label>
                        Foto Background Hero (Mobil Layanan / Background Utama)
                        <small>Pilih file foto baru jika ingin mengganti background (format JPG/PNG/WEBP, maks 5MB).</small>
                        <input type="file" name="hero_bg_image_file" accept="image/*">
                    </label>
                    @php $heroBg = $settings['hero_bg_image'] ?? 'assets/bali-phone-repair/hero-bg-slide3.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($heroBg) }}" alt="Hero Background">
                        <div class="image-preview-info">
                            <strong>Foto Aktif Saat Ini:</strong>
                            <span>{{ $heroBg }}</span>
                        </div>
                    </div>
                </div>

                <label>
                    Badge Lokasi / Layanan Panggilan
                    <small>Teks badge di atas headline utama</small>
                    <input name="hero_location_badge" value="{{ old('hero_location_badge', $settings['hero_location_badge'] ?? 'We come to you across Bali') }}">
                </label>

                <label>
                    Teks Tombol WhatsApp Utama
                    <small>Label tombol aksi di hero</small>
                    <input name="hero_cta_text" value="{{ old('hero_cta_text', $settings['hero_cta_text'] ?? 'Get a Free Quote') }}">
                </label>

                <label class="full">
                    Judul Utama Headline (H1)
                    <small>Judul besar paling atas website</small>
                    <input name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Fast & Professional Device Repair in Bali') }}">
                </label>

                <label class="full">
                    Deskripsi Sub-headline Hero
                    <small>Paragraf ringkas pengantar servis di bawah headline</small>
                    <textarea name="hero_description">{{ old('hero_description', $settings['hero_description'] ?? 'Cracked screen? Dead battery? Water damage? Our certified mobile technicians come directly to your villa, hotel, or anywhere in Bali. Same-day repairs with warranty.') }}</textarea>
                </label>

                <label class="full">
                    Template Pesan Awal WhatsApp
                    <small>Pesan otomatis yang muncul di chat WhatsApp ketika pengunjung menekan tombol Get Quote</small>
                    <input name="hero_cta_message" value="{{ old('hero_cta_message', $settings['hero_cta_message'] ?? 'Hi! I need a phone repair in Bali. Can you help?') }}">
                </label>
            </div>
        </section>

        <section class="form-section">
            <h2>3 Kartu Foto Teknisi di Bawah Hero</h2>
            <p class="help">Kelola 3 foto teknisi &amp; label garansi yang muncul di sisi kanan/bawah hero.</p>
            <div class="form-grid">
                <!-- Card 1 -->
                <div>
                    <label>Foto Kartu 1<input type="file" name="hero_card1_image_file" accept="image/*"></label>
                    @php $card1Img = $settings['hero_card1_image'] ?? 'assets/bali-phone-repair/teknisi1-optimized.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($card1Img) }}" alt="Card 1">
                        <div class="image-preview-info"><span>{{ $card1Img }}</span></div>
                    </div>
                    <label style="margin-top:8px">Label Tag Kartu 1<input name="hero_card1_tag" value="{{ old('hero_card1_tag', $settings['hero_card1_tag'] ?? 'Certified Tech') }}"></label>
                </div>

                <!-- Card 2 -->
                <div>
                    <label>Foto Kartu 2<input type="file" name="hero_card2_image_file" accept="image/*"></label>
                    @php $card2Img = $settings['hero_card2_image'] ?? 'assets/bali-phone-repair/teknisia1-optimized.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($card2Img) }}" alt="Card 2">
                        <div class="image-preview-info"><span>{{ $card2Img }}</span></div>
                    </div>
                    <label style="margin-top:8px">Label Tag Kartu 2<input name="hero_card2_tag" value="{{ old('hero_card2_tag', $settings['hero_card2_tag'] ?? 'OEM Parts') }}"></label>
                </div>

                <!-- Card 3 -->
                <div class="full">
                    <label>Foto Kartu 3<input type="file" name="hero_card3_image_file" accept="image/*"></label>
                    @php $card3Img = $settings['hero_card3_image'] ?? 'assets/bali-phone-repair/teknisib1-optimized.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($card3Img) }}" alt="Card 3">
                        <div class="image-preview-info"><span>{{ $card3Img }}</span></div>
                    </div>
                    <label style="margin-top:8px">Label Tag Kartu 3<input name="hero_card3_tag" value="{{ old('hero_card3_tag', $settings['hero_card3_tag'] ?? '30-60 Day Warranty') }}"></label>
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 2: TRUST BAR --}}
    {{-- ================================================================= --}}
    @if($section === 'trust')
        <section class="form-section">
            <h2>4 Poin Kepercayaan Utama</h2>
            <p class="help">Badge nilai jual yang meyakinkan calon pelanggan (garansi, sparepart, teknisi panggilan, dll).</p>
            <div class="form-grid">
                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Poin 1</h3>
                    <label>Ikon FontAwesome<input name="trust1_icon" value="{{ old('trust1_icon', $settings['trust1_icon'] ?? 'fa-solid fa-motorcycle') }}"></label>
                    <label style="margin-top:8px">Judul<input name="trust1_title" value="{{ old('trust1_title', $settings['trust1_title'] ?? 'We Come to You') }}"></label>
                    <label style="margin-top:8px">Sub-teks<input name="trust1_subtitle" value="{{ old('trust1_subtitle', $settings['trust1_subtitle'] ?? 'Anywhere in Bali') }}"></label>
                </div>

                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Poin 2</h3>
                    <label>Ikon FontAwesome<input name="trust2_icon" value="{{ old('trust2_icon', $settings['trust2_icon'] ?? 'fa-solid fa-microchip') }}"></label>
                    <label style="margin-top:8px">Judul<input name="trust2_title" value="{{ old('trust2_title', $settings['trust2_title'] ?? 'OEM Quality Parts') }}"></label>
                    <label style="margin-top:8px">Sub-teks<input name="trust2_subtitle" value="{{ old('trust2_subtitle', $settings['trust2_subtitle'] ?? 'Tested & Verified') }}"></label>
                </div>

                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Poin 3</h3>
                    <label>Ikon FontAwesome<input name="trust3_icon" value="{{ old('trust3_icon', $settings['trust3_icon'] ?? 'fa-solid fa-shield-halved') }}"></label>
                    <label style="margin-top:8px">Judul<input name="trust3_title" value="{{ old('trust3_title', $settings['trust3_title'] ?? '30-90 Day Warranty') }}"></label>
                    <label style="margin-top:8px">Sub-teks<input name="trust3_subtitle" value="{{ old('trust3_subtitle', $settings['trust3_subtitle'] ?? 'Peace of Mind') }}"></label>
                </div>

                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Poin 4</h3>
                    <label>Ikon FontAwesome<input name="trust4_icon" value="{{ old('trust4_icon', $settings['trust4_icon'] ?? 'fa-solid fa-hand-holding-dollar') }}"></label>
                    <label style="margin-top:8px">Judul<input name="trust4_title" value="{{ old('trust4_title', $settings['trust4_title'] ?? 'No Fix, No Fee') }}"></label>
                    <label style="margin-top:8px">Sub-teks<input name="trust4_subtitle" value="{{ old('trust4_subtitle', $settings['trust4_subtitle'] ?? 'Zero Risk Guarantee') }}"></label>
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 3: SERVICES --}}
    {{-- ================================================================= --}}
    @if($section === 'services')
        <section class="form-section">
            <h2>Header Bagian Layanan</h2>
            <p class="help">Teks pengantar di atas grid layanan utama website.</p>
            <div class="form-grid">
                <label>
                    Kategori / Eyebrow
                    <input name="services_eyebrow" value="{{ old('services_eyebrow', $settings['services_eyebrow'] ?? 'What We Fix') }}">
                </label>
                <label>
                    Judul Bagian Layanan (H2)
                    <input name="services_title" value="{{ old('services_title', $settings['services_title'] ?? 'Our Core Repair Services') }}">
                </label>
                <label class="full">
                    Deskripsi Subjudul Layanan
                    <textarea name="services_subtitle">{{ old('services_subtitle', $settings['services_subtitle'] ?? 'Professional repairs for all major brands, right at your doorstep') }}</textarea>
                </label>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 4: HOW IT WORKS --}}
    {{-- ================================================================= --}}
    @if($section === 'how')
        <section class="form-section">
            <h2>Header Cara Kerja</h2>
            <p class="help">Teks pembuka untuk alur servis 3 langkah.</p>
            <div class="form-grid">
                <label>Eyebrow<input name="how_eyebrow" value="{{ old('how_eyebrow', $settings['how_eyebrow'] ?? 'How It Works') }}"></label>
                <label>Judul (H2)<input name="how_title" value="{{ old('how_title', $settings['how_title'] ?? 'Simple, Fast & Hassle-Free') }}"></label>
                <label class="full">Deskripsi Subjudul<textarea name="how_subtitle">{{ old('how_subtitle', $settings['how_subtitle'] ?? 'Getting your device repaired in Bali has never been easier') }}</textarea></label>
            </div>
        </section>

        <section class="form-section">
            <h2>Langkah 1, 2, dan 3</h2>
            <div class="form-grid">
                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Langkah 1</h3>
                    <label>Ikon<input name="step1_icon" value="{{ old('step1_icon', $settings['step1_icon'] ?? 'fa-solid fa-comments') }}"></label>
                    <label style="margin-top:8px">Judul<input name="step1_title" value="{{ old('step1_title', $settings['step1_title'] ?? '1. Message Us on WhatsApp') }}"></label>
                    <label style="margin-top:8px">Deskripsi<textarea name="step1_desc">{{ old('step1_desc', $settings['step1_desc'] ?? 'Tell us your device model and the issue. We\'ll give you an instant, transparent quote with no hidden fees.') }}</textarea></label>
                </div>

                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Langkah 2</h3>
                    <label>Ikon<input name="step2_icon" value="{{ old('step2_icon', $settings['step2_icon'] ?? 'fa-solid fa-location-dot') }}"></label>
                    <label style="margin-top:8px">Judul<input name="step2_title" value="{{ old('step2_title', $settings['step2_title'] ?? '2. We Come to Your Location') }}"></label>
                    <label style="margin-top:8px">Deskripsi<textarea name="step2_desc">{{ old('step2_desc', $settings['step2_desc'] ?? 'Our certified technician arrives at your villa, hotel, or café anywhere in Bali at your scheduled time.') }}</textarea></label>
                </div>

                <div class="full">
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Langkah 3</h3>
                    <label>Ikon<input name="step3_icon" value="{{ old('step3_icon', $settings['step3_icon'] ?? 'fa-solid fa-circle-check') }}"></label>
                    <label style="margin-top:8px">Judul<input name="step3_title" value="{{ old('step3_title', $settings['step3_title'] ?? '3. Fixed & Tested on the Spot') }}"></label>
                    <label style="margin-top:8px">Deskripsi<textarea name="step3_desc">{{ old('step3_desc', $settings['step3_desc'] ?? 'Most repairs take 30-60 minutes. Test your device thoroughly before paying. Warranty included.') }}</textarea></label>
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 5: REVIEWS --}}
    {{-- ================================================================= --}}
    @if($section === 'reviews')
        <section class="form-section">
            <h2>Header Bagian Testimoni &amp; Ulasan</h2>
            <p class="help">Teks pengantar di atas carousel ulasan pelanggan.</p>
            <div class="form-grid">
                <label>Eyebrow<input name="reviews_eyebrow" value="{{ old('reviews_eyebrow', $settings['reviews_eyebrow'] ?? 'Customer Reviews') }}"></label>
                <label>Judul (H2)<input name="reviews_title" value="{{ old('reviews_title', $settings['reviews_title'] ?? 'Trusted by Travelers & Locals Across Bali') }}"></label>
                <label class="full">Deskripsi Subjudul<textarea name="reviews_subtitle">{{ old('reviews_subtitle', $settings['reviews_subtitle'] ?? 'See what our customers say about our mobile repair service') }}</textarea></label>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 6: PRICING --}}
    {{-- ================================================================= --}}
    @if($section === 'pricing')
        <section class="form-section">
            <h2>Header Tabel Harga Transparan</h2>
            <div class="form-grid">
                <label>Eyebrow<input name="pricing_eyebrow" value="{{ old('pricing_eyebrow', $settings['pricing_eyebrow'] ?? 'Transparent Pricing') }}"></label>
                <label>Judul (H2)<input name="pricing_title" value="{{ old('pricing_title', $settings['pricing_title'] ?? 'Estimated Repair Costs') }}"></label>
                <label class="full">Deskripsi Subjudul<textarea name="pricing_subtitle">{{ old('pricing_subtitle', $settings['pricing_subtitle'] ?? 'Exact price depends on your device model. Message us for a precise quote.') }}</textarea></label>
            </div>
        </section>

        <section class="form-section">
            <h2>6 Baris Estimasi Harga Servis</h2>
            <p class="help">Ubah jenis servis, durasi pengerjaan, dan estimasi harga perbaikan.</p>
            <div class="form-grid">
                @for($r = 1; $r <= 6; $r++)
                    @php
                        $dTitle = ['Screen Replacement', 'Battery Replacement', 'Charging Port Repair', 'Water Damage Recovery', 'Camera / Lens Repair', 'Back Glass Replacement'][$r-1];
                        $dDur = ['30-45 mins', '20-30 mins', '30-45 mins', '1-2 hours', '30-45 mins', '45-60 mins'][$r-1];
                        $dPrice = ['From IDR 350K (~$23 USD)', 'From IDR 300K (~$20 USD)', 'From IDR 250K (~$16 USD)', 'From IDR 400K (~$26 USD)', 'From IDR 300K (~$20 USD)', 'From IDR 350K (~$23 USD)'][$r-1];
                    @endphp
                    <div>
                        <h3 style="margin:0 0 10px;font-size:14px;color:#854d0e">Baris {{ $r }}: {{ $dTitle }}</h3>
                        <label>Nama Servis<input name="pricing_row{{ $r }}_title" value="{{ old('pricing_row'.$r.'_title', $settings['pricing_row'.$r.'_title'] ?? $dTitle) }}"></label>
                        <label style="margin-top:8px">Durasi Pengerjaan<input name="pricing_row{{ $r }}_duration" value="{{ old('pricing_row'.$r.'_duration', $settings['pricing_row'.$r.'_duration'] ?? $dDur) }}"></label>
                        <label style="margin-top:8px">Estimasi Biaya<input name="pricing_row{{ $r }}_price" value="{{ old('pricing_row'.$r.'_price', $settings['pricing_row'.$r.'_price'] ?? $dPrice) }}"></label>
                    </div>
                @endfor
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 7: EXTRA SERVICES (JUAL BELI & RENTAL) --}}
    {{-- ================================================================= --}}
    @if($section === 'extra')
        <section class="form-section">
            <h2>Header Bagian Jual Beli &amp; Rental</h2>
            <div class="form-grid">
                <label>Eyebrow<input name="extra_eyebrow" value="{{ old('extra_eyebrow', $settings['extra_eyebrow'] ?? 'More Than Just Repairs') }}"></label>
                <label>Judul (H2)<input name="extra_title" value="{{ old('extra_title', $settings['extra_title'] ?? 'Buy, Sell, Trade & Laptop Rental in Bali') }}"></label>
                <label class="full">Deskripsi Subjudul<textarea name="extra_subtitle">{{ old('extra_subtitle', $settings['extra_subtitle'] ?? 'Looking for a replacement phone, want to sell your old device, or need a laptop while visiting? We\'ve got you covered.') }}</textarea></label>
            </div>
        </section>

        <section class="form-section">
            <h2>3 Kartu Layanan Ekstra</h2>
            <p class="help">Kelola foto, badge, judul, dan teks tombol pada 3 kartu promosi.</p>
            <div class="form-grid">
                <!-- Card 1 -->
                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Kartu 1: Jual Device Bekas</h3>
                    <label>Foto Kartu 1<input type="file" name="extra_card1_image_file" accept="image/*"></label>
                    @php $extra1 = $settings['extra_card1_image'] ?? 'assets/bali-phone-repair/teknisi1-optimized.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($extra1) }}" alt="Card 1">
                        <div class="image-preview-info"><span>{{ $extra1 }}</span></div>
                    </div>
                    <label style="margin-top:8px">Badge Tag<input name="extra_card1_badge" value="{{ old('extra_card1_badge', $settings['extra_card1_badge'] ?? 'Instant Cash') }}"></label>
                    <label style="margin-top:8px">Judul Kartu<input name="extra_card1_title" value="{{ old('extra_card1_title', $settings['extra_card1_title'] ?? 'Sell Your Old Phone') }}"></label>
                    <label style="margin-top:8px">Deskripsi<textarea name="extra_card1_desc">{{ old('extra_card1_desc', $settings['extra_card1_desc'] ?? 'Got an iPhone, Samsung, or MacBook you no longer use? We offer fair market prices and instant cash.') }}</textarea></label>
                    <label style="margin-top:8px">Label Tombol<input name="extra_card1_btn" value="{{ old('extra_card1_btn', $settings['extra_card1_btn'] ?? 'Sell Device ->') }}"></label>
                </div>

                <!-- Card 2 -->
                <div>
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Kartu 2: Beli Unit Bergaransi</h3>
                    <label>Foto Kartu 2<input type="file" name="extra_card2_image_file" accept="image/*"></label>
                    @php $extra2 = $settings['extra_card2_image'] ?? 'assets/bali-phone-repair/teknisia1-optimized.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($extra2) }}" alt="Card 2">
                        <div class="image-preview-info"><span>{{ $extra2 }}</span></div>
                    </div>
                    <label style="margin-top:8px">Badge Tag<input name="extra_card2_badge" value="{{ old('extra_card2_badge', $settings['extra_card2_badge'] ?? 'Certified Pre-Owned') }}"></label>
                    <label style="margin-top:8px">Judul Kartu<input name="extra_card2_title" value="{{ old('extra_card2_title', $settings['extra_card2_title'] ?? 'Buy Quality Used Phones') }}"></label>
                    <label style="margin-top:8px">Deskripsi<textarea name="extra_card2_desc">{{ old('extra_card2_desc', $settings['extra_card2_desc'] ?? 'Fully tested iPhones, Samsung Galaxies, and MacBooks with warranty at competitive prices.') }}</textarea></label>
                    <label style="margin-top:8px">Label Tombol<input name="extra_card2_btn" value="{{ old('extra_card2_btn', $settings['extra_card2_btn'] ?? 'View Stock ->') }}"></label>
                </div>

                <!-- Card 3 -->
                <div class="full">
                    <h3 style="margin:0 0 10px;font-size:15px;color:#854d0e">Kartu 3: Rental MacBook &amp; Laptop</h3>
                    <label>Foto Kartu 3<input type="file" name="extra_card3_image_file" accept="image/*"></label>
                    @php $extra3 = $settings['extra_card3_image'] ?? 'assets/bali-phone-repair/teknisib1-optimized.jpg'; @endphp
                    <div class="image-preview-box">
                        <img class="image-preview-thumb" src="{{ asset($extra3) }}" alt="Card 3">
                        <div class="image-preview-info"><span>{{ $extra3 }}</span></div>
                    </div>
                    <label style="margin-top:8px">Badge Tag<input name="extra_card3_badge" value="{{ old('extra_card3_badge', $settings['extra_card3_badge'] ?? 'Flexible Rental') }}"></label>
                    <label style="margin-top:8px">Judul Kartu<input name="extra_card3_title" value="{{ old('extra_card3_title', $settings['extra_card3_title'] ?? 'MacBook & Laptop Rental') }}"></label>
                    <label style="margin-top:8px">Deskripsi<textarea name="extra_card3_desc">{{ old('extra_card3_desc', $settings['extra_card3_desc'] ?? 'Working remotely in Bali or waiting for your repair? Rent a MacBook Pro, MacBook Air, or Windows laptop daily or weekly.') }}</textarea></label>
                    <label style="margin-top:8px">Label Tombol<input name="extra_card3_btn" value="{{ old('extra_card3_btn', $settings['extra_card3_btn'] ?? 'Rent a Laptop ->') }}"></label>
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 8: FAQ --}}
    {{-- ================================================================= --}}
    @if($section === 'faq')
        <section class="form-section">
            <h2>Header Bagian FAQ (Tanya Jawab)</h2>
            <p class="help">Teks pengantar di atas accordion pertanyaan seputar servis HP di Bali.</p>
            <div class="form-grid">
                <label>Eyebrow<input name="faq_eyebrow" value="{{ old('faq_eyebrow', $settings['faq_eyebrow'] ?? 'FAQ') }}"></label>
                <label>Judul (H2)<input name="faq_title" value="{{ old('faq_title', $settings['faq_title'] ?? 'Frequently Asked Questions') }}"></label>
                <label class="full">Deskripsi Subjudul<textarea name="faq_subtitle">{{ old('faq_subtitle', $settings['faq_subtitle'] ?? 'Got questions? We\'ve got answers about our mobile repair service in Bali.') }}</textarea></label>
            </div>
        </section>
    @endif

    {{-- ================================================================= --}}
    {{-- LAYER 9: CONTACT & FOOTER --}}
    {{-- ================================================================= --}}
    @if($section === 'contact')
        <section class="form-section">
            <h2>Banner Ajakan Konsultasi Bawah</h2>
            <div class="form-grid">
                <label class="full">Judul Banner Ajakan (H2)<input name="cta_title" value="{{ old('cta_title', $settings['cta_title'] ?? 'Ready to Get Your Device Fixed Today?') }}"></label>
                <label class="full">Deskripsi Ajakan<textarea name="cta_description">{{ old('cta_description', $settings['cta_description'] ?? 'Message us on WhatsApp now for a free quote. Our technicians are ready to come to your location anywhere in Bali.') }}</textarea></label>
                <label>Label Tombol WhatsApp<input name="cta_btn_text" value="{{ old('cta_btn_text', $settings['cta_btn_text'] ?? 'Chat on WhatsApp Now') }}"></label>
            </div>
        </section>

        <section class="form-section">
            <h2>Informasi Kontak Bisnis &amp; Toko</h2>
            <div class="form-grid">
                <label>Nama Bisnis<input name="business_name" value="{{ old('business_name', $settings['business_name'] ?? 'Bali Phone Repair') }}"></label>
                <label>Nomor Telepon<input name="phone" value="{{ old('phone', $settings['phone'] ?? '+62 819-2916-4999') }}"></label>
                <label>WhatsApp (Format Angka Internasional, cth: 6281929164999)<input name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '6281929164999') }}"></label>
                <label>Email Resmi<input name="email" value="{{ old('email', $settings['email'] ?? 'hello@baliphonerepair.com') }}"></label>
                <label class="full">Alamat Outlet / Workshop<textarea name="address">{{ old('address', $settings['address'] ?? 'Jl. Pulau Misol No.106, Dauh Puri Kauh, Denpasar, Bali 80113') }}</textarea></label>
                <label>Jam Operasional<input name="opening_hours" value="{{ old('opening_hours', $settings['opening_hours'] ?? 'Monday - Sunday 09:00 - 21:00 (Open Daily)') }}"></label>
                <label>Link Google Maps<input name="google_maps" value="{{ old('google_maps', $settings['google_maps'] ?? 'https://www.google.com/maps/search/?api=1&query=Jl.+Pulau+Misol+No.106,+Dauh+Puri+Kauh,+Denpasar,+Bali+80113') }}"></label>
            </div>
        </section>

        <section class="form-section">
            <h2>Akun Sosial Media Resmi</h2>
            <div class="form-grid">
                <label>Instagram URL<input name="instagram" value="{{ old('instagram', $settings['instagram'] ?? 'https://instagram.com/baliphonerepair') }}"></label>
                <label>Facebook URL<input name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}"></label>
                <label>TikTok URL<input name="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"></label>
            </div>
        </section>
    @endif

    <div class="form-actions">
        <a class="btn-secondary" href="{{ route('admin.homepage.index') }}">Batal</a>
        <button class="btn" type="submit">Simpan Perubahan {{ $info['title'] }}</button>
    </div>
</form>

@endsection
