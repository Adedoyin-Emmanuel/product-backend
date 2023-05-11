<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


require_once("./handlers/handlers.php");

$app = new Router();

$app->route("POST", "products/create", handleCreate());
$app->route("GET", "products/all", getAllProducts());
$app->route("DELETE", "products/delete{id}", handleProductDelete($route_params));
