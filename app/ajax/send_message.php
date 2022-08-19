<?php
include '../../src/connect.php';
session_start();

$from_user_id = $_SESSION['user_id'];
$to_user_id = $_POST["u"];
$message_content = $_POST['v'];
$stmt = $conn->prepare("INSERT INTO message (message_content, from_user_id, to_user_id) VALUES (:message_content , :from_user_id, :to_user_id)");
$stmt->bindParam(':message_content', $message_content);
$stmt->bindParam(':from_user_id', $from_user_id);
$stmt->bindParam(':to_user_id', $to_user_id);
$stmt->execute();
echo "s";
?>