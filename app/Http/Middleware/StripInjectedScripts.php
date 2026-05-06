<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StripInjectedScripts
{
    // Known injected script patterns to remove
    private array $patterns = [
        '/<script[^>]*src=["\']\/\/async\.gsyndication\.com[^"\']*["\'][^>]*><\/script>/i',
        '/<script[^>]*src=["\']\/\/[^"\']*gsyndication[^"\']*["\'][^>]*><\/script>/i',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type', '');

        // Only process HTML and JSON responses
        if (
            str_contains($contentType, 'text/html') ||
            str_contains($contentType, 'application/json')
        ) {
            $content = $response->getContent();

            if ($content && str_contains($content, 'gsyndication')) {
                foreach ($this->patterns as $pattern) {
                    $content = preg_replace($pattern, '', $content);
                }
                // Also strip any plain script tag with gsyndication
                $content = preg_replace('/<script[^>]*gsyndication[^>]*>.*?<\/script>/is', '', $content);
                $response->setContent($content);
            }
        }

        return $response;
    }
}
