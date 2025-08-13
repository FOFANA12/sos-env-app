<?php

namespace App\Support;

class Civility
{
    /**
     * Supported civilities with their localized labels.
     */
    private static array $civilities = [
        ['code' => 'mr', 'name' => ['fr' => 'Monsieur', 'en' => 'Mr', 'ar' => 'السيد']],
        ['code' => 'mrs', 'name' => ['fr' => 'Madame', 'en' => 'Mrs', 'ar' => 'السيدة']],
        ['code' => 'mx', 'name' => ['fr' => 'Autre', 'en' => 'Mx', 'ar' => 'آخر']],
    ];

    /**
     * Return all civilities as an array.
     */
    public static function all(): array
    {
        return self::$civilities;
    }

    /**
     * Return only the civility codes.
     */
    public static function codes(): array
    {
        return array_column(self::$civilities, 'code');
    }

    /**
     * Return the localized name of a given civility code.
     * Defaults to French if the requested locale is not available.
     */
    public static function name(string $code, string $locale = 'fr'): ?string
    {
        foreach (self::$civilities as $civ) {
            if ($civ['code'] === $code) {
                return $civ['name'][$locale] ?? $civ['name']['fr'] ?? null;
            }
        }

        return null;
    }

    /**
     * Return a specific civility as an object with code and localized label.
     */
    public static function get(string $code, string $locale = 'fr'): ?object
    {
        foreach (self::$civilities as $civ) {
            if ($civ['code'] === $code) {
                return (object) [
                    'code' => $civ['code'],
                    'name' => $civ['name'][$locale] ?? $civ['name']['fr'],
                ];
            }
        }

        return null;
    }
}
