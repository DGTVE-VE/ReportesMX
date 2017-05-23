<?php

namespace App\Http\Middleware;
use Log;
use Closure;


class AllowedBrowsersMiddleware
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
        //$browser = \hisorange\BrowserDetect\Facade\Parser::browserFamily();
        $agent = new Jenssegers\Agent\Agent;
        $browser = $agent->browser();
        Log::info('Browser detected: '.$browser);

        if ($browser == 'Firefox' || $browser == 'Chrome' || $browser == 'Safari'){
                return $next($request);
            }
        return redirect('recomendacion');
    }
}
