<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_products";
 
    // object properties
    public $product_id;
    public $product_category;
    public $product_name;
    public $product_price;
    public $dateadded;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT p.product_id, p.product_category, c.category_name, p.product_name, p.product_price, p.dateadded FROM " . $this->table_name . " AS p INNER JOIN tbl_category AS c ON p.product_category = c.category_id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
    function create(){
 
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET product_category=:product_category, product_name=:product_name, product_price=:product_price, dateadded=NOW()";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->product_category=htmlspecialchars(strip_tags($this->product_category));
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
        $this->product_price=htmlspecialchars(strip_tags($this->product_price));
        $this->dateadded=htmlspecialchars(strip_tags($this->dateadded));
     
        // bind values
        $stmt->bindParam(":product_category", $this->product_category);
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":product_price", $this->product_price);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->product_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                product_category = :product_category,
                product_name = :product_name,
                product_price = :product_price
                WHERE
                product_id = :product_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->product_category=htmlspecialchars(strip_tags($this->product_category));
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
        $this->product_price=htmlspecialchars(strip_tags($this->product_price));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
    
        // bind new values
        $stmt->bindParam(':product_category', $this->product_category);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':product_price', $this->product_price);
        $stmt->bindParam(':product_id', $this->product_id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = ? LIMIT 0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->product_id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->product_id = $row['product_id'];
        $this->product_category = $row['product_category'];
        $this->product_name = $row['product_name'];
        $this->product_price = $row['product_price'];
        $this->dateadded = $row['dateadded'];
    }
}