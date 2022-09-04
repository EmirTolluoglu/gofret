<?php
include "header.php";


if (empty($_SESSION['user_id']) or $_SESSION['user_id'] == "1") {
    header("Location:pre-register");
    exit;
}
if ($_GET['u'] == ".php") {
    $username = $_SESSION['user_name'];
} else {
    $username = $_GET['u'];
}
echo $username;
$realUser = $_SESSION['user_id'];
$realUserName = $_SESSION['user_name'];

$guestusersor = $conn->prepare("SELECT user_id FROM user WHERE user_name = '$username'");
$guestusersor->execute();
$guestuser = $guestusersor->fetch(PDO::FETCH_ASSOC);
$user_id = $guestuser['user_id'];

$ownProfile = false;
if ($user_id == $realUser) {
    $ownProfile = true;
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

$friendler = $conn->prepare("SELECT * FROM user_friend WHERE (friend_first_id = $user_id OR friend_second_id = $user_id) and friend_status = 'friends'");
$friendler->execute();
$friendlerResult = $friendler->setFetchMode(PDO::FETCH_ASSOC);
$friendlerResult = $friendler->fetchAll();
$friendlercount = count($friendlerResult);

$kendiArk = $conn->prepare("SELECT * FROM user_friend WHERE (friend_first_id = $realUser OR friend_second_id = $realUser) and friend_status = 'friends'");
$kendiArk->execute();
$kendiArkResult = $kendiArk->setFetchMode(PDO::FETCH_ASSOC);
$kendiArkResult = $kendiArk->fetchAll();

$ikimizResult = false;
$ortakArkIdler = array();
if (!$ownProfile) {
    foreach ($kendiArkResult as $ortakArk) {
        foreach ($friendlerResult as $friend) {
            if ($ortakArk['friend_first_id'] == $realUser) {
                $bubenolmayan = $ortakArk['friend_second_id'];
            } else if ($ortakArk['friend_first_id'] != $realUser) {
                $bubenolmayan = $ortakArk['friend_first_id'];
            }

            if ($friend['friend_first_id'] == $user_id) {
                $bubenolmayan2 = $friend['friend_second_id'];
            } else if ($ortakArk['friend_first_id'] != $user_id) {
                $bubenolmayan2 = $friend['friend_first_id'];
            }

            if (($realUser > $user_id && $friend['friend_first_id'] == $realUser && $friend['friend_second_id'] == $user_id) ||
                ($realUser < $user_id && $friend['friend_second_id'] == $realUser && $friend['friend_first_id'] == $user_id)
            ) {
                echo "arklar";
                $ikimizResult = true;
            }
            if ($bubenolmayan == $bubenolmayan2) {
                array_push($ortakArkIdler, $bubenolmayan2);
            }
        }
    }
}


$productstmt = $conn->prepare("SELECT * FROM product WHERE user_id = $user_id");
$productstmt->execute();
$products = $productstmt->fetchAll(PDO::FETCH_ASSOC);
$productscount = count($products);


$stmt2 = $conn->prepare("SELECT product_order.product_order_id,
fp.product_name AS first_product,
sp.product_name AS second_product,
fu.user_name AS first_user,
su.user_name AS second_user,
fu.user_profile_photo AS first_profile,
su.user_profile_photo AS second_profile,
fp.product_type AS first_statu,
sp.product_type AS second_statu

FROM product_order

INNER JOIN product AS fp
	ON product_order.product_first_id = fp.product_id
    
INNER JOIN product AS sp
	ON product_order.product_second_id = sp.product_id

INNER JOIN user AS fu
	ON fp.user_id = fu.user_id
    
INNER JOIN user AS su
	ON sp.user_id = su.user_id
    
WHERE su.user_id = $user_id OR fu.user_id = $user_id");
$stmt2->execute();
$guncelTakas = $stmt2->fetchAll(PDO::FETCH_ASSOC);


$stmt3 = $conn->prepare("SELECT product_order.product_order_id, 
fp.product_name AS first_product,
sp.product_name AS second_product,
fu.user_name AS first_user,
su.user_name AS second_user,
fu.user_profile_photo AS first_profile,
su.user_profile_photo AS second_profile,
fu.user_level AS first_level,
su.user_level AS second_level,
fp.product_type AS first_statu,
sp.product_type AS second_statu,
product_order.order_status AS order_status


FROM product_order

INNER JOIN product AS fp
	ON product_order.product_first_id = fp.product_id
    
INNER JOIN product AS sp
	ON product_order.product_second_id = sp.product_id

INNER JOIN user AS fu
	ON fp.user_id = fu.user_id
    
INNER JOIN user AS su
	ON sp.user_id = su.user_id
    
WHERE (su.user_id = $user_id OR fu.user_id = $user_id) AND NOT product_order.order_status = 'progress'");
$stmt3->execute();
$gecmisTakas = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <div class="app">


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
                                            } else { ?>
                                                <input type="submit" name="friend" <?php if ($ikimizResult) {
                                                                                        echo "disabled";
                                                                                    } ?> value="<?php if ($ikimizResult) {
                                                                                                echo "ztn";
                                                                                            } else {
                                                                                                echo $user['user_id'];
                                                                                            } ?>" class="btn btn-primary btn-sm">
                                                <input type="submit" name="follow" value="fol" class="btn btn-primary btn-sm">
                                                <input type="hidden" name="backurl" value="<?php echo "profile/" . $user['user_name']; ?>">
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="level d-flex justify-content-end pt-2 me-3">
                                <?php if ($ownProfile) {
                                    echo '<a href="src/logout.php"><i class="fa fa-sign-out"></i></a>';
                                } ?>
                                <p class="fs-5 mb-0 fw-bold text-name">lvl.<?php echo $user['user_level']; ?></p>
                                <div class="progress rounded-5 ms-3" style="height: auto; width: 8vw;">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $user['user_level_xp']; ?>%; background-color: rgb(233, 205, 84);" aria-valuenow="<?php echo $user['user_level_xp']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-around mt-4">
                                <div class="p-2 text-name"><a href="profile/<?php echo $user['user_name']; ?>/friends/"><?php echo $friendlercount; ?> arkadaş</a>
                                    <p class="fs-7 text-name-muted"><?php if (!$ownProfile) {
                                                                        echo count($ortakArkIdler) . " ortak arkadaş";
                                                                    } ?></p>
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


                    <script>
                        function showHint(str) {
                            if (str.length == 0) {
                                document.getElementById("txtHint").innerHTML = "";
                                return;
                            } else {
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("hint").innerHTML = this.responseText;
                                    }
                                }
                                xmlhttp.open("GET", "app/ajax/show-hint.php?q=" + str, true);
                                xmlhttp.send();
                            }
                        }
                    </script>
                    <div id="interests" class="card">
                        <form action="src/interests.php" method="POST">
                            <h6 class="text-name ms-2">İlgi Alanları</h6>
                            <div id="interests-group" class="handle d-flex flex-wrap justify-content-start text-white">

                                <?php for ($i = 0; $i < $user_interests_count; $i++) {

                                ?>
                                    <div class="interest">
                                        <p><?php echo $user_interests_values[$i]['user_interests_value']; ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="text" name="user_interests" class="interest" onkeyup="showHint(this.value)" placeholder="Yaz Bişiler" id="user_interest_input">
                                <div id="hint"></div>


                                <div class="d-flex justify-content-between bg-white mt-5 w-100">

                                    <input type="button" id="edit_interest" name="edit_interest" value="düzenle" style="height:2rem; background-color: #04cf98; width:5rem; border-radius: 0.8rem; margin-bottom:2em; border:0px;">

                                    <input type="submit" id="save_interest" name="user_interests_value" value="kaydet" style="height:2rem; background-color: #04cf98; width:5rem; border-radius: 0.8rem; margin-bottom:2em; border:0px;">

                                    <input type="button" id="add_interest" name="add_interest" value="ekle" style="height:2rem; background-color: #04cf98; width:5rem; border-radius: 0.8rem; margin-bottom:2em; border:0px;">
                                </div>
                        </form>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script>
                        var inputcount = 0;
                        $('#add_interest').click(function() {
                            inputcount++;
                            var interest = document.createElement('input');
                            interest.classList.add('interest');
                            interest.setAttribute("name", "interest" + inputcount);
                            $('#interests-group').append(interest);
                        })
                    </script>

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

        </div>
    </div>
    <?php include_once "right-sidebar.php" ?>
    </div>
    </div>

</main>

<?php include_once "footer.php" ?>