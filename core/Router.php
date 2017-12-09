<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 12:28
 */

namespace App\Core;

use Exception;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'DELETE' => []
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$this->parse_route($uri)] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$this->parse_route($uri)] = $controller;
    }

    public function patch($uri, $controller)
    {
        $this->routes['PATCH'][$this->parse_route($uri)] = $controller;
    }

    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$this->parse_route($uri)] = $controller;
    }

    public function direct($uri, $requestType)
    {
        $match = $this->match_key_in_array($uri, $this->routes[$requestType]);
        $route = $match["route"];

        if (empty($route))
            throw new Exception('No route defined for this URI.');

        Input::add($match["params"]);

        return $this->callAction(
            ...explode('#', $this->routes[$requestType][$route])
        );
    }

    public function callAction($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new Exception("{$controller} does not have a {$action} action.");
        }

        return $controller->$action();
    }

    private function match_key_in_array($uri, $routes)
    {
        foreach ($routes as $key => $value)
        {
            if (preg_match("/^" . $key . "$/", $uri, $params)) {

                foreach ($params as $k => $v) {
                    if (is_int($k)) {
                        unset($params[$k]);
                    }
                }

                return ["route" => $key, "params" => $params];
            }
        }

        return null;
    }

    private function parse_route($route)
    {
        $route = str_replace("/", "\/", $route);

        $replace_params_regex = '/:(\w+)/';
        $route = preg_replace($replace_params_regex, "(?<$1>.+)", $route);

        return $route;
    }
}