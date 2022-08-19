<?php 
require_once 'src/connect.php';

$stmt = $conn->prepare('SELECT * FROM product_request where user_id='.$_SESSION['user_id']);
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $requests2 = array();
// foreach ($requests as $request) {
//     $stmt = $conn->prepare('SELECT * FROM product where product_id='.$request['product_id']);
//     $stmt->execute();
//     $product = $stmt->fetch(PDO::FETCH_ASSOC);
//     $request['product'] = $product;
//     $requests2[] = $request;
// }
// $stmt2 = $conn->prepare('SELECT * FROM product where product_id='.$requests);
// $stmt2->execute();
// $requests = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="left" class="col">
    <div class="mission text-center align-items-center g-3 w-100 container">
        <h5 class="text-gofret">Görevler</h5>
        <div class="reco-mission rounded-4 bg-white p-1">
            <h5 class="m-0">20 öğrenciyle tanış</h5>
            <div class="progress my-3 mx-auto rounded-5" style="height: 20px;">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mb-0">kalan 2</p>
        </div>

    </div>

    <aside class="bg-white mt-4 rounded-4">
        <ul>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "index" or basename($_SERVER['REQUEST_URI'], ".php") == "profile") {
                            echo "active";
                        } ?>"><a href="index.php"><i class="fa fa-home"></i><span>Ana Sayfa</span></a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "discover") {
                            echo "active";
                        } ?>"><a href="discover.php"><i class="fa fa-heart"></i><span>Keşfet</span></a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "trades") {
                            echo "active";
                        } ?>"><a href="trades.php"><i class="fa fa-user"></i><span>Takaslarım</span></a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "notifications") {
                            echo "active";
                        } ?>"><a href="notifications.php"><i class="fa fa-bell"></i><span>Bildirimler</span></a></li>
            <li class="<?php if (basename($_SERVER['REQUEST_URI'], ".php") == "message") {
                            echo "active";
                        } ?>"><a href="message.php"><i class="fa fa-comment-dots"></i><span>Mesajlar</span></a></li>
        </ul>
    </aside>

    <div class="trade-request">
        <h5 class="text-gofret">Takas İstekleri</h5>
        <div class="card2 rounded-3 bg-white p-3 d-block">
            <?php foreach ($requests as $request) {
                $myProductStmt = $conn->prepare('SELECT * FROM product where product_id='.$request['product_id']);
                $myProductStmt->execute();
                $myProduct = $myProductStmt->fetch(PDO::FETCH_ASSOC);

                $otherProductStmt = $conn->prepare('SELECT * FROM product where product_id='.$request['requested_product_id']);
                $otherProductStmt->execute();
                $otherProduct = $otherProductStmt->fetch(PDO::FETCH_ASSOC);
                
                $otherUserStmt = $conn->prepare('SELECT * FROM user where user_id='.$otherProduct['user_id']);
                $otherUserStmt->execute();
                $otherUser = $otherUserStmt->fetch(PDO::FETCH_ASSOC);
                ?>
            <div class="content row mb-3">
                <div class="col-5 pe-0">
                    <p class="text-end"><?= $myProduct['product_name'] ?></p>
                </div>
                <div class="col-2 text-center">
                    <i class="fa fa-arrows-turn-to-dots"></i>
                </div>
                <div class="col-5 ps-0 text-start ">
                    <p><?= $otherProduct['product_name'] ?></p>
                </div>
                <div class="profile-card d-flex justify-content-between align-items-center">
                    <img class="border-0" src="<?= $otherUser['user_profile_photo'] ?>" alt="logo">
                    <div class="handle ms-2 w-100 text-left">
                        <div class="handle2 align">
                            <p class="text-name fw-bold"><?= $otherUser['user_name'] ?></p>
                        </div>
                        <h6 class="fw-light text-name">9 ortak Arkadaş</h6>
                    </div>
                    <div class="confirmation d-flex">
                        <button class="border-0 box me-1" style="background-color: #04cf98; color: black;"><i class="fa fa-check"> </i></button>
                        <button class="border-0 box ms-1" style="background-color: #fa0175; color: aliceblue;"><i class="fa fa-x"> </i></button>
                    </div>
                </div>
            </div>
             <?php } ?>
        </div>
    </div>

</div>