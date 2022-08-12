<?php 
ob_start();
session_start();
include 'src/connect.php';

if(isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    $kullanicisor=$conn->prepare("SELECT * FROM user where id=$userid");
    $kullanicisor->execute();
    $user=$kullanicisor->fetch(PDO::FETCH_ASSOC);

    $userbadgesor = $conn->prepare("SELECT * FROM user_badge WHERE user_id = $userid");
    $userbadgesor->execute();

    // set the resulting array to associative
    $userbadges = $userbadgesor->setFetchMode(PDO::FETCH_ASSOC);
    $userbadges = $userbadgesor->fetchAll();
    $userbadgecount = count($userbadges);

    $badge_id = array();
    if($userbadgecount >= 3){$userbadgecount = 3;}
    for ($i=0; $i < $userbadgecount; $i++) { 
        array_push($badge_id, $userbadges[$i]['badge_id']);
    } 
    $badgesor = $conn->prepare("SELECT * FROM badge WHERE badge_id = :badge_id1 OR badge_id = :badge_id2 OR badge_id = :badge_id3");
    $badgesor->bindParam(':badge_id1', $badge_id[0]);
    $badgesor->bindParam(':badge_id2', $badge_id[1]);
    $badgesor->bindParam(':badge_id3', $badge_id[2]);
    $badgesor->execute();

    // set the resulting array to associative
    $badges = $badgesor->setFetchMode(PDO::FETCH_ASSOC);
    $badges = $badgesor->fetchAll();

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/ico.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/reset.min.css">
    <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gofret | Keşfet</title>
</head>

<body>

    <nav>
        <div class="container">
            <a href=""><img id="head-logo" src="img/gofret.png" alt="Gofret" width="96" height="36"></a>
            <div id="search-bar" class="search-bar">
                <input onfocusout="focusgg()" id="search_input" type="search" placeholder="Search for creators, inspirations, and projects">
                <i class="fa fa-magnifying-glass"></i>
            </div>
            <div id="primary-icons" class="primary justify-content-center align-items-center">
                <a href=""><i class="fa fa-home"></i></a>
                <a href=""><i class="fa fa-heart"></i></a>
                <a href=""><i class="fa fa-user"></i></a>
                <a href=""><i class="fa fa-bell"></i></a>
                <a href=""><i class="fa fa-comment-dots"></i></a>
                <button onclick="helllo()" class="search" href=""><i class="fa fa-magnifying-glass"></i></button>
            </div>
            <div class="btn btn-gofret">Takas Oluştur</div>
            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="<?php if(isset($_SESSION['user_id'])) {echo $user['profile_photo'];} ?>" alt="fef" />
                </div>
                <div class="menu">
                    <h3><?php if(isset($_SESSION['user_id'])) {echo $user['name'];} ?><br /><span>İl Muhtarı</span></h3>
                    <ul>
                        <li>
                            <i class="fa fa-user"></i><a href="profile.php">Proflim</a>
                        </li>
                        <li>
                            <i class="fa fa-suitcase"></i><a href="trades.php">Takaslar</a>
                        </li>
                        <li>
                            <i class="fa fa-users"></i><a href="#">Arkadaşlar</a>
                        </li>
                        <li>
                            <i class="fa fa-cogs"></i><a href="#">Ayarlar</a>
                        </li>
                        <li><i class="fa fa-info-circle"></i><a href="#">Yardım</a></li>
                        <li>
                            <i class="fa fa-sign-out"></i><a href="src/logout.php">Çıkış</a>
                        </li>
                    </ul>
                </div>
            </div>
            <script>
                function menuToggle() {
                    const toggleMenu = document.querySelector(".menu");
                    toggleMenu.classList.toggle("active");
                }
            </script>
        </div>
    </nav>