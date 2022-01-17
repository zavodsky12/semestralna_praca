<?php
session_start();
require "AuthController.php";
//require "App.php";
$authctr = new AuthController();
//$app = new App();
//$conn = mysqli_connect("localhost","root","dtb456","databaza");
$conn = mysqli_connect("localhost","root","","databaza2");
if(isset($_SESSION['name'])){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vlastne.css">
    <link rel="stylesheet" href="nove.css">
    <title>Obchod so športovými potrebami bikeski.sk | Všetky produkty</title>
    <script src="javaskripty.js"></script>
    <script>
        var prih = true;
        <?php if(Auth::isBadLoggin()) { ?>
        prih = true;
        <?php unset($_SESSION['bad']); ?>
        <?php } else { ?>
        prih = false;
        <?php } ?>
        window.onload = function () {
            vytvorPrihlasenie(prih);
        }
    </script>
</head>
<body>
<div id="stranka"></div>
</body>
</html>
