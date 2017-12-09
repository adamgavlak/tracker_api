<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 13:01
 */

namespace App\Controllers;

use App\Core\App;
use App\Core\Input;
use App\Models\User;
use App\Models\Project;

class PagesController
{
    public function index()
    {
//        $users = App::get('db')->all('users');
//        $user = new User;
//        $user->username = 'Hello';
//        $user->email = 'World';
//        $user->password = password_hash('secret', PASSWORD_BCRYPT);
//        $user->save();
        $user = User::find(1);

        // $project = Project::find(2);
        // $user = $project->user;

        json($user->projects);

        // json($user);
        // var_dump($user);
        // $users = User::all();

        // foreach ($users as $user)
        // {
        //     echo $user->email . "<br>";
        // }


//        return view('index', ["users" => $users]);
    }

    public function create()
    {
//        App::get('db')->insert("users", [
//            "username" => Input::get('username'),
//            "email" => Input::get('email')
//        ]);
        $user = new User;
        $user->username = 'Hello';
        $user->email = 'World';
        $user->password = password_hash('secret');
        $user->save();

        redirect("");
    }
}