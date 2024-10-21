<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Pr9";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve selected data from the form submission
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];

// Insert the selected data into a table
$sql = "INSERT INTO selected_data (country, state, city) VALUES ('$country', '$state', '$city')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
