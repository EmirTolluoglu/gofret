<?php
include_once 'header.php';
if (!$mobil) {
  header('Location: index');
  exit;
}

//get category from db
$category = $conn->prepare("SELECT * FROM category WHERE parent_category_id = 0");
$category->execute();
$categories = $category->setFetchMode(PDO::FETCH_ASSOC);
$categories = $category->fetchAll();

//get random 5 products from db
$productsor = $conn->prepare("
SELECT
    category.category_name AS MCategory,
    category.category_color AS cat_color,
    parent_category.category_name AS parentCategory,
    user.full_name,
    user.user_level,
    user.user_profile_photo,
    user.user_class,
    product.product_content,
    product.product_name
FROM
    category
INNER JOIN product ON product.category_id = category.category_id
INNER JOIN user ON user.user_id = product.user_id
INNER JOIN category AS parent_category
ON
    category.parent_category_id = parent_category.category_id
ORDER BY
    RAND()
LIMIT 5
");
$productsor->execute();
$products = $productsor->setFetchMode(PDO::FETCH_ASSOC);
$products = $productsor->fetchAll();

?>

<style>
  /* :root {
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
    } */



  .main-hover {
    margin-right: 20px;
  }

  .m-main-icon-felx {
    overflow-x: auto;
  }


  .main-row1-col1-text {
    font-size: 13px;
  }

  .main-row2-col2-opa-text {
    font-size: 10px;
  }


  .main-row1-col2-div3-level-what {
    font-size: 14px;
    color: brown;
  }



  .main-row1-col2-school-icon-level-lastday {
    height: 15px;
  }
</style>

<div class="app rounded-4  px-0 ">
  <main id="m-main">
    <div class="container">
      <div class=" d-flex m-main-icon-felx">

        <?php foreach ($categories as $categorie) {

        ?>

        <a href="productlist/<?= $categorie['category_name']; ?>" class="text-black text-decoration-none main-hover ">
      <div class="category-icon rounded-circle d-flex justify-content-center align-items-center p-2 mt-2 opacity-100 mx-auto" style="width: 50px; height: 50px; background-color: <?= $categorie['category_color']; ?>;">
        <i class="<?= $categorie['category_icon'] ?>"></i>
      </div>
      <p class="text-center fs-6 mb-1 text-black" style="opacity: 50% ;"><?= $categorie['category_name']; ?></p>
      </a>
    <?php } ?>
    </div>
    <hr class="m-0" />

    <div style="display: flex; justify-content: flex-start; width: 100%; height: 30vh; filter: blur(8px); box-shadow: 3px 40px 49px -40px rgba(0,0,0,0.79);">



      <div class="" style="width: 50%; ">
        <div class="grid" style="   height:  max-content;">
          <div>
            <div class="row text-center mx-auto">
              <div class="col card me-2 mb-0 " style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Pazartesi</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center mt-1" style="width: 100%; height: 12.5vh; overflow-y: auto;">
          <div class="grid" style="   height:  100%; width: 100%; ">

            <div class="row  text-center mx-auto ">
              <div class="col card me-2 mb-1 mt-1 " style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Salı</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>






            </div>
            <div class="row  text-center mx-auto ">
              <div class="col card me-2 mb-1 mt-1 " style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Çarşamba</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>


            </div>
            <div class="row  text-center mx-auto ">
              <div class="col card me-2 mb-1 mt-1" style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Perşembe</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>


            </div>
            <div class="row  text-center mx-auto ">
              <div class="col card me-2 mb-1 mt-1 " style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Cuma</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>


            </div>
            <div class="row  text-center mx-auto ">
              <div class="col card me-2 mb-1 mt-1 " style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Cumartesi</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>


            </div>
            <div class="row  text-center mx-auto ">
              <div class="col card me-2 mb-1 mt-1 " style="background-color: rgb(6, 6, 145);">
                <h1 class="fs-5 text-info text-decoration-underline">Pazar</h1>
                <p class="mb-2 fw-bold text-light main-row1-col1-text ">
                  17.00 - Matematik
                </p>
                <p class="mb-2 fw-bold text-light main-row1-col1-text">
                  20.00 - Marketing
                </p>
              </div>


            </div>




          </div>

        </div>







      </div>


      <div style="width:  50%;">
        <div class="grid" style="   height:  fit-content;">
          <div class="row text-center mx-auto">
            <div class="col card mb-0 text-center">
              <h1 class="fs-5 text-decoration-underline main-row1-col2-text" style="color: rgb(6, 6, 145);">
                Hedeflerim
              </h1>
              <div>
                <div class="d-flex justify-content-around main-row1-col2-school-icon-level-lastday">
                  <h2 class="fs-6 me-1 fw-bold  m-0" style="color: brown;">
                    Okul
                  </h2>
                  <i style="color: brown;" class="fa fa-arrow-right me-1  ms-1"></i>
                  <h3 class="fs-6 me-1  ps-1 m-0" style="color: brown;">
                    lvl.5
                  </h3>
                  <p class="main-row2-col2-opa-text opacity-50 m-0 ms-2">
                    Son 10 gün
                  </p>
                </div>
                <div class="d-flex main-row1-col2-div3">
                  <p class="main-row1-col2-div3-level-what m-0">Kulüp Yönetimi</p>
                </div>
                <a href="#" class="text-decoration-none">
                  <div class="d-flex p-0 mb-16">
                    <p class="fs-4 m-0" style="color: blue;">+</p>
                  </div>
                </a>
              </div>
            </div>

          </div>
        </div>


      </div>





    </div>
    <div class="bg-black text-white px-2 fs-1" style="transform: rotate(330deg) translate(120px, -75px); display: inline-block;">Burası Hala Yapılıyo..🛠️</div>
</div>
</div>

<div class="container mt-2 mb-5">

  <p class="ms-2 mt-1 p-3  mb-0 fs-4 fw-bolder ">İlgini çekebilecek takaslar</p>




  <div class="d-flex justify-content-start align-items-center pt-3 pb-4" style="width: 100%; height: max-content; overflow-y: auto;">
  <?php foreach ($products as $product) { ?>
  <div class=" mx-2" >
      <div class=" card m-1" style="height: 230px; width: 160px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="d-flex  " style="width: 100% ;">
          <img src="<?= $product['user_profile_photo']; ?>" alt="Görüntü Yüklenemedi" class="rounded-circle" style="width: 35px; height: 35px; right: 0; ">
          <div class="ps-3">
            <h1 class="m-0 fw-bolder fs-6" style="color: <?= $product['cat_color']; ?>;"><?= $product['MCategory']; ?></h1>
            <h2 style="font-size: 14px;" style="color: <?= $product['cat_color']; ?>;"><?= $product['parentCategory']; ?></h2>
          </div>

        </div>
        <h1 class="ms-2" style="font-size: 14px; "><?= $product['full_name']; ?></h1>
        <div class="d-flex justify-content-start align-items-center" style="width: 100px;">
          <div class="d-flex align-items-center justify-content-center rounded-pill me-2" style="width: 55px; height: 20px; background-color: <?= $product['cat_color']; ?>;">
            <h2 class="m-0 " style="font-size: 10px; color: white;">lvl. <?= $product['user_level']; ?></h2>
          </div>
          <h2 class="m-0 " style="font-size: 10px;  width: max-content; height: fit-content;"><?= $product['user_class']; ?>. sınıf</h2>
        </div>
        <div class="d-flex">
          <p class="mb-3" style="font-size: 12px; ">
            <?= $product['product_content']; ?>
          </p>
        </div>
        <div class="d-flex justify-content-end align-items-center">
          <a href="#">
            <div>
              <i class="fa-solid fa-angle-right fs-1"></i>
            </div>
          </a>

        </div>
      </div>

    </div>
    <?php } ?>
  </div>
</div>
</main>
</div>
<?php include 'footer.php'; ?>

</body>

</html>