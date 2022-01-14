<?php
session_start();
require "AuthController.php";
//require "App.php";
$authctr = new AuthController();
//$app = new App();
//$conn = mysqli_connect("localhost","root","dtb456","databaza");
$conn = mysqli_connect("localhost","root","","databaza2");
if(isset($_POST['idcko']))
{
    $id=$_POST['idcko'];
    $_SESSION['idcko']=$id;
    header("location:uprava.php");
}
?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vlastne.css">
    <link rel="stylesheet" href="nove.css">
    <title>Obchod so športovými potrebami bikeski.sk | Najnovšie produkty</title>
    <script src="javaskripty.js"></script>
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
            <li class="hlavne"><a href="index.php">Hlavná stránka</a></li>
            <li class="hlavne" onclick=dropdownSide("prve")>Letný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne prve"><a href="Letne/Bicykle.php" class="red">Bicykle</a></li>
            <li class="opacne prve"><a href="Letne/Kolobezky.html" class="red">Kolobežky</a></li>
            <li class="opacne prve"><a href="Letne/Korcule.html" class="red">Korčule</a></li>
            <li class="opacne prve"><a href="Letne/Doplnky.html" class="red">Príslušenstvo</a></li>
            <li class="opacne prve"><a href="Letne/Nahradne.html" class="red">Doplnky</a></li>
            <li class="hlavne" onclick=dropdownSide("druhe")>Zimný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne druhe">Lyže</li>
            <li class="opacne druhe">Snowboardy</li>
            <li class="opacne druhe">Korčule</li>
            <li class="opacne druhe">Bežky</li>
            <li class="opacne druhe">Príslušenstvo</li>
            <li class="opacne druhe">Doplnky</li>
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
            <br>
            <ul>
                <li class="hlavne"><a href="kosik.php">Pozrieť košík</a></li>
                <li class="hlavne"><a href="mojeObjednavky.php">Pozrieť moje objednávky</a></li>
            <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                    <li class="hlavne"><a href="pridaj.php">Pridaj produkt</a></li>
            <?php } ?>
            </ul>
        <?php } ?>
    </div>

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Najnovšie produkty</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
                    $pocet++;
                    ?>
<!--                    <a href="produkt.php">-->
                        <a href="produkt.php?sku=<?=$i?>">
                        <div class="w3-col">
                        <div class="w3-card-4 w3-margin w3-white">
                            <?php $obraz = $string['obrazok']; ?>
                            <img src="files/<?=$obraz?>" alt="Nature" class="produkt-obr">
                            <div class="w3-container">
                                <?php $meno = $string['nazov']; ?>
                                <h3 class="rovnaka-vyska"><b><?=$meno?></b></h3>
                                <?php $pocetK = $string['pocet_kusov']; ?>
                                <h4>Pocet kusov na sklade: <span class="w3-opacity"><?=$pocetK?></span></h4>
                                <?php $cena = $string['cena']; ?>
                                <h4>Cena: <span class="w3-opacity"><?=$cena?> €</span></h4>
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
                        </a>
<!--                    </a>-->
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
                <h2>Ste prihlásený ako <?=$_SESSION['username']?></h2>
                <form method="post">
                    <input type="submit" name="logout" value="Odhlasit">
                </form>
            </div>
        <?php } else { ?>
            <div class="login">
                <h2>Login</h2>
                <?php if(Auth::isBadLoggin()) { ?>
                    <p class="cervena">Zadali ste zlý login</p>
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
        <?php if(Auth::isLogged()) { ?>
            <div class="kosik">
                <h2>Váš košík</h2>
                    <?php
                    $sql = "SELECT MIN(id_nakupu) as total FROM objednavky";
                    $stmt = $conn->query($sql);
                    $string = $stmt->fetch_assoc();
                    $min = (int)$string['total'];
                    $sql = "SELECT MAX(id_nakupu) as total FROM objednavky";
                    $stmt = $conn->query($sql);
                    $string = $stmt->fetch_assoc();
                    $max = (int)$string['total'];
                    $userN = $_SESSION['name'];
                    for ($i = $min; $i < $max+1; $i++) {
                        $sql = "SELECT objednavky.pocet_kusov as pocet_kusov, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE '$userN'";
                        $stmt = $conn->query($sql);
                        $string = $stmt->fetch_assoc();
                        if (!is_null($string)) { ?>
                            <div class="right">
                                <p class="cierna"><b>Názov:</b> <?=$string['nazov']?></p>
                                <p class="cierna"><b>Počet kosov:</b> <?=$string['pocet_kusov']?></p>
                                <p class="cierna"><b>Celková cena:</b> <?=$string['cena'] * $string['pocet_kusov']?> €</p>
                            </div>
                            <br>
                        <?php } ?>
                    <?php } ?>
                <button><b><a href="kosik.php">Pozrieť košík</a></b></button>
            </div>
        <?php } else { ?>
            <div class="registracia">
                <h2>Registrácia</h2>
                <div class="right">
                    <p class="normalne">Ak ešte u nás nemáte konto, zaregistrujte sa</p>
                    <button><b><a href="registracia.php">Registrovať</a></b></button>
                </div>
            </div>
        <?php } ?>
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
