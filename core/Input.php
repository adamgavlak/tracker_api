<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 13:42
 */

namespace App\Core;

use Exception;

class Input
{
    protected static $data = [];

    public static function process($requestType)
    {
        if ($requestType == "PATCH" || $requestType == "PUT" || $requestType == "POST") {
            $_REQUEST = json_decode(file_get_contents('php://input'), true);
        }

        static::$data = $_REQUEST;
    }

    public static function get($key)
    {
        if (! array_key_exists($key, static::$data)) {
            throw new Exception("Key {$key} does not exist in Input");
        }

        return static::$data[$key];
    }

    public static function has($key)
    {
        return array_has(static::$data, $key);
    }

    public static function all()
    {
        return static::$data;
    }

    public static function add($params)
    {
        foreach ($params as $key => $value) {
            static::$data[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }
}