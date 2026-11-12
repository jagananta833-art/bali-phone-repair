@extends('layouts.public')

@php
    $whatsapp = preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999');
@endphp

@section('title', 'Book Your Repair Now - Get More Benefit at Our Partners | Bali Phone Repair')
@section('description', 'Servis HP, MacBook, dan laptop di Bali Phone Repair dan nikmati berbagai benefit eksklusif di UMKM mitra kami di Bali: Puco Rooftop, Puri Canggu Rooms, dan Warung Dangin.')
@section('canonical', route('partners.index'))

@section('content')
<main>
    <!-- HERO SECTION -->
    <section class="section inner-hero compact">
        <div class="inner-wrap">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Partners</span>
            </div>
            <p class="eyebrow" style="color:#38bdf8;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;">
                <i class="fa-solid fa-handshake" style="margin-right:6px;"></i> Verified Local Partners
            </p>
            <h1 style="font-size:clamp(28px, 4vw, 42px);line-height:1.2;margin:12px 0 16px;font-weight:800;letter-spacing:-0.03em;">
                Book your repair now <br>
                <span style="color:#38bdf8;">Get more benefit at our Partners</span>
            </h1>
            <p class="hero-text" style="max-width:760px;font-size:16px;line-height:1.7;color:#94a3b8;">
                Kami bermitra dengan bisnis dan UMKM lokal terkemuka di Bali untuk memberikan nilai tambah bagi setiap pelanggan Bali Phone Repair. Sambil menunggu servis perangkat Anda selesai, nikmati promo spesial, ruang tunggu eksklusif, hingga voucher menarik di mitra pilihan kami.
            </p>
        </div>
    </section>

    <!-- PARTNERS GRID SECTION -->
    <section class="section" style="padding-top:10px;">
        <div class="inner-wrap">
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:28px;">
                @foreach($partners as $partner)
                    <article style="background:#111827;border:1px solid #1f2937;border-radius:24px;padding:28px;display:flex;flex-direction:column;justify-content:space-between;box-shadow:0 10px 25px -5px rgba(0,0,0,0.3);transition:transform .2s ease, border-color .2s ease;" onmouseover="this.style.borderColor='#38bdf8';this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='#1f2937';this.style.transform='translateY(0)'">
                        <div>
                            <!-- LOGO CONTAINER -->
                            <div style="background:#0b0f19;border:1px solid #1f2937;border-radius:18px;height:200px;display:flex;align-items:center;justify-content:center;padding:16px;margin-bottom:22px;overflow:hidden;position:relative;">
                                <img src="{{ asset($partner['logo']) }}" alt="{{ $partner['name'] }} logo" style="max-height:100%;max-width:100%;object-fit:contain;transition:transform .3s ease;" loading="lazy" decoding="async">
                                <span style="position:absolute;top:12px;right:12px;background:rgba(56,189,248,0.15);color:#38bdf8;border:1px solid rgba(56,189,248,0.3);font-size:11px;font-weight:700;padding:4px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:0.5px;">
                                    {{ $partner['highlight'] }}
                                </span>
                            </div>

                            <!-- HEADER -->
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;flex-wrap:wrap;gap:8px;">
                                <span style="font-size:12px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;">
                                    {{ $partner['category'] }}
                                </span>
                                <span style="font-size:12px;color:#cbd5e1;background:#1e293b;padding:3px 10px;border-radius:999px;">
                                    <i class="fa-solid fa-location-dot" style="margin-right:4px;color:#38bdf8;"></i>{{ $partner['location'] }}
                                </span>
                            </div>

                            <h2 style="font-size:24px;font-weight:700;color:#f8fafc;margin-bottom:12px;letter-spacing:-0.02em;">
                                {{ $partner['name'] }}
                            </h2>

                            <!-- BENEFIT BOX -->
                            <div style="background:linear-gradient(135deg, rgba(56,189,248,0.12), rgba(16,185,129,0.08));border:1px solid rgba(56,189,248,0.25);border-radius:12px;padding:12px 14px;margin-bottom:16px;">
                                <div style="font-size:11px;font-weight:800;color:#38bdf8;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">
                                    <i class="fa-solid fa-gift" style="margin-right:4px;"></i> Customer Benefit:
                                </div>
                                <div style="font-size:14px;font-weight:600;color:#f1f5f9;line-height:1.4;">
                                    {{ $partner['benefit'] }}
                                </div>
                            </div>

                            <p style="font-size:14px;line-height:1.6;color:#94a3b8;margin-bottom:20px;">
                                {{ $partner['description'] }}
                            </p>
                        </div>

                        <!-- CARD FOOTER CTA -->
                        <div style="border-top:1px solid #1f2937;padding-top:16px;display:flex;align-items:center;justify-content:space-between;gap:12px;">
                            <span style="font-size:12px;color:#22c55e;font-weight:600;display:inline-flex;align-items:center;gap:6px;">
                                <i class="fa-solid fa-circle-check"></i> {{ $partner['badge'] }}
                            </span>
                            <a href="https://wa.me/{{ $whatsapp }}?text=Halo%20Bali%20Phone%20Repair%2C%20saya%20tertarik%20dengan%20benefit%20partner%20{{ urlencode($partner['name']) }}" target="_blank" rel="noreferrer" class="btn-secondary" style="font-size:13px;padding:8px 16px;border-radius:999px;">
                                Info Benefit &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS STEP SECTION -->
    <section class="section" style="background:#0d131f;border-top:1px solid #1f2937;border-bottom:1px solid #1f2937;padding:60px 0;">
        <div class="inner-wrap">
            <div style="text-align:center;max-width:680px;margin:0 auto 40px;">
                <p class="eyebrow" style="color:#38bdf8;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;">Simple &amp; Rewarding</p>
                <h2 style="font-size:30px;font-weight:800;color:#f8fafc;letter-spacing:-0.02em;margin-top:6px;">
                    Cara Mudah Klaim Keuntungan di Mitra Kami
                </h2>
                <p style="color:#94a3b8;font-size:15px;margin-top:8px;">
                    Cukup 3 langkah mudah untuk menikmati fasilitas dan penawaran spesial di jaringan mitra BPR.
                </p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:24px;">
                <div style="background:#111827;border:1px solid #1f2937;border-radius:18px;padding:26px;position:relative;">
                    <div style="font-size:32px;font-weight:900;color:rgba(56,189,248,0.25);margin-bottom:10px;">01</div>
                    <h3 style="font-size:18px;font-weight:700;color:#f8fafc;margin-bottom:8px;">Book Your Repair</h3>
                    <p style="font-size:14px;color:#94a3b8;line-height:1.6;">
                        Hubungi tim teknisi Bali Phone Repair via WhatsApp atau kunjungi workshop kami untuk melakukan perbaikan perangkat Anda.
                    </p>
                </div>
                <div style="background:#111827;border:1px solid #1f2937;border-radius:18px;padding:26px;position:relative;">
                    <div style="font-size:32px;font-weight:900;color:rgba(56,189,248,0.25);margin-bottom:10px;">02</div>
                    <h3 style="font-size:18px;font-weight:700;color:#f8fafc;margin-bottom:8px;">Dapatkan Bukti Servis</h3>
                    <p style="font-size:14px;color:#94a3b8;line-height:1.6;">
                        Simpan bukti konfirmasi booking atau invoice pengerjaan servis resmi dari Bali Phone Repair.
                    </p>
                </div>
                <div style="background:#111827;border:1px solid #1f2937;border-radius:18px;padding:26px;position:relative;">
                    <div style="font-size:32px;font-weight:900;color:rgba(56,189,248,0.25);margin-bottom:10px;">03</div>
                    <h3 style="font-size:18px;font-weight:700;color:#f8fafc;margin-bottom:8px;">Klaim Benefit di Mitra</h3>
                    <p style="font-size:14px;color:#94a3b8;line-height:1.6;">
                        Kunjungi lokasi mitra (Puco Rooftop, Puri Canggu Rooms, atau Warung Dangin) dan tunjukkan bukti Anda untuk menikmati benefit langsung.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- JOIN PARTNERSHIP CTA -->
    <section class="section split" style="margin-top:20px;">
        <div class="inner-card">
            <p class="eyebrow" style="color:#38bdf8;">Tertarik Berkolaborasi?</p>
            <h2 style="font-size:26px;font-weight:700;color:#f8fafc;margin-bottom:12px;">Punya Bisnis atau UMKM di Bali?</h2>
            <p style="color:#94a3b8;line-height:1.6;margin-bottom:20px;">
                Mari bergabung bersama jaringan kemitraan Bali Phone Repair. Tingkatkan kunjungan pelanggan ke tempat Anda melalui program kolaborasi komunitas dan cross-benefit gratis.
            </p>
            <a class="btn-secondary" href="https://wa.me/{{ $whatsapp }}?text=Halo%20Admin%20BPR%2C%20saya%20ingin%20mengajukan%20kemitraan%20UMKM%20dengan%20Bali%20Phone%20Repair" target="_blank" rel="noreferrer">
                <i class="fa-brands fa-whatsapp" style="margin-right:6px;"></i> Ajukan Kemitraan UMKM
            </a>
        </div>
        <div class="inner-card">
            <p class="eyebrow" style="color:#22c55e;">Butuh Servis Hari Ini?</p>
            <h2 style="font-size:26px;font-weight:700;color:#f8fafc;margin-bottom:12px;">Konsultasi Gratis dengan Teknisi</h2>
            <p style="color:#94a3b8;line-height:1.6;margin-bottom:20px;">
                Kirim tipe HP, keluhan kerusakan, dan lokasi Anda di Bali. Teknisi kami siap datang langsung ke tempat Anda atau melayani di workshop.
            </p>
            <a class="btn btn-primary" href="https://wa.me/{{ $whatsapp }}?text=Halo%20Bali%20Phone%20Repair%2C%20saya%20ingin%20konsultasi%20servis%20perangkat." target="_blank" rel="noreferrer" data-analytics-event="whatsapp_click" data-analytics-location="partners_footer">
                <i class="fa-brands fa-whatsapp" style="margin-right:6px;"></i> Chat WhatsApp Sekarang
            </a>
        </div>
    </section>
</main>

@push('schema')
<script type="application/ld+json">{!! json_encode([
    '@'.'context' => 'https://schema.org',
    '@'.'type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@'.'type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
        ['@'.'type' => 'ListItem', 'position' => 2, 'name' => 'Partners', 'item' => route('partners.index')],
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
