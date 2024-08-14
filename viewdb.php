<?php

require_once 'db_connection.php';


// // Query to show tables
// $sql = "SHOW TABLES";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         echo "Table: " . $row["Tables_in_$dbname"] . "<br>";
//     }
// } else {
//     echo "No tables found";
// }

// Query to show rows from a specific table
// $table_name = "your_table_name";
// $sql = "SELECT * FROM $table_name";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         print_r($row);
//         echo "<br>";
//     }
// } else {
//     echo "No rows found";
// }

// $conn->close();




//PDO METHOD

try {
    $dsn = "sqlsrv:Server=$db_host,$db_port;Database=$db_name";
    $pdo = new PDO($dsn, $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Query to show tables
$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES";
try {
    $stmt = $pdo->query($sql);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN, 2); // Fetch table names
    
    if (count($tables) > 0) {
        foreach ($tables as $table) {
            echo "Table: " . htmlspecialchars($table) . "<br>";
        }
    } else {
        echo "No tables found";
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
$pdo = null;
?>
