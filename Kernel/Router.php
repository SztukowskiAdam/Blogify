<?php

namespace Kernel;

class Router
{
    public static $GET = [];
    public static $POST = [];

    public static function get(string $path, string $method) {
        if (self::validate($path, $method)) {
            self::$GET[$path] = $method;
        }
    }

    public static function post(string $path, string $method) {
        if (self::validate($path, $method)) {
            self::$POST[$path] = $method;
        }
    }

    /**
     * Validates path and method
     * @param string $path
     * @param string $method
     * @return bool
     */
    private static function validate(string $path, string $method): bool {
        return strpos($method, '@') !== false;
    }
}