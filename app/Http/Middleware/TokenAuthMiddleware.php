<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\API\TokenHandler;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        // Perform token validation logic here
        if (!$this->isValidToken($token)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }

    private function isValidToken($token)
    {
        $token = TokenHandler::where('token', $token)->first();
        return $token !== null;

        // Check if the token exists and is valid in your storage (e.g., database)
        // Replace this with your token validation logic
        // return $token === 'YOUR_VALID_TOKEN';
    }
}
