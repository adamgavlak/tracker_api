<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 16:36
 */

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Input;
use App\Core\App;
use App\Models\User;

class SessionsController
{
    public function create()
    {
        $user = User::where('email', Input::get('email'))->first();

        if (!empty($user) && password_verify(Input::get('password'), $user->password))
        {
            $user->api_key = bin2hex(openssl_random_pseudo_bytes(32));
            $user->save();
            return json(['api_key' => $user->api_key]);
        }
        else
        {
            return json(['error' => 'Wrong email/password combination']);
        }
    }

    public function destroy()
    {
        Auth::user()->api_key = null;
        Auth::user()->save();
        return json(['message' => 'Logged out']);
    }
}