<?php
require_once 'connect.php';
session_start();
$product_name = $_POST['product_name'];
$user_id = $_SESSION['user_id'];
$product_content = $_POST['product_content'];
$teachdrop2 = $_POST['teachdrop2'];
$learndrop2 = $_POST['learndrop2'];

$stmt = $conn->prepare("INSERT INTO product (product_name, user_id, product_content, category_id, price_category_id) VALUES ('$product_name', $user_id, '$product_content', $teachdrop2, $learndrop2)");
$stmt->execute();

header('Location: ../index.php');
exit;
?>