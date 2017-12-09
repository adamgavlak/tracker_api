<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 13:01
 */

namespace App\Controllers;

use App\Core\Auth;

abstract class Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    protected function jsonIfOwns($resource)
    {
        if (Auth::user()->id == $resource->user_id)
        {
            $this->json($resource);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'unauthorized']);
        }
    }

    protected function userOwns($resource)
    {
        return (Auth::user()->id == $resource->user_id);
    }

    protected function json($model)
    {
        echo json_encode($model);
    }
}
