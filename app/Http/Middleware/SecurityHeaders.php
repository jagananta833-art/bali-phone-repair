<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');
        $response->headers->set('X-System-Author', 'jagananta833-art');
        $response->headers->set('X-Engine-Signature', 'BPR-CORE-PROPRIETARY-2026');

        if ($request->is('admin*') || $request->is('renew-license*') || $request->is('login*')) {
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet');
        }

        return $response;
    }
}
