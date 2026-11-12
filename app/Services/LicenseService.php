<?php

namespace App\Services;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class LicenseService
{
    private const SALT = 'bpr-core-lic-v1-jagananta833-art';

    /**
     * Mendapatkan Secret Key untuk hashing tanda tangan lisensi.
     */
    public static function getSecretKey(): string
    {
        $custom = env('LICENSE_SECRET_KEY');
        if (!empty($custom)) {
            return (string) $custom;
        }

        $appKey = (string) config('app.key', 'base64:defaultFallbackKeyForBaliPhoneRepairSecurity2026');
        return hash_hmac('sha256', self::SALT, $appKey);
    }

    /**
     * Membuat token lisensi baru.
     *
     * @param int $days Durasi lisensi dalam hari (default 365 hari = 1 tahun)
     * @param string $owner Pemilik / penerbit lisensi
     * @param string $domain Domain yang diotorisasi
     */
    public static function generate(int $days = 365, string $owner = 'jagananta833-art', string $domain = 'baliphonerepair.com'): string
    {
        $now = Carbon::now();
        $expiresAt = $now->copy()->addDays($days)->endOfDay();

        $payload = [
            'app' => 'baliphonerepair',
            'domain' => $domain,
            'owner' => $owner,
            'issued_at' => $now->toIso8601String(),
            'expires_at' => $expiresAt->toIso8601String(),
            'expires_ts' => $expiresAt->timestamp,
            'nonce' => bin2hex(random_bytes(6)),
        ];

        $encodedPayload = self::base64UrlEncode((string) json_encode($payload, JSON_UNESCAPED_SLASHES));
        $signature = hash_hmac('sha256', $encodedPayload, self::getSecretKey());

        return 'BPR1.' . $encodedPayload . '.' . $signature;
    }

    /**
     * Verifikasi token lisensi.
     */
    public static function verify(?string $token = null): array
    {
        $token = $token ?: self::getCurrentToken();

        if (empty($token)) {
            return [
                'valid' => false,
                'code' => 2301,
                'reason' => 'No license token installed on system.',
                'expires_at' => null,
                'days_left' => 0,
            ];
        }

        $parts = explode('.', trim($token));
        if (count($parts) !== 3 || $parts[0] !== 'BPR1') {
            return [
                'valid' => false,
                'code' => 2301,
                'reason' => 'Invalid license token structure.',
                'expires_at' => null,
                'days_left' => 0,
            ];
        }

        [$prefix, $encodedPayload, $signature] = $parts;
        $expectedSignature = hash_hmac('sha256', $encodedPayload, self::getSecretKey());

        if (!hash_equals($expectedSignature, $signature)) {
            return [
                'valid' => false,
                'code' => 2301,
                'reason' => 'Digital cryptographic signature mismatch.',
                'expires_at' => null,
                'days_left' => 0,
            ];
        }

        $json = self::base64UrlDecode($encodedPayload);
        $data = json_decode($json, true);

        if (!is_array($data) || ($data['app'] ?? '') !== 'baliphonerepair') {
            return [
                'valid' => false,
                'code' => 2301,
                'reason' => 'License is not intended for this application.',
                'expires_at' => null,
                'days_left' => 0,
            ];
        }

        $expiresTs = (int) ($data['expires_ts'] ?? 0);
        $expiresAt = Carbon::createFromTimestamp($expiresTs);
        $now = Carbon::now();

        if ($now->timestamp > $expiresTs) {
            return [
                'valid' => false,
                'code' => 2301,
                'reason' => 'License has expired.',
                'expires_at' => $expiresAt,
                'days_left' => 0,
                'payload' => $data,
            ];
        }

        $daysLeft = (int) ceil($now->diffInSeconds($expiresAt, false) / 86400);

        return [
            'valid' => true,
            'code' => 200,
            'reason' => 'License active and valid.',
            'expires_at' => $expiresAt,
            'days_left' => max(0, $daysLeft),
            'payload' => $data,
        ];
    }

    /**
     * Membaca lisensi aktif dari database settings atau .env
     */
    public static function getCurrentToken(): ?string
    {
        $fromEnv = env('SITE_LICENSE_TOKEN');
        if (!empty($fromEnv)) {
            return (string) $fromEnv;
        }

        try {
            if (Schema::hasTable('settings')) {
                $val = Setting::where('key', 'site_license_token')->value('value');
                if (!empty($val)) {
                    return (string) $val;
                }

                // Inisialisasi otomatis lisensi 1 tahun pertama pada deployment baru
                $initialToken = self::generate(365);
                Setting::updateOrCreate(['key' => 'site_license_token'], ['value' => $initialToken]);
                return $initialToken;
            }
        } catch (\Throwable) {
            // Abaikan jika DB belum siap
        }

        return null;
    }

    /**
     * Mengaktifkan token lisensi ke database settings.
     */
    public static function activate(string $token): array
    {
        $verification = self::verify(trim($token));
        if (!$verification['valid']) {
            return $verification;
        }

        Setting::updateOrCreate(
            ['key' => 'site_license_token'],
            ['value' => trim($token)]
        );

        return $verification;
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string
    {
        return (string) base64_decode(strtr($data, '-_', '+/'));
    }
}
