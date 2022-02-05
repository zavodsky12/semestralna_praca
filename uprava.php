<?php
require_once "funkcie/pripojDatabazu.php";
require_once "funkcie/presmerujAdmin.php";
?>


<!DOCTYPE html>
<html>
<head>
    <?php
    require_once "funkcie/pripajanieSuborov.php";
    ?>
</head>

<body>
<?php
require_once "funkcie/hornaCast.php";
?>

<div class="row">
    <?php
    require_once "funkcie/lavaStrana.php";
    ?>
    <?php
    require_once "funkcie/menucko.php";
    ?>

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

                <form method="post">
                    <p><label for="uprNazov"><b class="cierna">Názov: <?=$string['nazov']?></b></label></p>
                    <input class="uprtr" type="text" placeholder="Názov" name="uprNazov" id="uprNazov">
                    <button type="submit">Zmeniť</button>
                </form>

                <form method="post">
                    <p><label for="uprCena"><b class="cierna">Cena: <?=$string['cena']?> €</b></label></p>
                    <input class="uprtr" type="number" placeholder="Cena" name="uprCena" id="uprCena" min="1">
                    <button type="submit">Zmeniť</button>
                </form>

                <form method="post">
                    <p><label for="uprPocet"><b class="cierna">Počet kusov: <?=$string['pocet_kusov']?></b></label></p>
                    <input class="uprtr" type="number" placeholder="Počet kusov" name="uprPocet" id="uprPocet" min="0">
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
                    <input class="uprtr" type="number" placeholder="Kategória" name="uprKategoria" id="uprKategoria" min="1" max="6">
                    <button type="submit">Zmeniť</button>
                </form>

                <form method='post'>
                    <p><button class="cervena" name="zmazProdukt" value='<?=$string['id_produktu']?>'><b>Odstrániť produkt</b></button></p>
                </form>
            </div>

            <hr>

        </div>
    </div>

    <div class="col-22 col-s-4">

    </div>
    <?php
    require_once "funkcie/pravaStrana.php";
    ?>
</div>

</div>

<?php
require_once "funkcie/spodnaCast.php";
?>
</body>
</html>
