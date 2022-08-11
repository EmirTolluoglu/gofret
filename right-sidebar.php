<div id="right" class="col">
    <div id="profile-card" class="badge-handle">
        <div class="side-card rounded-4">
            <div class="banner">
                <img src="<?php if(isset($_SESSION['user_id'])) {echo $user['profile_photo'];} ?>" class="mx-auto img2" alt="Profile Photo">
            </div>
            <h5 class="mt-5 name"><?php if(isset($_SESSION['user_id'])) {echo $user['name'];} ?></h5>
            <div class="level">
                <p class="mb-0">lvl.12</p>
                <div class="progress rounded-5" style="height: 1.2rem;">
                    <div class="progress-bar" role="progressbar"
                        style="width: 75%; background-color: rgb(233, 205, 84);" aria-valuenow="75" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
            <p class="desc">il muhtarı<br>****<br></p>
            <hr class="mx-auto mb-1">
            <p class="text-center my-0">başarımlar</p>
        </div>
        <div class="badge-container">
            <div class="badge"><i class="fa-solid fa-atom fa-2x"></i></div>
            <div class="badge"><i class="fa fa-bookmark fa-2x"></i></div>
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