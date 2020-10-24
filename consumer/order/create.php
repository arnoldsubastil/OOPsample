<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/order.php';
 
$database = new Database();
$db = $database->getConnection();
 
$order = new Order($db);
 
$data = json_decode(file_get_contents("php://input"));
 

$order->customer_name = $data->customer_name;
$order->customer_email = $data->customer_email;
$order->dateorder = $data->dateorder;
$order->product_id = $data->product_id;
$order->cart_id = $data->cart_id;
 

if($order->create()){
    echo '{';
        echo '"message": "Product/s was created."';
    echo '}';
}
 
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}

// query products
$stmt = $order->readcart($data->cart_id);
$num = $stmt->rowCount();
 
if($num>0){
 
    $products_arr=array();
    $products_arr["records"]=array();
    $mailstring = '<table>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $new_customer_name = $customer_name;
        $new_customer_email = $customer_email;
        $new_dateorder = $dateorder;
        $new_dateadded = $dateadded;
        $mailstring .= '<tr><td>'.$product_name.'</td><td>'.$product_price.'</td></tr>';   
    }
 
    $mailstring .= '</table>';

    $mailstring = 'Order Summary<br>
    Name: '.$new_customer_name.'<br>
    Email: '.$new_customer_email.'<br>
    Delivery Date: '.$new_dateorder.'<br>
    Order Date: '.$new_dateadded.'<br>' . $mailstring;

    // echo $mailstring;
    $to =  $new_customer_email;
    $subject = "Gold Card membership Renewal";

    $headers  = 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
    $headers .= "From: Test Mailer <arnold.subastil@gmail.com>\r\nReply-To: noreply@forthmedia.net";


    $message = $mailstring;

        $mail_sent = mail( $to, $subject, $message, $headers );
}
 
 



?>