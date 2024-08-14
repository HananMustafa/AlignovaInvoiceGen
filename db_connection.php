<?php
// db_connection.php

// Retrieve database credentials from environment variables
$db_host = getenv('DB_HOST');
$db_username = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');
$db_port = getenv('DB_PORT'); 

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name, $db_port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Now you can use $conn to perform database operations
?>
