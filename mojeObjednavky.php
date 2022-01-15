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
            <li class="opacne prve"><a href="Letne/Bicykle.php" class="red">Bicykle</a></li>
            <li class="opacne prve"><a href="Letne/Kolobezky.html" class="red">Kolobežky</a></li>
            <li class="opacne prve"><a href="Letne/Korcule.html" class="red">Korčule</a></li>
            <li class="opacne prve"><a href="Letne/Nahradne.html" class="red">Doplnky</a></li>
            <li class="opacne prve"><a href="Letne/Doplnky.html" class="red">Príslušenstvo</a></li>
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
            <?php if ($_SESSION['name'] == 'admin@admin') { ?>
                <br>
                <ul>
                    <li class="hlavne"><a href="pridaj.php">Pridaj produkt</a></li>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Vaše objednávky</h1>
            <div class="container">
                <?php
                $sql = "SELECT MIN(id_nakupu) as total FROM hotove_objednavky";
                $stmt = $conn->query($sql);
                $string = $stmt->fetch_assoc();
                $min = (int)$string['total'];
                $sql = "SELECT MAX(id_nakupu) as total FROM hotove_objednavky";
                $stmt = $conn->query($sql);
                $string = $stmt->fetch_assoc();
                $max = (int)$string['total'];
                $userN = $_SESSION['name'];
                $sql = "SELECT id_nakupu as total FROM hotove_objednavky";
                $stmt = $conn->query($sql);
                $string = $stmt->fetch_assoc();
                if ($_SESSION['name'] == 'admin@admin') { ?>
                    <?php if (!is_null($string)) { ?>
                        <hr>
                        <table>
                            <tr>
                                <th>Názov</th>
                                <th>Počet kusov</th>
                                <th>Celková cena</th>
                                <th>Doručenie</th>
                                <th>Platba</th>
                                <th>Objednávateľ</th>
                            </tr>
                            <?php for ($i = $min; $i < $max+1; $i++) {
                                $sql = "SELECT obrazok, hotove_objednavky.pocet_kusov as pocet_kusov, nazov, cena, dorucenie, platba, email FROM hotove_objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i'";
                                $stmt = $conn->query($sql);
                                $string = $stmt->fetch_assoc();
                                if (!is_null($string)) { ?>

                                    <tr>
                                        <td><img src="files/<?=$string['obrazok']?>" alt="Nature" class="objednany-obr"><?=$string['nazov']?></td>
                                        <td><?=$string['pocet_kusov']?></td>
                                        <td><?=$string['cena'] * $string['pocet_kusov']?> €</td>
                                        <td><?=$string['dorucenie']?></td>
                                        <td><?=$string['platba']?></td>
                                        <td><?=$string['email']?></td>
                                    </tr>

                                <?php } ?>
                            <?php } ?>
                        </table>

                    <?php } else { ?>
                        <div class="container">
                            <h2 class="cierna">Nemáte žiadne objednanávky</h2>
                        </div>
                    <?php } ?>
                <?php } else {
                    $sql = "SELECT id_nakupu as total FROM hotove_objednavky WHERE id_pouzivatela IN(SELECT id_pouzivatela FROM pouzivatelia WHERE email LIKE '$userN')";
                    $stmt = $conn->query($sql);
                    $string = $stmt->fetch_assoc();
                    ?>
                <?php if (!is_null($string)) { ?>
                    <hr>
                    <table>
                        <tr>
                            <th>Názov</th>
                            <th>Počet kusov</th>
                            <th>Celková cena</th>
                            <th>Doručenie</th>
                            <th>Platba</th>
                        </tr>
                        <?php for ($i = $min; $i < $max+1; $i++) {
                            $sql = "SELECT obrazok, hotove_objednavky.pocet_kusov as pocet_kusov, nazov, cena, dorucenie, platba FROM hotove_objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE '$userN'";
                            $stmt = $conn->query($sql);
                            $string = $stmt->fetch_assoc();
                            if (!is_null($string)) { ?>

                                <tr>
                                    <td><img src="files/<?=$string['obrazok']?>" alt="Nature" class="objednany-obr"><?=$string['nazov']?></td>
                                    <td><?=$string['pocet_kusov']?></td>
                                    <td><?=$string['cena'] * $string['pocet_kusov']?> €</td>
                                    <td><?=$string['dorucenie']?></td>
                                    <td><?=$string['platba']?></td>
                                </tr>

                            <?php } ?>
                        <?php } ?>
                    </table>

                <?php } else { ?>
                    <div class="container">
                        <h2 class="cierna">Nemáte žiadne objednanávky</h2>
                    </div>
                <?php } ?>
                <?php } ?>
            </div>

            <hr>
        </div>
    </div>

    <div class="col-22 col-s-4 aside">
        <?php if(Auth::isLogged()) { ?>
            <div class="login">
                <h2>Ste prihlaseny ako <?=$_SESSION['username']?></h2>
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