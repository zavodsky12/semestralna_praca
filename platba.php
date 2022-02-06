<?php
require_once "funkcie/pripojDatabazu.php";
require_once "funkcie/presmerujNeprihlaseny.php";
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

    <div class="col-6 col-s-8">
        <div class="main">
            <h1>Platba</h1>
            <div class="container">
                <?php
                require_once "funkcie/selectmaxminNakup.php";
                $userN = $_SESSION['name'];
                $stmt = $con->prepare("SELECT id_nakupu as total FROM objednavky JOIN pouzivatelia USING(id_pouzivatela) WHERE email LIKE ?");
                $stmt->execute([$userN]);
                $string = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!empty($string)) { ?>
                    <hr>
                    <table>
                        <tr>
                            <th>Názov</th>
                            <th>Počet kusov</th>
                            <th>Celková cena</th>
                        </tr>
                        <?php for ($i = $min; $i < $max+1; $i++) {
                            $stmt = $con->prepare("SELECT objednavky.pocet_kusov as pocet_kusov, obrazok, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE ?");
                            $stmt->execute([$userN]);
                            $string = $stmt->fetch(PDO::FETCH_ASSOC);
                            if (!empty($string)) { ?>

                                <tr>
                                    <td><?=$string['nazov']?></td>
                                    <td><?=$string['pocet_kusov']?></td>
                                    <td><?=$string['cena'] * $string['pocet_kusov']?> €</td>
                                </tr>

                            <?php } ?>
                        <?php } ?>
                    </table>

                    <br>

                    <div class="pltenie">
                        <form method="post" class="kosikPlatba" style="background-color: #bfbfbf">
                            <p><b class="cierna">Zvoľte spôsob dopravy</b></p>
                            <input type="radio" name="doprava" id="doprava" value="osobny odber">
                            <label for="doprava" class="cierna">Osobný odber</label><br>
                            <input type="radio" name="doprava" id="doprava2" value="zasielka">
                            <label for="doprava2" class="cierna">Doručenie zásielkou</label>
                            <p><b class="cierna">Zvoľte spôsob platby</b></p>
                            <input type="radio" name="platba" id="platba" value="hotovost">
                            <label for="platba" class="cierna">Platba v hotovosti</label><br>
                            <input type="radio" name="platba" id="platba2" value="prevod">
                            <label for="platba2" class="cierna">Platba prevodom</label>
                            <p><button type="submit"><b>Objednať</b></button></p>
                        </form>
                    </div>
                <?php } else { ?>
                    <?php if(Auth::mameObjednane()) { ?>
                        <div class="container" style="background-color: lightgreen">
                            <h2 class="cierna">Vaša objednávka bola zaregistrovaná</h2>
                        </div>
                        <?php unset($_SESSION['objednane']); ?>
                    <?php } else { ?>
                        <div class="container">
                            <h2 class="cierna">V košíku nemáte žiadne produkty</h2>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <hr>
        </div>
    </div>

    <?php
    require_once "funkcie/praveMenuckoB.php";
    ?>
</div>

<?php
require_once "funkcie/spodnaCast.php";
?>
</body>
</html>
