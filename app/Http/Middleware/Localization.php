<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request and apply locale settings.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = array_map('trim', explode(',', env('SUPPORTED_LOCALES', 'en,fr,ar')));
        $defaultLocale    = config('app.locale', 'en');

        $locale = null;

        // 1. Paramètre d'URL (?locale=fr)
        if ($request->has('locale')) {
            $locale = $this->normalizeLocale($request->query('locale'));

            if ($request->hasSession()) {
                $request->session()->put('locale', $locale);
            }
        }

        // 2. Session (si utilisateur a déjà choisi une langue sur le Web)
        elseif ($request->hasSession() && $request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
        }

        // 3. En-tête custom X-Locale (utile pour mobile)
        elseif ($request->hasHeader('X-Locale')) {
            $locale = $this->normalizeLocale($request->header('X-Locale'));
        }

        // 4. En-tête standard Accept-Language
        elseif ($request->hasHeader('Accept-Language')) {
            $locale = $this->normalizeLocale($request->header('Accept-Language'));
        }

        // 5. Fallback (par défaut si rien n’est trouvé ou langue non supportée)
        if (! $locale || ! in_array($locale, $supportedLocales, true)) {
            $locale = $defaultLocale;
        }

        $this->setLocale($locale);

        return $next($request);
    }

    /**
     * Normalize locale string (e.g., "fr-FR" => "fr")
     */
    protected function normalizeLocale(?string $locale): ?string
    {
        if (! $locale) {
            return null;
        }

        return strtolower(substr(trim($locale), 0, 2));
    }

    /**
     * Set the locale globally for Laravel, Carbon and PHP
     */
    protected function setLocale(string $locale): void
    {
        app()->setLocale($locale);
        @setlocale(LC_ALL, $locale);
        Carbon::setLocale($locale);
    }
}
