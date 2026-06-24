<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /** Supported locales — Arabic is the default. */
    public const SUPPORTED = ['ar', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = config('app.locale', 'ar');
        }

        app()->setLocale($locale);

        // So route() / url() default to the active locale without passing it everywhere.
        URL::defaults(['locale' => $locale]);

        // Make locale + direction available to every view.
        view()->share('locale', $locale);
        view()->share('dir', $locale === 'ar' ? 'rtl' : 'ltr');

        return $next($request);
    }
}
