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
            <h1>Pridanie produktu</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="container">
                    <p class="cierna">Prosím, vyplňte toto pole pre pridanie produktu do databázy</p>
                    <hr>

                    <label for="file"><b class="cierna">Vložte obrázok</b></label>
                    <input class="cierna registr" type="file" id="file" name="file">

                    <label for="nazov"><b class="cierna">Názov</b></label>
                    <input class="registr" type="text" placeholder="Názov" name="nazov" id="nazov" required>

                    <label for="cena"><b class="cierna">Cena</b></label>
                    <input class="registr" type="number" placeholder="Cena" name="cena" id="cena" required>

                    <label for="pocet_kusov"><b class="cierna">Počet kusov</b></label>
                    <input class="registr" type="number" placeholder="Počet kusov" name="pocet_kusov" id="pocet_kusov" required>

                    <label for="popis"><b class="cierna">Popis</b></label>
                    <input class="registr" type="text" placeholder="Popis" name="popis" id="popis" required>

                    <label for="typ"><b class="cierna">Typ</b></label>
                    <select class="registr" id="typ" name="typ">
                        <option value="L">L</option>
                        <option value="Z">Z</option>
                    </select>

                    <label for="kategoria"><b class="cierna">Kategória</b></label>
                    <input class="registr" type="number" placeholder="Kategória" name="kategoria" id="kategoria" min="1" max="5" required>
                    <br>

                    <button type="submit">Pridať produkt</button>
                </div>
            </form>

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
