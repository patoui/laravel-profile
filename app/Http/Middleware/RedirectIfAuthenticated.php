<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function redirect;

final class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
