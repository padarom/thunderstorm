<?php

namespace Padarom\Thunderstorm\Http\Middleware;

use Illuminate\Support\Facades\Artisan;
use Closure;

class RunImport
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
        // Only run this if it was explicitly enabled
	if (env('DISABLE_IMPORTCRON', false)) {
            $random = rand(0, 9);
	    if ($random <= 2) {
		Artisan::call('import:uploads');
            }
	}

        return $next($request);
    } 
}