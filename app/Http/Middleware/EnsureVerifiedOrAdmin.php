<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureVerifiedOrAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Admin aplikasi tidak perlu verifikasi email
        if ($user && $user->is_admin) {
            return $next($request);
        }

        if (!$user ||
            ($user instanceof MustVerifyEmail &&
                !$user->hasVerifiedEmail())) {

            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::route('verification.notice');
        }

        return $next($request);
    }
}
