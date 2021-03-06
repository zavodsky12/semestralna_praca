<?php
require_once "../funkcie/pripojDatabazuFolder.php";
if(isset($_POST['idcko']))
{
    $id=$_POST['idcko'];
    $_SESSION['idcko']=$id;
    header("location:../uprava.php");
}
$_SERVER['DOCUMENT_ROOT'] = "index.php";
?>


<!DOCTYPE html>
<html lang="sk">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../vlastne.css">
    <link rel="stylesheet" href="../nove.css">
    <title>Obchod so športovými potrebami bikeski.sk | Zimný šport</title>
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
            <li class="hlavne" onclick="dropdownSide('prve')">Letný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne prve"><a href="../Letne/index.php?prod=1" class="red">Bicykle</a></li>
            <li class="opacne prve"><a href="../Letne/index.php?prod=2" class="red">Kolobežky</a></li>
            <li class="opacne prve"><a href="../Letne/index.php?prod=3" class="red">Korčule</a></li>
            <li class="opacne prve"><a href="../Letne/index.php?prod=4" class="red">Príslušenstvo</a></li>
            <li class="opacne prve"><a href="../Letne/index.php?prod=5" class="red">Doplnky</a></li>
            <li class="hlavne" onclick="dropdownSide('druhe')">Zimný šport<i class="fa fa-caret-down"></i></li>
            <li class="opacne druhe"><a href="../Zimne/index.php?prod=1" class="red">Lyže</a></li>
            <li class="opacne druhe"><a href="../Zimne/index.php?prod=2" class="red">Snowboardy</a></li>
            <li class="opacne druhe"><a href="../Zimne/index.php?prod=3" class="red">Korčule</a></li>
            <li class="opacne druhe"><a href="../Zimne/index.php?prod=4" class="red">Bežky</a></li>
            <li class="opacne druhe"><a href="../Zimne/index.php?prod=5" class="red">Príslušenstvo</a></li>
            <li class="opacne druhe"><a href="../Zimne/index.php?prod=6" class="red">Doplnky</a></li>
            <li class="hlavne" onclick="dropdownSide('tretie')">Doplnky<i class="fa fa-caret-down"></i></li>
            <li class="opacne tretie"><a href="index.php" class="red">Cyklodoplnky</a></li>
            <li class="opacne tretie"><a href="index.php" class="red">Cyklovýbava</a></li>
            <li class="opacne tretie"><a href="index.php" class="red">Lyžiarky</a></li>
            <li class="opacne tretie"><a href="index.php" class="red">Viazania</a></li>
            <li class="opacne tretie"><a href="index.php" class="red">Palice</a></li>
            <li class="opacne tretie"><a href="index.php" class="red">Letné doplnky</a></li>
            <li class="opacne tretie"><a href="index.php" class="red">Zimné doplnky</a></li>
        </ul>
        <?php if (isset($_SESSION['name'])) { ?>
            <br>
            <ul>
                <li class="hlavne"><a href="../kosik.php">Pozrieť košík</a></li>
                <li class="hlavne"><a href="../mojeObjednavky.php">Pozrieť moje objednávky</a></li>
                <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                    <li class="hlavne"><a href="../pridaj.php">Pridaj produkt</a></li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <br>
            <ul>
                <li class="hlavne"><a href="../prihlasenie.php">Prihlásiť sa</a></li>
                <li class="hlavne"><a href="../registracia.php">Registrovať</a></li>
            </ul>
        <?php } ?>
    </div>

    <div class="col-6 col-s-8">
        <div class="main" id="hlav">
            <br>
            <div class="container">
                <h2 class="cierna">Stránka vo výstavbe</h2>
            </div>
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
                    <input type="email" name="login" id="controle">
                    <label for="controle2" class="cierna">Heslo:</label>
                    <input type="password" name="password" id="controle2">
                    <input type="submit" value="Prihlásiť">
                </form>
            </div>
        <?php } ?>
        <br>
        <?php if(Auth::isLogged()) { ?>
            <div class="kosik">
                <h2>Váš košík</h2>
                <?php
                require_once "../funkcie/selectmaxminNakup.php";
                $userN = $_SESSION['name'];
                for ($i = $min; $i < $max+1; $i++) {
                    $stmt = $con->prepare("SELECT objednavky.pocet_kusov as pocet_kusov, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE ?");
                    $stmt->execute([$userN]);
                    $string = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!empty($string)) { ?>
                        <div class="right">
                            <p class="cierna"><b>Názov:</b> <?=$string['nazov']?></p>
                            <p class="cierna"><b>Počet kusov:</b> <?=$string['pocet_kusov']?></p>
                            <p class="cierna"><b>Celková cena:</b> <?=$string['cena'] * $string['pocet_kusov']?> €</p>
                        </div>
                        <br>
                    <?php } ?>
                <?php } ?>
                <button onclick="window.location.href = '../kosik.php';"><b>Pozrieť košík</b></button>
            </div>
        <?php } else { ?>
            <div class="registracia">
                <h2>Registrácia</h2>
                <div class="right">
                    <p class="normalne">Ak ešte u nás nemáte konto, zaregistrujte sa</p>
                    <button onclick="window.location.href = '../registracia.php';"><b>Registrovať</b></button>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-1 col-s-0">

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
