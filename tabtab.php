
<?php
require_once "funkcie/pripojDatabazu.php";
?>
<?php
$url = $_SERVER['REQUEST_URI'];
$array = explode('=', $url);
$i = $array[1];
$end = end($array);
$stmt = $con->prepare("UPDATE objednavky SET pocet_kusov = ? WHERE id_nakupu = ?");
$stmt->execute([$end, $i]);
$sql = "SELECT objednavky.pocet_kusov as pocet_kusov, produkty.pocet_kusov as pocet_kusovv, obrazok, nazov, cena FROM objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i'";
$stmt = $conn->query($sql);
$string = $stmt->fetch_assoc();
?>
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
