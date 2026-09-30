<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Artisan::command('seo:indexnow', function () {
    $host = 'baliphonerepair.com';
    $key = '4c3b28b78912443a9d94943fcf13db1b';
    $keyLocation = "https://{$host}/{$key}.txt";

    $urls = [
        "https://{$host}/",
        "https://{$host}/llms.txt",
        "https://{$host}/services",
        "https://{$host}/services/iphone-repair-bali",
        "https://{$host}/services/macbook-repair-bali",
        "https://{$host}/services/android-repair-bali",
        "https://{$host}/services/data-recovery-bali",
        "https://{$host}/service-areas",
        "https://{$host}/service-areas/canggu",
        "https://{$host}/service-areas/denpasar",
        "https://{$host}/service-areas/seminyak",
        "https://{$host}/service-areas/ubud",
    ];

    $payload = [
        'host' => $host,
        'key' => $key,
        'urlList' => $urls,
    ];

    $this->info("Submitting IndexNow ping to Bing and api.indexnow.org...");

    $endpoints = [
        'https://api.indexnow.org/indexnow',
        'https://www.bing.com/indexnow',
    ];

    foreach ($endpoints as $endpoint) {
        try {
            $response = Http::timeout(10)->post($endpoint, $payload);
            $status = $response->status();
            $body = $response->body();
            if ($status === 200 || $status === 202) {
                $this->info("SUCCESS: {$endpoint} => HTTP {$status}");
            } else {
                $this->warn("{$endpoint} => HTTP {$status}: {$body}");
            }
        } catch (\Throwable $e) {
            $this->error("{$endpoint} failed: " . $e->getMessage());
        }
    }
})->purpose('Submit all main URLs to IndexNow search engines (Bing, ChatGPT Search, Copilot, Yandex)');
