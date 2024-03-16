<?php

namespace App\Http\Middleware;

use App\Models\akunModel;
use Closure;
use Illuminate\Http\Request;

class loginRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->session()->get('data')->nama_role ?? "";
        if ($user == 'owner' || $user == 'kasir') {
            return redirect('/dashboard');
        } elseif ($user == 'kitchen') {
            return redirect('/kitchen');
        }
        return $next($request);
    }
}
