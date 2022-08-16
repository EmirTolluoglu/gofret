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

$user_interests_valuesor = $conn->prepare("SELECT user_interests_value FROM user_interests WHERE user_id = :user_id");
$user_interests_valuesor->bindParam(':user_id', $user_id);
$user_interests_valuesor->execute();

$user_interests_values = $user_interests_valuesor->setFetchMode(PDO::FETCH_ASSOC);
$user_interests_values = $user_interests_valuesor->fetchAll();
$user_interests_count = count($user_interests_values);


$guestbadgesor = $conn->prepare("SELECT * FROM user_badge WHERE user_id = $user_id");
$guestbadgesor->execute();

// set the resulting array to associative
$guestbadges = $guestbadgesor->setFetchMode(PDO::FETCH_ASSOC);
$guestbadges = $guestbadgesor->fetchAll();
$guestbadgecount = count($guestbadges);
$realguestbadgecount = count($guestbadges);
$guestbadge_id = array();
if ($guestbadgecount >= 3) {
    $guestbadgecount = 3;
}
for ($i = 0; $i < $guestbadgecount; $i++) {
    array_push($guestbadge_id, $guestbadges[$i]['badge_id']);
}
$guestbadgesor = $conn->prepare("SELECT * FROM badge WHERE badge_id = :badge_id1 OR badge_id = :badge_id2 OR badge_id = :badge_id3");
$guestbadgesor->bindParam(':badge_id1', $guestbadge_id[0]);
$guestbadgesor->bindParam(':badge_id2', $guestbadge_id[1]);
$guestbadgesor->bindParam(':badge_id3', $guestbadge_id[2]);
$guestbadgesor->execute();
$guestbadges = $guestbadgesor->setFetchMode(PDO::FETCH_ASSOC);
$guestbadges = $guestbadgesor->fetchAll();

$realUser = $_SESSION['user_id'];
$realUserName = $_SESSION['user_name'];
$friendler = $conn->prepare("SELECT * FROM user_friend WHERE (friend_first_id = $user_id OR friend_second_id = $user_id) and friend_status = 'friends'");
$ikimiz = $conn->prepare("SELECT * FROM user_friend WHERE ((friend_first_id = $user_id OR friend_second_id = $user_id) and (friend_first_id = $realUser OR friend_second_id = $realUser)) and friend_status = 'friends'");
$friendler->execute();
$ikimiz->execute();
$ikimizResult= $ikimiz->setFetchMode(PDO::FETCH_ASSOC);
$ikimizResult= $ikimiz->fetchAll();
count($ikimizResult);
$friendlerResult = $friendler->setFetchMode(PDO::FETCH_ASSOC);
$friendlerResult = $friendler->fetchAll();
$friendlercount = count($friendlerResult);

$productstmt = $conn->prepare("SELECT * FROM product WHERE user_id = $user_id");
$productstmt->execute();
$products = $productstmt->fetchAll(PDO::FETCH_ASSOC);
$productscount = count($products);

?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="badge-handle">
                    <div class="side-card rounded-4 bg-white">
                        <div class="banner" style="background-image: url(<?php echo $user['user_profile_banner']; ?>)">
                            <div class="profile-card">
                                <img src="<?php echo $user['user_profile_photo']; ?>" alt="Profile Photo">
                                <div class="card-section">
                                    <h4 class="text-name font-monospace"><?php echo $user['user_name']; ?></h4>
                                    <p class="school gtext-secondary fs-7"><?php echo $user['user_school']; ?><br><?php echo $user['user_city']; ?></p>
                                    <p class="degree text-name"><?php echo $user['user_class']; ?>.sınıf</p>
                                    <form action="src/user_com.php" method="GET" class="position-absolute">
                                        <?php if ($realUserName == $user['user_name']) { 
                                            echo "<input type='submit' class='btn btn-primary' value='Kendi Profilini Düzenle' name='edit'>";
                                        } else { ?>
                                        <input type="submit" name="friend" <?php if ($ikimizResult){echo "disabled";} ?> value="<?php if ($ikimizResult){echo "ztn";}else {echo $user['user_id'];} ?>" class="btn btn-primary btn-sm">
                                        <input type="submit" name="follow" value="fol" class="btn btn-primary btn-sm">
                                        <input type="hidden" name="backurl" value="<?php echo "profile/" . $user['user_name'];?>">
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="level d-flex justify-content-end pt-2 me-3">
                            <p class="fs-5 mb-0 fw-bold text-name">lvl.<?php echo $user['user_level']; ?></p>
                            <div class="progress rounded-5 ms-3" style="height: auto; width: 8vw;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $user['user_level_xp']; ?>%; background-color: rgb(233, 205, 84);" aria-valuenow="<?php echo $user['user_level_xp']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-around mt-4">
                            <div class="p-2 text-name"><a href="profile/<?php echo $user['user_name']; ?>/friends/"><?php echo $friendlercount; ?> arkadaş</a>
                                <!-- <p class="fs-7 text-name-muted">20 ortak arkadaş</p> -->
                            </div>
                            <!-- <div class="p-2 gtext-secondary">57 tamamlanmış takas</div> -->
                            <div class="p-2 gtext-secondary"><a href="profile/<?php echo $user['user_name']; ?>/product/"><?php echo $productscount; ?> takas</a></div>

                            <div class="p-2 gtext-secondary"><a href="profile/<?php echo $user['user_name']; ?>/badges/"> <?php echo $realguestbadgecount; ?> Rozet</a></div>
                        </div>
                    </div>
                    <div class="badge-container me-4 h-25">
                        <?php for ($i = 0; $i < $guestbadgecount; $i++) { ?>
                            <div class="badge mx-1"><i class="fa fa-<?php echo $guestbadges[$i]['badge_pic']; ?> fa-3x"></i></div>
                        <?php } ?>
                    </div>
                </div>



                <div id="about" class="card mt-0">
                    <h6 class="text-name ms-2">Hakkında</h6>

                    <form action="src/edit_bio.php" method="POST">
                        <textarea id="biography" class="input w-100" rows="7" maxlength="420" name="biography" oninput="benimfonksiyon()"><?php echo $user['user_biography']; ?></textarea>
                        <br>
                        <input id="biobtn" disabled type="submit" value="Kaydet">
                        <script>
                            function benimfonksiyon() {
                                document.getElementById("biobtn").disabled = false;
                            }
                        </script>
                    </form>
                </div>



                <div id="interests" class="card">
                    <h6 class="text-name ms-2">İlgi Alanları</h6>
                    <div class="handle d-flex flex-wrap justify-content-start text-white">

                        <?php for ($i = 0; $i < $user_interests_count; $i++) {

                        ?>
                            <div>
                                <p><?php echo $user_interests_values[$i]['user_interests_value']; ?></p>
                            </div>
                        <?php
                        }
                        ?>

                        <div>


                            <form id="interests_Form" action="src/interests.php" method="POST">

                                <input name="user_interests_value" id="interest_button" class="card" type="text" style="width: 100px; height:auto;">

                                <input onclick="add_new_interests()" type="submit" value="ekle">

                        </div>
                        </form>
                        <script>
                            var interest = document.getElementById("interests_Form");

                            function add_new_interests() {
                                interest.classList.add("d-none")


                            }
                        </script>

                    </div>
                    <p><br><br><br><br><br></p>
                </div>
                <div id="trade" class="row">
                    <div class="col" style="height: 100%;">
                        <h5 class="text-name m-0">Güncel Takaslar</h5>
                        <div class="card mt-2">
                            <p><br><br><br><br><br></p>
                        </div>
                    </div>
                    <div class="col" style="height: 100%;">
                        <h5 class="text-name m-0">Geçmiş Takaslar</h5>
                        <div class="card mt-2">
                            <p><br><br><br><br><br></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>

</main>

<?php include_once "footer.php" ?>