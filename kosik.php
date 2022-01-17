<?php
session_start();
require "AuthController.php";
$authctr = new AuthController();
$conn = mysqli_connect("localhost","root","","databaza2");
if(!isset($_SESSION['name'])){
    header("Location:index.php");
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
    <title>Obchod so športovými potrebami</title>
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

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Váš košík</h1>
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
        $sql = "SELECT id_nakupu as total FROM objednavky JOIN pouzivatelia USING(id_pouzivatela) WHERE email LIKE '$userN'";
        $stmt = $conn->query($sql);
        $string = $stmt->fetch_assoc();
        if (!is_null($string)) {
        for ($i = $min; $i < $max+1; $i++) {
            $sql = "SELECT objednavky.pocet_kusov as pocet_kusov, obrazok, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE '$userN'";
            $stmt = $conn->query($sql);
            $string = $stmt->fetch_assoc();
            if (!is_null($string)) { ?>

            <div class="container">
                <hr>

                <img src="files/<?=$string['obrazok']?>" alt="Nature" class="kosik-obr">
                <table>
                    <tr>
                        <th>Názov:</th>
                        <td><?=$string['nazov']?></td>
                    </tr>
                    <tr>
                        <th>Celková cena:</th>
                        <td><?=$string['cena'] * $string['pocet_kusov']?> €</td>
                    </tr>
                    <tr>
                        <th>Počet kusov:</th>
                        <td><?=$string['pocet_kusov']?></td>
                    </tr>
                </table>
                <br>
                <form method='post' style="padding: 0px">
                    <p><label for="uprMnozstvo"><b class="cierna">Zvoľte množstvo produktov:</b></label></p>
                    <input class="uprtr" type="number" placeholder="Množstvo" name="uprMnozstvo" id="uprMnozstvo">
                    <input class="uprtr" type="hidden" name="uprMnPoct" value="<?=$i?>">
                    <button type="submit"><b>Upraviť produkt</b></button>
                </form>
                <form method='post' style="padding: 0px">
                    <p><button class="cervena" name="zmazKosik" value='<?=$i?>'><b>Odstrániť produkt</b></button></p>
                </form>

            </div>
                <br>

            <?php } ?>
        <?php } ?>
            <div class="platba">
                <p class="kosikPlatba"><button><a href="platba.php"><b>Prejsť k platbe</b></a></button></p>
            </div>
        <?php } else { ?>
            <div class="container">
                <h2 class="cierna">V košíku nemáte žiadne produkty</h2>
            </div>
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
