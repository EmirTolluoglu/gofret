<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css" />
    <title>Document</title>
</head>

<body>

    <style>
    html,
    body,
    main {
        height: 100%;
        width: 100%;
        font-family: 'Poppins', sans-serif;
    }

    main .back {
        height: 100%;
        width: auto;
        background-repeat: no-repeat;
        background-image: url("img/back.png");
        background-size: cover;
        position: relative;
    }

    .back .handle {
        position: absolute;
        top: 40%;
        width: 100%;
    }

    .back .handle .btn {
        width: 60%;
        padding: 0;
        border: 2px solid white;
        border-radius: 1rem;
    }

    .back .handle .register {
        color: rgb(153, 35, 131);
        border: 0.15rem solid rgb(153, 35, 131);
    }

    .back .handle .login {
        color: rgb(62, 186, 162);
        border: 0.15rem solid rgb(62, 186, 162);
    }

    .back .handle img {
        width: 144px;
        height: 54px;
        position: fixed;
        left: 30%;
        bottom: 3rem;
    }

    .fs-5-5 {
        font-size: 1.15rem;
    }
    </style>
    <main>
        <div class="back">
            <div class="handle text-center text-white">
                <h3>Sonunda<br />Aramıza Katıldın!
                    </h4>
                    <div class="btn register mt-5 fs-5-5 fw-bold">
                      <a style="color: rgb(153, 35, 131);" class="text-decoration-none" href="register.php">Kayıt Ol</a>
                    </div>
                    <div class="btn login mt-3 fs-5-5 fw-bold">
                      <a style="color: rgb(62, 186, 162);" class="text-decoration-none" href="login">Giriş Yap</a>
                    </div>
                    <img src="img/gofret.png" alt="logo" />
            </div>
        </div>
    </main>
    <script src="lib/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>