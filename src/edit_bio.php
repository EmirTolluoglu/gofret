<?php 
require_once "connect.php";
session_start();
if (isset($_POST['biography'])) {
    $stmt= $conn->prepare("UPDATE user SET biography=:biography WHERE id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(':biography',$biography);
    $id = $_SESSION['user_id'];
    $biography=$_POST['biography'];
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