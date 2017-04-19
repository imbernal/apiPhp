<?php
header('Access-Control-Allow-Origin: *');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

  include_once '../config/core.php';
  include_once '../config/database.php';
  include_once '../objects/product.php';


  $database = new Database();
  $db = $database->getConnection();
  $product = new Product($db);


  $product->name = $_POST["name"];
  $product->price = $_POST["price"];
  $product->description = $_POST["description"];
  

  echo $product->create() ? "true" : "false";

}
