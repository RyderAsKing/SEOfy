<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppAPIKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = config('app.api_key');

        if ($request->header('X-API-KEY') !== $apiKey) {
            return response()->json(
                ['error' => 'Unauthorized. Invalid API key.'],
                401
            );
        }

        return $next($request);
    }
}
