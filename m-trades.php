<?php include 'header.php'; 
if($mobil) {header('Location: trades');}
?>

    <main id="m-trade">
      <div class="container mb-5 p-1">
        <div id="current-trades">
            <div class="card py-3 px-0">
                <div class="d-flex justify-content-between align-items-center mx-3 mb-3">
                  <img class="profile-photo" src="img/pp1.jpg" alt="pp">
                  <div class="handle me-auto ms-2">
                    <h4 class="m-0 mb-1">Zeynep Erşan</h6>
                        <div class="d-inline-block rounded-4 px-2 fw-bold text-light align-self-baseline" style="background-color: crimson;">lvl.12</div>
                  </div>
                    <p>Online  <strong>4/5</strong></p>
                </div>
                <div class="trade-main bg-danger d-flex justify-content-around rounded-4 p-3 text-white mb-3">
                    <div class="handle">
                        <h5 class="mb-0">İngilizce</h5>
                        <p class="mb-0">Yazım</p>
                    </div>
                    <img src="img/trade.png" alt="trade">
                    <div class="handle">
                        <h5 class="mb-0">Öğrenme</h5>
                        <p class="mb-0">İsteği</p>
                    </div>
                </div>
                <div class="trade-suc d-flex justify-content-center align-items-center">
                    <div class="btn btn-gofret me-2"> Ders onayla</div>
                    <a href=""><i class="fa fa-flag text-danger me-2"></i></a>
                    <a href=""><i class="fa fa-ellipsis-vertical"></i></a>
                </div>
              </div>
              <div class="card py-3 px-0">
                <div class="d-flex justify-content-between align-items-center mx-3 mb-3">
                  <img class="profile-photo" src="img/pp1.jpg" alt="pp">
                  <div class="handle me-auto ms-2">
                    <h4 class="m-0 mb-1">Zeynep Erşan</h6>
                        <div class="d-inline-block rounded-4 px-2 fw-bold text-light align-self-baseline bg-primary">lvl.12</div>
                  </div>
                    <p>Online  <strong>4/5</strong></p>
                </div>
                <div class="trade-main bg-primary d-flex justify-content-around rounded-4 p-3 text-white mb-3">
                    <div class="handle">
                        <h5 class="mb-0">İngilizce</h5>
                        <p class="mb-0">Yazım</p>
                    </div>
                    <img src="img/trade.png" alt="trade">
                    <div class="handle">
                        <h5 class="mb-0">Öğrenme</h5>
                        <p class="mb-0">İsteği</p>
                    </div>
                </div>
                <div class="trade-suc d-flex justify-content-center align-items-center">
                    <div class="btn btn-gofret me-2"> Ders onayla</div>
                    <a href=""><i class="fa fa-flag text-danger me-2"></i></a>
                    <a href=""><i class="fa fa-ellipsis-vertical"></i></a>
                </div>
              </div>
        </div>
        <div id="trade-requests" class="my-2">
          <a class="text-decoration-none fs-5 text-black ms-2">Takas İstekleri <i class="fa fa-caret-down"></i></a>
          <div class="card mt-1">
            <div class="d-flex align-items-center ">
                <img class="profile-photo img1-2x me-2" src="img/pp1.jpg" alt="pp">
                <p class="mb-0 fs-5">Emir Tolluoğlu</p>
            </div>

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
