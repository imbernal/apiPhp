<?php
header('Access-Control-Allow-Origin: *');
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/manufacture.php';

//class instance

$database = new Database();

$db = $database->getConnection();

$manufacture = new Manufacture($db);

//read al users
$results = $manufacture->readAll();

echo $results;
