@extends('layouts.public')
@php use App\Support\HtmlSanitizer; @endphp
@section('title', $page->meta_title ?: $page->title.' | Bali Phone Repair')
@section('description', $page->meta_description ?: $page->excerpt)
@section('canonical', route('pages.show', $page))
@section('analytics_content_id', $page->id)
@section('analytics_content_slug', $page->slug)
@section('content')
<main>
    <section class="section inner-hero">
        <div class="inner-wrap">
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>{{ $page->title }}</span></div>
            <p class="eyebrow">{{ $page->focus_keyword ?: 'Bali Phone Repair' }}</p>
            <h1>{{ $page->title }}</h1>
            @if($page->excerpt)<p class="hero-text">{{ $page->excerpt }}</p>@endif
        </div>
    </section>
    <section class="section">
        <div class="inner-wrap inner-grid">
            <article class="inner-card content-body">
                {!! HtmlSanitizer::clean($page->content) !!}
                @if($page->slug === 'contact')
                    <div class="link-list">
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp'] ?? '6281929164999') }}" target="_blank" rel="noreferrer" data-analytics-event="whatsapp_click" data-analytics-location="contact_details"><span>WhatsApp</span><span>Chat now</span></a>
                        @php
                            $contactPhone = trim((string) ($siteSettings['phone'] ?? '+6281929164999'));
                            $contactPhoneTel = preg_match('/^\+\d[\d\s().-]{5,}$/', $contactPhone)
                                ? '+'.preg_replace('/\D+/', '', $contactPhone)
                                : null;
                        @endphp
                        @if($contactPhoneTel)
                            <a href="tel:{{ $contactPhoneTel }}" data-analytics-event="phone_call_click" data-analytics-location="contact_details"><span>Telephone</span><span>{{ $contactPhone }}</span></a>
                        @endif
                        <a href="mailto:{{ $siteSettings['email'] ?? 'hello@baliphonerepair.com' }}"><span>Email</span><span>{{ $siteSettings['email'] ?? 'hello@baliphonerepair.com' }}</span></a>
                    </div>
                    <x-public.outlet
                        class="inner-card"
                        :business-name="$siteSettings['business_name'] ?? 'Bali Phone Repair'"
                        :address="$siteSettings['address'] ?? ''"
                        :phone="$contactPhone"
                        :phone-tel="$contactPhoneTel"
                        :opening-hours="$siteSettings['opening_hours'] ?? null"
                        :map-url="$siteSettings['google_maps'] ?? null"
                        analytics-location="contact_outlet" />
                @endif
            </article>
            <aside class="inner-card side-cta">
                <p class="eyebrow">Popular services</p>
                <h2>Device support</h2>
                <div class="link-list">
                    @foreach($services as $service)
                        <a href="{{ route('services.show', $service) }}"><span>{{ $service->name }}</span><span>→</span></a>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>
</main>
@push('schema')
<script type="application/ld+json">{!! json_encode(['@'.'context'=>'https://schema.org','@'.'type'=>'BreadcrumbList','itemListElement'=>[['@'.'type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],['@'.'type'=>'ListItem','position'=>2,'name'=>$page->title,'item'=>route('pages.show',$page)]]], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endsection
