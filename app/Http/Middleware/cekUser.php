<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class cekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        return $next($request);
    if (!Auth::check()) {
        return redirect('/')->withErrors('Anda harus login terlebih dahulu');
    }
    $user =Auth::user();
    if($user->level == $roles){
        // return $next($request);
        $response = $next($request);
        $headers =[
            'Cache-Control' =>'nocache, no-store, max-age=0, must-revalidate',
            'Pragma','no-cache',
            'Expires','Fri, 01 Jan 1990 00:00:00 GMT',
    ];
        foreach($headers as $key => $value){
        $response->headers->set($key,$value);
    }
        return $response;
    }else{
        return redirect('/')->withErrors('Anda harus login terlebih dahulu');
        }
    }
}