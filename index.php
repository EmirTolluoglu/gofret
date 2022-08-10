<?php
include_once "header.php"
?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class=" d-flex justify-content-center align-items-start">
                    <button type="button" class="btn btn-gofret m-2">Öğren</button>
                    <button type="button" class="btn btn-gofret2 m-2">Öğret</button>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card"></div>
                    </div>
                    <div class="col">
                        <div class="card"></div>
                    </div>
                    <div class="col">
                        <div class="card"></div>
                    </div>
                </div>
            </div>
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>

</main>

<?php include_once "footer.php" ?>