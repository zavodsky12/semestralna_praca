<?php
session_start();
require "../AuthController.php";
//require "App.php";
$authctr = new AuthController();
//$app = new App();
//$conn = mysqli_connect("localhost","root","dtb456","databaza");
$conn = mysqli_connect("localhost","root","","databaza2");
?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../vlastne.css">
    <link rel="stylesheet" href="../nove.css">
    <title>Obchod so športovými potrebami</title>
    <script src="../javaskripty.js"></script>
</head>

<body>
<div class="header zadnyObrazok">
    <h1>Bikeski.sk</h1>
    <h2>Predaj outdorových športových potrieb</h2>
</div>

<div class="row">
    <div class="col-1 col-s-0">

    </div>
    <div class="col-2 col-s-12 menu">
        <ul>
            <li class="hlavne"><a href="../index.php">Hlavná stránka</a></li>
            <li class="hlavne" onclick=dropdownSide("prve")>Letný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne prve"><a href="Bicykle.php" class="red">Bicykle</a></li>
            <li class="opacne prve"><a href="Kolobezky.html" class="red">Kolobežky</a></li>
            <li class="opacne prve"><a href="Korcule.html" class="red">Korčule</a></li>
            <li class="opacne prve"><a href="Nahradne.html" class="red">Doplnky</a></li>
            <li class="opacne prve"><a href="Doplnky.html" class="red">Príslušenstvo</a></li>
            <li class="hlavne" onclick=dropdownSide("druhe")>Zimný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne druhe">Lyže</li>
            <li class="opacne druhe">Snowboardy</li>
            <li class="opacne druhe">Korčule</li>
            <li class="opacne druhe">Bežky</li>
            <li class="opacne druhe">Doplnky</li>
            <li class="opacne druhe">Príslušenstvo</li>
            <li class="hlavne" onclick=dropdownSide("tretie")>Doplnky<i class="fa fa-caret-down"></i></li>
            <li class="opacne tretie">Cyklodoplnky</li>
            <li class="opacne tretie">Cyklovýbava</li>
            <li class="opacne tretie">Lyžiarky</li>
            <li class="opacne tretie">Viazania</li>
            <li class="opacne tretie">Palice</li>
            <li class="opacne tretie">Letné doplnky</li>
            <li class="opacne tretie">Zimné doplnky</li>
        </ul>
        <?php if (isset($_SESSION['name'])) { ?>
            <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                <br>
                <ul>
                    <li class="hlavne"><a href="../pridaj.php">Pridaj produkt</a></li>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Najnovšie produkty</h1>
            <p>Hry XXXII. olympijády sa uskutočnili v roku 2021 v Tokiu, v hlavnom meste Japonska. Uskutočnili sa o rok neskôr ako sa plánovalo kvôli pandémii koronavírusu. Hrozilo aj ich úplné zrušenie, čo by sa stalo prvý raz od druhej svetovej vojny. Zároveň sa prvý raz neuskutočnili v plánovanom čase. Hry boli jedny z najstratovejších v histórií, preto je šťastím, že ich organizovalo práve Japonsko, jedna z najsilnejších ekonomík sveta, ktorá presun o rok dokázala zvládnuť.</p>
            <?php
            $pocet = 0;
            $sql = "SELECT MIN(id_produktu) as total FROM produkty";
            $stmt = $conn->query($sql);
            $string = $stmt->fetch_assoc();
            $min = (int)$string['total'];
            $sql = "SELECT MAX(id_produktu) as total FROM produkty";
            $stmt = $conn->query($sql);
            $string = $stmt->fetch_assoc();
            $max = (int)$string['total'];
            for ($i = $min; $i < $max+1; $i++) {
                $sql = "SELECT * FROM produkty WHERE id_produktu = '$i'";
                $stmt = $conn->query($sql);
                $string = $stmt->fetch_assoc();
                if (!is_null($string)) {
                    if ($string['typ'] == 'L') {
                    $pocet++;
                    ?>
                    <div class="w3-col">
                        <div class="w3-card-4 w3-margin w3-white">
                            <?php $obraz = $string['obrazok']; ?>
                            <img src="../files/<?=$obraz?>" alt="Nature" class="produkt-obr">
                            <div class="w3-container">
                                <?php $meno = $string['nazov']; ?>
                                <h3 class="rovnaka-vyska"><b><?=$meno?></b></h3>
                                <?php $pocetK = $string['pocet_kusov']; ?>
                                <h4>Pocet kusov na sklade: <span class="w3-opacity"><?=$pocetK?></span></h4>
                                <?php $cena = $string['cena']; ?>
                                <h4>Cena: <span class="w3-opacity"><?=$cena?></span></h4>
                                <p><button><b>Vložiť do košíka</b></button></p>
                                <?php if (isset($_SESSION['name'])) { ?>
                                    <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                                        <p><button class="cervena" name="idcko"><a href="../uprava.php"><b>Upraviť produkt</b></a></button></p>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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

    <div class="col-22 col-s-4 aside">
        <?php if(Auth::isLogged()) { ?>
            <div class="login">
                <h2>Ste prihlaseny</h2>
                <form method="post">
                    <input type="submit" name="logout" value="Odhlasit">
                </form>
            </div>
        <?php } else { ?>
            <div class="login">
                <h2>Login</h2>
                <?php if(Auth::isBadLoggin()) { ?>
                    <p class="cervena">Zadali ste zly login</p>
                    <?php unset($_SESSION['bad']); ?>
                <?php } ?>
                <form method="post">
                    <label for="controle" class="cierna">Email:</label>
                    <input type="email" name="login">
                    <label for="controle" class="cierna">Heslo:</label>
                    <input type="password" name="password">
                    <input type="submit" value="Prihlasit">
                </form>
            </div>
        <?php } ?>
        <br>
        <div class="registracia">
            <h2>Registrácia</h2>
            <div class="right">
                <p class="normalne">Ak ešte u nás nemáte konto, zaregistrujte sa</p>
                <button><b><a href="../registracia.php">Registrovať</a></b></button>
            </div>
        </div>
        <!--        <br>-->
        <!--        <div class="right">-->
        <!--            <img src="pravy.png" class="obr">-->
        <!--            <h2>Japonsko</h2>-->
        <!--            <p>Japonsko (jap. 日本 – Nippon alebo Nihon; formálne: jap. 日本国 – Nippon-koku alebo Nihon-koku) je štát ležiaci na východnom okraji ázijského kontinentu, na východ od Číny a Kórey. Rozkladá sa od Ochotského mora na severe, po Východočínske more na juhovýchode. Zo západu ho obklopuje Japonské more a z východu a juhu Tichý oceán.</p>-->
        <!--        </div>-->
    </div>
    <div class="col-1 col-s-0">

    </div>
</div>

</div>

<div>
    <div class="col-3">

    </div>
    <div class="col-6">
        <div class="footer">
            <p>Autor stránky - Daniel Závodský.</p>
        </div>
    </div>
    <div class="col-3">

    </div>
</div>
</body>
</html>
