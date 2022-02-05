<?php
session_start();
require "AuthController.php";
$authctr = new AuthController();
$conn = mysqli_connect("localhost","root","","databaza2");
try {
    $con = new PDO("mysql:host=localhost;dbname=databaza2", "root", "");
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("DB error: " . $e->getMessage());
}
?>
