<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gofret";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function replace_tr($text) {
  $text = trim($text);
  $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ','.', ',', '#', '$', '%', '&');
  $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-','-','-','-','-','-','-',);
  $new_text = str_replace($search,$replace,$text);
  return $new_text;
} 
?>