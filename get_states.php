<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pr9";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$country_id = intval($_GET['country_id']);

$sql = "SELECT id, name FROM states WHERE country_id = $country_id";
$result = $conn->query($sql);

$states = array();
while($row = $result->fetch_assoc()) {
    $states[] = $row;
}

$conn->close();
echo json_encode($states);
?>
