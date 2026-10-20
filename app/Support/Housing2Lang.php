<?php

namespace App\Support;

class Housing2Lang
{
    protected static ?array $map = null;

    /** Translate a Malay UI string to English when the housing2 locale is set to 'en'. */
    public static function t(?string $text): ?string
    {
        if ($text === null || $text === '') {
            return $text;
        }

        if (session('housing2_locale', 'ms') !== 'en') {
            return $text;
        }

        self::$map ??= require base_path('lang/housing2_en.php');

        return self::$map[$text] ?? $text;
    }

    public static function locale(): string
    {
        return session('housing2_locale', 'ms');
    }
}
