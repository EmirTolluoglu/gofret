<?php 
require_once "connect.php";
session_start();
if (isset($_POST['biography'])) {
    $stmt= $conn->prepare("UPDATE user SET user_biography=:biography WHERE user_id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(':biography',$biography);
    $id = $_SESSION['user_id'];
    $biography=$_POST['biography'];
    $stmt->execute();
    if ($stmt) {
        $conn=null;
        header("Location:../profile.php?u=". $_SESSION['user_name']);
        exit;
    }

    $conn=null;
    header("Location:../profile.php?u=". $_SESSION['user_name']);
    exit;

}
?>