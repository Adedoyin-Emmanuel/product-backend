<?php

require_once("./handlers/handlers.php");

$app = new Router();

$app->route("GET", "/", handleDefaultRoute());
$app->route("POST", "/products/create", handleCreate());
$app->route("GET", "/products/all", getAllProducts());
$app->route("DELETE", "/products/delete{id", handleProductDelete($route_params));
