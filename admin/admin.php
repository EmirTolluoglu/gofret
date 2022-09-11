<?php
require_once "../src/connect.php";
session_start();

if (!(isset($_SESSION['user_id'])) || $_SESSION['admin'] != 2) {
    header("Location: ../index");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM user WHERE permissin = 0");
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
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
            <th>Ad</th>
            <th>Okul</th>
            <th>Sınıf</th>
            <th>email</th>
            <th>izin?</th>
        </tr>
        <?php foreach ($people as $pep) { ?>
            <tr>
                <td><?= $pep['user_name'] ?></td>
                <td><?= $pep['user_school'] ?></td>
                <td><?= $pep['user_class'] ?></td>
                <td><?= $pep['user_email'] ?></td>
                <td>
                    <form action="yap.php" method="POST">
                        <select id="durum" name="durum">
                            <option value="red">Reddet</option>
                            <option value="kabul">Kabul</option>
                            <option value="admin">Admin</option>
                        </select>
                        <input type="hidden" name="userin_id" value="<?= $pep['user_id'] ?>">
                        <input type="submit">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php include "sqlqueryinput.php"; ?>

    
</body>

</html>