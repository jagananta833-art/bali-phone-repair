@extends('layouts.admin')

@section('page_title', 'Website and SEO Settings')
@section('page_subtitle', 'Manage global business details, homepage text, tracking, and default metadata.')

@section('content')
<form method="post" action="{{ route('admin.settings.update') }}" class="form-card">
    @csrf @method('put')

    <section class="form-section" id="website-settings">
        <h2>Website Settings</h2>
        <p class="help">Global identity used across the public website and schema.</p>
        <div class="form-grid">
            <label>Business Name<input name="business_name" value="{{ old('business_name', $settings['business_name'] ?? '') }}"></label>
            <label>Email<input name="email" value="{{ old('email', $settings['email'] ?? '') }}"></label>
            <label class="full">Company Description<textarea name="company_description">{{ old('company_description', $settings['company_description'] ?? '') }}</textarea></label>
        </div>
    </section>

    <section class="form-section" id="contact-information">
        <h2>Contact Information</h2>
        <p class="help">Phone, WhatsApp, address, and hours appear in CTAs, footer, contact pages, and LocalBusiness schema.</p>
        <div class="form-grid">
            <label>Phone<input name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}"></label>
            <label>WhatsApp International Digits<input name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"></label>
            <label class="full">Address<textarea name="address">{{ old('address', $settings['address'] ?? '') }}</textarea></label>
            <label class="full">Opening Hours<input name="opening_hours" value="{{ old('opening_hours', $settings['opening_hours'] ?? '') }}"></label>
            <label class="full">Google Maps URL<input name="google_maps" value="{{ old('google_maps', $settings['google_maps'] ?? '') }}"></label>
        </div>
    </section>

    <section class="form-section" id="homepage-content">
        <h2>Homepage Content</h2>
        <p class="help">These defaults feed approved homepage content without changing its visual design.</p>
        <div class="form-grid">
            <label>Hero Title<input name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}"></label>
            <label class="full">Hero Subtitle<textarea name="hero_subtitle">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea></label>
        </div>
    </section>

    <section class="form-section" id="seo-settings">
        <h2>SEO Settings</h2>
        <p class="help">Default metadata is used only when a specific page does not provide its own title or description.</p>
        <div class="form-grid">
            <label>Default Meta Title<input name="default_meta_title" value="{{ old('default_meta_title', $settings['default_meta_title'] ?? '') }}"></label>
            <label class="full">Default Meta Description<textarea name="default_meta_description">{{ old('default_meta_description', $settings['default_meta_description'] ?? '') }}</textarea></label>
            <label>Google Search Console Verification<input name="google_search_console" value="{{ old('google_search_console', $settings['google_search_console'] ?? '') }}"></label>
            <label>Google Tag Manager Container ID<input name="google_tag_manager_id" placeholder="GTM-XXXXXXX" value="{{ old('google_tag_manager_id', $settings['google_tag_manager_id'] ?? '') }}"></label>
            <input type="hidden" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}">
            <p class="help full">GTM is the only tag injected by the website. Configure GA4 inside GTM; the legacy Analytics value is retained but is never rendered directly.</p>
        </div>
    </section>

    <section class="form-section">
        <h2>Social Links</h2>
        <p class="help">Optional public social links for footer or contact modules.</p>
        <div class="form-grid">
            <label>Instagram<input name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}"></label>
            <label>Facebook<input name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}"></label>
            <label>TikTok<input name="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"></label>
        </div>
    </section>

    <div class="form-actions">
        <button class="btn" type="submit">Save Settings</button>
    </div>
</form>
@endsection
