<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class UserAdminMiddleware
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
        if (!Sentinel::inRole('admin'))
        {
            $data = [
                'alert' => 'danger',
                'message' => "Vous n'avez pas la permission pour accedez à cette partie du site!"
            ];
            return redirect('dashboard')->with($data);
        }
        return $next($request);
    }
}
