<?php
include_once "header.php";
$path = __FILE__;
$file = basename($path, ".php");
session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $user_id = $user['id'];
    $user_name = $user['name'];
    $user_surname = $user['surname'];
    $user_email = $user['email'];
    $user_password = $user['password'];
    $user_photo = $user['photo'];
    $user_cover = $user['cover'];
    $user_about = $user['about'];
    $user_birthday = $user['birth'];
}
$kullanicisor=$db->prepare("SELECT * FROM user where email=:email");
$kullanicisor->execute(array(
  'email' => $_SESSION['email']
  ));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php"; ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class=" d-flex justify-content-center align-items-start">
                    <button type="button" class="btn btn-gofret m-2">Öğren</button>
                    <button type="button" class="btn btn-gofret2 m-2">Öğret</button>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card"></div>
                    </div>
                    <div class="col">
                        <div class="card"></div>
                    </div>
                    <div class="col">
                        <div class="card"></div>
                    </div>
                </div>
            </div>
            <?php include_once "right-sidebar.php"; ?>
        </div>
    </div>

</main>

<?php include_once "footer.php"; ?>