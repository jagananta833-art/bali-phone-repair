<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    private const KEY = '4c3b28b78912443a9d94943fcf13db1b';
    private const HOST = 'baliphonerepair.com';

    /**
     * Mengirim daftar URL ke IndexNow (Bing & ChatGPT Search crawler).
     */
    public static function ping(array|string $urls): bool
    {
        $urlList = is_array($urls) ? array_values(array_filter($urls)) : [trim($urls)];
        if (empty($urlList)) {
            return false;
        }

        // Pastikan URL berformat absolut dengan domain baliphonerepair.com
        $normalizedUrls = array_map(function ($u) {
            if (!str_starts_with($u, 'http')) {
                return 'https://' . self::HOST . '/' . ltrim($u, '/');
            }
            return $u;
        }, $urlList);

        $payload = [
            'host' => self::HOST,
            'key' => self::KEY,
            'keyLocation' => 'https://' . self::HOST . '/' . self::KEY . '.txt',
            'urlList' => array_values(array_unique($normalizedUrls)),
        ];

        try {
            // 1. Universal IndexNow Gateway (Bing, Yandex, Seznam, Naver)
            $response = Http::timeout(6)
                ->withHeaders(['Content-Type' => 'application/json; charset=utf-8'])
                ->post('https://api.indexnow.org/indexnow', $payload);

            if ($response->successful()) {
                Log::info('[INDEXNOW] Berhasil submit ' . count($payload['urlList']) . ' URL ke IndexNow Gateway.');
                return true;
            }

            // 2. Fallback langsung ke Bing endpoint
            $bingResponse = Http::timeout(6)
                ->withHeaders(['Content-Type' => 'application/json; charset=utf-8'])
                ->post('https://www.bing.com/indexnow', $payload);

            if ($bingResponse->successful()) {
                Log::info('[INDEXNOW] Berhasil submit ' . count($payload['urlList']) . ' URL ke Bing Direct.');
                return true;
            }

            Log::warning('[INDEXNOW] Response status tidak sukses: ' . $response->status());
            return false;
        } catch (\Throwable $e) {
            Log::warning('[INDEXNOW] Gagal menembak IndexNow: ' . $e->getMessage());
            return false;
        }
    }
}
