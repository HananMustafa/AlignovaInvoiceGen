<?php

//sqlsrv code
// $db_host = getenv('DB_HOST');       
// $db_username = getenv('DB_USERNAME'); 
// $db_password = getenv('DB_PASSWORD'); 
// $db_name = getenv('DB_NAME');       
// $db_port = getenv('DB_PORT');       

// $connectionOptions = array(
//     "Database" => $db_name,
//     "Uid" => $db_username,
//     "PWD" => $db_password,
//     "ConnectionPooling" => false,
// );

// $conn = sqlsrv_connect($db_host . "," . $db_port, $connectionOptions);

// if ($conn === false) {
//     die(print_r(sqlsrv_errors(), true));
// }







//PDO code
$db_host = getenv('DB_HOST');       
$db_username = getenv('DB_USERNAME'); 
$db_password = getenv('DB_PASSWORD'); 
$db_name = getenv('DB_NAME');      
$db_port = getenv('DB_PORT');      

try {
    
    $dsn = "sqlsrv:Server=$db_host,$db_port;Database=$db_name";
    $pdo = new PDO($dsn, $db_username, $db_password);
    
  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
