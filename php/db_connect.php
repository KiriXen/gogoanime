<?php
$host = "localhost";
$dbname = "gogoanime1";
$username = "root"; // Change this to your MySQL username
$password = "";     // Change this to your MySQL password (the password is empty on localhost)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>