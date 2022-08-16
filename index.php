<?php
include_once "header.php";

$productsor = $conn->prepare("SELECT product_name,user_id,product_content FROM product");
$productsor->execute();

// set the resulting array to associative
$products = $productsor->setFetchMode(PDO::FETCH_ASSOC);
$products = $productsor->fetchAll();
$productcount = count($products);

// function GetAuth($product_user_id)
// {


//     $authsor = $conn->prepare("SELECT user_name,user_level,user_class FROM user where user_id=$product_user_id");
//     $authsor->execute();
//     $auth = $authsor->fetch(PDO::FETCH_ASSOC);
//     return $auth;
// }
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
                    <div onclick="changeState(this)" id="learn" type="button" class="btn btn-gofret m-2">Öğren</div>
                    <div class="switcher">
                        <label for="toggle-1">
                            <input type="checkbox" class="checkbox1" id="toggle-1" onchange="changeState2()" /><span><small></small></span>
                        </label>
                    </div>
                    <div onclick="changeState(this)" id="teach" type="button" class="btn btn-gofret2 m-2">Öğret</div>

                </div>
                <div id="type-flag" class="learn" style="height: 0.3rem;"></div>
                <div class="row">
                    <?php for ($i = 0; $i < $productcount; $i++) {
                        $authid = $products[$i]['user_id'];
                        $authsor = $conn->prepare("SELECT user_name,user_level,user_class,user_profile_photo FROM user where user_id=$authid");
                        $authsor->execute();
                        $auth = $authsor->fetch(PDO::FETCH_ASSOC);
                        $authname = $auth['user_name'];
                        $authlevel = $auth['user_level'];
                        $authclass = $auth['user_class'];
                        $authprofilephoto = $auth['user_profile_photo'];
                    ?>
                        <div class="col-4">
                            <div class="card mx-4" style="height: 20rem;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img class="profile-photo" src="<?php echo $authprofilephoto; ?>" alt="pp">
                                    <div class="handle me-auto ms-2">
                                        <h4 class="m-0"><?php echo $products[$i]['product_name']; ?></h6>
                                            <p class="m-0">Pilav</p>
                                    </div>

                                </div>
                                <h5 class="m-0 mt-3 fs-5"><?php echo $authname; ?></h5>
                                <div class="d-flex justify-content-start align-items-center mt-1">
                                    <div class=" pe-3 fw-bold align-self-baseline">lvl. <?php echo $authlevel; ?>
                                    </div>
                                    <p class="align-self-baseline"><?php echo $authclass; ?>.sınıf</p>
                                </div>

                                <p class="m-0 mb-3"><?php echo $products[$i]['product_content']; ?></p>
                                <a class="mx-auto mt-auto" href="">
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