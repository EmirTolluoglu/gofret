<?php 
require_once "connect.php";
session_start();

if (isset($_POST['levelU']) || isset($_POST['levelD'])) {
    $stmt = $conn->prepare("SELECT level,level_xp FROM user WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $id = $_SESSION['user_id'];
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $level_xp = $result['level_xp'];
    $level = $result['level'];
    $quantity = $_POST['quantity'];
    
    if (isset($_POST['levelU'])) {
        $level_xp += $quantity;
    }elseif (isset($_POST['levelD'])) {
        $level_xp -= $quantity;
    }
    
    if ($level_xp >= 100) {
        $level_xp -= 100;
        $level += 1;
    }elseif ($level_xp < 0) {
        $level_xp += 100;
        $level -= 1;
    }

    if ($level < 1) {
        $level = 1;
        $level_xp = 0;
    }

    $stmt = $conn->prepare("UPDATE user SET level = $level, level_xp = $level_xp WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $id = $_SESSION['user_id'];
    $stmt->execute();

    Header("Location:../index.php");
    exit;
}

?>