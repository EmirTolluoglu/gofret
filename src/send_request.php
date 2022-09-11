<?php 
include 'connect.php';

$myprodut = $_POST['my_product'];
$thisProduct = $_POST['this_product'];
$myMessage = $_POST['message_c'];

$stmt = $conn->prepare("INSERT INTO product_request (product_id, requested_product_id) VALUES ($myprodut, $thisProduct)");
$stmt->execute();

$stmt2 = $conn->prepare("SELECT 

myUser.user_id AS My, 
youUser.user_id AS You 

FROM message

INNER JOIN user AS myUser
	ON message.from_user_id = myUser.user_id
    
 INNER JOIN user AS youUser
	ON message.to_user_id = youUser.user_id
    
INNER JOIN product AS myProduct
	ON myProduct.product_id = $myprodut
    
 INNER JOIN product AS youProduct
	ON youProduct.product_id = $thisProduct
    
");
$stmt2->execute();
$prdct = $stmt2->fetch(PDO::FETCH_ASSOC);
$you = $prdct['You'];
$my = $prdct['My'];
$stmt = $conn->prepare("INSERT INTO `message`(`from_user_id`, `to_user_id`, `message_content`, `message_product_quatation_id`, `message_product_quat_id`) 
VALUES ($my,$you,'$myMessage','$thisProduct','$myprodut')");
$stmt->execute();

header("Location: ../message/$you");
exit;

?>