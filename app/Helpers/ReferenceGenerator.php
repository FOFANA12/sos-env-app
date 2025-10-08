<?php

namespace App\Helpers;

use App\Models\Family;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReferenceGenerator
{
    /**
     * Generic refernece generator.
     */
    public static function generateReference(string $prefix, int $id): string
    {
        $now = now();
        $date = Carbon::parse($now)->format('Y-d-m');

        return "{$prefix}-{$date}-" . str_pad((string) $id, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate a unique article reference for the given family.
     *
     * @param \App\Models\Family $family
     * @return array{reference: string, number: string}
     */
    public static function generateArticleReference(Family $family): array
    {
        $reference = null;
        $number = null;

        DB::transaction(function () use (&$family, &$reference, &$number) {
            $family->increment('article_counter');
            $family->refresh();

            $number = str_pad((string) $family->article_counter, 3, '0', STR_PAD_LEFT);
            $reference = $family->code . '-' . $number;
        });

        return [
            'reference' => $reference,
            'number' => $number,
        ];
    }
}
