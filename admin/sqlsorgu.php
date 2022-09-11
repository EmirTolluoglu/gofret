<?php
require_once "../src/connect.php";
$sqlsorugsu = $_POST['sqlqu'];

$stmt = $conn->prepare($sqlsorugsu);
$stmt->execute();
if($stmt){
header("Location: admin.php?durum=ok");
}else {
    header("Location: admin.php?durum=no");
}
exit;