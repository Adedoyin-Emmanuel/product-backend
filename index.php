<?php

require_once("./controllers/product.controller.php");
require_once("./routers/router.php");


$app = new Router();


function handleCreate()
{
    $product = new Product();
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['tmp_name'];

    echo $product->create($product_name, $product_description, $product_price, $product_image);
    die();
}

function getAllProducts()
{
    $product = new Product();

    echo $product->get();
    die();
}

function handleProductDelete($route_params)
{
    $product_id = $route_params['id'];
    $product = new Product();

    echo $product->delete($product_id);
    die();
}
$app->route("POST", "/products/create", handleCreate());
$app->route("GET", "/products/all", getAllProducts());
$app->route("DELETE", "/products/delete{id", handleProductDelete($route_params));
