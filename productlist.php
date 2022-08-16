<?php
include "header.php";

if (empty($_SESSION['user_id']) or $_SESSION['user_id'] == "1") {
    header("Location:pre-register.php");
    exit;
}

if (isset($_GET['u'])) {
    $username = $_GET['u'];
    $guestusersor = $conn->prepare("SELECT user_id FROM user WHERE user_name = '$username'");
    $guestusersor->execute();
    $guestuser = $guestusersor->fetch(PDO::FETCH_ASSOC);
    $user_id = $guestuser['user_id'];
}

$kullanicisor = $conn->prepare("SELECT * FROM user where user_id=$user_id");
$kullanicisor->execute();
$user = $kullanicisor->fetch(PDO::FETCH_ASSOC);

//friend count
$productstmt = $conn->prepare("SELECT * FROM product WHERE user_id = $user_id");
$productstmt->execute();
$products = $productstmt->fetchAll(PDO::FETCH_ASSOC);
$productscount = count($products);
echo $productscount;
?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="card mt-0">
                    <h6 class="text-name ms-2"><?php if($_SESSION['user_name'] == $user['user_name']) {echo "Senin takasların";}else{echo $user['user_name'] . "'nin takasları";} ?> </h6>
                    <div class="row">
                        <?php for ($i=0; $i < $productscount; $i++) { 
                        ?>
                        <div class="col-4 text-center fw-bold">
                            <a href="<?php echo "product/" . $products[$i]['product_name']; ?>"><?php echo $products[$i]['product_name']; ?></a>
                            <p><?php echo $products[$i]['product_content']; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>

</main>

<?php include_once "footer.php" ?>