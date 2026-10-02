@php
    $assetBase = 'assets/bali-phone-repair/';
    $active = fn (...$patterns) => request()->routeIs(...$patterns) ? 'is-active' : '';
    $navGroups = [
        'Main / Utama' => [
            ['label' => 'Dashboard', 'id_label' => 'Dasbor', 'icon' => 'dashboard', 'url' => route('admin.dashboard'), 'active' => $active('admin.dashboard')],
        ],
        'Website / Situs' => [
            ['label' => 'Homepage Content', 'id_label' => 'Konten Beranda (Per-Layer)', 'icon' => 'home', 'url' => route('admin.homepage.index'), 'active' => $active('admin.homepage.*')],
            ['label' => 'Pages', 'id_label' => 'Halaman', 'icon' => 'pages', 'url' => route('admin.pages.index'), 'active' => $active('admin.pages.*')],
            ['label' => 'Services', 'id_label' => 'Layanan', 'icon' => 'services', 'url' => route('admin.services.index'), 'active' => $active('admin.services.*')],
        ],
        'Blog / Artikel' => [
            ['label' => 'Posts', 'id_label' => 'Artikel', 'icon' => 'posts', 'url' => route('admin.posts.index'), 'active' => $active('admin.posts.*')],
            ['label' => 'Categories', 'id_label' => 'Kategori', 'icon' => 'categories', 'url' => route('admin.content.index', 'categories'), 'active' => request()->routeIs('admin.content.*') && request()->route('resource') === 'categories' ? 'is-active' : ''],
        ],
        'Content / Konten' => [
            ['label' => 'Testimonials', 'id_label' => 'Testimoni', 'icon' => 'testimonials', 'url' => route('admin.content.index', 'testimonials'), 'active' => request()->routeIs('admin.content.*') && request()->route('resource') === 'testimonials' ? 'is-active' : ''],
            ['label' => 'FAQs', 'id_label' => 'Pertanyaan', 'icon' => 'faqs', 'url' => route('admin.content.index', 'faqs'), 'active' => request()->routeIs('admin.content.*') && request()->route('resource') === 'faqs' ? 'is-active' : ''],
            ['label' => 'Locations', 'id_label' => 'Area Layanan', 'icon' => 'areas', 'url' => route('admin.locations.index'), 'active' => $active('admin.locations.*')],
            ['label' => 'Media', 'id_label' => 'Gambar/File', 'icon' => 'media', 'url' => route('admin.media.index'), 'active' => $active('admin.media.*')],
        ],
        'System / Sistem' => [
            ['label' => 'SEO Settings', 'id_label' => 'Pengaturan SEO', 'icon' => 'seo', 'url' => route('admin.settings.edit').'#seo-settings', 'active' => ''],
            ['label' => 'Website Settings', 'id_label' => 'Pengaturan Website', 'icon' => 'settings', 'url' => route('admin.settings.edit').'#website-settings', 'active' => ''],
            ['label' => 'Users', 'id_label' => 'Pengguna', 'icon' => 'users', 'url' => route('admin.users.index'), 'active' => $active('admin.users.*')],
        ],
    ];
    $icons = [
        'dashboard' => '<svg viewBox="0 0 24 24"><path d="M3 13h8V3H3v10Zm10 8h8V3h-8v18ZM3 21h8v-6H3v6Z"/></svg>',
        'home' => '<svg viewBox="0 0 24 24"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>',
        'pages' => '<svg viewBox="0 0 24 24"><path d="M7 3h7l5 5v13H7z"/><path d="M14 3v5h5"/><path d="M10 13h6M10 17h6"/></svg>',
        'services' => '<svg viewBox="0 0 24 24"><path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L4 17v3h3l5.3-5.3a4 4 0 0 0 5.4-5.4l-2.8 2.8-3-3 2.8-2.8Z"/></svg>',
        'posts' => '<svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h8M8 17h5"/></svg>',
        'categories' => '<svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h10M4 18h16"/><path d="M17 10l3 2-3 2"/></svg>',
        'testimonials' => '<svg viewBox="0 0 24 24"><path d="M4 5h16v11H8l-4 4V5Z"/><path d="M8 9h8M8 13h5"/></svg>',
        'faqs' => '<svg viewBox="0 0 24 24"><path d="M12 19h.01"/><path d="M9.2 9a3 3 0 1 1 5.1 2.1c-.9.8-2.3 1.4-2.3 3.4"/><circle cx="12" cy="12" r="9"/></svg>',
        'areas' => '<svg viewBox="0 0 24 24"><path d="M12 21s7-5.3 7-11a7 7 0 1 0-14 0c0 5.7 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>',
        'media' => '<svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><path d="m4 16 5-5 4 4 2-2 5 5"/><circle cx="15.5" cy="9" r="1.5"/></svg>',
        'seo' => '<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6"/><path d="m16 16 4 4"/><path d="M8.5 11h5M11 8.5v5"/></svg>',
        'settings' => '<svg viewBox="0 0 24 24"><path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"/><path d="M19 12a7 7 0 0 0-.1-1l2-1.5-2-3.4-2.4 1a8 8 0 0 0-1.8-1L14.4 3h-4.8l-.3 3.1a8 8 0 0 0-1.8 1l-2.4-1-2 3.4 2 1.5a7 7 0 0 0 0 2l-2 1.5 2 3.4 2.4-1a8 8 0 0 0 1.8 1l.3 3.1h4.8l.3-3.1a8 8 0 0 0 1.8-1l2.4 1 2-3.4-2-1.5c.1-.3.1-.7.1-1Z"/></svg>',
        'users' => '<svg viewBox="0 0 24 24"><path d="M16 20c0-2.2-1.8-4-4-4s-4 1.8-4 4"/><circle cx="12" cy="9" r="4"/><path d="M20 19c0-1.7-1-3.1-2.5-3.7"/><path d="M17 5.5a3 3 0 0 1 0 5"/></svg>',
        'view' => '<svg viewBox="0 0 24 24"><path d="M2.1 12s3.7-6 9.9-6 9.9 6 9.9 6-3.7 6-9.9 6-9.9-6-9.9-6Z"/><circle cx="12" cy="12" r="3"/></svg>',
        'logout' => '<svg viewBox="0 0 24 24"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M14 4h5v16h-5"/></svg>',
        'menu' => '<svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>',
    ];
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('page_title', 'Admin') | Bali Phone Repair</title>
    <link rel="icon" type="image/jpeg" href="{{ asset($assetBase.'logo-optimized.jpg') }}">
    <style>
        :root{--admin-bg:#f8fafc;--admin-sidebar:#ffffff;--admin-panel:#ffffff;--admin-panel-2:#f1f5f9;--admin-line:#e2e8f0;--admin-line-strong:#cbd5e1;--admin-text:#0f172a;--admin-text-secondary:#334155;--admin-muted:#64748b;--admin-gold:#D4A346;--admin-gold-hover:#C69214;--admin-gold-dark:#854d0e;--admin-gold-light:rgba(212,163,70,.12);--admin-gold-border:rgba(212,163,70,.35);--gold-gradient:linear-gradient(135deg,#F5D061 0%,#D4A346 50%,#B8860B 100%);--gold-gradient-hover:linear-gradient(135deg,#FAE292 0%,#E5B24E 50%,#C69214 100%);--admin-red:#ef4444;--admin-radius:16px;--admin-shadow:0 4px 20px -2px rgba(15,23,42,.06),0 2px 6px -1px rgba(15,23,42,.04)}
        *{box-sizing:border-box}body.admin-body{margin:0;min-height:100vh;background:radial-gradient(circle at top left,rgba(212,163,70,.09),transparent 32%),radial-gradient(circle at 80% 10%,rgba(248,212,119,.06),transparent 30%),var(--admin-bg);color:var(--admin-text);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;overflow-x:hidden}a{color:inherit;text-decoration:none}button,input,select,textarea{font:inherit}.admin-shell{min-height:100vh;display:grid;grid-template-columns:292px minmax(0,1fr)}.admin-sidebar{position:sticky;top:0;height:100vh;padding:22px 18px;background:#ffffff;border-right:1px solid var(--admin-line);overflow-y:auto;box-shadow:2px 0 16px rgba(15,23,42,.03)}.admin-brand{display:flex;align-items:center;gap:12px;padding:10px 10px 22px}.admin-brand img{width:44px;height:44px;border-radius:12px;object-fit:cover;box-shadow:0 2px 8px rgba(0,0,0,.08)}.admin-brand strong{display:block;color:#0f172a;font-size:15px;line-height:1.25}.admin-brand span{display:block;color:var(--admin-muted);font-size:12px;margin-top:2px}.admin-brand span span{display:none}.admin-nav-group{margin:18px 0}.admin-nav-title{padding:0 10px 8px;color:#94a3b8;text-transform:uppercase;font-size:11px;font-weight:800;letter-spacing:.08em}.admin-nav-link,.admin-logout{width:100%;display:flex;align-items:center;gap:11px;padding:11px 12px;border:1px solid transparent;border-radius:12px;color:#475569;background:transparent;font-weight:700;cursor:pointer;transition:background .16s ease,border-color .16s ease,color .16s ease,transform .16s ease,box-shadow .16s ease}.admin-nav-link:hover,.admin-logout:hover{background:#f8fafc;border-color:var(--admin-line);color:#0f172a;transform:translateX(3px);box-shadow:0 4px 14px rgba(15,23,42,.04)}.admin-nav-link.is-active{background:linear-gradient(135deg,rgba(245,208,97,.18),rgba(212,163,70,.08));border-color:rgba(212,163,70,.4);color:var(--admin-gold-dark);font-weight:750;transform:translateX(3px);box-shadow:0 6px 18px rgba(212,163,70,.14)}.admin-nav-icon{display:inline-grid;place-items:center;width:31px;height:31px;border-radius:10px;background:#f1f5f9;color:#64748b;font-size:0;flex:0 0 auto;transition:background .16s ease,color .16s ease,transform .16s ease}.admin-nav-link:hover .admin-nav-icon,.admin-logout:hover .admin-nav-icon{transform:scale(1.05);background:rgba(212,163,70,.14);color:#b45309}.admin-nav-link.is-active .admin-nav-icon{background:var(--gold-gradient);color:#ffffff;box-shadow:0 3px 8px rgba(184,134,11,.35)}.admin-nav-icon svg{width:18px;height:18px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round}.admin-nav-text{display:grid;gap:2px;min-width:0}.admin-nav-text strong{font-size:14px;line-height:1.1}.admin-nav-text small{color:var(--admin-muted);font-size:11px;font-weight:700;line-height:1.1}.admin-sidebar-actions{border-top:1px solid var(--admin-line);margin-top:18px;padding-top:18px}.admin-main{min-width:0}.admin-topbar{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:space-between;gap:16px;padding:18px 28px;background:rgba(255,255,255,.9);backdrop-filter:blur(18px);border-bottom:1px solid var(--admin-line)}.admin-topbar h1{margin:0;font-size:24px;color:#0f172a;font-weight:800;letter-spacing:0}.admin-topbar p{margin:4px 0 0;color:var(--admin-muted);font-size:14px}.admin-language-note{display:inline-flex;align-items:center;gap:8px;margin-top:8px;padding:6px 10px;border:1px solid var(--admin-line);border-radius:999px;background:#f8fafc;color:#64748b;font-size:12px;font-weight:750}.admin-menu-toggle{display:none;width:42px;height:42px;border:1px solid var(--admin-line);border-radius:12px;background:#ffffff;color:#0f172a}.admin-menu-toggle svg{width:21px;height:21px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round}.admin-content{width:min(1180px,calc(100% - 48px));margin:0 auto;padding:28px 0 56px}.flash,.error{border-radius:13px;padding:13px 15px;margin-bottom:18px;border:1px solid var(--admin-line)}.flash{background:#fefce8;border-color:#fef08a;color:#854d0e;font-weight:600}.error{background:#fef2f2;border-color:#fecaca;color:#991b1b;font-weight:600}.admin-card,.form-card,.table-card{background:#ffffff;border:1px solid var(--admin-line);border-radius:var(--admin-radius);box-shadow:var(--admin-shadow)}.admin-card{padding:20px}.admin-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}.admin-grid.two{grid-template-columns:repeat(2,minmax(0,1fr))}.metric-card b{display:block;font-size:34px;line-height:1;margin-bottom:10px;color:#0f172a}.metric-card span,.muted{color:var(--admin-muted)}.section-head{display:flex;align-items:flex-start;justify-content:space-between;gap:18px;margin-bottom:18px}.section-head h2,.section-head h1{margin:0;color:#0f172a;letter-spacing:0}.section-head p{margin:6px 0 0;color:var(--admin-muted)}.btn,.btn-secondary,.link-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:42px;border-radius:12px;border:1px solid transparent;padding:0 15px;font-weight:800;cursor:pointer;transition:transform .16s ease,box-shadow .16s ease,background .16s ease,border-color .16s ease}.btn{background:var(--gold-gradient);color:#1e1b18;box-shadow:0 4px 14px rgba(212,163,70,.28)}.btn:hover{background:var(--gold-gradient-hover);transform:translateY(-1px);box-shadow:0 6px 20px rgba(212,163,70,.38)}.btn-secondary{background:#ffffff;border-color:var(--admin-line-strong);color:#334155}.btn-secondary:hover{border-color:var(--admin-gold);background:#f8fafc;color:#854d0e;transform:translateY(-1px);box-shadow:0 4px 12px rgba(212,163,70,.15)}.link-btn{background:transparent;color:#475569}.quick-actions{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}.quick-actions .btn,.quick-actions .btn-secondary{min-height:38px;border-radius:10px;padding:0 12px;font-size:13px}.table-card{overflow:hidden}.table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px}.admin-search{width:280px;max-width:100%;height:42px;border:1px solid var(--admin-line-strong);border-radius:12px;background:#ffffff;color:#0f172a;padding:0 13px}table{width:100%;border-collapse:collapse}th,td{text-align:left;padding:14px 16px;border-bottom:1px solid var(--admin-line);vertical-align:top}th{background:#f8fafc;color:#64748b;font-size:11.5px;text-transform:uppercase;letter-spacing:.06em;font-weight:750}td{color:#1e293b}tbody tr:hover{background:#fbfcfe}.status{display:inline-flex;padding:5px 9px;border-radius:999px;font-size:12px;font-weight:750;border:1px solid var(--admin-line);background:#f1f5f9;color:#475569}.status.published{background:rgba(245,208,97,.2);color:#854d0e;border-color:rgba(212,163,70,.4);font-weight:800}.actions-cell{display:flex;align-items:center;justify-content:flex-end;flex-wrap:nowrap;gap:8px;min-width:max-content}.actions-cell form{display:inline-flex;margin:0;flex:0 0 auto}.actions-cell .btn-secondary,.actions-cell button.btn-secondary{min-width:54px;min-height:34px;height:34px;padding:0 12px;border-radius:9px;font-size:12px;line-height:1;font-weight:820;box-shadow:none;flex:0 0 auto}.actions-cell .btn-secondary:hover,.actions-cell button.btn-secondary:hover{transform:translateY(-1px);box-shadow:0 4px 12px rgba(0,0,0,.08)}.actions-cell .btn-secondary[href*="edit"],.actions-cell a.btn-secondary:first-child{background:rgba(212,163,70,.12);border-color:rgba(212,163,70,.35);color:#854d0e}.actions-cell a[target="_blank"]{background:rgba(59,130,246,.08);border-color:rgba(59,130,246,.25);color:#1d4ed8}.actions-cell button[type="submit"]{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.25);color:#b91c1c}.table-card th:last-child,.table-card td:last-child{width:1%;white-space:nowrap}.form-card{padding:0;overflow:hidden}.form-section{padding:24px;border-bottom:1px solid var(--admin-line)}.form-section:last-child{border-bottom:0}.form-section h2{margin:0 0 6px;font-size:18px;color:#0f172a}.form-section .help{margin:0 0 18px;color:var(--admin-muted);font-size:14px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.form-grid .full{grid-column:1/-1}label{display:grid;gap:7px;color:#1e293b;font-weight:750}label small{color:var(--admin-muted);font-weight:500}input,select,textarea{width:100%;border:1px solid var(--admin-line-strong);border-radius:12px;background:#ffffff;color:#0f172a;padding:12px 13px}input:focus,select:focus,textarea:focus{border-color:var(--admin-gold);box-shadow:0 0 0 3px rgba(212,163,70,.2);outline:none}textarea{min-height:130px;resize:vertical}.content-area{min-height:260px}.check{display:flex;align-items:center;gap:10px}.check input{width:auto}.field-error{color:#dc2626;font-size:13px}.form-actions{display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;padding:20px 24px;background:#f8fafc;border-top:1px solid var(--admin-line)}.empty-state{text-align:center;padding:34px;color:var(--admin-muted)}.media-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px}.media-card img{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:12px;border:1px solid var(--admin-line)}.mobile-overlay{display:none}.admin-table-scroll{overflow-x:auto}.admin-table-scroll table{min-width:720px}.admin-topbar>.btn-secondary{min-height:38px;padding:0 13px;border-radius:10px;font-size:13px}
        @media(max-width:1100px){.admin-grid,.quick-actions{grid-template-columns:repeat(2,minmax(0,1fr))}.media-grid{grid-template-columns:repeat(3,minmax(0,1fr))}}
        @media(max-width:820px){.admin-shell{display:block}.admin-sidebar{position:fixed;z-index:30;inset:0 auto 0 0;width:min(300px,86vw);transform:translateX(-105%);transition:transform .22s ease}.admin-shell.sidebar-open .admin-sidebar{transform:translateX(0)}.admin-shell.sidebar-open .mobile-overlay{display:block;position:fixed;inset:0;z-index:20;background:rgba(0,0,0,.4)}.admin-menu-toggle{display:inline-grid;place-items:center}.admin-topbar{padding:14px 18px}.admin-language-note,.admin-topbar>.btn-secondary{display:none}.admin-content{width:min(100% - 28px,1180px);padding-top:20px}.admin-grid,.admin-grid.two,.quick-actions,.form-grid,.media-grid{grid-template-columns:1fr}.section-head,.table-tools{display:grid}.admin-search{width:100%}.actions-cell{min-width:max-content;flex-wrap:nowrap}.actions-cell .btn-secondary,.actions-cell button.btn-secondary{width:auto}.form-actions{justify-content:stretch}.form-actions .btn,.form-actions .btn-secondary{width:100%}}
    </style>
    @stack('styles')
</head>
<body class="admin-body">
<div class="admin-shell" id="adminShell">
    <div class="mobile-overlay" data-close-menu></div>
    <aside class="admin-sidebar" aria-label="Admin navigation">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset($assetBase.'logo-optimized.jpg') }}" alt="Bali Phone Repair logo">
            <span><strong>Bali Phone Repair Admin</strong></span>
        </a>
        <nav>
            @foreach($navGroups as $group => $items)
                <div class="admin-nav-group">
                    <div class="admin-nav-title">{{ $group }}</div>
                    @foreach($items as $item)
                        <a class="admin-nav-link {{ $item['active'] }}" href="{{ $item['url'] }}">
                            <span class="admin-nav-icon" aria-hidden="true">{!! $icons[$item['icon']] ?? '' !!}</span>
                            <span class="admin-nav-text"><strong>{{ $item['label'] }}</strong><small>{{ $item['id_label'] }}</small></span>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </nav>
        <div class="admin-sidebar-actions">
            <a class="admin-nav-link" href="{{ route('home') }}" target="_blank" rel="noreferrer">
                <span class="admin-nav-icon" aria-hidden="true">{!! $icons['view'] !!}</span><span class="admin-nav-text"><strong>View Website</strong><small>Lihat Website</small></span>
            </a>
            <form method="post" action="{{ route('admin.logout') }}">
                @csrf
                <button class="admin-logout" type="submit"><span class="admin-nav-icon" aria-hidden="true">{!! $icons['logout'] !!}</span><span class="admin-nav-text"><strong>Logout</strong><small>Keluar</small></span></button>
            </form>
        </div>
    </aside>
    <main class="admin-main">
        <header class="admin-topbar">
            <button class="admin-menu-toggle" type="button" data-toggle-menu aria-label="Open admin menu">{!! $icons['menu'] !!}</button>
            <div>
                <h1>@yield('page_title', 'Dashboard')</h1>
                <p>@yield('page_subtitle', 'Manage Bali Phone Repair content and SEO safely.')</p>
                <span class="admin-language-note">English / Indonesia labels for easier content updates</span>
            </div>
            <a class="btn-secondary" href="{{ route('home') }}" target="_blank" rel="noreferrer">View Website / Lihat Website</a>
        </header>
        <section class="admin-content">
            @if(session('ok'))<div class="flash">{{ session('ok') }}</div>@endif
            @if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
            @yield('content')
        </section>
    </main>
</div>
<script>
    const shell = document.getElementById('adminShell');
    document.querySelectorAll('[data-toggle-menu]').forEach((button) => button.addEventListener('click', () => shell.classList.toggle('sidebar-open')));
    document.querySelectorAll('[data-close-menu], .admin-nav-link').forEach((item) => item.addEventListener('click', () => shell.classList.remove('sidebar-open')));
    document.querySelectorAll('[data-admin-search]').forEach((input) => {
        const target = document.querySelector(input.dataset.adminSearch);
        if (!target) return;
        input.addEventListener('input', () => {
            const term = input.value.trim().toLowerCase();
            target.querySelectorAll('[data-search-row]').forEach((row) => row.hidden = !row.textContent.toLowerCase().includes(term));
        });
    });
</script>
</body>
</html>
