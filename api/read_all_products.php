<?php
header('Access-Control-Allow-Origin: *');
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/product.php';

//class instance

$database = new Database();

$db = $database->getConnection();

$product = new Product($db);

//read al products
$results = $product->readAll();

echo $results;
