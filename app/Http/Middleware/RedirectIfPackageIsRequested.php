<?php
namespace App\Http\Middleware;
use Closure;

class RedirectIfPackageIsRequested
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
        if ($request->has('packageName')) {
            if ($request->get('packageVersion')) {
                return redirect(route('get-package-with-version', [
                    'identifier' => $request->get('packageName'),
                    'version' => $request->get('packageVersion'),
                ]));
            }
            
            return redirect(route('get-package', [
                'identifier' => $request->get('packageName')
            ]));
        }

        return $next($request);
    }
}