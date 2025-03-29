<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self' http://localhost:* https://localhost:*; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:* https://localhost:*; " .
            "style-src 'self' 'unsafe-inline' http://localhost:* https://localhost:*; " .
            "img-src 'self' data: http://localhost:* https://localhost:*; " .
            "font-src 'self' data: http://localhost:* https://localhost:*; " .
            "connect-src 'self' http://localhost:* https://localhost:*;"
        );

        return $response;
    }
}
