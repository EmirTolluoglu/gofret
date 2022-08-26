<?php
// Array with names
$a[] = "Müzik";
$a[] = "Kitap Okumak";
$a[] = "Ders Çalışmak";
$a[] = "Yazılım";
$a[] = "Bilişim";
$a[] = "C++";
$a[] = "C#";
$a[] = "Hayvanlar";
$a[] = "Şarkı";
$a[] = "Matematik";
$a[] = "Tasarım";
$a[] = "Modelleme";
$a[] = "Oyun";
$a[] = "Burak";
$a[] = "Gofret";
$a[] = "Yemek";
$a[] = "Spor";
$a[] = "Fitness";
$a[] = "Kişisel Gelişim";
$a[] = "Hızlı Öğrenme";
$a[] = "Yabancı Dil";
$a[] = "İngilizce";
$a[] = "Almanca";
$a[] = "Türkçe";
$a[] = "Psikoloji";
$a[] = "Kurumsal";
$a[] = "Logo";
$a[] = "Fransızca";
$a[] = "Arapça";
$a[] = "İspanyolca";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
if($hint !== "") {echo $hint;}
?>