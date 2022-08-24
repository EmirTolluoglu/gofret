<?php 
include 'connect.php';

$myprodut = $_POST['my_product'];
$thisProduct = $_POST['this_product'];

$stmt = $conn->prepare("INSERT INTO product_request (product_id, requested_product_id) VALUES ($myprodut, $thisProduct)");
$stmt->execute();
header("Location: ../index.php");
exit;

?>