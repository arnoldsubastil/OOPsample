<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$orders = new Order($db);
 
// query products
$stmt = $orders->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $products_arr=array();
    $products_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $product_item=array(
            "order_id" => $order_id,
            "customer_name" => $customer_name,
            "customer_email" => $customer_email,
            "product_list" => $product_list,
            "product_id" => $product_id,
            "cart_id" => $cart_id,
            "order_num" => $order_num,
            "dateorder" => $dateorder,
            "order_sum" => $order_sum,
            "dateadded" => $dateadded
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>