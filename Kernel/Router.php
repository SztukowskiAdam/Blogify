<?php

namespace Kernel;

class Router
{
    public static $GET = [];
    public static $POST = [];

    /**
     * Saves get route
     * @param string $path
     * @param string $method
     */
    public static function get(string $path, string $method) {
        if (self::validate($path, $method)) {
            self::$GET[$path] = $method;
        }
    }

    /**
     * Saves post route
     * @param string $path
     * @param string $method
     */
    public static function post(string $path, string $method) {
        if (self::validate($path, $method)) {
            self::$POST[$path] = $method;
        }
    }

    public static function path(string $path, bool $useForwardedHost = false): string {
        if ($path[0] === '/') {
            return self::urlOrigin($_SERVER, $useForwardedHost).'/paiw'.$path;
        }
        return self::urlOrigin($_SERVER)."/paiw/$path";

    }

    public static function currentUrl(): string {
        return self::urlOrigin($_SERVER).$_SERVER['REQUEST_URI'];
    }

    private static function urlOrigin($s, $useForwardedHost = false ): string {
        $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
        $sp       = strtolower( $s['SERVER_PROTOCOL'] );
        $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
        $port     = $s['SERVER_PORT'];
        $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
        $host     = ( $useForwardedHost && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
        $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
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