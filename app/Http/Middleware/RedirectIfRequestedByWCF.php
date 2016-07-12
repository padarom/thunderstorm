<?php
namespace App\Http\Middleware;
use Closure;

class RedirectIfRequestedByWCF
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
        $userAgent = $request->header('User-Agent');
        if (strpos($userAgent, 'HTTP.PHP') !== false) {
            return "WCF";
        }

        return $next($request);
    }
}