<?php
include_once "header.php";
$path = __FILE__;
$file = basename($path, ".php");
?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php"; ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="badge-handle">
                    <div class="side-card rounded-4 bg-white">
                        <div class="banner">
                            <div class="profile-card">
                                <img src="img/profile.jpg" class="" alt="Profile Photo">
                                <div class="card-section">
                                    <h4 class="text-name font-monospace">İrem Türk</h5>
                                        <p class="school gtext-secondary fs-7">Haydarpaşa Lisesi<br>İstanbul,Türkiye</p>
                                        <p class="degree text-name">10.Sınıf</p>
                                </div>
                            </div>
                        </div>
                        <div class="level d-flex justify-content-end pt-2 me-3">
                            <p class="fs-5 mb-0 fw-bold text-name">lvl.12</p>
                            <div class="progress rounded-5 ms-3" style="height: auto; width: 8vw;">
                                <div class="progress-bar" role="progressbar" style="width: 75%; background-color: rgb(233, 205, 84);" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-around mt-4">
                            <div class="p-2 text-name">127 arkadaş
                                <p class="fs-7 text-name-muted">20 ortak arkadaş</p>
                            </div>
                            <div class="p-2 gtext-secondary">57 tamamlanmış takas</div>
                            <div class="p-2 gtext-secondary">18 Başarım</div>
                        </div>
                    </div>
                    <div class="badge-container me-4 h-25">
                        <div class="badge mx-1"><i class="fa fa-bookmark fa-3x"></i></div>
                        <div class="badge mx-1"><i class="fa fa-bookmark fa-3x"></i></div>
                        <div class="badge mx-1"><i class="fa fa-bookmark fa-3x"></i></div>
                    </div>
                </div>
                <div id="about" class="card mt-0">
                    <h6 class="text-name ms-2">Hakkında</h6>

                    <form action="src/edit_bio.php" method="POST">
                    <textarea id="bio" name="bio" rows="7" cols="65"></textarea>
                    <br>
                    <input type="submit" value="Kaydet">
                    </form>
                </div>
                <div id="interests" class="card">
                    <h6 class="text-name ms-2">İlgi Alanları</h6>
                    <div class="handle d-flex flex-wrap justify-content-start text-white">
                        <div>
                            <p>Müzik - Gitar</p>
                        </div>
                        <div>
                            <p>Matematik</p>
                        </div>
                        <div>
                            <p>Yemek Yapmak</p>
                        </div>
                        <div>
                            <p>Fotoğraf Çekmek</p>
                        </div>
                        <a href="">
                            <div><i class="fa fa-plus text-black"> </i></div>
                        </a>
                    </div>
                    <p><br><br><br><br><br></p>
                </div>
                <div id="trade" class="row">
                    <div class="col" style="height: 100%;">
                        <h5 class="text-name m-0">Güncel Takaslar</h5>
                        <div class="card mt-2">
                            <p><br><br><br><br><br></p>
                        </div>
                    </div>
                    <div class="col" style="height: 100%;">
                        <h5 class="text-name m-0">Geçmiş Takaslar</h5>
                        <div class="card mt-2">
                            <p><br><br><br><br><br></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once "right-sidebar.php"; ?>
        </div>
    </div>

</main>

<?php include_once "footer.php"; ?>
