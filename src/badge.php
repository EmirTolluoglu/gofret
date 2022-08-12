<?php 
require_once "connect.php";
session_start();

// if(isset($_POST['add']) || true){
    $badgesor=$conn->prepare("INSERT INTO user_badge (user_id,badge_id) VALUES (:user_id,:badge_id)");
    $badgesor->bindParam(':user_id',$user_id);
    $badgesor->bindParam(':badge_id',$badge_id);
    $user_id=$_SESSION['user_id'];
    $badge_id=1;
    $badgesor->execute();
// }
?>