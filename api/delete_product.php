<?php
header('Access-Control-Allow-Origin: *');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

  include_once '../config/core.php';
  include_once '../config/database.php';
  include_once '../objects/product.php';

  $database = new Database();
  $db = $database->getConnection();
  $product = new Product($db);
  var_dump($_POST['id']);
  echo $product->delete($_POST['id']) ? "true" : 'false';
}
