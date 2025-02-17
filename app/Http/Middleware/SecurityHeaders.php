<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $response = $next($request);

        $extras = '';

        if (app()->isLocal()) {
            $extras = " 'unsafe-inline'";
        }

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set(
            'Content-Security-Policy',
            implode(';', [
                "default-src 'self'",
                "connect-src 'self'",
                "font-src 'self' data: https://use.fontawesome.com",
                "img-src 'self' https://via.placeholder.com data:",
                "script-src 'self' 'unsafe-eval'" . $extras,
                "style-src 'self' 'unsafe-inline' https://use.fontawesome.com" . $extras,
                'frame-src https://youtube.com https://www.youtube.com',
            ])
        );

        return $response;
    }
}
