<?php

namespace GoodM4ven\GoodNight;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DetectSettingChange
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
        $isSwitcherEnabled = config('good-night.switcher-enabled');

        // ? Clear the view cache in case settings are changed
        if ($request->session()->has('good-night-switch-enabled')) {
            if ($request->session('good-night-switch-enabled') !== $isSwitcherEnabled) {
                Artisan::call('view:clear');
            }
        } else {
            $request->session()->put('good-night-switch-enabled', $isSwitcherEnabled);
        }

        return $next($request);
    }
}
