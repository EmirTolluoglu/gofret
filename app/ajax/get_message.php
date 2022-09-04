<?php
include '../../src/connect.php';
session_start();

$user_id = $_POST['u'];
$realUser = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT *,CURRENT_TIMESTAMP() AS today FROM message WHERE (to_user_id =$user_id AND from_user_id =$realUser) OR (to_user_id =$realUser AND from_user_id =$user_id) ORDER BY message_date ASC");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>