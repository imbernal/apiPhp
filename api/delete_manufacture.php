<?php
header('Access-Control-Allow-Origin: *');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

  include_once '../config/core.php';
  include_once '../config/database.php';
  include_once '../objects/manufacture.php';

  $database = new Database();
  $db = $database->getConnection();
  $manufacture = new Manufacture($db);

  echo $manufacture->delete($_POST['id']) ? "true" : 'false';
}
