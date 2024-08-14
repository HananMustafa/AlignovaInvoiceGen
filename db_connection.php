<?php
// db_connection.php

// Retrieve database credentials from environment variables
$db_host = getenv('DB_HOST');       // Server name, e.g., "your_server_name"
$db_username = getenv('DB_USERNAME'); // Username
$db_password = getenv('DB_PASSWORD'); // Password
$db_name = getenv('DB_NAME');       // Database name
$db_port = getenv('DB_PORT');       // Port (typically 1433 for SQL Server)

// Create a new SQL Server connection
$connectionOptions = array(
    "Database" => $db_name,
    "Uid" => $db_username,
    "PWD" => $db_password
);

// Establishes the connection
$conn = sqlsrv_connect($db_host, $connectionOptions);

// Check connection
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Connected successfully";

// Now you can use $conn to perform database operations
?>
