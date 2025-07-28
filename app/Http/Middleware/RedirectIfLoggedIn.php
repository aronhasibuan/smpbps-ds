<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect berdasarkan role user
            switch ($user->user_role) {
                case 'kepalabps':
                    return redirect('/beranda-kepala-bps');
                case 'ketuatim':
                    return redirect('/beranda-ketua-tim');
                default:
                    return redirect('/beranda-anggota-tim');
            }
        }
        return $next($request);
    }
}
