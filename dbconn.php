<?php

require_once 'mongo-php/src/Client.php';

// Replace <password> with your actual password
$connectionString = 'mongodb+srv://hananmustafa:<password>@cluster0.69nsn.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

// Create a MongoDB client
try {
    $client = new MongoDB\Client($connectionString);

    // Select a database
    $database = $client->selectDatabase('yourDatabaseName');

    // Select a collection
    $collection = $database->selectCollection('yourCollectionName');

    echo "Connected to MongoDB successfully!";
} catch (Exception $e) {
    echo "Failed to connect to MongoDB: " . $e->getMessage();
}

?>
