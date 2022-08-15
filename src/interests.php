<?php 
require_once "connect.php";
session_start();
if (isset($_POST['user_interests_value'])) {
    $stmt= $conn->prepare("INSERT INTO user_interests (user_id, user_interests_value) VALUES (:user_id, :user_interests_value)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(':user_interests_value',$user_interests_value);
    $user_id = $_SESSION['user_id'];
    $user_interests_value=$_POST['user_interests_value'];
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