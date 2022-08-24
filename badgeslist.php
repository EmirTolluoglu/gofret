<?php
include "header.php";

if (empty($_SESSION['user_id']) or $_SESSION['user_id'] == "1") {
    header("Location:pre-register");
    exit;
}

if (isset($_GET['u'])) {
    $username = $_GET['u'];
    $guestusersor = $conn->prepare("SELECT user_id FROM user WHERE user_name = '$username'");
    $guestusersor->execute();
    $guestuser = $guestusersor->fetch(PDO::FETCH_ASSOC);
    $user_id = $guestuser['user_id'];
}

$kullanicisor = $conn->prepare("SELECT * FROM user where user_id=$user_id");
$kullanicisor->execute();
$user = $kullanicisor->fetch(PDO::FETCH_ASSOC);

$guestbadgesor = $conn->prepare("SELECT * FROM user_badge WHERE user_id = $user_id");
$guestbadgesor->execute();
$guestbadges = $guestbadgesor->setFetchMode(PDO::FETCH_ASSOC);
$guestbadges = $guestbadgesor->fetchAll();
$guestbadgecount = count($guestbadges);


?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="card mt-0">
                    <h6 class="text-name ms-2"><?php if($_SESSION['user_name'] == $user['user_name']) {echo "Senin rozetlerin";}else{echo $user['user_name'] . "'nin rozetleri";} ?> </h6>
                    <div class="row">
                        <?php for ($i=0; $i < $guestbadgecount; $i++) { 
                            $badge_id = $guestbadges[$i]['badge_id'];
                            $realbadgesor = $conn->prepare("SELECT * FROM badge WHERE badge_id = $badge_id");
                            $realbadgesor->execute();
                            $realbadges = $realbadgesor->setFetchMode(PDO::FETCH_ASSOC);
                            $realbadges = $realbadgesor->fetch();
                        ?>
                        <div class="col-4 text-center fw-bold mt-3">
                            <i style="color: #<?php echo $realbadges['badge_color']; ?>;" class="fa fa-<?php echo $realbadges['badge_pic']; ?> fa-lg fs-1 mt-4"></i>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>

</main>

<?php include_once "footer.php" ?>