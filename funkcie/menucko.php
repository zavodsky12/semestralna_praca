<div class="col-2 col-s-12 menu">
    <ul>
        <li class="hlavne"><a href="index.php">Hlavná stránka</a></li>
        <li class="hlavne" onclick=dropdownSide("prve")>Letný šport<i class="fa fa-caret-down"></i></li>
        <li class="opacne prve"><a href="Letne/index.php?prod=1" class="red">Bicykle</a></li>
        <li class="opacne prve"><a href="Letne/index.php?prod=2" class="red">Kolobežky</a></li>
        <li class="opacne prve"><a href="Letne/index.php?prod=3" class="red">Korčule</a></li>
        <li class="opacne prve"><a href="Letne/index.php?prod=4" class="red">Príslušenstvo</a></li>
        <li class="opacne prve"><a href="Letne/index.php?prod=5" class="red">Doplnky</a></li>
        <li class="hlavne" onclick=dropdownSide("druhe")>Zimný šport<i class="fa fa-caret-down"></i></li>
        <li class="opacne druhe"><a href="Zimne/index.php?prod=1" class="red">Lyže</a></li>
        <li class="opacne druhe"><a href="Zimne/index.php?prod=2" class="red">Snowboardy</a></li>
        <li class="opacne druhe"><a href="Zimne/index.php?prod=3" class="red">Korčule</a></li>
        <li class="opacne druhe"><a href="Zimne/index.php?prod=4" class="red">Bežky</a></li>
        <li class="opacne druhe"><a href="Zimne/index.php?prod=5" class="red">Príslušenstvo</a></li>
        <li class="opacne druhe"><a href="Zimne/index.php?prod=6" class="red">Doplnky</a></li>
        <li class="hlavne" onclick=dropdownSide("tretie")>Doplnky<i class="fa fa-caret-down"></i></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Cyklodoplnky</a></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Cyklovýbava</a></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Lyžiarky</a></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Viazania</a></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Palice</a></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Letné doplnky</a></li>
        <li class="opacne tretie"><a href="Doplnky/index.php" class="red">Zimné doplnky</a></li>
    </ul>
    <?php if (isset($_SESSION['name'])) { ?>
        <br>
        <ul>
            <li class="hlavne"><a href="kosik.php">Pozrieť košík</a></li>
            <li class="hlavne"><a href="mojeObjednavky.php">Pozrieť moje objednávky</a></li>
            <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                <li class="hlavne"><a href="pridaj.php">Pridaj produkt</a></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <br>
        <ul>
            <li class="hlavne"><a href="prihlasenie.php">Prihlásiť sa</a></li>
            <li class="hlavne"><a href="registracia.php">Registrovať</a></li>
        </ul>
    <?php } ?>
</div>
