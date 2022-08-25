<?php
require_once 'src/connect.php';

$requestler = [];
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
    user_requester.user_profile_photo AS requester_user_profile,
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
    $requestler = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt5 = $conn->prepare("SELECT COUNT(notification_id) AS not_count FROM notification WHERE user_id =" . $_SESSION['user_id'] . " AND is_readed = 0");
    $stmt5->execute();
    $onlyNot = $stmt5->fetch(PDO::FETCH_ASSOC);

    $stmt6 = $conn->prepare("SELECT COUNT(message_id) AS mes_count FROM message WHERE to_user_id =" . $_SESSION['user_id'] . " AND is_readed = 0");
    $stmt6->execute();
    $onlyMes = $stmt6->fetch(PDO::FETCH_ASSOC);
}
?>

<div id="left" class="col-xl-3 col-lg-3 col-md-4">
    <div class="mission text-center align-items-center g-3 w-100 container">
        <h5 class="text-gofret">Görevler</h5>
        <div class="reco-mission rounded-4 bg-white p-1">
            <?php if ($user_id) { ?>
                <h5 class="m-0">20 öğrenciyle tanış</h5>
                <div class="progress my-3 mx-auto rounded-5" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0">kalan 2</p>
            <?php } else {
                echo "<br/><br/><p>Heyy! Hala Giriş Yapmadın mı?</p><br/><br/>";
            } ?>
        </div>
    </div>

    <aside class="bg-white mt-4 rounded-4">
        <ul>
            <li class="<?php if (basename($_SERVER['REQUEST_URI']) == "gofret") {
                            echo "active";
                        } ?>"><a href="./"><i class="fa fa-home"></i><span>Ana Sayfa</span></a></li>
            <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'profile')) {
                            echo "active";
                        } ?>"><a href="profile"><i class="fa fa-heart"></i><span>Profile</span></a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "trades") {
                            echo "active";
                        } ?>"><a href="trades"><i class="fa fa-user"></i><span>Takaslarım</span></a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "notifications") {
                            echo "active";
                        } ?>"><a href="notifications"><i class="fa fa-bell"></i><span>Bildirimler</span>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <div class="mx-auto">
                            <div class="text-primary bg-white rounded-circle" style="width: 25px; height: 25px; position: relative;"><span class="mb-0" style="position: absolute; top: -11px; left: 7px;"><?= $onlyNot['not_count'] ?></span></div>
                        </div>
                    <?php } ?>
                </a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "message") {
                            echo "active";
                        } ?>"><a href="message"><i class="fa fa-comment-dots"></i><span>Mesajlar</span>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <div class="mx-auto">
                            <div class="text-primary bg-white rounded-circle" style="width: 25px; height: 25px; position: relative;"><span class="mb-0" style="position: absolute; top: -11px; left: 7px;"><?php if ($onlyMes['mes_count'] > 9) {
                                                                                                                                                                                                                echo "9+";
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo $onlyMes['mes_count'];
                                                                                                                                                                                                            } ?></span></div>
                        </div>
                    <?php } ?>
                </a></li>
        </ul>
    </aside>

    <div class="trade-request">
        <h5 class="text-gofret">Takas İstekleri</h5>
        <div class="card2 rounded-3 bg-white p-3 d-block" id="left-request">
            <?php if (count($requestler) == 0) {
                echo "<p>Burda Neden Hiçbirşey Yok Ki :(</p>";
            } else {
                foreach ($requestler as $request) {
                    $ogren = $request['requested_product_id'];
                    $ogret = $request['requester_product_id'];
                    $ogrenName = $request['requested_product'];
                    $ogretName = $request['requester_product'];
                    if ($request['requested_product_type'] == "teach") {
                        $ogret = $request['requested_product_id'];
                        $ogren = $request['requester_product_id'];
                        $ogrenName = $request['requester_product'];
                        $ogretName = $request['requested_product'];
                    }

                    $finished_user = "requester";
                    if ($request['requester_username'] == $_SESSION['user_name']) {
                        $finished_user = "requested";
                    }

            ?>
                    <div class="content row mb-3">
                        <div class="col-5 pe-0">
                            <p class="text-end"><?= $ogrenName ?></p>
                        </div>
                        <div class="col-2 text-center">
                            <i class="fa fa-arrows-turn-to-dots"></i>
                        </div>
                        <div class="col-5 ps-0 text-start ">
                            <p><?= $ogretName ?></p>
                        </div>
                        <div class="profile-card d-flex justify-content-between align-items-center">
                            <img class="border-0" src="<?= $request[$finished_user . '_user_profile'] ?>" alt="logo">
                            <div class="handle ms-2 w-100 text-left">
                                <div class="handle2 align">
                                    <p class="text-name fw-bold"><?= $request['requester_username'] ?></p>
                                </div>
                                <h6 class="fw-light text-name">9 ortak Ark.</h6>
                            </div>
                            <div class="confirmation d-flex" id="heyoo" data-product-request-id="<?= $request['product_request_id'] ?>" data-product-id="<?= $request['requester_product_id'] ?>" data-requested-id="<?= $request['requested_product_id'] ?>">
                                <button class="border-0 requestbtn-mini box me-1" value="s" style="background-color: #04cf98; color: black;"><i class="fa fa-check"> </i></button>
                                <button class="border-0 requestbtn-mini box ms-1" value="d" style="background-color: #fa0175; color: aliceblue;"><i class="fa fa-x"> </i></button>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        //jquery document ready
        $(document).ready(function() {
            if (<?php if($user_id == 0) { echo 0;} else {echo 1;}?>) {
                $(".requestbtn-mini").click(function() {
                    var requester_id = $(this).parent().attr("data-product-id");
                    var requested_id = $(this).parent().attr("data-requested-id");
                    var request_id = $(this).parent().attr("data-product-request-id");
                    $(this).parent().parent().parent().fadeOut(1600, "linear", function() {
                        $(this).remove();
                        if ($('#left-request').children().length == 0) {
                            $('#left-request').append('<div class="text-center"><p class="my-2 fs-6">Tüm istekler bitti mi?? :(</p></div>');

                        }

                    });

                    $.ajax({
                        type: "POST",
                        url: "app/ajax/send_request_result.php",
                        data: {
                            i: requester_id,
                            u: requested_id,
                            r: request_id,
                            t: $(this).val()
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                });
            }
        });
    </script>
</div>