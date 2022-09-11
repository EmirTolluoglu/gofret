<?php
require_once "header.php";

$category = $_GET['u'];
$parentCategory = $conn->prepare("SELECT category_parent.category_name AS parent_name

FROM category AS category_child

INNER JOIN category AS category_parent 
	ON category_child.parent_category_id = category_parent.category_id

WHERE category_child.category_name = '$category'");
$parentCategory->execute();
$parentCategory = $parentCategory->fetch(PDO::FETCH_ASSOC);

$categorys = $conn->prepare("
SELECT 
c2.category_name,
c2.category_color,
c2.category_icon

FROM category

INNER JOIN category AS c2 ON category.category_id = c2.parent_category_id

WHERE category.category_name = '$category'
");
$categorys->execute();
$categoryses = $categorys->fetchAll(PDO::FETCH_ASSOC);

$products = $conn->prepare("
SELECT     
category.category_name AS MCategory,
category.category_color AS cat_color,
pcat.category_name AS parentCategory,
user.full_name,
user.user_level,
user.user_profile_photo,
user.user_class,
product.product_content,
product.product_name 

FROM product

INNER JOIN category ON category.category_id = product.category_id
INNER JOIN category AS pcat ON category.parent_category_id = pcat.category_id
INNER JOIN user ON product.user_id = user.user_id

WHERE category.category_name = '$category'
");
$products->execute();
$products = $products->fetchAll(PDO::FETCH_ASSOC);


?>

<main>
  <?php if (count($categoryses) > 0) { ?>
    <div class="container mb-2">
      <div class="d-flex m-main-icon-felx">

        <?php foreach ($categoryses as $categoryParent) {

        ?>

          <a href="productlist/<?= $categoryParent['category_name']; ?>" class="text-black text-decoration-none mx-2">
            <div class="category-icon rounded-circle d-flex justify-content-center align-items-center p-2 mt-2 opacity-100 mx-auto" style="width: 50px; height: 50px; background-color: <?= $categoryParent['category_color']; ?>;">
              <i class="<?= $categoryParent['category_icon'] ?>"></i>
            </div>
            <p class="text-center fs-6 mb-1 text-black" style="opacity: 50% ;"><?= $categoryParent['category_name']; ?></p>
          </a>
        <?php } ?>
      </div>
      <hr class="m-0" />
    </div>
    <?php }  ?>
    <a href="<?php if(!empty($parentCategory)) {echo 'productlist/'.$parentCategory['parent_name'];} else{echo "m-main";} ?>"><h6 class="btn btn-gofret w-100">Bir Üst Katagoriye Çık</h6></a>
    <img id="banner" style="width: 100%;" class="img-fluid banner" src="img/ogren.png" alt="hey">
    <div style="background-color: #04cf98; width: 100%; height: 0.4rem;"></div>
    <div class="container">
      <h2 class="my-2 text-center"><?= $category ?></h2>
      <div class="d-flex my-3 justify-content-between align-items-center">
        <button onclick="ogren()" class="btn-gofret me-2 ms-auto">Öğren</button>
        <button onclick="ogret()" class="btn-gofret3">Öğret</button>
        <a href="" class="me-auto ms-2"><i class="fa fa-arrows-up-down fa-lg "></i></a>
      </div>
    </div>
    
    
    <?php if(count($products) > 0){ foreach($products as $product){?>
    <div class="card mx-4 w-auto">
      <div class="d-flex justify-content-between align-items-center">
        <img class="profile-photo" src="<?= $product['user_profile_photo']; ?>" alt="pp">
        <div class="handle me-auto ms-2">
          <h4 class="m-0 fw-bolder" style="color: <?= $product['cat_color']; ?>;"><?= $product['parentCategory']; ?></h6>
            <p class="m-0" style="color: <?= $product['cat_color']; ?>;"><?= $product['MCategory']; ?></p>
        </div>
        <div class="rounded-4 px-2 fw-bold text-light align-self-baseline" style="background-color: <?= $product['cat_color']; ?>;">lvl.<?= $product['user_level']; ?>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center mt-1">
        <h5 class="m-0"><?= $product['full_name']; ?></h5>
        <p class="align-self-baseline"><?= $product['user_class']; ?>.sınıf</p>
      </div>
      <div class="d-flex justify-content-between">
        <p class="m-0"><?= $product['product_content']; ?></p>
        <a href="product/<?= $product['product_name']; ?>" class="ms-auto align-self-end"><i class="fa fa-chevron-right fa-xl"></i></a>
      </div>
    </div>
      <?php }}else{ echo '<p class="text-center my-5 fs-3">Neden burada takas yok ki?? <br> Sen Oluştursana! </p>'; } ?>
</main>
<?php

require_once "footer.php"; ?>