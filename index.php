<?php

require_once("./controllers/product.controller.php");


$my_product = new Product();

$my_product->create("test", "test", "test", "test");
