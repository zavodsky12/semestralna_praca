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

    <?php
    $url = $_SERVER['REQUEST_URI'];
    $array = explode('=', $url);
    $end = end($array);
    $sql = "SELECT * FROM produkty WHERE id_produktu = '$end'";
    $stmt = $conn->query($sql);
    $string = $stmt->fetch_assoc();
    ?>
    <div class="col-6 col-s-8">
        <div class="main">
            <br>
            <div class="container">
                <h2 class="cierna"><?=$string['nazov']?></h2>
                <hr>

                <table>
                    <tr>
                        <th colspan="2"><img src="files/<?=$string['obrazok']?>" alt="Nature" class="pridanieObr"></th>
                    </tr>
                    <tr>
                        <th>Názov</th>
                        <td><?=$string['nazov']?></td>
                    </tr>
                    <tr>
                        <th>Cena</th>
                        <td><?=$string['cena']?> €</td>
                    </tr>
                    <tr>
                        <th>Počet kusov</th>
                        <td><?=$string['pocet_kusov']?></td>
                    </tr>
                </table>

                <h2 class="cierna">Popis</h2>
                <p class="cierna"><?=$string['popis']?></p>

                <?php if(Auth::isLogged()) { ?>
                    <form method="post">
                        <label for="vlozDoK"><b class="cierna">Napíšte, koľko výrobkov chcete vložiť do košíka</b></label>
                        <input class="registr" type="number" placeholder="Vložte počet kusov" name="vlozDoK" id="vlozDoK" min="1" max="<?=$string['pocet_kusov']?>" value="1" required>
                        <input class="registr" type="number" placeholder="Vložte počet kusov" name="end" value="<?=$end?>" style="display: none" required>
                        <button type="submit">Vložiť do košíka</button>
                    </form>
                <?php } else { ?>
                    <p class="red">Pre objednanie produktu sa musíte prihlásiť</p>
                    <p class="red">Ak u nás ešte namáte konto <a href="registracia.php" class="modre">zaregistrujte sa</a></p>
                <?php } ?>
            </div>

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
                            <p class="cierna"><b>Počet kusov:</b> <?=$string['pocet_kusov']?></p>
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
