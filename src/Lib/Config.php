<?php


namespace App\Lib;


use App\Exceptions\ConfigMissingException;

class Config
{
    private static array $config;

    public static function get(string $key, $default = null): string
    {
        if (!isset(self::$config)) {
            $path = dirname(__DIR__, 2) . '/.env';

            if (!file_exists($path)) {
                throw new ConfigMissingException;
            }

            $content = array_map(static function ($value) {
                preg_match('/(^.*?(?==)).*((?<==").*(?="))/', $value, $matches);

                return [
                    'keys' => $matches[1] ?? null,
                    'values' => $matches[2] ?? null,
                ];
            }, file($path));

            self::$config = array_combine(
                array_column($content, 'keys'),
                array_column($content, 'values')
            );
        }

        return self::$config[$key] ?? $default;
    }
}
