<?php
class Order{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_orders";
 
    // object properties
    public $order_id;
    public $customer_name;
    public $customer_email;
    public $product_id;
    public $cart_id;
    public $dateadded;
 
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){
        $query = "SELECT *,GROUP_CONCAT(p.product_name SEPARATOR ',') AS product_list, COUNT(o.product_id) AS order_num, SUM(p.product_price) AS order_sum FROM " . $this->table_name . " AS o INNER JOIN tbl_products AS p ON p.product_id = o.product_id GROUP BY o.cart_id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function readcart($cart){
        $query = "SELECT * FROM " . $this->table_name . " AS o INNER JOIN tbl_products AS p ON p.product_id = o.product_id WHERE o.cart_id=:cart_id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":cart_id", $cart);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
    
    function create(){
        
        // var_dump($this->product_id);
        $product_ids = explode(',',$this->product_id);

        foreach($product_ids as $singlekey){

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET customer_name=:customer_name, customer_email=:customer_email, product_id=:product_id, cart_id=:cart_id, dateorder=:dateorder, dateadded=NOW()";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // bind values
        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":customer_email", $this->customer_email);
        $stmt->bindParam(":product_id", $singlekey);
        $stmt->bindParam(":cart_id", $this->cart_id);
        $stmt->bindParam(":dateorder", $this->dateorder);
     
        // execute query
        $stmt->execute();

        }
     

            return true;
        // return false;
         
    }

}

?>