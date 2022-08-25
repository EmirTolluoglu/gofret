<?php
include '../../src/connect.php';
session_start();

$user_id = $_POST['u'];
//get messages from user and order by date

$stmt = $conn->prepare("SELECT * FROM message WHERE (to_user_id =".$user_id." OR from_user_id =".$_SESSION['user_id'].") AND (to_user_id =".$_SESSION['user_id']." OR from_user_id =".$user_id.") ORDER BY message_date ASC");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>