<?php
class Product{
  // db connection and table name
  private $conn;
  private $table_name = 'products';

  //object properties
  public $id;
  public $name;
  public $price;
  public $description;
  public $manufacture_id;

  public $timestamp;

  public function __construct($db){
    $this->conn = $db;
  }

  public function create(){
    try{
      $query = "INSERT INTO products
        SET name=:name, description=:description, price=:price,created=:created, manufacture_id=:manufacture_id";

      // prepare statement
      $stmt = $this->conn->prepare($query);

      //sanatize
      $name = htmlspecialchars(strip_tags($this->name));
      $description = htmlspecialchars(strip_tags($this->description));
      $price = htmlspecialchars(strip_tags($this->price));
      $manufacture_id = htmlspecialchars(strip_tags($this->manufacture_id));


      $stmt->bindParam(':name' ,$name);
      $stmt->bindParam(':description' ,$description);
      $stmt->bindParam(':price' ,$price);
      $stmt->bindParam(':manufacture_id' ,$manufacture_id);


      $created = date('Y-m-d H:i:s');
      $stmt->bindParam(":created" , $created);

      if($stmt->execute()){
        return true;
      }else{
        return false;
      }
    }
    catch(PDOException $e){
      die('ERROR: ' . $e->getMessage());
    }
  }

  public function delete($id){

    try {

      //query
      $query = "DELETE FROM products WHERE id =:id";

      $stmt = $this->conn->prepare($query);

      //  sanatize

      $ins = htmlspecialchars(strip_tags($id));

      //binding

      $stmt->bindParam(':id' , $id);


      if($stmt->execute()){
        return true;
      }else {
        return false;
      }

    } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
    }

  }

  public function readAll(){
    $query = "SELECT p.id,p.name,p.price,p.description FROM " . $this->table_name . "
    p";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($products);
  }

  public function update(){
    try {

      $query = "UPDATE products SET name=:name, description=:description, price=:price
      WHERE id=:id" ;

      $stmt = $this->conn->prepare($query);

      //sanatize
      $name = htmlspecialchars(strip_tags($this->description));
      $description = htmlspecialchars(strip_tags($this->description));
      $price = htmlspecialchars(strip_tags($this->price));

      $id = htmlspecialchars(strip_tags($this->id));

      $stmt->bindParam(':name' ,$name);
      $stmt->bindParam(':description' ,$description);
      $stmt->bindParam(':price' ,$price);

      $stmt->bindParam(':id' ,$id);

      if($stmt->execute()){
        return true;
      }else{
        return false;
      }

    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage());
    }



  }

  public function readOne($id){

    $query = "SELECT p.id,p.name,p.price,p.description, m.name  FROM " . $this->table_name . "
    p WHERE p.id = :id";

    $stmt = $this->conn->prepare($query);

    $id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':id' , $id);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($results);

  }

  public function productByManufacture(){
    $query = "SELECT p.id,p.name,p.price,p.description FROM " . $this->table_name . "
    p JOIN manufactures m ON m.id = p.manufacture_id WHERE m.id=:manufacture_id";

    $stmt = $this->conn->prepare($query);

    $manufacture_id = htmlspecialchars(strip_tags($this->manufacture_id));

    $stmt->bindParam(':manufacture_id' , $manufacture_id);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($results);
  }

}
