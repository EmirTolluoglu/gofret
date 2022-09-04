<?php include_once 'header.php';
if (!$mobil) {
  header('Location: trades');
  exit;
}
$user_id = 0;
$orders = [];
$finished_orders = [];
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
  $requestler = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmt2 = $conn->prepare("SELECT product_order.product_order_id,
    fp.product_name AS first_product,
    sp.product_name AS second_product,
    fu.user_name AS first_user,
    su.user_name AS second_user,
    fu.user_profile_photo AS first_profile,
    su.user_profile_photo AS second_profile,
    fu.user_level AS first_level,
    su.user_level AS second_level,
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
<style>
    :root {
      --theme-bg-color: rgba(16 18 27 / 40%);
      --border-color: rgba(113 119 144 / 25%);
      --theme-color: #f9fafb;
      --inactive-color: rgb(113 119 144 / 78%);
      --body-font: "Poppins", sans-serif;
      --hover-menu-bg: rgba(12 15 25 / 30%);
      --content-title-color: #999ba5;
      --content-bg: rgb(146 151 179 / 13%);
      --button-inactive: rgb(249 250 251 / 55%);
      --dropdown-bg: #21242d;
      --dropdown-hover: rgb(42 46 60);
      --popup-bg: rgb(22 25 37);
      --search-bg: #14162b;
      --overlay-bg: rgba(36, 39, 59, 0.3);
      --scrollbar-bg: rgb(1 2 3 / 40%);
    }
          #m-trade {
            background-color: rgba(16 18 27 / 40%);
            max-width: 1250px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            width: 100%;
            height:100%;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            font-size: 15px;
            font-weight: 500;
        }
        body {
            font-family: var(--body-font);
            background-image: url("img/backd.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column ;
        }


</style>

<main id="m-trade">
  <div class="container mb-5 p-1">
    <a href="create-product"><div class="w-100 btn btn-gofret mt-3 p-4 fs-4" style="height: 75px;"><p class="text-center">Takasını Oluşturr!</p></div></a>
    <div id="current-trades">
      
      <a class="text-decoration-none fs-5 text-black ms-2"><p style="color:white;  display:block !important;"  >Aktif Takaslar <i class="fa fa-caret-down me-2"></i></p></a>
        <?php if (count($orders) == 0) {
          echo '<div class="text-center" style="height: 75px;"><p class="my-5 fs-5" style="color:white">Hala Takasların Yok mu?? :(</p></div>';
        } else {
          foreach ($orders as $order) {
            $ogren = 'first';
            $ogret = 'second';
            if ($order['first_statu'] == "teach") {
              $ogren = 'second';
              $ogret = 'first';
            }
            $benOgret = 1;
            if ($order[$ogren . '_user'] == $_SESSION['user_name']) {
              $benOgret = 0;
            }
        ?>
            <div class="card py-3 px-0 ">
              <div class="d-flex justify-content-between align-items-center mx-3 mb-3">
                <img class="profile-photo" src="<?= $benOgret ? $order[$ogren . '_profile'] : $order[$ogret . '_profile'] ?>" alt="pp">
                <div class="handle me-auto ms-2">
                  <h4 class="m-0 mb-1"><?= $benOgret ? $order[$ogren . '_user'] : $order[$ogret . '_user'] ?></h6>
                    <div class="d-inline-block rounded-4 px-2 fw-bold text-light align-self-baseline" style="background-color: crimson;"><?= $benOgret ? $order[$ogren . '_level'] : $order[$ogret . '_level'] ?>.lvl</div>
                </div>
                <p>Online <strong>4/5</strong></p>
              </div>
              <div class="trade-main bg-danger d-flex justify-content-around rounded-4 p-3 text-white mb-3">
                <div class="handle">
                  <h5 class="mb-0"><?= $order[$ogren . '_product'] . ($benOgret ? "" : "(you)"); ?></h5>
                  <p class="mb-0">Yazım</p>
                </div>
                <img src="img/trade.png" alt="trade">
                <div class="handle">
                  <h5 class="mb-0"><?= $order[$ogret . '_product'] . ($benOgret ? "(you)" : ""); ?></h5>
                  <p class="mb-0">İsteği</p>
                </div>
              </div>
              <div class="trade-suc d-flex justify-content-center align-items-center">
                <div class="btn btn-gofret me-2"> Ders onayla</div>
                <a href=""><i class="fa fa-flag text-danger me-2"></i></a>
                <a href=""><i class="fa fa-ellipsis-vertical"></i></a>
              </div>
            </div>
        <?php }
        } ?>
    </div>


    <div id="trade-requests" class="my-4 " style="width:100%; height:200px">
      <a class="text-decoration-none fs-5 text-black ms-2" ><p style="color:white;">Takas İstekleri <i class="fa fa-caret-down" style="color:white;"> </i></p></a>
      <div class="card2 rounded-3 bg-white p-3 d-block " id="left-request">
        <?php if (count($requestler) == 0) {
          echo "<p>Burda Neden Hiçbirşey Yok Ki :(</p>";
        } else {
          foreach ($requestler as $request) {
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



            $finished_user = "requester";
            if ($request['requester_username'] == $_SESSION['user_name']) {
              $finished_user = "requested";
            }
        ?>
            <div class="content row mb-3">
              <div class="col-5 pe-0">
                <p class="text-end"><?php echo $ogrenName;
                                    if (!$benogretiyorum) {
                                      echo "(you)";
                                    } ?></p>
              </div>
              <div class="col-2 text-center">
                <i class="fa fa-arrows-turn-to-dots" style="color:white;"></i>
              </div>
              <div class="col-5 ps-0 text-start ">
                <p><?php echo $ogretName;
                    if ($benogretiyorum) {
                      echo "(you)";
                    } ?> </p>
              </div>
              <div class="profile-card d-flex justify-content-between align-items-center">
                <img class="border-0" src="<?= $request[$finished_user . '_user_profile_photo'] ?>" alt="logo">
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
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        //jquery document ready
        $(document).ready(function() {
            if (<?= $user_id != 0 ?>) {
                $(".requestbtn-mini").click(function() {
                    var requester_id = $(this).parent().attr("data-product-id");
                    var requested_id = $(this).parent().attr("data-requested-id");
                    var request_id = $(this).parent().attr("data-product-request-id");
                    $(this).parent().parent().parent().fadeOut(1600, "linear", function() {
                        $(this).remove();
                        if ($('#left-request').children().length == 0) {
                            $('#left.-request').append('<div class="text-center"><p class="my-2 fs-6">Tüm istekler bitti mi?? :(</p></div>');

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
                            location.reload();
                        }
                    });
                });
            }
        });
    </script>
<?php include_once "footer.php" ?>