<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));
 

$product->product_category = $data->product_category;
$product->product_name = $data->product_name;
$product->product_price = $data->product_price;
 
if($product->create()){
    echo '{';
        echo '"message": "Product was created."';
    echo '}';
}
 
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}
?>