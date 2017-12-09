<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    protected static $currentUser;

    public static function requireLogin()
    {
        $apiKey = $_SERVER['HTTP_X_API_KEY'];

        if (empty($apiKey)) {
            http_response_code(401);
            die(json(["error" => "Unauthorized"]));
        }

        $user = User::where('api_key', $apiKey)->first();

        if (empty($user)) {
            http_response_code(401);
            die(json(["error" => "Unauthorized"]));
        }

        self::$currentUser = $user;
    }

    public static function user()
    {
        if (empty(self::$currentUser))
            self::requireLogin();

        return self::$currentUser;
    }
}