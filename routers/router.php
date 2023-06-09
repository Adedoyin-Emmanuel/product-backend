<?php
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
