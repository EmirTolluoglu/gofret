<?php

require_once "../src/connect.php";
session_start();

if (!(isset($_SESSION['user_id'])) || $_SESSION['admin'] != 2) {
    header("Location: ../index");
    exit;
}

$stmt = $conn->prepare("SELECT product.product_name,product.product_id,product.product_content,product.category_id,product.product_type, user.user_name, category.category_name FROM product 

INNER JOIN user
	ON user.user_id = product.user_id

INNER JOIN category 
	On category.category_id = product.category_id");
$stmt->execute();
$poducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>productler</title>
</head>
<body>
    <style>
        table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
    </style>
    <table>
        <tr>
            <th>Id</th>
            <th>Ad</th>
            <th>içerik</th>
            <th>kimin</th>
            <th>katagorisi</th>
            <th>type</th>
        </tr>

        <?php foreach ($poducts as $poduct) { ?>
            <tr>
                <td><?= $poduct['product_id'] ?></td>
                <td><?= $poduct['product_name'] ?></td>
                <td><?= $poduct['product_content'] ?></td>
                <td><?= $poduct['user_name'] ?></td>
                <td><?= $poduct['category_name'] ?></td>
                <td><?= $poduct['product_type'] ?></td>
            </tr>
        <?php } ?>
    <table>
    <?php include "sqlqueryinput.php"; ?>
</body>
</html>