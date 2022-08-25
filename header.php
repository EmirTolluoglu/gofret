<?php
ob_start();
session_start();
include 'src/connect.php';
$user_id = 0;
$mobil = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $kullanicisor = $conn->prepare("SELECT * FROM user where user_id=$user_id");
    $kullanicisor->execute();
    $user = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    $userbadgesor = $conn->prepare("SELECT * FROM user_badge WHERE user_id = $user_id");
    $userbadgesor->execute();

    // set the resulting array to associative
    $userbadges = $userbadgesor->setFetchMode(PDO::FETCH_ASSOC);
    $userbadges = $userbadgesor->fetchAll();
    $userbadgecount = count($userbadges);

    $badge_id = array();
    if ($userbadgecount >= 3) {
        $userbadgecount = 3;
    }
    for ($i = 0; $i < $userbadgecount; $i++) {
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
    <base href="http://localhost/gofret/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gofret | Keşfet</title>
</head>

<body>
    <header>
        <div class="container">
            <a href=""><img id="head-logo" src="img/gofret.png" alt="Gofret" width="96" height="36"></a>
            <div id="search-bar" class="search-bar">
                <i class="fa fa-magnifying-glass"></i>
                <input onfocusout="focusgg()" id="search_input" type="search" placeholder="Search for creators, inspirations, and projects">
            </div>

            <a href="<?php if ($user_id) {
                            echo "create-product";
                        } ?>">
                <div class="btn btn-gofret <?php if (!$user_id) {
                                                echo "btn-gofret-disabled";
                                            } ?>">
                    <p>Takas Oluştur</p><i class="fa fa-arrow-right-arrow-left"></i>
                </div>
            </a>
            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="<?= $user_id ? $_SESSION['user_profile_photo'] : "img/default_photo.jpg"; ?>" alt="fef" />
                </div>
                <div class="menu">
                    <h3><?php if (isset($_SESSION['user_id'])) {
                            echo $user['user_name'];
                        } ?><br /><span>İl Muhtarı</span></h3>
                    <ul>
                        <li>
                            <i class="fa fa-user"></i><a href="<?= $user_id ? "profile/" . $_SESSION['user_name'] : "pre-register" ?>">Proflim</a>
                        </li>
                        <li>
                            <i class="fa fa-suitcase"></i><a href="trades">Takaslar</a>
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
            <a href="message" class="text-decoration-none"><i class="fa-solid fa-comment-dots text-muted"></i></a>
        </div>
    </header>
    <?php include 'preloader.php'; ?>
    <?php if (!$user_id) { ?>
        <div class="pop-back">
            <div class="pop-up" id="pop-up">
                <div class="content">
                    <div class="container">
                        <div class="dots">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                        <span class="close" onclick="closePopUpMenu()">close</span>
                        <div class="title">
                            <h1>Beta?</h1>
                        </div>

                        <img src="img/gofret_vec.webp" alt="Car">

                        <div class="subscribe">
                            <h1>Gofretin Tadına Bakmak için <span>Giriş Yap</span> :|</h1>

                            <a href="login"><button class="btn btn-gofret me-2 fs-3">Giriş</button></a>
                            <a href="register"><button class="btn btn-gofret2 fs-3">Kayıt Ol</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>