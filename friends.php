<?php
include "header.php";

if (empty($_SESSION['user_id']) or $_SESSION['user_id'] == "1") {
    header("Location:pre-register.php");
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

//friend count
$friendstmt = $conn->prepare("SELECT * FROM user_friend WHERE (friend_first_id = $user_id or friend_second_id = $user_id) and friend_status = 'friends'");
$friendstmt->execute();
$friends = $friendstmt->fetchAll(PDO::FETCH_ASSOC);
$friendscount = count($friends);
echo $friendscount;
?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="card mt-0">
                    <h6 class="text-name ms-2">Arkadaşların</h6>
                    <div class="row">
                        <?php for ($i=0; $i < $friendscount; $i++) { 
                        ?>
                        <div class="col-4 text-center fw-bold">
                            <img class="img-fluid" src="<?php echo $friendsuserresult['user_profile_photo']; ?>" alt="profile" >
                            <a href="<?php echo "profile/" . $friendsuserresult['user_name']; ?>"><?php echo $friendsuserresult['user_name']; ?></a>
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