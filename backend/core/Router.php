<?php

namespace app\core;


class Router
{
    public array $routes = [];
    public string $method = '';
    public Request $request;

    public function __construct(string $method, Request $request)
    {
        $this->method = $method;

        $this->request = $request;
    }


    public function get($route, $callback)
    {
        if ($this->request->getMethod() === 'get') {
            $this->method = $this->request->getMethod();
            $this->routes[$this->method][$route] = $callback;
        }
    }

    public function post($route, $callback)
    {
        if ($this->request->getMethod() === 'post') {
            $this->method = $this->request->getMethod();
            $this->routes[$this->method][$route] = $callback;
        }
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            http_response_code(404);
            echo "404 Not Found: ";
        }



        if (is_array($callback)) {
            $class = new $callback[0]();
            if (method_exists($class, $callback[1])) {
                return call_user_func([$class, $callback[1]], $this->request);
            }
        }
    }

    public function test()
    {
        echo 'gaumarjos yleco';
    }
}
