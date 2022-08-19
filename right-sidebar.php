<div id="right" class="col">
    <div id="profile-card" class="badge-handle">
        <div class="side-card rounded-4">
            <div class="banner" style="background-image: url(<?php echo $_SESSION['user_profile_banner']; ?>)">
                <img src="<?php echo $_SESSION['user_profile_photo']; ?>" class="mx-auto img2" alt="Profile Photo">
            </div>
            <h5 class="mt-5 name"><?php echo $_SESSION['user_name'];?></h5>
            <div class="level">
            <div class="level d-flex justify-content-end pt-2 me-3">
                            <p class="fs-5 mb-0 fw-bold text-name" style="margin-right: 0px;">lvl.<?php echo $user['user_level']; ?></p>
                            <div class="progress rounded-5 ms-3" style="height: auto; width: 8vw; margin-right: 2rem;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $user['user_level_xp']; ?>%; background-color: rgb(233, 205, 84);" aria-valuenow="<?php echo $user['user_level_xp']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
            </div>
            <p class="desc">il muhtarı<br>****<br></p>
            <hr class="mx-auto mb-1">
            <p class="text-center my-0">başarımlar</p>
        </div>
        <div class="badge-container p-2">
            <?php for ($i=0; $i < $userbadgecount; $i++) { 
                
            ?>
            <div class="badge"><i class="fa-regular fa-<?php echo $badges[$i]['badge_pic']; ?> fa-2x"></i></div>
            <?php } ?>
        </div>
    </div>
    <div class="current-trades text-center align-items-center g-3 w-100 container">
        <h6 class="text-gofret">Güncel Takaslar</h6>
        <div class="card-back rounded-4 bg-white p-3">
            <div class="card2">
                <img src="img/pp1.jpg" alt="burak">
                <div class="handle ms-2 w-100">
                    <div class="handle2">
                        <p>Burak Gümrah</p>
                        <p class="m-0">lvl.20</p>
                    </div>
                    <h6 style="text-align: left;">Matematik - Parabol</h6>
                </div>
            </div>
            <div class="card2">
                <img src="img/pp2.jpg" alt="burak">
                <div class="handle ms-2 w-100 text-left">
                    <div class="handle2 align">
                        <p>Zeynep Erşan :3</p>
                        <p class="m-0">lvl.28</p>
                    </div>
                    <h6 style="text-align: left;">Müzik - Gitar</h6>
                </div>
            </div>
        </div>
    </div>
</div>