<?php
require_once "connect.php";
session_start();

$message_content = $_POST['message'];
$to_user_id = $_POST['to_user_id'];
$from_user_id = $_POST['from_user_id'];

$stmt = $conn->prepare("INSERT INTO message (from_user_id, to_user_id, message_content) VALUES ($to_user_id, $from_user_id, '$message_content')");
$stmt->execute();

if ($stmt) {
    echo '                    <ul class="people">
    <li class="person" data-chat="person1">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/thomas.jpg" alt="" />
        <span class="name">Thomas Bangalter</span>
        <span class="time">2:09 PM</span>
        <span class="preview">I was wondering...</span>
    </li>
</ul>';
} else {
    echo "fail";
}
$conn = null;
exit;
