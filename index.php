<?php

require_once("./controllers/product.controller.php");


$my_product = new Product();


$status = $my_product->get();

echo $status;



