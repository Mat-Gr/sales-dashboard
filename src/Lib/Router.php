<?php

namespace App\Lib;

use App\Controllers\Interfaces\ControllerInterface;
use App\Lib\Abstracts\BaseResponse;

class Router
{

    public const GET = 'GET';

    public static function getResponse(array $routes): string
    {
        foreach ($routes as $route) {
            if ($route instanceof BaseResponse) {
                http_response_code($route->getStatus());

                return $route;
            }
        }

        http_response_code(404);

        return 'Error 404: Couldn\'t resolve the requested url';
    }

    public static function get(
        string $route,
        ControllerInterface $controller,
        string $action
    ): ?BaseResponse {
        if (!self::uriMatchesRoute($route)) {
            return null;
        }

        if (!self::requestMatchesMethod(self::GET)) {
            return null;
        }

        return $controller->{$action}();
    }

    private static function uriMatchesRoute(string $route): bool
    {
        $params = $_SERVER['REQUEST_URI'];
        $params = !str_starts_with($params, '/') ? "/{$params}" : $params;

        $regex = str_replace('/', '\/', $route);
        return preg_match('/^'.($regex).'($|\?)/', $params, $matches,
                PREG_OFFSET_CAPTURE) === 1;
    }

    private static function requestMatchesMethod(string $method): bool
    {
        return strcasecmp($_SERVER['REQUEST_METHOD'], $method) === 0;
    }

}
