<?php
include_once "header.php";
if ($mobil) {
    header('Location: m-main');
}

$productsor = $conn->prepare("SELECT product_name,user_id,product_content,product_id,category_id FROM product");
$productsor->execute();
$products = $productsor->setFetchMode(PDO::FETCH_ASSOC);
$products = $productsor->fetchAll();
?>

<main>
    <style>
        .learn {
            background-color: #04cf98;
        }

        .teach {
            background-color: #2E276D;
        }

        div.switcher+div.switcher {
            margin-top: 10px;
        }

        div.switcher label {
            padding: 0;
        }

        div.switcher label * {
            vertical-align: middle;
        }

        div.switcher label input {
            display: none;
        }

        div.switcher label input+span {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
            background: #04cf98;
            border: 2px solid #04cf98;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        div.switcher label input+span small {
            position: absolute;
            display: block;
            width: 50%;
            height: 100%;
            background: #fff;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
            left: 0;
        }

        div.switcher label input:checked+span {
            background: #2E276D;
            border-color: #2E276D;
        }

        div.switcher label input:checked+span small {
            left: 50%;
        }
    </style>
    <div class="container">

        <div class="row my-5">
            <?php include_once "left-sidebar.php"; ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="d-flex justify-content-center align-items-center" id="product-order">
                    <div id="learn" type="button" class="btn btn-gofret m-2">Öğren</div>
                    <!-- <div class="switcher">
                        <label for="toggle-1">
                            <input type="checkbox" class="checkbox1" id="toggle-1" onchange="changeState2()" /><span><small></small></span>
                        </label>
                    </div>
                    <div onclick="changeState(this)" id="teach" type="button" class="btn btn-gofret2 m-2">Öğret</div> -->
                </div>
                <div id="type-flag" class="learn" style="height: 0.3rem;"></div>
                <div class="row">
                    <?php foreach ($products as $product) {
                        if (isset($_SESSION['user_id']) && $product['user_id'] == $_SESSION['user_id']) {
                            continue;
                        }
                        $authid = $product['user_id'];
                        $authsor = $conn->prepare("SELECT user_name,user_level,user_class,user_profile_photo, full_name FROM user where user_id=$authid");
                        $authsor->execute();
                        $auth = $authsor->fetch(PDO::FETCH_ASSOC);
                        $authname = $auth['full_name'];
                        $authlevel = $auth['user_level'];
                        $authclass = $auth['user_class'];
                        $authprofilephoto = $auth['user_profile_photo'];

                        $category = $conn->prepare("
                        SELECT 
                        category.category_name AS MCategory, 
                        category.category_color AS cat_color, 
                        parent_category.category_name AS parentCategory,
                        product.product_name 
                        
                        FROM category

                        INNER JOIN product
                            On product.category_id = category.category_id

                        INNER JOIN category AS parent_category
                            ON category.parent_category_id = parent_category.category_id
                            WHERE product.product_id =". $product['product_id']
                        );
                        $category->execute();
                        $category = $category->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <div class="col">
                            <div class="card" style="height: 20rem;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img class="profile-photo" src="<?= $authprofilephoto; ?>" alt="pp">
                                    <div class="handle me-auto ms-2">
                                        <h4 class="m-0 fw-bolder" style="color: <?= $category['cat_color']; ?>;"><?php if(!empty($category['parentCategory'])){ echo $category['parentCategory'];}else{ echo $category['MCategory'];} ?></h4>
                                            <p class="m-0" style="color: <?= $category['cat_color']; ?>;"><?php if(!empty($category['parentCategory'])){ echo $category['MCategory'];} ?></p>
                                    </div>

                                </div>
                                <h5 class="m-0 mt-3 fs-5"><?= $authname; ?></h5>
                                <div class="d-flex justify-content-start align-items-center mt-1">
                                    <div class="px-3 fw-bold align-self-baseline rounded-4  text-white" style="background-color: <?= $category['cat_color']; ?>;">lvl. <?= $authlevel; ?>
                                    </div>
                                    <p class="ms-2 align-self-baseline"><?= $authclass; ?>.sınıf</p>
                                </div>

                                <p class="m-0 mb-3"><?= $product['product_content']; ?></p>
                                <a class="mx-auto mt-auto" href="product/<?= $product['product_name']; ?>">
                                    <div class="btn btn-gofret ">Mesaj At</div>
                                </a>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php include_once "right-sidebar.php"; ?>
        </div>
    </div>

</main>
<script>
    var lastName = "learn";
    var type_flag = document.getElementById("type-flag");
    var checkbox = document.getElementsByClassName("checkbox1");
    var state = 0;

    function changeState(obj) {
        if (obj.id != lastName) {
            type_flag.classList.remove(lastName);
            lastName = obj.id;
            type_flag.classList.add(lastName);
            controlCheck();
        }
    }

    function changeState2() {
        if (checkbox[0].checked) {
            type_flag.classList.remove(lastName);
            lastName = "teach";
            type_flag.classList.add(lastName);
        } else {
            type_flag.classList.remove(lastName);
            lastName = "learn";
            type_flag.classList.add(lastName);
        }
    }

    function controlCheck() {
        if (lastName == "learn") {
            checkbox[0].checked = false;
        } else {
            checkbox[0].checked = true;
        }
    }
</script>
<?php include_once "footer.php";
?>