@extends('layouts.admin')

@section('page_title', 'Kelola Konten Homepage (Per-Layer)')
@section('page_subtitle', 'Edit seluruh isi, teks, harga, nomor WhatsApp, serta ganti/upload foto di setiap layer homepage.')

@push('styles')
<style>
    .layer-nav-tabs {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 12px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--admin-line);
    }
    .layer-nav-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        background: #ffffff;
        border: 1px solid var(--admin-line-strong);
        border-radius: 10px;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s ease;
    }
    .layer-nav-btn:hover, .layer-nav-btn.is-active {
        background: linear-gradient(135deg, rgba(245, 208, 97, 0.22), rgba(212, 163, 70, 0.12));
        border-color: var(--admin-gold);
        color: #854d0e;
    }
    .layer-nav-btn.is-active {
        box-shadow: 0 4px 14px rgba(212, 163, 70, 0.22);
    }
    .layer-tag {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        background: rgba(245, 208, 97, 0.2);
        color: #854d0e;
        border: 1px solid rgba(212, 163, 70, 0.35);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 8px;
    }
    .image-preview-box {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 14px;
        background: #f8fafc;
        border: 1px solid var(--admin-line);
        border-radius: 12px;
        margin-top: 8px;
    }
    .image-preview-thumb {
        width: 90px;
        height: 65px;
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
    .layer-group-card {
        margin-bottom: 28px;
    }
</style>
@endpush

@section('content')

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

<form method="post" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data" class="form-card">
    @csrf
    @method('put')

    <!-- Layer Quick Anchor Nav -->
    <div style="padding: 20px 24px 0;">
        <div class="layer-nav-tabs">
            <a href="#layer-1" class="layer-nav-btn is-active">Layer 1: Hero &amp; Foto</a>
            <a href="#layer-2" class="layer-nav-btn">Layer 2: Trust Bar</a>
            <a href="#layer-3" class="layer-nav-btn">Layer 3: Layanan</a>
            <a href="#layer-4" class="layer-nav-btn">Layer 4: Cara Kerja</a>
            <a href="#layer-5" class="layer-nav-btn">Layer 5: Ulasan / Testimoni</a>
            <a href="#layer-6" class="layer-nav-btn">Layer 6: Harga Transparan</a>
            <a href="#layer-7" class="layer-nav-btn">Layer 7: Jual-Beli &amp; Rental</a>
            <a href="#layer-8" class="layer-nav-btn">Layer 8: FAQ</a>
            <a href="#layer-9" class="layer-nav-btn">Layer 9: Banner Bawah &amp; Kontak</a>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- LAYER 1: HERO SECTION -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-1">
        <span class="layer-tag">Layer 1</span>
        <h2>Hero Section &amp; Background Visual</h2>
        <p class="help">Kelola foto background utama (mobil layanan), headline, badge lokasi, dan 3 kartu foto teknisi di hero.</p>

        <div class="form-grid">
            <div class="full">
                <label>
                    Foto Background Hero (Mobil Layanan / Background Utama)
                    <small>Pilih file foto baru jika ingin mengganti foto background mobil (format JPG/PNG/WEBP, maks 5MB).</small>
                    <input type="file" name="hero_bg_image_file" accept="image/*">
                </label>
                @php
                    $currentHeroBg = $settings['hero_bg_image'] ?? 'assets/bali-phone-repair/hero-bg-slide3.jpg';
                @endphp
                <div class="image-preview-box">
                    <img class="image-preview-thumb" src="{{ asset($currentHeroBg) }}" alt="Current Hero Background">
                    <div class="image-preview-info">
                        <strong>Foto Aktif Saat Ini:</strong>
                        <span>{{ $currentHeroBg }}</span>
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
                <small>Label tombol ajakan di hero</small>
                <input name="hero_cta_text" value="{{ old('hero_cta_text', $settings['hero_cta_text'] ?? 'Get a Free Quote') }}">
            </label>

            <label class="full">
                Judul Utama Headline (H1)
                <small>Judul besar paling atas di layer 1</small>
                <input name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Fast & Professional Device Repair in Bali') }}">
            </label>

            <label class="full">
                Deskripsi Sub-headline Hero
                <small>Paragraf ringkas penjelasan servis di bawah judul utama</small>
                <textarea name="hero_description">{{ old('hero_description', $settings['hero_description'] ?? 'Cracked screen? Dead battery? Water damage? Our certified mobile technicians come directly to your villa, hotel, or anywhere in Bali. Same-day repairs with warranty.') }}</textarea>
            </label>

            <label class="full">
                Pesan Awal WhatsApp Tombol Hero
                <small>Template pesan otomatis saat calon pelanggan menekan tombol Get Quote</small>
                <input name="hero_cta_message" value="{{ old('hero_cta_message', $settings['hero_cta_message'] ?? 'Hi! I need a phone repair in Bali. Can you help?') }}">
            </label>
        </div>

        <h3 style="margin:24px 0 12px;font-size:16px;color:#854d0e;font-weight:800">3 Kartu Foto Teknisi di Bawah Hero</h3>
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

    <!-- ================================================================= -->
    <!-- LAYER 2: TRUST BAR -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-2">
        <span class="layer-tag">Layer 2</span>
        <h2>Trust Bar (4 Poin Keunggulan)</h2>
        <p class="help">4 item garansi dan keunggulan servis tepat di bawah seksi hero.</p>

        <div class="form-grid">
            <!-- Item 1 -->
            <div>
                <label>Ikon Item 1 (FontAwesome)<input name="trust1_icon" value="{{ old('trust1_icon', $settings['trust1_icon'] ?? 'fa-bolt') }}"></label>
                <label style="margin-top:8px">Judul Item 1<input name="trust1_title" value="{{ old('trust1_title', $settings['trust1_title'] ?? 'Same-Day Repair') }}"></label>
                <label style="margin-top:8px">Sub-judul Item 1<input name="trust1_subtitle" value="{{ old('trust1_subtitle', $settings['trust1_subtitle'] ?? 'Most repairs in 30-60 mins') }}"></label>
            </div>

            <!-- Item 2 -->
            <div>
                <label>Ikon Item 2 (FontAwesome)<input name="trust2_icon" value="{{ old('trust2_icon', $settings['trust2_icon'] ?? 'fa-shield-halved') }}"></label>
                <label style="margin-top:8px">Judul Item 2<input name="trust2_title" value="{{ old('trust2_title', $settings['trust2_title'] ?? '30 to 60-Day Warranty') }}"></label>
                <label style="margin-top:8px">Sub-judul Item 2<input name="trust2_subtitle" value="{{ old('trust2_subtitle', $settings['trust2_subtitle'] ?? 'Full coverage on parts & labor') }}"></label>
            </div>

            <!-- Item 3 -->
            <div>
                <label>Ikon Item 3 (FontAwesome)<input name="trust3_icon" value="{{ old('trust3_icon', $settings['trust3_icon'] ?? 'fa-motorcycle') }}"></label>
                <label style="margin-top:8px">Judul Item 3<input name="trust3_title" value="{{ old('trust3_title', $settings['trust3_title'] ?? 'We Come to You') }}"></label>
                <label style="margin-top:8px">Sub-judul Item 3<input name="trust3_subtitle" value="{{ old('trust3_subtitle', $settings['trust3_subtitle'] ?? 'Villa, hotel, or cafe anywhere in Bali') }}"></label>
            </div>

            <!-- Item 4 -->
            <div>
                <label>Ikon Item 4 (FontAwesome)<input name="trust4_icon" value="{{ old('trust4_icon', $settings['trust4_icon'] ?? 'fa-screwdriver-wrench') }}"></label>
                <label style="margin-top:8px">Judul Item 4<input name="trust4_title" value="{{ old('trust4_title', $settings['trust4_title'] ?? 'Quality Parts') }}"></label>
                <label style="margin-top:8px">Sub-judul Item 4<input name="trust4_subtitle" value="{{ old('trust4_subtitle', $settings['trust4_subtitle'] ?? 'OEM & premium grade components') }}"></label>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 3: SERVICES SECTION -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-3">
        <span class="layer-tag">Layer 3</span>
        <h2>Seksi Layanan Perbaikan (Services)</h2>
        <p class="help">Kelola judul, subjudul, dan informasi pengantar untuk seksi kartu layanan servis.</p>

        <div class="form-grid">
            <label>
                Label Eyebrow Seksi
                <input name="services_eyebrow" value="{{ old('services_eyebrow', $settings['services_eyebrow'] ?? 'What We Fix') }}">
            </label>
            <label>
                Judul Utama Seksi Layanan
                <input name="services_title" value="{{ old('services_title', $settings['services_title'] ?? 'Our Repair Services') }}">
            </label>
            <label class="full">
                Sub-judul / Deskripsi Seksi Layanan
                <textarea name="services_subtitle">{{ old('services_subtitle', $settings['services_subtitle'] ?? 'Professional phone and laptop repairs at your location. All prices include parts, labor, and travel.') }}</textarea>
            </label>
        </div>
        <p class="help" style="margin-top:14px">
            💡 Untuk menambah, mengedit rincian teknis, atau mengubah artikel per layanan, Anda juga dapat membuka menu <a href="{{ route('admin.services.index') }}" style="color:#4ade80;text-decoration:underline">Services / Layanan</a> di sidebar.
        </p>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 4: HOW IT WORKS -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-4">
        <span class="layer-tag">Layer 4</span>
        <h2>Cara Kerja Servis (How We Work / 3-Step)</h2>
        <p class="help">Penjelasan 3 langkah mudah bagaimana teknisi datang ke villa/hotel pelanggan.</p>

        <div class="form-grid">
            <label>Label Eyebrow<input name="how_eyebrow" value="{{ old('how_eyebrow', $settings['how_eyebrow'] ?? 'Easy 3-Step Process') }}"></label>
            <label>Judul Seksi<input name="how_title" value="{{ old('how_title', $settings['how_title'] ?? 'How On-Site Repair Works in Bali') }}"></label>
            <label class="full">Sub-judul Seksi<textarea name="how_subtitle">{{ old('how_subtitle', $settings['how_subtitle'] ?? 'No need to drive in traffic or leave your villa. We make device repair completely hassle-free.') }}</textarea></label>
        </div>

        <div class="form-grid" style="margin-top:16px">
            <!-- Step 1 -->
            <div>
                <label>Langkah 1 - Ikon (FontAwesome)<input name="step1_icon" value="{{ old('step1_icon', $settings['step1_icon'] ?? 'fa-comments') }}"></label>
                <label style="margin-top:8px">Langkah 1 - Judul<input name="step1_title" value="{{ old('step1_title', $settings['step1_title'] ?? 'Contact on WhatsApp') }}"></label>
                <label style="margin-top:8px">Langkah 1 - Deskripsi<textarea name="step1_desc">{{ old('step1_desc', $settings['step1_desc'] ?? 'Message us with your device model, issue, and location in Bali. We give an instant fixed price quote.') }}</textarea></label>
            </div>

            <!-- Step 2 -->
            <div>
                <label>Langkah 2 - Ikon (FontAwesome)<input name="step2_icon" value="{{ old('step2_icon', $settings['step2_icon'] ?? 'fa-motorcycle') }}"></label>
                <label style="margin-top:8px">Langkah 2 - Judul<input name="step2_title" value="{{ old('step2_title', $settings['step2_title'] ?? 'Technician Comes to You') }}"></label>
                <label style="margin-top:8px">Langkah 2 - Deskripsi<textarea name="step2_desc">{{ old('step2_desc', $settings['step2_desc'] ?? 'Our certified mobile technician arrives at your villa, hotel, or cafe with all tools and replacement parts.') }}</textarea></label>
            </div>

            <!-- Step 3 -->
            <div class="full">
                <label>Langkah 3 - Ikon (FontAwesome)<input name="step3_icon" value="{{ old('step3_icon', $settings['step3_icon'] ?? 'fa-circle-check') }}"></label>
                <label style="margin-top:8px">Langkah 3 - Judul<input name="step3_title" value="{{ old('step3_title', $settings['step3_title'] ?? 'Fixed & Tested On-Site') }}"></label>
                <label style="margin-top:8px">Langkah 3 - Deskripsi<textarea name="step3_desc">{{ old('step3_desc', $settings['step3_desc'] ?? 'We fix your device right in front of you in 30-60 minutes. Test everything thoroughly before paying.') }}</textarea></label>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 5: CUSTOMER REVIEWS -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-5">
        <span class="layer-tag">Layer 5</span>
        <h2>Ulasan Pelanggan (Customer Reviews)</h2>
        <p class="help">Header seksi ulasan dan testimoni pelanggan di Bali.</p>

        <div class="form-grid">
            <label>Label Eyebrow<input name="reviews_eyebrow" value="{{ old('reviews_eyebrow', $settings['reviews_eyebrow'] ?? 'Customer Reviews') }}"></label>
            <label>Judul Seksi<input name="reviews_title" value="{{ old('reviews_title', $settings['reviews_title'] ?? 'Loved by Tourists & Expats in Bali') }}"></label>
            <label class="full">Sub-judul Seksi<textarea name="reviews_subtitle">{{ old('reviews_subtitle', $settings['reviews_subtitle'] ?? 'Read real experiences from travelers, digital nomads, and locals across Bali.') }}</textarea></label>
        </div>
        <p class="help" style="margin-top:14px">
            💡 Untuk menambah testimoni spesifik baru atau mengedit nama reviewer, Anda juga dapat membuka menu <a href="{{ route('admin.content.index', 'testimonials') }}" style="color:#4ade80;text-decoration:underline">Testimonials / Testimoni</a> di sidebar.
        </p>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 6: PRICING TABLE -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-6">
        <span class="layer-tag">Layer 6</span>
        <h2>Ringkasan Harga Transparan (Pricing Table)</h2>
        <p class="help">Tabel daftar harga cepat 6 perbaikan populer di homepage.</p>

        <div class="form-grid">
            <label>Label Eyebrow<input name="pricing_eyebrow" value="{{ old('pricing_eyebrow', $settings['pricing_eyebrow'] ?? 'Transparent Pricing') }}"></label>
            <label>Judul Seksi<input name="pricing_title" value="{{ old('pricing_title', $settings['pricing_title'] ?? 'Simple, Honest Upfront Rates') }}"></label>
            <label class="full">Sub-judul Seksi<textarea name="pricing_subtitle">{{ old('pricing_subtitle', $settings['pricing_subtitle'] ?? 'No hidden call-out fees. The price we quote is the price you pay.') }}</textarea></label>
        </div>

        <h3 style="margin:20px 0 12px;font-size:15px;color:#f8d477">Baris Layanan &amp; Tarif Cepat</h3>
        <div class="form-grid">
            <!-- Row 1 -->
            <div>
                <label>Baris 1 - Layanan<input name="pricing_row1_title" value="{{ old('pricing_row1_title', $settings['pricing_row1_title'] ?? 'iPhone Screen Replacement') }}"></label>
                <label style="margin-top:6px">Baris 1 - Durasi<input name="pricing_row1_duration" value="{{ old('pricing_row1_duration', $settings['pricing_row1_duration'] ?? '30-45 mins on-site') }}"></label>
                <label style="margin-top:6px">Baris 1 - Harga<input name="pricing_row1_price" value="{{ old('pricing_row1_price', $settings['pricing_row1_price'] ?? 'From Rp 500.000') }}"></label>
            </div>

            <!-- Row 2 -->
            <div>
                <label>Baris 2 - Layanan<input name="pricing_row2_title" value="{{ old('pricing_row2_title', $settings['pricing_row2_title'] ?? 'iPhone Battery Replacement') }}"></label>
                <label style="margin-top:6px">Baris 2 - Durasi<input name="pricing_row2_duration" value="{{ old('pricing_row2_duration', $settings['pricing_row2_duration'] ?? '25-30 mins on-site') }}"></label>
                <label style="margin-top:6px">Baris 2 - Harga<input name="pricing_row2_price" value="{{ old('pricing_row2_price', $settings['pricing_row2_price'] ?? 'From Rp 400.000') }}"></label>
            </div>

            <!-- Row 3 -->
            <div>
                <label>Baris 3 - Layanan<input name="pricing_row3_title" value="{{ old('pricing_row3_title', $settings['pricing_row3_title'] ?? 'MacBook Screen & Battery') }}"></label>
                <label style="margin-top:6px">Baris 3 - Durasi<input name="pricing_row3_duration" value="{{ old('pricing_row3_duration', $settings['pricing_row3_duration'] ?? '45-60 mins on-site') }}"></label>
                <label style="margin-top:6px">Baris 3 - Harga<input name="pricing_row3_price" value="{{ old('pricing_row3_price', $settings['pricing_row3_price'] ?? 'From Rp 950.000') }}"></label>
            </div>

            <!-- Row 4 -->
            <div>
                <label>Baris 4 - Layanan<input name="pricing_row4_title" value="{{ old('pricing_row4_title', $settings['pricing_row4_title'] ?? 'Water Damage Treatment') }}"></label>
                <label style="margin-top:6px">Baris 4 - Durasi<input name="pricing_row4_duration" value="{{ old('pricing_row4_duration', $settings['pricing_row4_duration'] ?? 'Diagnostic + ultrasonic cleaning') }}"></label>
                <label style="margin-top:6px">Baris 4 - Harga<input name="pricing_row4_price" value="{{ old('pricing_row4_price', $settings['pricing_row4_price'] ?? 'From Rp 500.000') }}"></label>
            </div>

            <!-- Row 5 -->
            <div>
                <label>Baris 5 - Layanan<input name="pricing_row5_title" value="{{ old('pricing_row5_title', $settings['pricing_row5_title'] ?? 'Charging Port & Speaker Fix') }}"></label>
                <label style="margin-top:6px">Baris 5 - Durasi<input name="pricing_row5_duration" value="{{ old('pricing_row5_duration', $settings['pricing_row5_duration'] ?? '30-45 mins on-site') }}"></label>
                <label style="margin-top:6px">Baris 5 - Harga<input name="pricing_row5_price" value="{{ old('pricing_row5_price', $settings['pricing_row5_price'] ?? 'From Rp 300.000') }}"></label>
            </div>

            <!-- Row 6 -->
            <div>
                <label>Baris 6 - Layanan<input name="pricing_row6_title" value="{{ old('pricing_row6_title', $settings['pricing_row6_title'] ?? 'MacBook Rental (Daily / Weekly)') }}"></label>
                <label style="margin-top:6px">Baris 6 - Durasi<input name="pricing_row6_duration" value="{{ old('pricing_row6_duration', $settings['pricing_row6_duration'] ?? 'Delivered to your villa') }}"></label>
                <label style="margin-top:6px">Baris 6 - Harga<input name="pricing_row6_price" value="{{ old('pricing_row6_price', $settings['pricing_row6_price'] ?? 'From Rp 150.000/day') }}"></label>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 7: EXTRA SERVICES (BUY & SELL / RENTAL / HOME CARE) -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-7">
        <span class="layer-tag">Layer 7</span>
        <h2>Layanan Ekstra (Jual-Beli, Rental MacBook, Home Care)</h2>
        <p class="help">3 kartu layanan tambahan dengan foto, badge, dan tombol aksi.</p>

        <div class="form-grid">
            <label>Label Eyebrow<input name="extra_eyebrow" value="{{ old('extra_eyebrow', $settings['extra_eyebrow'] ?? 'More Than Just Repairs') }}"></label>
            <label>Judul Seksi<input name="extra_title" value="{{ old('extra_title', $settings['extra_title'] ?? 'Device Sales, MacBook Rental & Care') }}"></label>
            <label class="full">Sub-judul Seksi<textarea name="extra_subtitle">{{ old('extra_subtitle', $settings['extra_subtitle'] ?? 'Looking to sell your old phone, rent a MacBook for remote work, or book regular villa visits? We\'ve got you covered.') }}</textarea></label>
        </div>

        <div class="form-grid" style="margin-top:16px">
            <!-- Extra Card 1 -->
            <div>
                <h4 style="color:#854d0e;font-weight:800;margin:0 0 8px">Kartu 1: Jual Beli Device</h4>
                <label>Ganti Foto Kartu 1<input type="file" name="extra_card1_image_file" accept="image/*"></label>
                @php $exCard1Img = $settings['extra_card1_image'] ?? 'assets/bali-phone-repair/iphone-buy-sell-optimized.jpg'; @endphp
                <div class="image-preview-box">
                    <img class="image-preview-thumb" src="{{ asset($exCard1Img) }}" alt="Extra Card 1">
                    <div class="image-preview-info"><span>{{ $exCard1Img }}</span></div>
                </div>
                <label style="margin-top:8px">Badge Tag<input name="extra_card1_badge" value="{{ old('extra_card1_badge', $settings['extra_card1_badge'] ?? 'Buy & Sell') }}"></label>
                <label style="margin-top:8px">Judul<input name="extra_card1_title" value="{{ old('extra_card1_title', $settings['extra_card1_title'] ?? 'iPhone Buy & Sell') }}"></label>
                <label style="margin-top:8px">Deskripsi<textarea name="extra_card1_desc">{{ old('extra_card1_desc', $settings['extra_card1_desc'] ?? 'Upgrade your phone or get instant cash for your used iPhone with fair market evaluations.') }}</textarea></label>
                <label style="margin-top:8px">Teks Tombol WA<input name="extra_card1_btn" value="{{ old('extra_card1_btn', $settings['extra_card1_btn'] ?? 'Check Value') }}"></label>
            </div>

            <!-- Extra Card 2 -->
            <div>
                <h4 style="color:#854d0e;font-weight:800;margin:0 0 8px">Kartu 2: Rental MacBook</h4>
                <label>Ganti Foto Kartu 2<input type="file" name="extra_card2_image_file" accept="image/*"></label>
                @php $exCard2Img = $settings['extra_card2_image'] ?? 'assets/bali-phone-repair/macbook-m1-optimized.jpg'; @endphp
                <div class="image-preview-box">
                    <img class="image-preview-thumb" src="{{ asset($exCard2Img) }}" alt="Extra Card 2">
                    <div class="image-preview-info"><span>{{ $exCard2Img }}</span></div>
                </div>
                <label style="margin-top:8px">Badge Tag<input name="extra_card2_badge" value="{{ old('extra_card2_badge', $settings['extra_card2_badge'] ?? 'Daily / Weekly') }}"></label>
                <label style="margin-top:8px">Judul<input name="extra_card2_title" value="{{ old('extra_card2_title', $settings['extra_card2_title'] ?? 'MacBook Pro M1/M2 Rental') }}"></label>
                <label style="margin-top:8px">Deskripsi<textarea name="extra_card2_desc">{{ old('extra_card2_desc', $settings['extra_card2_desc'] ?? 'Perfect for developers, designers, remote work, and urgent replacement laptops delivered to your villa.') }}</textarea></label>
                <label style="margin-top:8px">Teks Tombol WA<input name="extra_card2_btn" value="{{ old('extra_card2_btn', $settings['extra_card2_btn'] ?? 'Rent MacBook') }}"></label>
            </div>

            <!-- Extra Card 3 -->
            <div class="full">
                <h4 style="color:#854d0e;font-weight:800;margin:0 0 8px">Kartu 3: Home Service &amp; Villa Care</h4>
                <label>Ganti Foto Kartu 3<input type="file" name="extra_card3_image_file" accept="image/*"></label>
                @php $exCard3Img = $settings['extra_card3_image'] ?? 'assets/bali-phone-repair/costumer-documentation-optimized.jpg'; @endphp
                <div class="image-preview-box">
                    <img class="image-preview-thumb" src="{{ asset($exCard3Img) }}" alt="Extra Card 3">
                    <div class="image-preview-info"><span>{{ $exCard3Img }}</span></div>
                </div>
                <label style="margin-top:8px">Badge Tag<input name="extra_card3_badge" value="{{ old('extra_card3_badge', $settings['extra_card3_badge'] ?? 'Island-Wide Service') }}"></label>
                <label style="margin-top:8px">Judul<input name="extra_card3_title" value="{{ old('extra_card3_title', $settings['extra_card3_title'] ?? 'Villa & Hotel Home Care') }}"></label>
                <label style="margin-top:8px">Deskripsi<textarea name="extra_card3_desc">{{ old('extra_card3_desc', $settings['extra_card3_desc'] ?? 'Need regular device maintenance for your villa staff or coworking team? Contact us for corporate care.') }}</textarea></label>
                <label style="margin-top:8px">Teks Tombol WA<input name="extra_card3_btn" value="{{ old('extra_card3_btn', $settings['extra_card3_btn'] ?? 'Book Home Care') }}"></label>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 8: FAQ ACCORDION -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-8">
        <span class="layer-tag">Layer 8</span>
        <h2>Tanya Jawab (FAQ Accordion)</h2>
        <p class="help">Header seksi tanya jawab yang sering ditanyakan pelanggan.</p>

        <div class="form-grid">
            <label>Label Eyebrow<input name="faq_eyebrow" value="{{ old('faq_eyebrow', $settings['faq_eyebrow'] ?? 'Frequently Asked Questions') }}"></label>
            <label>Judul Seksi<input name="faq_title" value="{{ old('faq_title', $settings['faq_title'] ?? 'Everything You Need to Know') }}"></label>
            <label class="full">Sub-judul Seksi<textarea name="faq_subtitle">{{ old('faq_subtitle', $settings['faq_subtitle'] ?? 'Got questions before booking? Here are quick answers to the most common inquiries.') }}</textarea></label>
        </div>
        <p class="help" style="margin-top:14px">
            💡 Untuk mengedit atau menambah butir pertanyaan &amp; jawaban FAQ spesifik, buka menu <a href="{{ route('admin.content.index', 'faqs') }}" style="color:#b45309;font-weight:700;text-decoration:underline">FAQs / Pertanyaan</a> di sidebar.
        </p>
    </section>

    <!-- ================================================================= -->
    <!-- LAYER 9: BOTTOM CTA & CONTACT SETTINGS -->
    <!-- ================================================================= -->
    <section class="form-section layer-group-card" id="layer-9">
        <span class="layer-tag">Layer 9</span>
        <h2>Banner Bawah &amp; Kontak Global</h2>
        <p class="help">Banner penutup di bagian bawah halaman serta informasi kontak global (WhatsApp, Telepon, Alamat, dll).</p>

        <div class="form-grid">
            <label class="full">Judul Banner CTA Bawah<input name="cta_title" value="{{ old('cta_title', $settings['cta_title'] ?? 'Ready to Fix Your Device Today?') }}"></label>
            <label class="full">Deskripsi Banner CTA Bawah<textarea name="cta_description">{{ old('cta_description', $settings['cta_description'] ?? 'Message our team on WhatsApp now. Tell us your issue and villa address, and a technician will be on the way.') }}</textarea></label>
            <label>Teks Tombol Banner CTA Bawah<input name="cta_btn_text" value="{{ old('cta_btn_text', $settings['cta_btn_text'] ?? 'Get Free Quote on WhatsApp') }}"></label>
            <label>Nama Bisnis<input name="business_name" value="{{ old('business_name', $settings['business_name'] ?? 'Bali Phone Repair') }}"></label>
            <label>Nomor WhatsApp (Angka Internasional)<input name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '6281929164999') }}"></label>
            <label>Nomor Telepon Publik<input name="phone" value="{{ old('phone', $settings['phone'] ?? '+6281929164999') }}"></label>
            <label>Email Kontak<input name="email" value="{{ old('email', $settings['email'] ?? 'hello@baliphonerepair.com') }}"></label>
            <label>Jam Buka / Operasional<input name="opening_hours" value="{{ old('opening_hours', $settings['opening_hours'] ?? 'Mo-Sa 09:00-21:00') }}"></label>
            <label class="full">Alamat Lengkap Workshop / Kantor<textarea name="address">{{ old('address', $settings['address'] ?? 'Jl. Pulau Misol No.106, Dauh Puri Kauh, Denpasar, Bali 80113') }}</textarea></label>
            <label class="full">Tautan Google Maps<input name="google_maps" value="{{ old('google_maps', $settings['google_maps'] ?? '') }}"></label>
        </div>

        <h3 style="margin:20px 0 10px;font-size:15px;color:#854d0e;font-weight:800">Media Sosial</h3>
        <div class="form-grid">
            <label>Instagram URL<input name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}"></label>
            <label>Facebook URL<input name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}"></label>
            <label>TikTok URL<input name="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"></label>
        </div>
    </section>

    <!-- Save Action Bar -->
    <div class="form-actions" style="position:sticky;bottom:0;z-index:20;background:rgba(255,255,255,0.94);backdrop-filter:blur(16px);border-top:1px solid var(--admin-line);box-shadow:0 -4px 20px rgba(0,0,0,0.06);display:flex;justify-content:space-between;align-items:center;">
        <span style="color:var(--admin-muted);font-size:13px">Perubahan langsung aktif di website setelah disimpan.</span>
        <button class="btn" type="submit" style="padding:0 28px;height:46px;font-size:15px">💾 Simpan Semua Perubahan</button>
    </div>
</form>

@endsection
