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
