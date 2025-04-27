<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): \Symfony\Component\HttpFoundation\Response
    {
        
        $user_role = $request->user()->getRole(); // misalnya return 'ADM', 'STF', dst

        if (in_array($user_role, $roles)) {
            return $next($request);
        }

        abort(403, 'Forbidden, Kamu tidak punya akses ke halaman ini.');
    }
}
