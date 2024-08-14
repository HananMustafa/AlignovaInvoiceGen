<?php
// db_connection.php

// Database credentials
$host = 'adaptable-prod.database.windows.net';
$port = '1433';
$dbname = 'alignovainvoicegen-main-db-093047a122974de21';
$username = 'alignovainvoicegen-main-db-093047a122974de21';
$password = 'zBtJxn5v2a9ADEKCy8jxeZbcWNGyzR';

// Create a new PDO instance
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
