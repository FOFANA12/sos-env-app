<?php

namespace App\Support;

class Role
{
    /**
     * Supported user roles with their localized labels.
     */
    private static array $roles = [
        ['code' => 'public_user', 'name' => ['fr' => 'Utilisateur public', 'en' => 'Public User', 'ar' => 'مستخدم عام']],
        ['code' => 'admin', 'name' => ['fr' => 'Administrateur', 'en' => 'Administrator', 'ar' => 'مسؤول']],
    ];

    /**
     * Return all roles as an array.
     */
    public static function all(): array
    {
        return self::$roles;
    }

    /**
     * Return only the role codes.
     */
    public static function codes(): array
    {
        return array_column(self::$roles, 'code');
    }

    /**
     * Return the localized name of a given role code.
     * Defaults to French if the requested locale is not available.
     */
    public static function name(string $code, string $locale = 'fr'): ?string
    {
        foreach (self::$roles as $role) {
            if ($role['code'] === $code) {
                return $role['name'][$locale] ?? $role['name']['fr'] ?? null;
            }
        }

        return null;
    }

    /**
     * Return a specific role as an object with code and localized label.
     */
    public static function get(string $code, string $locale = 'fr'): ?object
    {
        foreach (self::$roles as $role) {
            if ($role['code'] === $code) {
                return (object) [
                    'code' => $role['code'],
                    'name' => $role['name'][$locale] ?? $role['name']['fr'],
                ];
            }
        }

        return null;
    }
}
