<?php
require_once "src/connect.php";
if (isset($_SESSION["user_id"])) {
  header("Location: profile/" . $_SESSION["user_name"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>register | gofret</title>

  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css" />
  <link rel="icon" type="image/x-icon" href="img/ico.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <style>
    nav {
      display: none;
    }

    html,
    body,
    main {
      height: 100%;
      margin: 0;
      width: 100%;
      font-family: 'Poppins', sans-serif;
    }

    main .back {
      height: 100vh;
      width: 100vw;
      background-repeat: no-repeat;
      background-image: url("img/back.png");
      background-size: cover;
      position: absolute;
      filter: blur(5px);
    }

    main .logo {
      position: fixed;
      width: 112px;
      height: 42px;
      transform: translateX(50%);
      bottom: 1.5rem;
      right: 50%;
    }

    main form {
      position: absolute;
      top: 40%;
      right: 50%;
      transform: translateX(50%);

    }

    main .motto {
      font-weight: 600;
      color: aliceblue;
      position: absolute;
      text-align: center;
      max-width: 10rem;
      top: 8rem;
      font-size: 1.7rem;
      right: 50%;
      transform: translateX(50%);
    }

    /* @extend display-flex; */

    a:focus,
    a:active {
      text-decoration: none;
      outline: none;
      transition: all 300ms ease 0s;
      -moz-transition: all 300ms ease 0s;
      -webkit-transition: all 300ms ease 0s;
      -o-transition: all 300ms ease 0s;
      -ms-transition: all 300ms ease 0s;
    }

    input,
    select,
    textarea {
      outline: none;
      appearance: unset !important;
      -moz-appearance: unset !important;
      -webkit-appearance: unset !important;
      -o-appearance: unset !important;
      -ms-appearance: unset !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      appearance: none !important;
      -moz-appearance: none !important;
      -webkit-appearance: none !important;
      -o-appearance: none !important;
      -ms-appearance: none !important;
      margin: 0;
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      box-shadow: none !important;
      -moz-box-shadow: none !important;
      -webkit-box-shadow: none !important;
      -o-box-shadow: none !important;
      -ms-box-shadow: none !important;
    }

    input[type=checkbox] {
      appearance: checkbox !important;
      -moz-appearance: checkbox !important;
      -webkit-appearance: checkbox !important;
      -o-appearance: checkbox !important;
      -ms-appearance: checkbox !important;
    }

    input[type=radio] {
      appearance: radio !important;
      -moz-appearance: radio !important;
      -webkit-appearance: radio !important;
      -o-appearance: radio !important;
      -ms-appearance: radio !important;
    }

    .signup {
      margin-bottom: 150px;
    }

    .signup-content {
      padding: 75px 0;
    }

    .signup-form,
    .signup-image,
    .signin-form,
    .signin-image {
      width: 50%;
      overflow: hidden;
    }

    .signup-image {
      margin: 0 55px;
    }

    .form-title {
      margin-bottom: 33px;
    }

    .signup-image {
      margin-top: 45px;
    }

    figure {
      margin-bottom: 50px;
      text-align: center;
    }

    .form-submit {
      font-size: 13px;
      display: inline-block;
      font-weight: bolder;
      background: #714aab;
      color: #fff;
      border-bottom: none;
      width: 100%;
      padding: 10px 0;
      border-radius: 16px;
      margin-top: 45px;
      cursor: pointer;
    }

    .form-submit:hover {
      background: #4292dc;
    }

    #signin {
      margin-top: 16px;
    }

    .signup-image-link {
      font-size: 14px;
      color: #222;
      display: block;
      text-align: center;
    }

    .term-service {
      font-size: 13px;
      color: #222;
    }

    .signup-form {
      margin-left: 75px;
      margin-right: 75px;
      padding-left: 34px;
    }

    .register-form {
      width: 80%;
    }

    .form-group {
      position: relative;
      margin-bottom: 11px;
      overflow: hidden;
    }

    .form-group:last-child {
      margin-bottom: 0px;
    }

    input {
      color: rgb(58, 222, 137);
      font-size: 0.8rem;
      background: transparent;
      width: 100%;
      display: block;
      border: none;
      border-bottom: 2px solid rgb(170, 170, 170);
      padding: 5px 25px;
      font-family: Poppins;
      box-sizing: border-box;
    }

    input:focus {
      border-bottom: 2px solid rgb(58, 222, 137);
    }

    input[type=checkbox]:not(old) {
      width: 2em;
      margin: 0;
      padding: 0;
      font-size: 1em;
      display: none;
    }

    ::placeholder {
      /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: rgb(255, 255, 255);
      opacity: 1;
      /* Firefox */
    }

    input[type=checkbox]:not(old)+label {
      display: inline-block;
      line-height: 1.5em;
      margin-top: 6px;
      color: orangered;
      font-size: 12px;
    }

    input[type=checkbox]:not(old)+label>span {
      display: inline-block;
      width: 12px;
      height: 12px;
      margin-right: 3px;
      margin-bottom: 3px;
      border: 2px solid orangered;
      border-radius: 3px;
      background: transparent;
      vertical-align: bottom;
    }

    * {
      font-family: poppins;
    }

    input[type=checkbox]:not(old):checked+label>span:before {
      content: '✓';
      position: absolute;
      top: 0px;
      display: block;
      color: rgb(58, 222, 137);
      font-size: 15px;
      line-height: 1.2;
      text-align: center;
      font-family: 'Material-Design-Iconic-Font';
      font-weight: bold;
    }

    .forget {
      position: absolute;
      right: 0 !important;
      left: unset;
    }

    .forget a {
      font-size: 12px;
      color: orangered;
      text-decoration: none;
    }

    .agree-term {
      display: inline-block;
      width: auto;
    }

    label {
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      color: rgb(34, 34, 34);
    }

    .label-agree-term {
      position: relative;
      top: 0%;
      transform: translateY(0);
    }

    form .btn {
      height: 50px;
      width: 100%;
      border-radius: 15px;
      position: relative;
      overflow: hidden;
    }

    form .btn .btn-layer {
      height: 100%;
      width: 300%;
      position: absolute;
      left: -100%;
      background: -webkit-linear-gradient(right, #003366, #004080, #0059b3, #0073e6);
      border-radius: 15px;
      transition: all 0.4s ease;
      ;
    }

    form .btn:hover .btn-layer {
      left: 0;
    }

    form .btn input[type="submit"] {
      height: 100%;
      width: 100%;
      z-index: 1;
      position: relative;
      background: none;
      border: none;
      color: #fff;
      padding-left: 0;
      border-radius: 15px;
      font-size: 20px;
      font-weight: 500;
      cursor: pointer;
    }

    .border-b {
      border-bottom-width: 1px;

    }

    .translate-y-1\/2 {
      transform: translateY(50%);
    }

    .btn-hr {
      height: 4px;
      width: 100%;
      border-bottom: #714aab solid 2px;
      border-radius: 15px;
    }

    .btn-reg {
      border: 2px solid #ffffff;
      font-size: 13px;
      font-weight: bolder;
    }
  </style>
  <?php include_once 'preloader.php'; ?>
  <main>
    <div class="back"> </div>
    <h4 class="motto">Mağaraya ulaştın</h4>
    <form action="src/sign.php" method="POST" class="register-form" id="register-form">
      <div class="form-group">
        <label for="email"><i class="fa fa-envelope fa-xs ms-1 text-white"></i></label>
        <input type="email" name="email" id="email" placeholder="Your Email" />
      </div>
      <div class="form-group mb-1">
        <label for="pass"><i class="fa fa-lock fa-xs ms-1 text-white"></i></label>
        <input type="password" name="pass" id="pass" placeholder="Password" />
      </div>

      <div class="form-group">
        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
        <label for="agree-term" class="label-agree-term"><span><span></span></span>Beni Unutma</label>
        <label for="agree-term" class="forget"><a class="" href="">Şifremi Unuttum :/</a></label>
      </div>
      <div class="form-group form-button">
        <input type="submit" name="login" id="login" class="form-submit" value="Giriş Yap" />
      </div>
      <div class="btn-hr"></div>
      <a class="text-decoration-none" href="register">
        <div class="btn-reg py-2 mt-3 rounded-4 border-white bg-transparent w-100 text-center text-white">Kayıt Olmalıyım</div>
      </a>
      </div>
    </form>

    <img class="logo" src="img/gofret.png" alt="logo" />

  </main>

  <script src="js/all.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/vendor/modernizr-3.11.2.min.js"></script>
</body>

</html>