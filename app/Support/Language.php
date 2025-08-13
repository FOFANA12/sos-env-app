<?php

namespace App\Support;

class Language
{
    /**
     * Supported languages with their localized names.
     */
    private static array $languages = [
        ['code' => 'fr', 'name' => ['fr' => 'Français', 'en' => 'French', 'ar' => 'فرنسي']],
        ['code' => 'en', 'name' => ['fr' => 'Anglais', 'en' => 'English', 'ar' => 'إنجليزي']],
        ['code' => 'ar', 'name' => ['fr' => 'Arabe', 'en' => 'Arabic', 'ar' => 'عربي']],
    ];

    /**
     * Return all languages as an array.
     */
    public static function all(): array
    {
        return self::$languages;
    }

    /**
     * Return only the language codes.
     */
    public static function codes(): array
    {
        return array_column(self::$languages, 'code');
    }

    /**
     * Return the localized name of a given language code.
     * Defaults to French if the requested locale is not available.
     */
    public static function name(string $code, string $locale = 'fr'): ?string
    {
        foreach (self::$languages as $lang) {
            if ($lang['code'] === $code) {
                return $lang['name'][$locale] ?? $lang['name']['fr'] ?? null;
            }
        }

        return null;
    }

    /**
     * Return a specific language as an object with code and localized label.
     */
    public static function get(string $code, string $locale = 'fr'): ?object
    {
        foreach (self::$languages as $lang) {
            if ($lang['code'] === $code) {
                return (object) [
                    'code' => $lang['code'],
                    'name' => $lang['name'][$locale] ?? $lang['name']['fr'],
                ];
            }
        }

        return null;
    }
}
