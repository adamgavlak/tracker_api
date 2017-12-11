<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 16:49
 */

namespace App\Controllers;

use App\Core\Input;
use App\Models\User;

class SignupController
{
    public function create()
    {
        $user = new User();
        $user->email = Input::get('email');
        $user->password = password_hash(Input::get('password'), PASSWORD_BCRYPT);
        $user->api_key = bin2hex(openssl_random_pseudo_bytes(32));
        $user->save();

        json(['api_key' => $user->api_key]);
    }
}