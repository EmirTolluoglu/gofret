<?php
require_once 'src/connect.php';

// Get category from database
$stmt = $conn->prepare('SELECT * FROM category');
$stmt->execute();
$categories = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="img/ico.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Document</title>
</head>

<body>
  <style>
    .drop-handler {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .drop-handler select {
      width: 150px;
      height: 30px;
      background-color: rgb(15, 153, 15);
      border-radius: 50em;
    }
  </style>
  <header id="mobile-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a href="#"><img id="head-logo" src="img/gofret.png" alt="Gofret" width="96" height="36" class="" /></a>
      <div id="search-bar" class="search-bar ms-auto me-2">
        <i class="fa fa-magnifying-glass"></i>
        <input onfocusout="focusgg()" id="search_input" type="search" placeholder="Search for creators, inspirations, and projects" />
      </div>
      <i class="fa-solid fa-comment-dots text-muted"></i>
    </div>
  </header>

  <div class="card align-items-center" style="
          margin-top: 62px;
          margin-bottom: 62px;
          box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.2);
        ">
    <div>
      <h1 class="fs-3">Takas mı Lazım?</h1>
    </div>
    <form action="src/create_product.php" method="POST">
      <div style="width: 100%" class="my-3">
        <h1 class="fs-6">Öğretmek İstediğin şeyi seç!</h1>
        <div id="drop-group">
          <div class="drop-handler">
            <select name="learndrop1" id="learndrop1">
              <option> </option>
              <?php foreach ($categories as $category) {
                if ($category['parent_category_id'] == 0) {
                  echo '<option value=' . $category['category_id'] . '>' . $category['category_name'] . '</option>';
                }
              } ?>
            </select>
          </div>
          <div class="drop-handler">
            <select name="learndrop2" id="learndrop2">
              <option> </option>
            </select>
          </div>
        </div>
        <div class="rounded-end" style="
              background-color: white;
              width: 75%;
              box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.2);
            ">
          <p class="p-2" style="color: red">
            İlk önce envantere eklemeyi unutma!
          </p>
        </div>
        <div class="d-flex justify-content-around align-items-center">
          <input type="radio" name="takasnasıl" id="" />
          <p style="font-size: 13px" class="m-0">Online</p>
          <input type="radio" name="takasnasıl" id="" />
          <p style="font-size: 13px" class="m-0">Yüzyüze</p>
          <input type="radio" name="takasnasıl" id="" />
          <p style="font-size: 13px" class="m-0">Kütüphane/cafe vs.</p>
        </div>
        <div>
          <div class="d-flex rounded-pill mb-2 ps-2 justify-content-center align-items-center" style="
                width: 100%;
                box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.2);
                height: 40px;
              ">
            <label for="takas-gün-ve-saat">Gün ve saat seçimi:</label>
            <input type="datetime-local" class="pe-1 ms-1" style="height: 25px; width: 40%; border: none" />
          </div>
        </div>
      </div>
      <div style="width: 100%">
        <h1 class="fs-6">Öğretmek İstediğin şeyi seç!</h1>
        <div id="drop-group">
          <div class="drop-handler">
            <select name="teachdrop1" id="teachdrop1">
              <option> </option>
              <?php foreach ($categories as $category) {
                if ($category['parent_category_id'] == 0) {
                  echo '<option value=' . $category['category_id'] . '>' . $category['category_name'] . '</option>';
                }
              } ?>
            </select>
          </div>
          <div class="input-group">
            <input type="text" name="product_name">
            <textarea name="product_content" id="product_content" cols="30" rows="10"></textarea>
          </div>
          <div class="drop-handler">
            <select name="teachdrop2" id="teachdrop2">
              <option> </option>
            </select>
          </div>
        </div>
        <div class="rounded-end" style="
              background-color: white;
              width: 75%;
              box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.2);
            ">
          <p class="p-2">İlk önce envantere eklemeyi unutma!</p>
        </div>
        <div class="d-flex justify-content-around align-items-center">
          <input type="radio" name="takasnasıl" id="" />
          <p style="font-size: 13px" class="m-0">Online</p>
          <input type="radio" name="takasnasıl" id="" />
          <p style="font-size: 13px" class="m-0">Yüzyüze</p>
          <input type="radio" name="takasnasıl" id="" />
          <p style="font-size: 13px" class="m-0">Kütüphane/cafe vs.</p>
        </div>

        <div>
          <div class="d-flex rounded-pill m-0 ps-2 justify-content-center align-items-center" style="
                width: 100%;
                box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.2);
                height: 40px;
              ">
            <label for="takas-gün-ve-saat">Gün ve saat seçimi:</label>
            <input type="datetime-local" class="pe-1 ms-1" style="height: 25px; width: 40%; border: none" />
          </div>
        </div>


      </div>

      <div style="width: 100%; justify-content: end; height: fit-content" class="d-flex my-2">
        <a href="#" class="text-decoration-none">
          <div style="
                width: 130px;
                height: 30px;
                background-color: rgb(6, 199, 38);
              " class="d-flex rounded-pill justify-content-center align-items-center">
            <input type="submit" value="devam et" name="submit">
          </div>
        </a>
      </div>
  </div>
  </form>

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#learndrop1').change(function(event) {
        $.post("app/ajax/get_category.php", {
            v: event.target.value
          },
          function(data) {
            $('#learndrop2').html('<option></option>');
            $('#learndrop2').append(data);
          });
      });

      $('#teachdrop1').change(function(event) {
        $.post("app/ajax/get_category.php", {
            v: event.target.value
          },
          function(data) {
            $('#teachdrop2').html('<option></option>');
            $('#teachdrop2').append(data);
          });
      });
    });
  </script>
</body>

</html>