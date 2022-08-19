<?php include_once "header.php";

$stmt = $conn->prepare('SELECT 
product_request.product_request_id, 
product_requested.product_name AS requested_product,
product_requested.product_type AS requested_product_type,
product_requester.product_name AS requester_product,
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

WHERE user_requested.user_id = 38 
ORDER BY product_request.product_request_time ASC');

$stmt->execute();
$requests2 = $stmt->fetchAll(PDO::FETCH_ASSOC);


// $realUser = $_SESSION['user_id'];
// $kendiArk = $conn->prepare("SELECT * FROM product Where product_user_id = 38");
// echo $kendiArk->rowCount();
// $kendiArk->execute();
// $kendiArkResult = $kendiArk->setFetchMode(PDO::FETCH_ASSOC);
// $kendiArkResult = $kendiArk->fetchAll();

?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-7 col-lg-6 col-md-8">
                <div id="trade-requests" class="mb-5">
                    <a>Takas İstekleri (2) <i class="fa fa-caret-down"></i></a>
                    <div class="handle">
                        <?php foreach ($requests2 as $request) {

                            $requestedProductIsTeach = 0;
                            if($request['requested_product_type'] == "teach"){
                                $requestedProductIsTeach = 1;
                            }
                        ?>
                            <div class="card my-0">
                                <div class="d-flex align-items-center">
                                    <img src="<?= $request['requester_user_profile_photo'] ?>" alt="PP" class="border-1 profile-photo s3 me-2">
                                    <div class="me-5">
                                        <h6 class="mb-0 fs-7 text-name"><?= $request['requester_username'] ?></h5>
                                            <!-- <p class="fs-7 mb-0 text-name"> Ortak Arkadaş</p> -->
                                    </div>
                                    <div class="d-flex content align-items-center">
                                        <div class="learn">
                                            <h6 class="gtext-secondary text-center mb-0"><u>Öğren<?php if($requestedProductIsTeach) {echo "(you)";} ?></u></h6>
                                            <p class="mb-0 text-center"><?php if ($requestedProductIsTeach) {
                                                                            echo $request['requested_product'];
                                                                        } else {
                                                                            echo $request['requester_product'];
                                                                        } ?></p>
                                        </div>
                                        <i class="fa fa-arrow-right-arrow-left mx-3"></i>
                                        <div class="teach">
                                            <h6 class="gtext-secondary text-center mb-0"><u>Öğret<?php if(!$requestedProductIsTeach) {echo "(you)";} ?></u></h6>
                                            <p class="mb-0 text-center"><?php if ($requestedProductIsTeach) {
                                                                            echo $request['requester_product'];
                                                                        } else {
                                                                            echo $request['requested_product'];
                                                                        } ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end me-4">
                                <div class="btn btn-gofret text-light pup-50 mx-2">İletişime Geç</div>
                                <div class="btn btn-danger text-light pup-50" style="width: 2rem; height: 2rem;"><i></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="current-trades" class="mb-5">
                    <a>Güncel Takaslar (1) <i class="fa fa-caret-down"></i></a>
                    <div class="card text-center pt-0 mt-2 border border-secondary">
                        <p class="fs-7">Online / Kalan ders Sayısı: 2/5</p>
                        <div class="row">
                            <div class="col">
                                <div class="mx-auto text-center">
                                    <img src="img/pp2.jpg" alt="burak" class="border-1 profile-photo s3 mb-3">
                                    <h6>Zeynep Erşen</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex content align-items-center">
                                    <div class="learn">
                                        <h6 class="gtext-secondary text-center mb-0"><u>Öğren</u></h6>
                                        <p class="mb-0 text-center">Instagram Post Tasarımı</p>
                                    </div>
                                    <i class="fa fa-arrow-right-arrow-left mx-3"></i>
                                    <div class="teach">
                                        <h6 class="gtext-secondary text-center mb-0"><u>Öğret</u></h6>
                                        <p class="mb-0 text-center">Matematik / Parabol</p>
                                    </div>
                                </div>
                                <div style="outline: none;" class="btn bg-main text-name fw-bold w-100 my-2 p-1 border-0">Mesaj Gönder!</div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn btn-gofret text-light fw-bold me-2">Dersi Onayla</div>
                                    <div class="btn btn-danger text-light" style="width: 2rem; height: 2rem;">
                                        <i></i>
                                    </div>
                                </div>

                            </div>

                            <div class="col">
                                <div class="mx-auto text-center">
                                    <img src="img/pp1.jpg" alt="burak" class="border-1 profile-photo s3 mb-3">
                                    <h6>Burak Gümrah</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="trade-history">
                    <a>Geçmiş Takaslar (2) <i class="fa fa-caret-down"></i></a>
                    <div class="card border border-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <img src="img/pp2.jpg" alt="burak" class="border-1 profile-photo s5">
                            <div class="d-flex flex-column ms-2 me-auto">
                                <h6 class="mb-0 text-name">Zeynep Erşen</h6>
                                <div>
                                    <p class="d-inline text-light rounded-4 px-2" style="background-color: green;">lvl.12</p>
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
                                    <p class="mb-0 w-50">Instagram Post Tasarımı</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="gtext-secondary me-3 mb-0"><u>Öğret</u></h6>
                                    <p class="mb-0 w-50">Matematik / Parabol</p>
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