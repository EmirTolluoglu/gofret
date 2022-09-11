<?php

require_once "../src/connect.php";
$durum = $_POST['durum'];
$idsi = $_POST['userin_id'];

if($durum == "kabul")
{
    $stmt = $conn->prepare("UPDATE user SET permissin = 1 WHERE user_id = $idsi");
    $stmt->execute();
} else if($durum == "red") {
    $stmt3 = $conn->prepare("DELETE FROM user WHERE user_id = $idsi");
    $stmt3->execute();
} else if($durum == "admin") {
    $stmt = $conn->prepare("UPDATE user SET permissin = 2 WHERE user_id = $idsi");
    $stmt->execute();
}
header("Location: admin.php");
exit;
?>