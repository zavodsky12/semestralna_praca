<?php
require_once "funkcie/pripojDatabazu.php";
require_once "funkcie/presmerujUprava.php";
?>


<!DOCTYPE html>
<html lang="sk">
<head>
    <?php
    require_once "funkcie/pripajanieSuborov.php";
    ?>
</head>

<body>
<?php
require_once "funkcie/hornaCast.php";
?>

<div class="row">
    <?php
    require_once "funkcie/menucko.php";
    ?>

    <div class="col-6 col-s-8">
        <div class="main" id="hlav">
            <h1>Všetky produkty</h1>
            <ul style="background-color: #0073e6">
                <li class="sortovace" onclick="utriedNazov('hlav')">Utrieď podľa názvu</li>
                <li class="sortovace" onclick="utriedCena('hlav')">Utrieď podľa ceny</li>
                <li class="sortovace" onclick="utriedPocet('hlav')">Utrieď podľa počtu produktov na sklade</li>
            </ul>
            <br>
            <input class="cierna vyhladaj" type="text" id="filtrovanie" onkeyup="filterList()" placeholder="Vyhľadaj produkt.." title="Type in a name">
            <?php
            $pocet = 0;
            require_once "funkcie/selectmaxminProdukty.php";
            for ($i = $min; $i < $max+1; $i++) {
                $sql = "SELECT * FROM produkty WHERE id_produktu = '$i'";
                $stmt = $conn->query($sql);
                $string = $stmt->fetch_assoc();
                if (!is_null($string)) {
                    $pocet++;
                    ?>
                    <div class="w3-col horne" onclick="window.location.href = '/semestralka/produkt.php?sku=<?=$i?>';">
                        <div class="w3-card-4 w3-margin w3-white">
                            <?php $obraz = $string['obrazok']; ?>
                            <img src="files/<?=$obraz?>" alt="Nature" class="produkt-obr">
                            <div class="w3-container">
                                <?php $meno = $string['nazov']; ?>
                                <h3 class="rovnaka-vyska"><b><?=$meno?></b></h3>
                                <?php $pocetK = $string['pocet_kusov']; ?>
                                <h4>Pocet kusov na sklade: <span class="w3-opacity pocetTr"><?=$pocetK?></span></h4>
                                <?php $cena = $string['cena']; ?>
                                <h4>Cena: <span class="w3-opacity cenaTr"><?=$cena?> €</span></h4>
                                <p><button><b>Pozrieť produkt</b></button></p>
                                <?php if (isset($_SESSION['name'])) { ?>
                                    <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                                        <form method='post' class="zadnyForm">
                                            <p><button class="cervena" name="idcko" value='<?=$i?>'><b>Upraviť produkt</b></button></p>
                                        </form>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($pocet == 3) {
                    $pocet = 0;
                } ?>
            <?php } ?>
            <?php while ($pocet < 3) { ?>
                <div class="w3-col" style="height: 570px">
                </div>
                <?php $pocet++; ?>
            <?php } ?>

            <hr>

        </div>
    </div>

    <?php
    require_once "funkcie/praveMenucko.php";
    ?>
</div>

<?php
require_once "funkcie/spodnaCast.php";
?>
</body>
</html>
