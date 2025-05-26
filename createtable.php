<?php

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "museumdb";

$conn = new mysqli($server_name, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$create_table = "CREATE TABLE Feedback (
id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
wherefrom VARCHAR(30) NOT NULL,
comment VARCHAR(50) NOT NULL,
date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_table) === TRUE) {
    echo "Table Feedback created succesfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close()

?>