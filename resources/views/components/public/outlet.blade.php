@props([
    'businessName',
    'address',
    'phone' => null,
    'phoneTel' => null,
    'openingHours' => null,
    'mapUrl' => null,
    'analyticsLocation' => 'outlet',
])

@php
    $address = trim((string) $address);
    $mapUrl = trim((string) $mapUrl);
    $directionsUrl = $mapUrl !== ''
        ? $mapUrl
        : ($address !== '' ? 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($address) : null);
@endphp

<address {{ $attributes->class(['outlet-details']) }}>
    <strong>{{ $businessName }}</strong>
    @if($address !== '')
        <span>{{ $address }}</span>
    @endif
    @if($phoneTel)
        <a href="tel:{{ $phoneTel }}"
           data-analytics-event="phone_call_click"
           data-analytics-location="{{ $analyticsLocation }}">{{ $phone }}</a>
    @endif
    @if($openingHours)
        <span>{{ $openingHours }}</span>
    @endif
    @if($directionsUrl)
        <a href="{{ $directionsUrl }}"
           target="_blank"
           rel="noreferrer"
           data-analytics-event="directions_click"
           data-analytics-location="{{ $analyticsLocation }}"
           data-analytics-outlet-label="{{ $businessName }}">Get directions</a>
    @endif
</address>
