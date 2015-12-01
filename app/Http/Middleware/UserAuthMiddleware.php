<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Sentinel::check()) {
            $data = [
                'alert' => 'danger',
                'message' => "Vous devez être connectez par accedez a cette partie du site!"
            ];
            return redirect('login')->with($data);
        }
        
        return $next($request);
    }
}
