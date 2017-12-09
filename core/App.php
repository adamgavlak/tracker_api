<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 12:33
 */

namespace App\Core;

class App
{
    protected static $registry = [];

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (! array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} found in container.");
        }

        return static::$registry[$key];
    }

    public static function generateCSRFToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
}