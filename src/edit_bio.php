<?php 
require_once "connect.php";
if (isset($_POST['bio'])) {
    $stmt= $conn->prepare("UPDATE user SET bio=:bio WHERE 1");
    $stmt->bindParam(':bio',$bio);
    $bio=$_POST['bio'];
    $stmt->execute();
    if ($stmt) {
        $conn=null;
        header("Location:../profile.php");
        exit;
    }

    $conn=null;
    header("Location:../profile.php");
    exit;

}
?>