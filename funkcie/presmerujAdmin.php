<?php
if(!isset($_SESSION['name'])){
    header("Location:index.php");
} else {
    if ($_SESSION['name'] != 'admin@admin') {
        header("Location:index.php");
    }
}
?>