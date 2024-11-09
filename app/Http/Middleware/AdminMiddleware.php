<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est authentifié et a le rôle 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Autorise l'accès si l'utilisateur est admin
        }

        // Redirige vers l'accueil ou une autre page avec un message d'erreur si l'utilisateur n'est pas admin
        return redirect('/')->with('error', "Vous n'avez pas l'autorisation d'accéder à cette page.");
    }
}
