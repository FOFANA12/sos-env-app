<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateTimeFormatter
{
    /**
     * Format a date according to the application's locale.
     *
     * @param  string  $date  The date to format.
     * @param  string  $format  The format to apply (default: 'D/MM/YYYY').
     * @return string|null Returns the formatted date, or null if the input is invalid.
     */
    public static function formatDate(string $date, ?string $format = null): ?string
    {
        try {
            $locale = app()->getLocale();
            $carbon = Carbon::parse($date)->locale($locale);

            return $format
                ? $carbon->isoFormat($format)
                : $carbon->isoFormat('L');
        } catch (\Exception $e) {
            return null;
        }
    }


    /**
     * Format a datetime according to the application's locale.
     *
     * @param  string  $datetime  The datetime to format.
     * @param  string  $format  The format to apply (default: 'D/MM/YYYY [at] HH:mm').
     * @return string|null Returns the formatted datetime, or null if the input is invalid.
     */
    public static function formatDatetime(string $datetime, ?string $format = null): ?string
    {
        try {
            $locale = app()->getLocale();
            $carbon = Carbon::parse($datetime)->locale($locale);

            $at = __('app/common.date.at') ;

            return $format
                ? $carbon->isoFormat($format)
                : $carbon->isoFormat("L [{$at}] HH:mm");
        } catch (\Exception $e) {
            return null;
        }
    }
}
