<?php

require_once 'db_connection.php';


// Query to show tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Table: " . $row["Tables_in_$dbname"] . "<br>";
    }
} else {
    echo "No tables found";
}

// Query to show rows from a specific table
$table_name = "your_table_name";
$sql = "SELECT * FROM $table_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print_r($row);
        echo "<br>";
    }
} else {
    echo "No rows found";
}

$conn->close();
?>
