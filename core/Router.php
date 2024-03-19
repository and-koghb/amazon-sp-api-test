<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function add($route, $controller, $method)
    {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function handle($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            $controller = new $controller();
            $controller->$method();
        } else {
            throw new \Exception('Page is not found', 404);
        }
    }
}