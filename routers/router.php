<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Router
{
    public function route($method, $path, $handler)
    {

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = $_SERVER['REQUEST_URI'];

        /*Check if method and path match the requested route*/
        if ($method === $requestMethod && preg_match("#^{$path}$#", $requestPath)) {
            $routeParams = [];
            preg_match_all("#\{([^\}]+)\}#", $path, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $paramName = $match[1];
                $paramValue = $_GET[$paramName] ?? null;
                if ($paramValue !== null) {
                    $routeParams[$paramName] = $paramValue;
                }
            }
            $handler($routeParams);
        }
    }
}
