<?php
session_start();
require "AuthController.php";
$authctr = new AuthController();
$conn = mysqli_connect("localhost","root","","databaza2");
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
            <h1>Registrácia</h1>
            <form method="post">
                <div class="container">
                    <p class="cierna">Prosím, vyplňte toto pole pre registráciu</p>
                    <hr>

                    <label for="email"><b class="cierna">Email</b></label>
                    <input class="registr" type="email" placeholder="Email" name="registration" id="email" required>

                    <label for="username"><b class="cierna">Meno</b></label>
                    <input class="registr" type="text" placeholder="Meno" name="username" id="username" required>

                    <label for="psw"><b class="cierna">Heslo</b></label>
                    <input class="registr" type="password" placeholder="Heslo" name="password" id="psw" required>

                    <label for="psw-repeat"><b class="cierna">Zopakujte heslo</b></label>
                    <input class="registr" type="password" placeholder="Zopakujte heslo" name="psw-repeat" id="psw-repeat" required>
                    <hr>
                    <p class="cierna">Vytvorením účtu súhlasíte s našími podmienkami používania <a class="modre" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">Terms & Privacy</a>.</p>

                    <?php if(Auth::isLogged()) { ?>
                        <br>
                        <p class="red">Už ste prihlásený</p>
                    <?php } else {?>
                        <button type="submit">Registrovať</button>
                    <?php }?>
                </div>
                <?php if(Auth::isBadLoggin2()) { ?>
                    <p class="cervena">Nepodarilo sa prihlásiť už u nás máte účet</p>
                    <?php unset($_SESSION['bad2']); ?>
                <?php }?>
                <?php if(Auth::isBadLoggin3()) { ?>
                    <p class="cervena">Nepodarilo sa prihlásiť zadali ste zlé údaje</p>
                    <?php unset($_SESSION['bad3']); ?>
                <?php }?>

                <?php if(!Auth::isLogged()) { ?>
                <div class="container">
                    <p class="cierna">Už u nás máte účet? <a href="prihlasenie.php" class="modre">Prihláste sa</a>.</p>
                </div>
                <?php }?>
            </form>

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
        <?php if(Auth::isLogged()) { ?>
            <br>
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
