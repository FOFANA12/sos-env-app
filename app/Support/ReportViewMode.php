<?php

namespace App\Support;

class ReportViewMode
{
    /**
     * Liste des modes d’affichage disponibles.
     */
    public static array $modes = [
        [
            'code' => 'all',
            'name' => [
                'fr' => 'Tous les signalements',
                'en' => 'All reports',
                'ar' => 'جميع البلاغات',
            ],
        ],
        [
            'code' => 'mine',
            'name' => [
                'fr' => 'Mes signalements',
                'en' => 'My reports',
                'ar' => 'بلاغاتي',
            ],
        ],
    ];

    /**
     * Get all available view modes.
     */
    public static function all(): array
    {
        return self::$modes;
    }
}
