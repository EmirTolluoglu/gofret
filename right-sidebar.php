<?php

if (isset($_SESSION['user_id'])) {
    $stmt2 = $conn->prepare("SELECT product_order.product_order_id,
    fp.product_name AS first_product,
    sp.product_name AS second_product,
    fu.user_name AS first_user,
    su.user_name AS second_user,
    fu.user_profile_photo AS first_profile,
    fu.user_level AS first_level,
    fu.user_level AS second_level,
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
    $orders = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div id="right" class="col-xl-3 col-lg-3">
    <div id="profile-card" class="badge-handle">
        <div class="side-card rounded-4">
            <div class="banner" style="background-image: url(<?= $user_id ? $_SESSION['user_profile_banner'] : "img/default_banner.jpg"; ?>)">
                <img src="<?= $user_id ? $_SESSION['user_profile_photo'] : "img/default_photo.jpg"; ?>" class="mx-auto img2" alt="Profile Photo">
            </div>
            <h5 class="mt-5 name"><?= $user_id ? $_SESSION['user_name'] : "Sen Kimsin?"; ?></h5>
            <div class="level">
                <p class="mb-0">lvl.<?= $user_id ? $_SESSION['user_level'] : "?"; ?></p>
                <div class="progress rounded-5" style="height: 1.2rem;">
                    <div class="progress-bar" role="progressbar" style="width: <?= $user_id ? $_SESSION['user_level_xp'] : "43"; ?>%; background-color: rgb(233, 205, 84);" aria-valuenow="<?= $user_id ? $_SESSION['user_level_xp'] : "43"; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <p class="desc">il muhtarı<br>****<br></p>
            <hr class="mx-auto mb-1">
            <p class="text-center my-0">başarımlar</p>
        </div>
        <div class="badge-container p-2">
            <?php if ($user_id) {
                for ($i = 0; $i < $userbadgecount; $i++) {

            ?>
                    <div class="badge"><i class="fa-regular fa-<?= $badges[$i]['badge_pic']; ?> fa-2x"></i></div>
            <?php }
            } ?>
        </div>
    </div>
    <div class="current-trades text-center align-items-center g-3 w-100 container">
        <h6 class="text-gofret">Güncel Takaslar</h6>
        <div class="card-back rounded-4 bg-white p-3">
            <?php if ($user_id) {
                foreach ($orders as $order) {
                    $finished_user = "first";
                    if ($order['first_user'] == $_SESSION['user_name']) {
                        $finished_user = "second";
                    }
            ?>
                    <div class="card2">
                        <img src="<?= $order[$finished_user . "_profile"] ?>" alt="pp">
                        <div class="handle ms-2 w-100">
                            <div class="handle2">
                                <p><?= $order[$finished_user . "_user"] ?></p>
                                <p class="m-0">lvl.<?= $order[$finished_user . "_level"] ?></p>
                            </div>
                            <div>
                                <a href="product/<?= $order[$finished_user . "_product"] ?>" style="text-align: left;"><?= $order[$finished_user . "_product"] ?></a>
                            </div>
                        </div>
                    </div>
            <?php }
            } else { echo "<br><br>Giriş Yapmadan nasıl Takasların Olucak ki?<br><br"; }?>
        </div>
    </div>
</div>