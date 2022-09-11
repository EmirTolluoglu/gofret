<?php

require_once "../src/connect.php";
session_start();

if (!(isset($_SESSION['user_id'])) || $_SESSION['admin'] != 2) {
    header("Location: ../index");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userler</title>
</head>
<body>
    <style>
        table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
    </style>
    <table>
        <tr>
            <th>Id</th>
            <th>Ad</th>
            <th>tüm ad</th>
            <th>mail</th>
            <th>şehir</th>
            <th>okul</th>
            <th>sınıf</th>
            <th>level</th>
            <th>xp</th>
            <th>izin?</th>
        </tr>

        <?php foreach ($people as $pep) { ?>
            <tr>
                <td><?= $pep['user_id'] ?></td>
                <td><?= $pep['user_name'] ?></td>
                <td><?= $pep['full_name'] ?></td>
                <td><?= $pep['user_email'] ?></td>
                <td><?= $pep['user_city'] ?></td>
                <td><?= $pep['user_school'] ?></td>
                <td><?= $pep['user_class'] ?></td>
                <td><?= $pep['user_level'] ?></td>
                <td><?= $pep['user_level_xp'] ?></td>
                <td><?= $pep['permissin'] ?></td>
            </tr>
        <?php } ?>
    <table>
    <?php include "sqlqueryinput.php"; ?>
</body>
</html>