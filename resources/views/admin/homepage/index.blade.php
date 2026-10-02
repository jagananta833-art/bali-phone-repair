@extends('layouts.admin')

@section('page_title', 'Pilih Bagian / Layer Homepage')
@section('page_subtitle', 'Pilih layer website yang ingin Anda perbarui. Teks, foto, dan tombol akan langsung aktif seketika.')

@push('styles')
<style>
    .hub-intro {
        margin-bottom: 24px;
    }
    .shortcuts-bar {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 32px;
    }
    .shortcut-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 16px 18px;
        background: #ffffff;
        border: 1px solid var(--admin-line);
        border-radius: 14px;
        transition: all 0.2s ease;
        box-shadow: var(--admin-shadow);
    }
    .shortcut-card:hover {
        border-color: var(--admin-gold);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(212, 163, 70, 0.15);
    }
    .shortcut-card .tag {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #854d0e;
        letter-spacing: .06em;
        margin-bottom: 6px;
    }
    .shortcut-card h3 {
        margin: 0 0 4px;
        font-size: 16px;
        color: #0f172a;
    }
    .shortcut-card p {
        margin: 0 0 12px;
        font-size: 13px;
        color: var(--admin-muted);
        line-height: 1.4;
    }
    .shortcut-card strong {
        font-size: 13px;
        color: var(--admin-gold-dark);
        font-weight: 800;
    }

    .section-list-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 0 0 18px;
    }
    .section-list-heading h2 {
        margin: 0;
        font-size: 18px;
        color: #0f172a;
    }

    .sections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 18px;
    }
    .section-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 22px;
        background: #ffffff;
        border: 1px solid var(--admin-line);
        border-radius: 16px;
        transition: all 0.22s ease;
        box-shadow: var(--admin-shadow);
        position: relative;
        overflow: hidden;
    }
    .section-card:hover {
        border-color: var(--admin-gold);
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(212, 163, 70, 0.18);
    }
    .section-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }
    .layer-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        background: rgba(245, 208, 97, 0.22);
        color: #854d0e;
        border: 1px solid rgba(212, 163, 70, 0.35);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
    }
    .anchor-badge {
        font-size: 12px;
        color: #64748b;
        font-family: monospace;
        background: #f1f5f9;
        padding: 3px 8px;
        border-radius: 6px;
    }
    .section-card h3 {
        margin: 0 0 8px;
        font-size: 18px;
        color: #0f172a;
        font-weight: 800;
        line-height: 1.3;
    }
    .section-card .desc {
        margin: 0 0 14px;
        font-size: 13.5px;
        color: #475569;
        line-height: 1.5;
    }
    .section-quote {
        margin: 0 0 18px;
        padding: 10px 14px;
        background: #f8fafc;
        border-left: 3px solid var(--admin-gold);
        border-radius: 0 8px 8px 0;
        font-size: 12.5px;
        color: #64748b;
        font-style: italic;
        line-height: 1.4;
    }
    .section-card-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid var(--admin-line);
        margin-top: auto;
    }
    .edit-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 800;
        color: #854d0e;
    }
    .view-link {
        font-size: 12px;
        color: #64748b;
        text-decoration: underline;
    }
    .view-link:hover {
        color: #0f172a;
    }

    @media(max-width: 900px) {
        .shortcuts-bar {
            grid-template-columns: 1fr;
        }
        .sections-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

@if(session('ok'))
    <div class="flash">
        <strong>✓ Berhasil!</strong> {{ session('ok') }}
    </div>
@endif

<div class="hub-intro">
    <div class="section-list-heading">
        <h2>Pintasan Master Koleksi</h2>
        <a class="link-btn" href="{{ route('admin.homepage.edit') }}" style="font-size:13px">Mode Formulir Lengkap (9 Layer) →</a>
    </div>
    <div class="shortcuts-bar">
        <a class="shortcut-card" href="{{ route('admin.services.index') }}">
            <div>
                <span class="tag">Master Data</span>
                <h3>Halaman Layanan</h3>
                <p>Tambah atau edit halaman detail servis iPhone, Android, MacBook, dll.</p>
            </div>
            <strong>Kelola Layanan →</strong>
        </a>
        <a class="shortcut-card" href="{{ route('admin.content.index', 'testimonials') }}">
            <div>
                <span class="tag">Master Data</span>
                <h3>Testimoni Pelanggan</h3>
                <p>Tambah review turis &amp; ekspat yang tampil di carousel testimoni.</p>
            </div>
            <strong>Kelola Testimoni →</strong>
        </a>
        <a class="shortcut-card" href="{{ route('admin.content.index', 'faqs') }}">
            <div>
                <span class="tag">Master Data</span>
                <h3>Daftar FAQ</h3>
                <p>Tambah &amp; edit pertanyaan populer seputar servis HP di Bali.</p>
            </div>
            <strong>Kelola FAQ →</strong>
        </a>
    </div>
</div>

<div class="section-list-heading">
    <h2>Bagian Homepage (Dari Atas ke Bawah)</h2>
    <span class="muted" style="font-size:13px">Klik pada layer yang ingin diubah</span>
</div>

<div class="sections-grid">
    @foreach($sections as $key => $info)
        <article class="section-card">
            <div>
                <div class="section-card-top">
                    <span class="layer-badge">{{ $info['layer_tag'] }}</span>
                    @if($info['anchor'])
                        <span class="anchor-badge">#{{ $info['anchor'] }}</span>
                    @else
                        <span class="anchor-badge">Atas / Hero</span>
                    @endif
                </div>

                <h3>{{ $info['title'] }}</h3>
                <p class="desc">{{ $info['description'] }}</p>

                <blockquote class="section-quote">
                    “{{ $info['example'] }}”
                </blockquote>
            </div>

            <div class="section-card-actions">
                <a class="edit-btn" href="{{ route('admin.homepage.sections.edit', $key) }}">
                    Edit Layer Ini →
                </a>
                <a class="view-link" href="{{ route('home') }}{{ $info['anchor'] ? '#'.$info['anchor'] : '' }}" target="_blank" rel="noreferrer">
                    Lihat di Web ↗
                </a>
            </div>
        </article>
    @endforeach
</div>

@endsection
