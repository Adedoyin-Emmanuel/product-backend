<?php

class App
{

    public function __construct()
    {
    }

    public function get($route_path, callable $callback)
    {
        if (!isset($route_path) or !isset($callback)) {
            die("Route path or callback is required");
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            if ($_SERVER["REQUEST_URI"]  == $route_path and $_SERVER["REQUEST_URI"] == "/all_products") {
                echo $callback();
                header("Content-Type: application/json");
            }
        }
    }

    public function post($route_path, callable $callback)
    {
        if (!isset($route_path) or !isset($callback)) {
            die("Route path or callback is required");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if ($_SERVER["REQUEST_URI"]  == $route_path and $_SERVER["REQUEST_URI"] == "/add_product") {
            
                $product_name = $_POST["product_name"];
                $product_desc = $_POST["product_desc"];
                $product_img = $_POST["product_img"];
                $product_price = $_POST["product_price"];
                
                echo $callback($product_name, $product_desc, $product_img, $product_price);
                header("Content-Type: application/json");
            }
        }
    }



    public function delete($route_path, callable $callback)
    {
        if (!isset($route_path) or !isset($callback)) {
            die("Route path or callback is required");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if ($_SERVER["REQUEST_URI"]  == $route_path and $_SERVER["REQUEST_URI"] == "/delete") {
                $prams = $_POST["id"];
                echo $callback($prams);
                header("Content-Type: application/json");
            }
        }
    }
}
