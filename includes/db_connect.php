<?php
include('connectionData.txt');

// Create a new PDO connection
try {
    $conn = new PDO("mysql:host=$server;port=$port;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>