<?php 

session_start();

if (isset($_SESSION['user_id'])) {
    session_destroy();
}
$_SESSION['user_id'] = 1;
header("Location:../login.php");

?>