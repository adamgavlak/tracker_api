<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Input;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $this->json($users);
    }

    public function show()
    {
        $user = User::find(Input::get('id'));
        $this->json($user);
    }

    public function update()
    {
        if (Auth::user()->id == Input::get('id'))
        {
            $user = User::find(Input::get('id'));
            $user->fill(Input::all());

            if (!empty(Input::has('password')))
            {
                $user->password = password_hash(Input::get('password'), PASSWORD_BCRYPT);
            }

            $user->save();
            json($user);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'Unauthorized']);
        }
    }

    public function destroy()
    {
        $id = Input::get('id');
        if (Auth::user()->id == $id)
        {
            User::destroy($id);
            $this->json(['message' => "User ${$id} has been deleted"]);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'Unauthorized']);
        }
    }
}