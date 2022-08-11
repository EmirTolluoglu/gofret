<?php 
require_once 'connect.php';
session_start();

if (isset($_POST['signup'])) {
  $stmt1 = $conn->prepare("SELECT * FROM user WHERE email = :email");
  $stmt1->bindParam(':email', $email);
  $email = $_POST['email'];
  $stmt1->execute();
  $user = $stmt1->fetch(PDO::FETCH_ASSOC);
if ($user) {
  Header("Location:../register.php");
  exit;
}
// prepare sql and bind parameters
$stmt = $conn->prepare("INSERT INTO user (name, email, password)
VALUES (:name, :email, :password)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashed_password);

// insert a row
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->execute();

if ($stmt) {

    Header("Location:../index.php");
    exit;

} else {

    //echo "kayıt başarısız";
    Header("Location:../register.php");
    exit;
}
}

if (isset($_POST['login'])) {


    $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

  if($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        Header("Location:../index.php");
        exit;
    } else {
        Header("Location:../login.php");
        exit;
    }
  } else {
    Header("Location:../login.php");
    exit;
  }
}

$conn = null;
?>