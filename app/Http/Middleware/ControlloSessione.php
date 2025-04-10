<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlloSessione
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        

        #controllo se la sessione è attiva
        if(!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Devi essere loggato per accedere alla pagina.');
        }
        return $next($request);
    }
}
