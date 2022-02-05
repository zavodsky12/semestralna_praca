<?php
require_once "funkcie/pripojDatabazu.php";
require_once "funkcie/presmerujPrihlaseny.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once "funkcie/pripajanieSuborov.php";
    ?>
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
