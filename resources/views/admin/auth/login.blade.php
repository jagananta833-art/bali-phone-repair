<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Login | Bali Phone Repair</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/bali-phone-repair/logo-optimized.jpg') }}">
    <style>
        :root{--bg:#f8fafc;--panel:#ffffff;--line:#e2e8f0;--text:#0f172a;--muted:#64748b;--primary:#D4A346;--primary-dark:#854d0e;--gold-gradient:linear-gradient(135deg,#F5D061 0%,#D4A346 50%,#B8860B 100%);--gold-gradient-hover:linear-gradient(135deg,#FAE292 0%,#E5B24E 50%,#C69214 100%);--field-h:54px}
        *{box-sizing:border-box}html{min-height:100%;-webkit-text-size-adjust:100%}body{min-height:100vh;margin:0;display:grid;place-items:center;padding:28px;font-family:system-ui,-apple-system,"Segoe UI",sans-serif;background:radial-gradient(circle at top left,rgba(212,163,70,.12),transparent 36%),radial-gradient(circle at 80% 10%,rgba(248,212,119,.08),transparent 32%),var(--bg);color:var(--text)}
        a{color:inherit;text-decoration:none}
        .login-shell{width:min(980px,100%);min-height:560px;display:grid;grid-template-columns:.95fr 1.05fr;border:1px solid var(--line);border-radius:24px;overflow:hidden;background:#ffffff;box-shadow:0 24px 60px -10px rgba(15,23,42,.08),0 12px 24px -6px rgba(212,163,70,.08)}
        .brand-panel{position:relative;min-height:560px;padding:38px;background:linear-gradient(135deg,rgba(212,163,70,.25),rgba(184,134,11,.45)),url("{{ asset('assets/bali-phone-repair/service-optimized.jpg') }}") center/cover}
        .brand-panel:before{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(15,23,42,.25),rgba(15,23,42,.82))}
        .brand-content{position:relative;z-index:1;height:100%;display:flex;flex-direction:column;justify-content:space-between;color:#ffffff}
        .brand{display:flex;align-items:center;gap:14px}.brand img{width:58px;height:58px;border-radius:50%;object-fit:cover;box-shadow:0 12px 28px rgba(0,0,0,.34)}.brand strong,.brand small{display:block}.brand strong{font-size:22px;line-height:1;color:#ffffff}.brand small{margin-top:5px;color:rgba(255,255,255,.85);font-weight:800}
        .brand-copy h1{max-width:360px;margin:0 0 16px;font-size:44px;line-height:.98;letter-spacing:0;color:#ffffff}.brand-copy p{max-width:360px;margin:0;color:rgba(255,255,255,.9);line-height:1.7}
        .form-panel{display:flex;flex-direction:column;justify-content:center;padding:44px;background:#ffffff}.form-panel h2{margin:0 0 8px;font-size:34px;line-height:1.1;letter-spacing:0;color:#0f172a;font-weight:800}.form-panel>p{margin:0 0 28px;color:var(--muted)}
        .field{display:block;margin-bottom:16px;color:#1e293b;font-weight:750}.field-text{display:block;margin-bottom:8px}.field input{width:100%;height:var(--field-h);padding:0 16px;border:1px solid #cbd5e1;border-radius:14px;background:#f8fafc;color:var(--text);font:inherit;line-height:var(--field-h);outline:none;transition:all .18s ease}.field input:focus{border-color:var(--primary);background:#ffffff;box-shadow:0 0 0 4px rgba(212,163,70,.2)}
        .password-wrap{position:relative;display:block}.password-wrap input{padding-right:58px}.toggle-password{position:absolute;right:7px;top:50%;display:grid;place-items:center;width:40px;height:40px;margin:0;padding:0;border:1px solid #e2e8f0;border-radius:12px;background:#f1f5f9;color:#64748b;cursor:pointer;transform:translateY(-50%)}.toggle-password svg{width:20px;height:20px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round}.toggle-password .eye-off{display:none}.toggle-password[aria-pressed="true"] .eye{display:none}.toggle-password[aria-pressed="true"] .eye-off{display:block}.toggle-password:hover,.toggle-password:focus-visible{border-color:var(--primary);background:#e2e8f0;color:#0f172a;outline:none}
        .error{margin:0 0 18px;padding:12px 14px;border:1px solid #fecaca;border-radius:14px;background:#fef2f2;color:#991b1b;font-weight:700}.submit{width:100%;height:var(--field-h);margin-top:6px;padding:0 20px;border:0;border-radius:999px;background:var(--gold-gradient);color:#1e1b18;font-weight:800;font-size:16px;cursor:pointer;box-shadow:0 12px 28px rgba(212,163,70,.32);transition:all .18s ease}.submit:hover{background:var(--gold-gradient-hover);transform:translateY(-1px);box-shadow:0 16px 36px rgba(212,163,70,.42)}
        .back{display:inline-flex;width:max-content;margin-top:22px;color:var(--primary-dark);font-weight:800;transition:color .16s ease}.back:hover{color:#b45309;text-decoration:underline}.helper{margin-top:22px;padding-top:20px;border-top:1px solid var(--line);color:#94a3b8;font-size:13px;line-height:1.6}
        @media(max-width:760px){body{display:block;min-height:100svh;padding:18px}.login-shell{min-height:0;grid-template-columns:1fr;border-radius:20px}.brand-panel{min-height:270px;padding:28px}.brand-copy h1{font-size:34px;line-height:1}.form-panel{padding:28px}}
        @media(max-width:420px){body{padding:12px}.brand-panel{min-height:240px;padding:22px}.brand{gap:12px}.brand img{width:50px;height:50px}.brand strong{font-size:19px}.brand small{font-size:12px}.brand-copy h1{font-size:30px}.form-panel{padding:22px}.form-panel h2{font-size:30px}:root{--field-h:52px}}
    </style>
</head>
<body>
<main class="login-shell">
    <section class="brand-panel" aria-label="Bali Phone Repair admin">
        <div class="brand-content">
            <a class="brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/bali-phone-repair/logo-optimized.jpg') }}" alt="Bali Phone Repair logo">
                <span><strong>Bali Phone Repair</strong><small>Repair - Trade - Rental</small></span>
            </a>
            <div class="brand-copy">
                <h1>Admin workspace</h1>
                <p>Manage services, posts, SEO settings, media, FAQs, testimonials, and website information.</p>
            </div>
        </div>
    </section>
    <section class="form-panel">
        <h2>Sign in</h2>
        <p>Use your administrator account to continue.</p>
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="post" action="{{ route('admin.login.submit') }}">
            @csrf
            <label class="field">
                <span class="field-text">Email</span>
                <input name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            </label>
            <label class="field">
                <span class="field-text">Password</span>
                <span class="password-wrap">
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                    <button class="toggle-password" type="button" aria-label="Show password" aria-pressed="false">
                        <svg class="eye" viewBox="0 0 24 24" aria-hidden="true"><path d="M2.1 12s3.7-6 9.9-6 9.9 6 9.9 6-3.7 6-9.9 6-9.9-6-9.9-6Z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="eye-off" viewBox="0 0 24 24" aria-hidden="true"><path d="m3 3 18 18"/><path d="M10.6 10.6A3 3 0 0 0 12 15a3 3 0 0 0 2.4-4.8"/><path d="M9.9 5.2A10.7 10.7 0 0 1 12 5c6.2 0 9.9 7 9.9 7a17.7 17.7 0 0 1-3.2 4.1"/><path d="M6.1 6.8A17.8 17.8 0 0 0 2.1 12s3.7 7 9.9 7c1.3 0 2.5-.3 3.6-.8"/></svg>
                    </button>
                </span>
            </label>
            <button class="submit" type="submit">Login</button>
        </form>
        <a class="back" href="{{ route('home') }}">Back to website</a>
        <p class="helper">Admin pages are marked noindex and protected by authentication.</p>
    </section>
</main>
<script>
    const toggle = document.querySelector('.toggle-password');
    const password = document.querySelector('#password');
    toggle?.addEventListener('click', () => {
        const visible = password.type === 'text';
        password.type = visible ? 'password' : 'text';
        toggle.setAttribute('aria-pressed', String(!visible));
        toggle.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');
    });
</script>
</body>
</html>
