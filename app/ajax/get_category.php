<?php
include '../../src/connect.php';
session_start();

$parent_category_id=$_POST["v"];
$stmt = $conn->prepare("SELECT category_id,category_name FROM category WHERE parent_category_id = $parent_category_id");
$stmt->execute();
$categories = $stmt->fetchAll();

foreach ($categories as $category) {
    echo '<option value=' . $category['category_id'] . '>' . $category['category_name'] . '</option>';
}
?>