<?php
session_start();
require "AuthController.php";
$authctr = new AuthController();
$conn = mysqli_connect("localhost","root","","databaza2");
if(!isset($_SESSION['name'])){
    header("Location:index.php");
} else {
    if ($_SESSION['name'] != 'admin@admin') {
        header("Location:index.php");
    }
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
                    <li class="hlavne"><a href="pridaj.php">Pridaj produkt</a></li>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Úprava produktu</h1>
                <div class="container">
                    <?php
                    $id = $_SESSION['idcko'];
                    $sql = "SELECT * FROM produkty WHERE id_produktu = '$id'";
                    $stmt = $conn->query($sql);
                    $string = $stmt->fetch_assoc();
                    ?>
                    <p class="cierna">Tu môžete upravovať svoj produkt</p>
                    <hr>

                    <img src="files/<?=$string['obrazok']?>" alt="Nature" class="pridanieObr"><br><br>

                    <h2 class="cierna">Popis</h2>
                    <p class="cierna"><?=$string['popis']?></p>

<!--                    <form method="post" enctype="multipart/form-data">-->
<!--                        <label for="uprObr"><b class="cierna">Obrázok:</b></label>-->
<!--                        <input class="uprtr cierna" type="file" id="uprObr" name="uprObr">-->
<!--                        <button type="submit">Zmeniť</button>-->
<!--                    </form>-->

                    <form method="post">
                        <p><label for="uprNazov"><b class="cierna">Názov: <?=$string['nazov']?></b></label></p>
                        <input class="uprtr" type="text" placeholder="Názov" name="uprNazov" id="uprNazov">
                        <button type="submit">Zmeniť</button>
                    </form>

                    <form method="post">
                        <p><label for="uprCena"><b class="cierna">Cena: <?=$string['cena']?> €</b></label></p>
                        <input class="uprtr" type="number" placeholder="Cena" name="uprCena" id="uprCena">
                        <button type="submit">Zmeniť</button>
                    </form>

                    <form method="post">
                        <p><label for="uprPocet"><b class="cierna">Počet kusov: <?=$string['pocet_kusov']?></b></label></p>
                        <input class="uprtr" type="number" placeholder="Počet kusov" name="uprPocet" id="uprPocet">
                        <button type="submit">Zmeniť</button>
                    </form>

                    <form method="post">
                        <p><label for="uprPopis"><b class="cierna">Popis:</b></label></p>
                        <input class="uprtr" type="text" placeholder="Popis" name="uprPopis" id="uprPopis">
                        <button type="submit">Zmeniť</button>
                    </form>

                    <form method="post">
                        <p><label for="uprTyp"><b class="cierna">Typ: <?=$string['typ']?></b></label></p>
                        <select class="uprtr" id="uprTyp" name="uprTyp">
                            <option value="L">L</option>
                            <option value="Z">Z</option>
                        </select>
                        <button type="submit">Zmeniť</button>
                    </form>

                    <form method="post">
                        <p><label for="uprKategoria"><b class="cierna">Kategória: <?=$string['kategoria']?></b></label></p>
                        <input class="uprtr" type="number" placeholder="Kategória" name="uprKategoria" id="uprKategoria" min="1" max="5">
                        <button type="submit">Zmeniť</button>
                    </form>
                </div>

            <hr>

        </div>
    </div>

    <div class="col-22 col-s-4">

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
