<?php
include_once "header.php";

$stmt = $conn->prepare("SELECT *,CURRENT_TIMESTAMP() AS today FROM notification WHERE user_id =" . $_SESSION['user_id'] . " ORDER BY notification_date DESC");
$stmt->execute();
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <style>
        #notifications .not-message {
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #555;
            font-weight: 500;
            transition: 0.5s;
            cursor: pointer;
        }

        #notifications .not-message:hover {
            background: #f5f5f5;
        }
    </style>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                <div class="card flex-column" id="notifications">
                    <h6>Yakın Zaman</h6>

                    <?php $yeni = 0;
                    $dun = 0;
                    $gecenhafta = 0;

                    $gecenay = 0;
                    $uzunzaman = 0;
                    foreach ($notifications as $notification) {
                        $today = new DateTime($notification['today']);
                        $notification_date = new DateTime($notification['notification_date']);
                        $interval = $today->diff($notification_date);

                        if ($interval->format('%m') > 0) {
                            if ($interval->format('%m') == 1) {
                                $gecenay = 1;
                            } else {
                                $uzunzaman = 1;
                            }
                            $time = $interval->format('%m') . " ay önce";
                        } else if ($interval->format('%d') > 10) {
                            $time = $interval->format('%d') / 7;

                            $time = intval($time) . " hafta önce";
                            if ($time == 1) {
                                $gecenhafta = 1;
                            }
                        } else if ($interval->format('%i') > 0) {
                            $time = $interval->format('%i') . " dakika önce";
                        } else if ($interval->format('%d') > 0) {
                            $time = $interval->format('%d') . " gün önce";
                        } else if ($interval->format('%h') < 0) {
                            $time = $interval->format('%h') . " saat önce";
                        } else if ($interval->format('%i') < 0) {
                            $time = $interval->format('%i') . " dakika önce";
                        } else if ($interval->format('%s') < 10) {
                            $time = "şimdi";
                        } else {
                            $time = $interval->format('%s') . " saniye önce";
                        }

                    ?>
                        <a href="" class="text-decoration-none rounded not-message">
                            <div class="d-flex my-2">
                                <img src="<?= $notification['notification_profile_photo'] ?>" alt="pp" class="border-0 profile-photo s3 me-2">
                                <div class="d-flex align-items-center justify-content-between w-100">
                                    <div>
                                        <h6 class="mb-0 fs-7 text-black"><?= $notification['notification_content'] ?></h5>
                                            <p class="fs-7 mb-0 text-primary"><?= $time ?></p>
                                    </div>
                                    <?php if (!$notification['is_readed']) {
                                        echo '<div><i class="fa fa-circle fa-xs text-primary"></i></div>';
                                    } ?>

                                </div>
                            </div>
                        </a>

                    <?php } ?>
                </div>
            </div>
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>

</main>

<?php include_once "footer.php" ?>