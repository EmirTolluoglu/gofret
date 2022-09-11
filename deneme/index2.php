<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gofret";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $myfile = fopen("gofret.sql", "r") or die("Unable to open file!");
  
  
  $stmt2 = $conn->prepare(fread($myfile,filesize("gofret.sql")));
  $stmt2->execute();
  fclose($myfile);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>