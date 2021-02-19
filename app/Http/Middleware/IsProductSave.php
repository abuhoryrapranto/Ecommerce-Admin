<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsProductSave
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('product-saved-successfully') == true)
            return $next($request);
        return redirect('product/add-new');
    }
}
