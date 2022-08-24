<?php include_once "header.php";
$user_id = 0;
$orders = [];
$finished_orders = [];
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT product_request.product_request_id,
    product_request.requested_product_id AS requested_product_id,
    product_requested.product_name AS requested_product,
    product_requested.product_type AS requested_product_type,
    product_requester.product_name AS requester_product, 
    product_requester.product_id AS requester_product_id, 
    product_requester.product_type AS requester_product_type,
    user_requester.user_name AS requester_username, 
    user_requester.user_profile_photo AS requester_user_profile_photo,
    user_requester.user_level AS requester_level 

    FROM product_request 

    INNER JOIN product AS product_requested 
        ON product_request.requested_product_id=product_requested.product_id 
        
    INNER JOIN product AS product_requester 
        ON product_request.product_id=product_requester.product_id 

    INNER JOIN user AS user_requested
        ON product_requested.user_id=user_requested.user_id 
        
    INNER JOIN user AS user_requester 
        ON product_requester.user_id=user_requester.user_id 

    WHERE user_requested.user_id = $user_id AND product_request.product_request_statu = 0
    ORDER BY product_request.product_request_time ASC");
    $stmt->execute();
    $requests2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    $orders = $stmt2->fetchAll(PDO::FETCH_ASSOC);


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
    $finished_orders = $stmt3->fetchAll(PDO::FETCH_ASSOC);
}
?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                <div id="trade-requests" class="mb-5">
                    <a>Takas İstekleri (2) <i class="fa fa-caret-down"></i></a>
                    <?php if (count($requestler) == 0) {
                        echo '<div class="text-center" style="height: 75px;"><p class="my-5 fs-5">Hala Takasların Yok mu?? :(</p></div>';
                    } else {
                        foreach ($requests2 as $request) {

                            $ogren = $request['requested_product_id'];
                            $ogret = $request['requester_product_id'];
                            $ogrenName = $request['requested_product'];
                            $ogretName = $request['requester_product'];
                            $benogretiyorum = false;
                            if ($request['requested_product_type'] == "teach") {
                                $ogret = $request['requested_product_id'];
                                $ogren = $request['requester_product_id'];
                                $ogrenName = $request['requester_product'];
                                $ogretName = $request['requested_product'];
                                $benogretiyorum = true;
                            }

                    ?>
                            <div class="handle" data-request-id="<?= $request['product_request_id'] ?>">
                                <div class="card my-0">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $request['requester_user_profile_photo'] ?>" alt="PP" class="border-1 profile-photo s3 me-2">
                                        <div class="me-5">
                                            <h6 class="mb-0 fs-7 text-name"><?= $request['requester_username'] ?></h5>
                                                <!-- <p class="fs-7 mb-0 text-name"> Ortak Arkadaş</p> -->
                                        </div>
                                        <div class="d-flex content align-items-center">
                                            <div class="learn" data-product-id="<?= $ogren ?>">
                                                <h6 class="gtext-secondary text-center mb-0">Öğren<?php if (!$benogretiyorum) {
                                                                                                        echo "(you)";
                                                                                                    } ?></h6>
                                                <p class="mb-0 text-center"><?= $ogrenName ?></p>
                                            </div>
                                            <i class="fa fa-arrow-right-arrow-left mx-3"></i>
                                            <div class="teach" data-product-id="<?= $ogret ?>">
                                                <h6 class="gtext-secondary text-center mb-0">Öğret<?php if ($benogretiyorum) {
                                                                                                        echo "(you)";
                                                                                                    } ?></h6>
                                                <p class="mb-0 text-center"><?= $ogretName ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end me-4">
                                    <button class="requestbtn btn btn-gofret text-light pup-50 mx-2" value="a">İletişime Geç</button>
                                    <button class="btn btn-danger requestbtn text-light pup-50" style="width: 2rem; height: 2rem;" value="d"><i></i></button>

                                </div>

                            </div>
                    <?php }
                    } ?>
                </div>

                <div id="current-trades" class="mb-5">
                    <a>Güncel Takaslar (1) <i class="fa fa-caret-down"></i></a>
                    <?php if (count($orders) == 0) {
                        echo '<div class="text-center" style="height: 75px;"><p class="my-5 fs-5">Hala Takasların Yok mu?? :(</p></div>';
                    }else {
                    foreach ($orders as $order) {
                        $ogren = 'first';
                        $ogret = 'second';
                        if ($order['first_statu'] == "teach") {
                            $ogren = 'second';
                            $ogret = 'first';
                        }
                    ?>
                        <div class="card text-center pt-0 mt-2 border border-secondary">
                            <p class="fs-7">Online / Kalan ders Sayısı: 2/5</p>
                            <div class="row">
                                <div class="col">
                                    <div class="mx-auto text-center">
                                        <img src="<?= $order[$ogren . '_profile'] ?>" alt="burak" class="border-1 profile-photo s3 mb-3">
                                        <h6 class="mb-0"><?= $order[$ogren . '_user'] ?></h6>
                                        <?php if ($order[$ogren . '_user'] == $_SESSION['user_name']) {
                                            echo "<p>(you)</p>";
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex content align-items-center">
                                        <div class="learn">
                                            <h6 class="gtext-secondary text-center mb-0"><u>Öğren</u></h6>
                                            <p class="mb-0 text-center"><?= $order[$ogren . '_product'] ?></p>
                                        </div>
                                        <i class="fa fa-arrow-right-arrow-left mx-3"></i>
                                        <div class="teach">
                                            <h6 class="gtext-secondary text-center mb-0"><u>Öğret</u></h6>
                                            <p class="mb-0 text-center"><?= $order[$ogret . '_product'] ?></p>
                                        </div>
                                    </div>
                                    <div style="outline: none;" class="btn bg-main text-name fw-bold w-100 my-2 p-1 border-0">Mesaj Gönder!</div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-gofret text-light fs-6 fw-bold me-2">Onayla</div>
                                        <div class="btn btn-danger text-light" style="width: 2rem; height: 2rem;">
                                            <i></i>
                                        </div>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="mx-auto text-center">
                                        <img src="<?= $order[$ogret . '_profile'] ?>" alt="pp" class="border-1 profile-photo s3 mb-3">
                                        <h6 class="mb-0"><?= $order[$ogret . '_user'] ?></h6>
                                        <?php if ($order[$ogret . '_user'] == $_SESSION['user_name']) {
                                            echo "<p>(you)</p>";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
                </div>

                <div id="trade-history">

                    <a>Geçmiş Takaslar (2) <i class="fa fa-caret-down"></i></a>
                    <?php if (count($finished_orders) == 0) {
                        echo '<div class="text-center" style="height: 75px;"><p class="my-5 fs-5">Hala Geçmiş Takasların Yok mu?? :(</p></div>';
                    } else { ?>
                        <div class="card border border-secondary">
                            <?php foreach ($finished_orders as $finished_order) {
                                $finished_user = "first";
                                if ($finished_order['first_user'] == $_SESSION['user_name']) {
                                    $finished_user = "second";
                                }

                                $ogren = 'first';
                                $ogret = 'second';
                                if ($order['first_statu'] == "teach") {
                                    $ogren = 'second';
                                    $ogret = 'first';
                                }

                            ?>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <img src="<?= $finished_order[$finished_user . "_profile"] ?>" alt="pp" class="border-1 profile-photo s5">
                                    <div class="d-flex flex-column ms-2 me-auto">
                                        <h6 class="mb-0 text-name"><?= $finished_order[$finished_user . "_user"] ?></h6>
                                        <div>
                                            <p class="d-inline text-light rounded-4 px-2" style="background-color: green;">lvl. <?= $finished_order[$finished_user . "_level"] ?></p>
                                        </div>
                                        <p class="mb-0 gtext-secondary2 fs-8">5/5 - matematik</p>
                                    </div>
                                    <div class="mx-auto">
                                        <p class="gtext-secondary2 fw-bold mb-0"><u>Tamamlandı</u></p>
                                        <i class="fa fa-certificate"></i>
                                        <p class="d-inline ms-2 text-name">120 Xp</p>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="gtext-secondary me-3 mb-0"><u>Öğren</u></h6>
                                            <p class="mb-0 w-50"><?= $finished_order[$ogren . "_product"] ?></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <h6 class="gtext-secondary me-3 mb-0"><u>Öğret</u></h6>
                                            <p class="mb-0 w-50"><?= $finished_order[$ogret . "_product"] ?></p>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>
</main>
<!-- add jsquery from internet -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
    //jquery document ready
    $(document).ready(function() {
        $(".requestbtn").click(function() {
            $(this).parent().parent().fadeOut(1600, "linear", function() {
                $(this).remove();
                if ($('#trade-requests').children().length == 0) {
                    $('#trade-requests').append('<div class="text-center" style="height: 75px;"><p class="my-5 fs-5">Hala İstekleriniz Yok mu?? :(</p></div>');
                }
            });
            var yardimci = $(this).parent().parent().children().children().children('.content');

            $.ajax({
                type: "POST",
                url: "app/ajax/send_request_result.php",
                data: {
                    i: yardimci.children('.teach').attr('data-product-id'),
                    u: yardimci.children('.learn').attr('data-product-id'),
                    r: $(this).parent().parent().attr('data-request-id'),
                    t: $(this).val()
                },
                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>
<?php include_once "footer.php" ?>