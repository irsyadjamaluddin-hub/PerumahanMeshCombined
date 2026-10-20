<?php

namespace App\Support;

class KkkLang
{
    protected static ?array $map = null;

    /** Translate a Malay UI string to English when the kkk locale is set to 'en'. */
    public static function t(?string $text): ?string
    {
        if ($text === null || $text === '') {
            return $text;
        }

        if (session('kkk_locale', 'ms') !== 'en') {
            return $text;
        }

        self::$map ??= require base_path('lang/kkk_en.php');

        return self::$map[$text] ?? $text;
    }

    public static function locale(): string
    {
        return session('kkk_locale', 'ms');
    }
}
