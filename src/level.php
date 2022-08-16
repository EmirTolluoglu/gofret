<?php 
require_once "connect.php";
session_start();

if (isset($_POST['levelU']) || isset($_POST['levelD'])) {
    $stmt = $conn->prepare("SELECT user_level, user_level_xp FROM user WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $user_id = $_SESSION['user_id'];
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_level_xp = $result['user_level_xp'];
    $user_level = $result['user_level'];
    $user_quantity = $_POST['quantity'];
    
    if (isset($_POST['levelU'])) {
        $user_level_xp += $user_quantity;
    }elseif (isset($_POST['levelD'])) {
        $user_level_xp -= $user_quantity;
    }
    
    if ($user_level_xp >= 100) {
        $user_level_xp -= 100;
        $user_level += 1;
    }elseif ($user_level_xp < 0) {
        $user_level_xp += 100;
        $user_level -= 1;
    }

    if ($user_level < 1) {
        $user_level = 1;
        $user_level_xp = 0;
    }

    $stmt = $conn->prepare("UPDATE user SET user_level = $user_level, user_level_xp = $user_level_xp WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $user_id = $_SESSION['user_id'];
    $stmt->execute();

    Header("Location:../index.php");
    exit;
}

?>