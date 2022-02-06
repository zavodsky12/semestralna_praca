<?php
require_once "funkcie/pripojDatabazu.php";
require_once "funkcie/presmerujAdmin.php";
?>


<!DOCTYPE html>
<html lang="en">
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
    require_once "funkcie/menucko.php";
    ?>

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Pridanie produktu</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="container">
                    <p class="cierna">Prosím, vyplňte toto pole pre pridanie produktu do databázy</p>
                    <hr>

                    <label for="file"><b class="cierna">Vložte obrázok</b></label>
                    <input class="cierna registr" type="file" id="file" name="file" required>

                    <label for="nazov"><b class="cierna">Názov</b></label>
                    <input class="registr" type="text" placeholder="Názov" name="nazov" id="nazov" required>

                    <label for="cena"><b class="cierna">Cena</b></label>
                    <input class="registr" type="number" placeholder="Cena" name="cena" id="cena" min="0" required>

                    <label for="pocet_kusov"><b class="cierna">Počet kusov</b></label>
                    <input class="registr" type="number" placeholder="Počet kusov" name="pocet_kusov" id="pocet_kusov" min="0" required>

                    <label for="popis"><b class="cierna">Popis</b></label>
                    <input class="registr" type="text" placeholder="Popis" name="popis" id="popis" required>

                    <label for="typ"><b class="cierna">Typ</b></label>
                    <select class="registr" id="typ" name="typ">
                        <option value="L">L</option>
                        <option value="Z">Z</option>
                    </select>

                    <label for="kategoria"><b class="cierna">Kategória</b></label>
                    <input class="registr" type="number" placeholder="Kategória" name="kategoria" id="kategoria" min="1" max="6" required>
                    <br>

                    <button type="submit">Pridať produkt</button>
                </div>
            </form>

            <hr>

        </div>
    </div>

    <div class="col-22 col-s-4">

    </div>
    <?php
    require_once "funkcie/pravaStrana.php";
    ?>
</div>

<?php
require_once "funkcie/spodnaCast.php";
?>
</body>
</html>
