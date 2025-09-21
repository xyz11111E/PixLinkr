<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, string $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, string $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];

            if (is_string($handler) && str_contains($handler, '@')) {
                [$action, $controller] = explode('@', $handler);
                $controllerClass = "\\App\\Controllers\\{$controller}";

                if (class_exists($controllerClass)) {
                    $instance = new $controllerClass();
                    if (method_exists($instance, $action)) {
                        $instance->$action();
                        return;
                    }
                }
                http_response_code(500);
                echo "Controller or method not found.";
            } else {
                call_user_func($handler);
            }
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}