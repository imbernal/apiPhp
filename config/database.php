<?php

class Database{
  //credentials
  private $host = 'localhost';
  private $db_name = 'apiphp';
  private $username = 'root';
  private $password = '';
  public $conn;

  //get database connection
  public function getConnection(){
    $this->conn = null;

    try {
      $this->conn= new PDO("mysql:host=" . $this->host .";dbname=" . $this->db_name, $this->username , $this->password);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $this->conn;
  }


}
