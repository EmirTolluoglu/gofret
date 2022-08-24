<?php


function mobilmi()
{
    //Sunucuya tarayıcıdan gelen istek doğrultusunda ziyaretçinin cihaz bilgileri iletilir, 
    //preg_match methodu ile bu terimlerin olup olmadığı kontrol edilir.
    //return ile döndürülür.
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <script>
        document.cookie = 'sandwich=turkey;';
    </script>
    <?php echo $_COOKIE['sandwich']; ?>
</body>

</html>