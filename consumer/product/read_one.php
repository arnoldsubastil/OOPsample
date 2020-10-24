<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// set ID property of product to be edited
$product->product_id = isset($_POST['product_id']) ? $_POST['product_id'] : die();
 
// read the details of product to be edited
$product->readOne();
 
// create array
$product_arr = array(
    "product_id" =>  $product->product_id,
    "product_category" => $product->product_category,
    "product_name" => $product->product_name,
    "product_price" => $product->product_price,
    "dateadded" => $product->dateadded
 
);
 
// make it json format
print_r(json_encode($product_arr));
?>