<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Pr9";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$state_id = intval($_GET['state_id']);

$sql = "SELECT id, name FROM cities WHERE state_id = $state_id";
$result = $conn->query($sql);

$cities = array();
while($row = $result->fetch_assoc()) {
    $cities[] = $row;
}

$conn->close();
echo json_encode($cities);
?>
