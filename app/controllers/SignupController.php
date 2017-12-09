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
        $user->save();

        json(['message' => 'You have successfuly signed up! Please log in now.']);
    }
}