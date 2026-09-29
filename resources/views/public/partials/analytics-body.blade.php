@php
    $googleTagManagerId = strtoupper(trim((string) ($siteSettings['google_tag_manager_id'] ?? '')));
    $hasValidGoogleTagManagerId = preg_match('/\AGTM-[A-Z0-9]{6,14}\z/', $googleTagManagerId) === 1;
@endphp
@if($hasValidGoogleTagManagerId)
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $googleTagManagerId }}"
height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
@endif
