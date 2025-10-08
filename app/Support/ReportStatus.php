<?php

namespace App\Support;

class ReportStatus
{
    /**
     * List of available statuses with their localized names and display colors.
     */
    private static array $statuses = [
        [
            'code' => 'pending',
            'color' => '#FF9800',
            'name' => [
                'fr' => 'En attente',
                'en' => 'Pending',
                'ar' => 'قيد الانتظار',
            ],
        ],
        [
            'code' => 'resolved',
            'color' => '#4CAF50',
            'name' => [
                'fr' => 'Résolu',
                'en' => 'Resolved',
                'ar' => 'تم الحل',
            ],
        ],
        [
            'code' => 'rejected',
            'color' => '#F44336',
            'name' => [
                'fr' => 'Rejeté',
                'en' => 'Rejected',
                'ar' => 'مرفوض',
            ],
        ],
    ];

    /**
     * Get all statuses as an array.
     */
    public static function all(): array
    {
        return self::$statuses;
    }

    /**
     * Get only the list of status codes.
     */
    public static function codes(): array
    {
        return array_column(self::$statuses, 'code');
    }

    /**
     * Get the localized name of a given status code.
     * Defaults to French if the requested locale is not available.
     */
    public static function name(string $code, string $locale = 'fr'): ?string
    {
        foreach (self::$statuses as $status) {
            if ($status['code'] === $code) {
                return $status['name'][$locale] ?? $status['name']['fr'];
            }
        }

        return null;
    }

    /**
     * Get a specific status as an object with code, label and color.
     */
    public static function get(string $code, string $locale = 'fr'): ?object
    {
        foreach (self::$statuses as $status) {
            if ($status['code'] === $code) {
                return (object) [
                    'code' => $status['code'],
                    'label' => $status['name'][$locale] ?? $status['name']['fr'],
                    'color' => $status['color'],
                ];
            }
        }

        return null;
    }
}
