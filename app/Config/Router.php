<?php

function load(string $controller, string $action, ...$params)
{
    try {
        $controllerNameSpace = "app\\Controllers\\{$controller}";

        if (!class_exists($controllerNameSpace)) {
            throw new \Exception("Controller {$controllerNameSpace} not found");
        }

        $controllerInstance = new $controllerNameSpace();

        if (!method_exists($controllerInstance, $action)) {
            throw new \Exception("Action {$action} not found");
        }

        call_user_func_array([$controllerInstance, $action], $params);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


$router = [
    "GET" => [
        '/' => fn() => load("Ramais", "index"),
        '/ramais' => fn() => load("Ramais", "getRamais"),
    ],
    "POST" => [
        '/salvar-ramal' => fn() => load("Ramais", "saveRamal"),
    ],
];
