<?php 
require_once '../../src/connect.php';
session_start();

$product = $_POST['u'];
$stmt = $conn->prepare("SELECT product_name, product_id FROM product WHERE product_id =".$product);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);
?>