<?php require_once "src/connect.php";
ob_start();
session_start();
$product_name = $_GET['u'];

$productsor = $conn->prepare("SELECT * FROM product where product_name='$product_name'");
$productsor->execute();
$product = $productsor->fetch(PDO::FETCH_ASSOC);

$user_id = $product['user_id'];
$authstmt = $conn->prepare("SELECT * FROM user where user_id=$user_id");
$authstmt->execute();
$auth = $authstmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <base href="http://localhost/gofret/">
  <link rel="icon" type="image/x-icon" href="img/ico.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <title>Gofret | Trades</title>
</head>

<body>
  <header id="mobile-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a href=""><img id="head-logo" src="img/gofret.png" alt="Gofret" width="96" height="36" class="" /></a>
      <div id="search-bar" class="search-bar ms-auto me-2">
        <i class="fa fa-magnifying-glass"></i>
        <input onfocusout="focusgg()" id="search_input" type="search" placeholder="Search for creators, inspirations, and projects" />
      </div>
      <i class="fa-solid fa-comment-dots text-muted"></i>
    </div>
  </header>

  <nav id="mobile-nav">
    <div class="container">
      <div class="d-flex justify-content-around py-3 w-100">
        <a href=""><i class="fa fa-home text-secondary fa-lg"></i></a>
        <a href=""><i class="fa fa-heart text-secondary fa-lg"></i></a>
        <a href=""><img src="img/trade.png" alt="" /></a>
        <a href=""><i class="fa fa-user text-secondary fa-lg"></i></a>
        <a href=""><i class="fa fa-bell text-secondary fa-lg"></i></a>
      </div>
    </div>
  </nav>

  <main id="m-product">
    <div class="container mb-5">
      <a class="text-decoration-none text-danger" href=""><i class="fa fa-x fa-xl"></i></a>
      <div class="card mt-2">
        <div class="d-flex mb-4">
          <img class="profile-photo me-2 img2x" src="<?php echo $auth['user_profile_photo']; ?>" alt="pp" />
          <div class="handle me-auto">
            <h5 class="m-0 fw-bold fs-2 text-danger"><?php echo $product['product_name']; ?></h5>
            <p class="m-0 fs-4 text-danger">Yazım</p>
          </div>
          <div class="">
            <p class="m-0 bg-warning px-3 py-1 rounded-4 text-white fw-bold">
              lvl. <?php echo $auth['user_level']; ?>
            </p>
          </div>
        </div>
        <div class="intro-name mb-2">
          <h5 class="mb-0 letter-space fw-light fs-3"><?php echo $auth['user_name']; ?></h5>
          <p class="mb-0 letter-space fw-light fs-6"><?php echo $auth['user_class']; ?>.sınıf </p>
        </div>
        <div class="bio">
          <?php echo $product['product_content']; ?>
        </div>
        <hr />
        <div class="pers-times mb-4">
          <h6>Takas için ayırdığı vakitler.</h6>
          <p class="mb-1">Pazartesi 8.00 - 12.00</p>
          <p class="mb-1">Pazartesi 8.00 - 12.00</p>
          <p class="mb-1">Online - Dicord/Zoom</p>
          <p class="mb-1">Tahmini 5 güne biter</p>
        </div>
        <div class="assur">
          <p>
            <b>Sertifikalı bir ilandır.</b> İletişim boyunca notlarınızı ve
            buluşmalarınızdan fotoğraflarınızı saklayın
          </p>
        </div>
        <div class="select-time">
          <h6>Zaman Aralığı Seç:</h6>
          <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
          <script>
            $(function() {
              $('input[name="daterange"]').daterangepicker({
                opens: 'right'
              }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
              });
            });
          </script>
        </div>
      </div>
    </div>
  </main>

  <script src="js/all.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>