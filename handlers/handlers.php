<?php
require_once("./controllers/product.controller.php");
require_once("./routers/router.php");

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


function handleDefaultRoute()
{
    echo "Hello world!";
    die();
}
