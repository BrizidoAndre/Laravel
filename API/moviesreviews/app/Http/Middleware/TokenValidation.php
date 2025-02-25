<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (is_null($token)) {
            return response()->json(['message' => 'Unauthenticated user'], 401);
        }

        $accessToken = AccessToken::where('tokenString', $token)->first();

        if (is_null($accessToken)) {
            return response()->json(['message' => 'Invalid token'], 403);
        }

        $moreHours = date_diff(date_create(), date_create($accessToken->creationDate))->h >= 1;
        $moreDays = date_diff(date_create(), date_create($accessToken->creationDate))->d >= 1;
        $moreMonths = date_diff(date_create(), date_create($accessToken->creationDate))->m >= 1;
        $moreYears = date_diff(date_create(), date_create($accessToken->creationDate))->y >= 1;

        if ($moreHours || $moreDays || $moreMonths || $moreYears) {
            $accessToken->delete();
            return response()->json(['message' => 'Invalid token'], 403);
        }

        // return $next($request);
        return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }
}
