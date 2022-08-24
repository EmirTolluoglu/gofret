<?php 

include '../../src/connect.php';

$trade_id = $_POST['i'];
$trade_id2 = $_POST['u'];
if($trade_id > $trade_id2){
    $trade_id = $trade_id2;
    $trade_id2 = $_POST['u'];
}
$request_id = $_POST['r'];
$request_state = $_POST['t'];

if($request_state == "s"){

    $stmt = $conn->prepare("INSERT INTO product_order (product_first_id, product_second_id, order_status) VALUES ($trade_id, $trade_id2, 'progress')");
    $stmt->execute();


    $stmt2 = $conn->prepare("UPDATE product_request SET product_request_statu = 1 WHERE product_request_id = $request_id");
    $stmt2->execute();
}else if($request_state == "d"){
    //delete request
    $stmt3 = $conn->prepare("DELETE FROM product_request WHERE product_request_id = $request_id");
    $stmt3->execute();
}


echo $request_state. "success";

?>