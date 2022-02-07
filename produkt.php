<?php
require_once "funkcie/pripojDatabazu.php";
?>


<!DOCTYPE html>
<html lang="sk">
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
                        <input class="registr" type="hidden" name="end" value="<?=$end?>">
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

    <?php
    require_once "funkcie/praveMenucko.php";
    ?>
</div>

<?php
require_once "funkcie/spodnaCast.php";
?>
</body>
</html>
