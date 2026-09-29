<footer class="footer">
    <div class="footer-main">
        <div class="footer-brand">
            <a class="footer-logo" href="{{ route('home') }}" aria-label="Bali Phone Repair">
                <img src="{{ asset($assetBase.'logo-optimized.jpg') }}" alt="Bali Phone Repair logo" width="64" height="64">
                <strong>{{ $businessName }}</strong>
            </a>
            <p>{{ $siteSettings['company_description'] ?? 'Fast device repair, home service, buy and sell, and MacBook rental across Bali.' }}</p>
            <div class="footer-actions">
                <a class="footer-btn primary" href="https://wa.me/{{ $whatsapp }}?text=Hi%20Bali%20Phone%20Repair%2C%20I%20would%20like%20to%20talk%20to%20a%20technician." target="_blank" rel="noreferrer" data-analytics-event="whatsapp_click" data-analytics-location="footer"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i><span>Ask Technician</span></a>
                @if($phoneTel ?? null)
                    <a class="footer-btn" href="tel:{{ $phoneTel }}" data-analytics-event="phone_call_click" data-analytics-location="footer"><i class="fa-solid fa-phone" aria-hidden="true"></i><span>{{ $phone }}</span></a>
                @endif
            </div>
        </div>
        <nav class="footer-links" aria-label="Footer navigation">
            <div>
                <h3>Repair Services</h3>
                <a href="{{ route('services.show', 'iphone-repair-bali') }}">Screen repair</a>
                <a href="{{ route('services.show', 'iphone-repair-bali') }}">Battery replacement</a>
                <a href="{{ route('services.show', 'android-repair-bali') }}">Charging problem</a>
                <a href="{{ route('services.show', 'data-recovery-bali') }}">Water damage</a>
                <a href="{{ route('services.show', 'data-recovery-bali') }}">Software & data</a>
                <a class="footer-emphasis" href="{{ route('services.index') }}">View all services</a>
            </div>
            <div>
                <h3>Device Needs</h3>
                <a href="{{ route('services.show', 'iphone-repair-bali') }}">iPhone</a>
                <a href="{{ route('services.show', 'android-repair-bali') }}">Android</a>
                <a href="{{ route('services.show', 'macbook-repair-bali') }}">MacBook</a>
                <a href="{{ route('services.show', 'laptop-repair-bali') }}">Laptop</a>
                <a href="{{ route('home') }}#jual-beli">Buy & Sell</a>
                <a class="footer-emphasis" href="{{ route('home') }}#rental">MacBook rental</a>
            </div>
            <div>
                <h3>About Us</h3>
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('blog') }}">Blog</a>
                <a href="{{ route('areas.index') }}">Service Areas</a>
                <a href="{{ route('areas.index') }}">Home Care</a>
                <a href="{{ route('home') }}#harga">Pricing</a>
                <a href="{{ route('home') }}#faq">FAQ</a>
                <a href="{{ route('contact') }}">Contact us</a>
                <a href="{{ route('areas.index') }}">Bali coverage</a>
            </div>
            <div class="footer-map">
                <h3>Contact and location</h3>
                <x-public.outlet
                    :business-name="$businessName"
                    :address="$siteSettings['address'] ?? ''"
                    :phone="$phone"
                    :phone-tel="$phoneTel"
                    :opening-hours="$siteSettings['opening_hours'] ?? null"
                    :map-url="$siteSettings['google_maps'] ?? null"
                    analytics-location="footer_outlet" />
            </div>
        </nav>
    </div>
    <div class="footer-bottom">
        <small>Copyright &copy; {{ date('Y') }} Bali Phone Repair. All rights reserved.</small>
        <div class="footer-social" aria-label="Social links">
            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noreferrer" aria-label="WhatsApp" data-analytics-event="whatsapp_click" data-analytics-location="footer_social"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
            <a href="mailto:{{ $email }}" aria-label="Email"><i class="fa-solid fa-envelope" aria-hidden="true"></i></a>
        </div>
    </div>
</footer>
