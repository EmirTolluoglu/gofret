<?php 
require_once 'connect.php';
session_start();

if (isset($_POST['signup'])) {
  $stmt1 = $conn->prepare("SELECT * FROM user WHERE user_email = :email");
  $stmt1->bindParam(':email', $email);
  $email = $_POST['email'];
  $stmt1->execute();
  $user = $stmt1->fetch(PDO::FETCH_ASSOC);
if ($user) {
  Header("Location:../register.php");
  exit;
}
// prepare sql and bind parameters
$stmt = $conn->prepare("INSERT INTO user (user_name, user_email, user_password, user_biography, user_school, user_class, full_name)
VALUES (:name, :email, :password, :biography, :user_school, :user_class, :full_name)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':biography', $biography);
$stmt->bindParam(':user_school', $user_school);
$stmt->bindParam(':user_class', $user_class);
$stmt->bindParam(':full_name', $full_name);
$stmt->bindParam(':password', $hashed_password);
// insert a row
$full_name = ucwords($_POST['name']);
$name = strtolower(replace_tr($_POST['name']));
$email = $_POST['email'];
$user_school = ucwords($_POST['user_school']);
$user_class = $_POST['user_class'];
$password = $_POST['password'];
$biography = "Merhaba benim adım " .$name .".";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->execute();

if ($stmt) {

    Header("Location:../login");
    exit;

} else {

    //echo "kayıt başarısız";
    Header("Location:../register.php");
    exit;
}
}

if (isset($_POST['login'])) {


    $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = :email");
    $stmt->bindParam(':email', $email);
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  


  if($stmt->rowCount() > 0) {
    $user = $stmt->fetch();
    if (password_verify($password, $user['user_password']) && $user['permissin'] != 0) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_level'] = $user['user_level'];
        $_SESSION['user_level_xp'] = $user['user_level_xp'];
        $_SESSION['user_profile_photo'] = $user['user_profile_photo'];
        $_SESSION['user_profile_banner'] = $user['user_profile_banner'];
        $_SESSION['admin'] = $user['permissin'];

        Header("Location:../index.php");
        exit;
    } else {
        Header("Location:../login");
        exit;
    }
  } else {
    Header("Location:../login");
    exit;
  }
}

$conn = null;
?>