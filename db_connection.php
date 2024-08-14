<?php
// db_connection.php

// Retrieve database credentials from environment variables
$db_host = getenv('DB_HOST');       // Database host
$db_username = getenv('DB_USERNAME'); // Username
$db_password = getenv('DB_PASSWORD'); // Password
$db_name = getenv('DB_NAME');       // Database name
$db_port = getenv('DB_PORT');       // Port (usually 1433 for MSSQL)

// Create a new SQL Server connection
$connectionOptions = array(
    "Database" => $db_name,
    "Uid" => $db_username,
    "PWD" => $db_password,
    "ConnectionPooling" => false, // Disable connection pooling if needed
);

// Establish the connection
$conn = sqlsrv_connect($db_host . "," . $db_port, $connectionOptions);

// Check connection
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Use $conn to perform database operations
?>
