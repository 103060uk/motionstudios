<?php

$dsn = "mysql:host=localhost;dbname=motionstudiosusers"; 
$dbusername = "admin";
$dbpassword = "ADMIN";

try {
   $pdo = new PDO($dsn, $dbusername, $dbpassword); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

