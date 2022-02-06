<?php
require_once "funkcie/pripojDatabazu.php";
if(!isset($_SESSION['name'])){
    header("Location:index.php");
}
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
            <h1>Váš košík</h1>
            <?php
            require_once "funkcie/selectmaxminNakup.php";
            $userN = $_SESSION['name'];
            $stmt = $con->prepare("SELECT id_nakupu as total FROM objednavky JOIN pouzivatelia USING(id_pouzivatela) WHERE email LIKE ?");
            $stmt->execute([$userN]);
            $string = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($string)) {
            for ($i = $min; $i < $max+1; $i++) {
                $stmt = $con->prepare("SELECT objednavky.pocet_kusov as pocet_kusov, produkty.pocet_kusov as pocet_kusovv, obrazok, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i' AND email LIKE ?");
                $stmt->execute([$userN]);
                $string = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($string)) { ?>

                <div class="container">
                    <hr>

                    <img src="files/<?=$string['obrazok']?>" alt="Nature" class="kosik-obr">
                    <div id="produkt<?=$i?>">
                        <table>
                            <tr>
                                <th>Názov:</th>
                                <td><?=$string['nazov']?></td>
                            </tr>
                            <tr>
                                <th>Celková cena:</th>
                                <td><?=$string['cena'] * $string['pocet_kusov']?> €</td>
                            </tr>
                            <tr>
                                <th>Počet kusov:</th>
                                <td><?=$string['pocet_kusov']?></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <p><label for="uprMnozstvo<?=$i?>"><b class="cierna">Zvoľte množstvo produktov:</b></label></p>
                    <input class="uprtr" type="number" placeholder="Množstvo" name="uprMnozstvo<?=$i?>" id="uprMnozstvo<?=$i?>" min="1" max="<?=$string['pocet_kusovv']?>" onkeyup="zmenData<?=$i?>()">
                    <input class="uprtr" type="hidden" name="uprMnozstvo<?=$i?>" id="uprMnozstv<?=$i?>" value="<?=$i?>">
                    <form method='post' style="padding: 0px">
                        <p><button class="cervena" name="zmazKosik" value='<?=$i?>'><b>Odstrániť produkt</b></button></p>
                    </form>
                </div>
            <br>
                <script>
                    function zmenData<?=$i?>() {
                        var xhttp;
                        var str = document.getElementById("uprMnozstvo<?=$i?>").value;
                        if (str <= 0 || str > <?=$string['pocet_kusovv']?>) {

                        } else {
                            xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function () {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("produkt<?=$i?>").innerHTML = this.responseText;
                                }
                            };
                            xhttp.open("GET", "tabtab.php?q=" + <?=$i?> + "=" + str, true);
                            xhttp.send();
                        }
                    }
                </script>
            <?php } ?>
            <?php } ?>
                <div class="platba">
                    <p class="kosikPlatba"><button onclick="window.location.href = 'platba.php';"><b>Prejsť k platbe</b></button></p>
                </div>
            <?php } else { ?>
                <div class="container">
                    <h2 class="cierna">V košíku nemáte žiadne produkty</h2>
                </div>
            <?php } ?>

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
