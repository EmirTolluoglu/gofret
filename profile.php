<?php
include "header.php";

if (empty($_SESSION['user_id']) or $_SESSION['user_id'] == "1") {
    header("Location:pre-register.php");
    exit;
}

if(isset($_GET['u'])){
    $userid = $_GET['u'];
}

$kullanicisor=$conn->prepare("SELECT * FROM user where user_id=$userid");
$kullanicisor->execute();
$user=$kullanicisor->fetch(PDO::FETCH_ASSOC);
$_SESSION['user_profile_photo'] = $user['user_profile_photo'];
$_SESSION['user_profile_banner'] = $user['user_profile_banner'];

$user_interests_valuesor = $conn->prepare("SELECT user_interests_value FROM user_interests WHERE user_id = :user_id");
$user_interests_valuesor->bindParam(':user_id', $user_id);
$user_interests_valuesor->execute();



$user_interests_values = $user_interests_valuesor->setFetchMode(PDO::FETCH_ASSOC);
$user_interests_values = $user_interests_valuesor->fetchAll();
$user_interests_count = count($user_interests_values);

?>

<main>
    <div class="container">
        <div class="row my-5">
            <?php include_once "left-sidebar.php" ?>
            <div id="middle" class="col-xxl-6 col-xl-6 col-lg-5 col-md-8">
                <div class="badge-handle">
                    <div class="side-card rounded-4 bg-white">
                        <div class="banner" style="background-image: url(<?php echo $_SESSION['user_profile_banner']; ?>)">
                            <div class="profile-card">
                                <img src="<?php echo $_SESSION['user_profile_photo']; ?>" alt="Profile Photo">
                                <div class="card-section">
                                    <h4 class="text-name font-monospace"><?php if(isset($_SESSION['user_id'])) {echo $user['user_name'];} ?></h5>
                                        <p class="school gtext-secondary fs-7"><?php if(isset($_SESSION['user_id'])) {echo $user['user_school'];} ?><br><?php if(isset($_SESSION['user_id'])) {echo $user['user_city'];} ?></p>
                                        <p class="degree text-name"><?php if(isset($_SESSION['user_id'])) {echo $user['user_class'];} ?>.sınıf</p>
                                </div>
                            </div>
                        </div>
                        <div class="level d-flex justify-content-end pt-2 me-3">
                            <p class="fs-5 mb-0 fw-bold text-name">lvl.<?php if(isset($_SESSION['user_id'])) {echo $user['user_level'];} ?></p>
                            <div class="progress rounded-5 ms-3" style="height: auto; width: 8vw;">
                            <div class="progress-bar" role="progressbar"
                        style="width: <?php if(isset($_SESSION['user_id'])) {echo $user['user_level_xp'];} ?>%; background-color: rgb(233, 205, 84);" aria-valuenow="<?php if(isset($_SESSION['user_id'])) {echo $user['user_level_xp'];} ?>" aria-valuemin="0"
                        aria-valuemax="100"></div>
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
                        <?php for ($i=0; $i < $userbadgecount; $i++) { ?>
                        <div class="badge mx-1"><i class="fa fa-<?php echo $badges[$i]['badge_pic']; ?> fa-3x"></i></div>
                        <?php } ?>
                    </div>
                </div>



                <div id="about" class="card mt-0">
                    <h6 class="text-name ms-2">Hakkında</h6>

                    <form action="src/edit_bio.php" method="POST">
                    <textarea id="biography" class="input w-100" rows="7" maxlength="420" name="biography" oninput="benimfonksiyon()"><?php echo $user['user_biography'];?></textarea>
                    <br>
                    <input id="biobtn" disabled type="submit" value="Kaydet">
                    <script>
                    function benimfonksiyon() {
                    document.getElementById("biobtn").disabled=false;
                    }

                    </script>
                    </form>      
                </div>



                <div id="interests" class="card">
                    <h6 class="text-name ms-2">İlgi Alanları</h6>
                    <div class="handle d-flex flex-wrap justify-content-start text-white">
                       
                        <?php for ($i=0; $i <$user_interests_count ; $i++) { 
                            
                         ?>
                            <div>
                            <p><?php echo $user_interests_values[$i]['user_interests_value'];?></p>
                            </div>          
                        <?php
                        }
                        ?>

                        <div >


                        <form id="interests_Form" action="src/interests.php" method="POST">

                        <input name="user_interests_value" id="interest_button" class="card" type="text" style="width: 100px; height:auto;">
                            
                        <input onclick="add_new_interests()" type="submit" value="ekle">

                        </div>
                    </form> 
                    <script>
                    var interest = document.getElementById("interests_Form");
                        function add_new_interests(){
                        interest.classList.add("d-none")        
                            

                        }


                    </script>

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
            <?php include_once "right-sidebar.php" ?>
        </div>
    </div>

</main>

<?php include_once "footer.php" ?>