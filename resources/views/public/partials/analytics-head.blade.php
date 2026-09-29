@php
    $googleTagManagerId = strtoupper(trim((string) ($siteSettings['google_tag_manager_id'] ?? '')));
    $hasValidGoogleTagManagerId = preg_match('/\AGTM-[A-Z0-9]{6,14}\z/', $googleTagManagerId) === 1;
    $googleSearchConsoleVerification = trim((string) ($siteSettings['google_search_console'] ?? ''));
@endphp
@if($googleSearchConsoleVerification !== '')
<meta name="google-site-verification" content="{{ $googleSearchConsoleVerification }}">
@endif
@if($hasValidGoogleTagManagerId)
<script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer',@json($googleTagManagerId));
</script>
@endif
