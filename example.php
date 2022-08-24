<?php 

include 'src/connect.php';
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

$array2 = array(
    ["id" => 1, "name" => "foo", "age" => "10"],
    ["id" => 2, "name" => "bar", "age" => "20"],
    ["id" => 3, "name" => "baz", "age" => "30"]
);
$stmt = $conn->prepare("SELECT * FROM message WHERE to_user_id =38 ORDER BY message_date ASC");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>