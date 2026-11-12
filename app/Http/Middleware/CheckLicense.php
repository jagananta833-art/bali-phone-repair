<?php

namespace App\Http\Middleware;

use App\Services\LicenseService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLicense
{
    /**
     * Pola rute/path yang selalu diizinkan agar bisa diakses untuk proses perpanjangan.
     */
    private const EXEMPT_PATHS = [
        'renew-license',
        'renew-license/*',
        'up',
        'assets/*',
        'build/*',
        'favicon.ico',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        foreach (self::EXEMPT_PATHS as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }

        $check = LicenseService::verify();

        if (!$check['valid']) {
            if ($request->expectsJson() || $request->is('wp-json/*') || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'code' => 2301,
                    'error' => 'Error 2301: Service Suspended',
                    'message' => 'System configuration check failed. Please contact the administrator.',
                ], 503)->header('Retry-After', '3600');
            }

            return response()->view('errors.2301', [
                'reason' => $check['reason'] ?? 'System configuration check failed.',
            ], 503)
                ->header('Retry-After', '3600')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        }

        return $next($request);
    }
}

