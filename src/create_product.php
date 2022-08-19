<?php
require_once 'connect.php';

$stmt = $conn->prepare('INSERT INTO product (product_name, product_content, product_price, category_id) VALUES (?, ?, ?, ?)');
$stmt->execute([$_POST['product_name'], $_POST['product_content'], $_POST['price'], $_POST['category_id']]);

?>