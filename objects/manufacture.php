<?php

class Manufacture{
  // db connection and table name
  private $conn;
  private $table_name = 'manufactures';


  //object properties
  public $id;
  public $name;
  public $country;
  public $dropship;

  public function __construct($db){
    $this->conn = $db;
  }

  public function readAll()
  {
      //select all data
      $query = "SELECT id, name, country, dropship FROM manufactures ORDER BY id";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      $manufactures = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return json_encode($manufactures);
  }

  public function create()
  {
      try {
          // insert query
          $query = "INSERT INTO manufactures
      SET name=:name, country=:country, dropship=:dropship";

          // prepare statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $name = htmlspecialchars(strip_tags($this->name));
          $country = htmlspecialchars(strip_tags($this->country));
          $dropship = htmlspecialchars(strip_tags($this->dropship));

          // bind the parameters
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':country', $country);
          $stmt->bindParam(':dropship', $dropship);


          // Execute the query
          if ($stmt->execute()) {
              return true;
          } else {
              return false;
          }
      } //show error if any
      catch (PDOException $exception) {
          die('ERROR: ' . $exception->getMessage());
      }
  }

  public function delete($ins)
  {
      // query to delete multiple records
      $query = "DELETE FROM manufactures WHERE id =:ins";
      $stmt = $this->conn->prepare($query);

      // sanitize
      $ins = htmlspecialchars(strip_tags($ins));

      // binding
      $stmt->bindParam(':ins', $ins);

      if ($stmt->execute()) {
          return true;
      } else {
          return false;
      }
  }

  public function update()
  {
      $query = "UPDATE manufactures SET name=:name, country=:country, dropship=:dropship WHERE id=:id";

      $stmt = $this->conn->prepare($query);

      // sanitize
      $id = htmlspecialchars(strip_tags($this->id));
      $name = htmlspecialchars(strip_tags($this->name));
      $country = htmlspecialchars(strip_tags($this->country));
      $dropship = htmlspecialchars(strip_tags($this->dropship));

      $stmt->bindParam(':id', $id);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':country', $country);
      $stmt->bindParam(':dropship', $dropship);

      if ($stmt->execute()) {
          return true;
      } else {
          return false;
      }
  }

  public function readOne()
  {
      $query = "SELECT m.id, m.name, m.country, m.dropship
      FROM " . $this->table_name . " m
      LEFT JOIN manufactures m
        ON m.manufacture_id=m.id
      WHERE m.id = :id";

      $stmt = $this->conn->prepare($query);
      $id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return json_encode($results);
  }
}
