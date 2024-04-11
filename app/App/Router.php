<?php

namespace Codeir\BelajarPHPMvc\App;

class Router
{
    private static array $routes = [];

    public static function add(string $method, 
                               string $path, 
                               string $controller, 
                               string $function,
                               array $middlewares = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middlewares,
        ];
    }

    public static function run(): void
    {
        $path = "/";
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            // 3.
            // buat path route dengan regex
            // buat pattern terlebih dahulu
            $pattern = "#^" . $route['path'] . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {
                // 1.
                // echo 'Controller : ' . $route['controller'] . '<br>';
                // echo 'Function : ' . $route['function'];

                // 11.
                // call middleware
                foreach($route['middleware'] as $middleware){
                    $instance = new $middleware;
                    $instance->before();
                }

                // 2.
                $function = $route['function'];

                $controller = new $route['controller'];
                // $controller->$function();

                // 3.
                // panggilnya menggunakan call_user_func_array dikarenakan datanya array
                // hapus data pertama dahulu
                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);
                
                return;
            }
        }

        http_response_code(404);
        echo 'CONTROLLER NOT FOUND';
    }
}