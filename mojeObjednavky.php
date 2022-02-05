<?php
require_once "funkcie/pripojDatabazu.php";
require_once "funkcie/presmerujNeprihlaseny.php";
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
                        <form action="">
                            <select name="customers" onchange="vypisObjednavkyy(this.value)" class="vyber">
                                <option value="">Vyberte zo zoznamu</option>
                                <?php
                                $sql = "SELECT MIN(id_pouzivatela) as total FROM pouzivatelia";
                                $stmt = $conn->query($sql);
                                $strin = $stmt->fetch_assoc();
                                $mi = (int)$strin['total'];
                                $sql = "SELECT MAX(id_pouzivatela) as total FROM pouzivatelia";
                                $stmt = $conn->query($sql);
                                $strin = $stmt->fetch_assoc();
                                $ma = (int)$strin['total'];
                                for ($i = $mi; $i < $ma+1; $i++) {
                                    $sql = "SELECT * FROM pouzivatelia WHERE id_pouzivatela = '$i'";
                                    $stmt = $conn->query($sql);
                                    $strin = $stmt->fetch_assoc();
                                    $em = $strin['email'];
                                    $idp = $strin['id_pouzivatela'];
                                    if (!is_null($strin)) {
                                        ?>
                                        <option value="<?=$idp?>"><?=$em?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </form>
                        <br>
                    <div id="vypisObjednavky"></div>
                    <script>
                        function vypisObjednavkyy(str) {
                            var xhttp;
                            if (str == "") {
                                document.getElementById("vypisObjednavky").innerHTML = "";
                                return;
                            }
                            xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("vypisObjednavky").innerHTML = this.responseText;
                                }
                            };
                            xhttp.open("GET", "objobj.php?q="+str, true);
                            xhttp.send();
                        }
                    </script>

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
                                <th>Názov produktu</th>
                                <th>Č. obj</th>
                                <th>Počet kusov</th>
                                <th>Celková cena</th>
                                <th>Doručenie</th>
                                <th>Platba</th>
                            </tr>
                            <?php for ($i = $min; $i < $max+1; $i++) {
                                $sql = "SELECT objednavka_cislo, obrazok, hotove_objednavky.pocet_kusov as pocet_kusov, nazov, cena, dorucenie, platba FROM hotove_objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE '$userN'";
                                $stmt = $conn->query($sql);
                                $string = $stmt->fetch_assoc();
                                if (!is_null($string)) { ?>

                                    <tr>
                                        <td><img src="files/<?=$string['obrazok']?>" alt="Nature" class="objednany-obr"><?=$string['nazov']?></td>
                                        <td><?=$string['objednavka_cislo']?></td>
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

    <?php
    require_once "funkcie/praveMenuckoB.php";
    ?>
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
