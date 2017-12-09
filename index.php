<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use App\Core\{
    Input, Router, Request
};

Input::process(Request::method());

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
