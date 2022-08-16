<?php 
require_once "connect.php";
session_start();

if (isset($_GET['friend'])) {    
    $backurl = $_GET['backurl'];
    $user_id = $_SESSION['user_id'];
    $friend_id = $_GET['friend'];
    $friend_first_id = max($user_id, $friend_id);
    $friend_second_id = min($user_id, $friend_id);
    $friend_test = $conn->prepare("SELECT friend_status FROM user_friend WHERE friend_first_id = $friend_first_id AND friend_second_id = $friend_second_id");
    $friend_test->execute();
    $friend_test_result = $friend_test->setFetchMode(PDO::FETCH_ASSOC);
    $friend_test_result = $friend_test->fetchAll();
    $friend_test_count = count($friend_test_result);
    if ($friend_test_count == 0) {
        $friend_status = '';
        if ($user_id == $friend_first_id) {
            $friend_status = 'pending_first_second';
        }else{
            $friend_status = 'pending_second_first';
        }
        $friend_insert = $conn->prepare("INSERT INTO user_friend (friend_first_id, friend_second_id, friend_status) VALUES ($friend_first_id, $friend_second_id , '$friend_status')");
        $friend_insert->execute();
        header("Location:../" . $backurl);
        exit;
    }else{
        $friend_status = $friend_test_result[0]['friend_status'];
        if ($friend_status == 'pending_first_second' && $user_id == $friend_second_id) {
            $friend_status = 'friends';
        }else{

            header("Location:../" . $backurl);
            exit;
        }
        $friend_update = $conn->prepare("UPDATE user_friend SET friend_status = '$friend_status' WHERE friend_first_id = $friend_first_id AND friend_second_id = $friend_second_id");
        $friend_update->execute();
        header("Location:../" . $backurl);
        exit;
    }

}
?>