<?php
$conn = mysqli_connect("localhost","root","","databaza2");
?>

<table>
    <tr>
        <th>Názov produktu</th>
        <th>Počet kusov</th>
        <th>Č. obj</th>
        <th>Celková cena</th>
        <th>Doručenie</th>
        <th>Platba</th>
        <th>Objednávateľ</th>
    </tr>
    <?php
    $sql = "SELECT MIN(id_nakupu) as total FROM hotove_objednavky";
    $stmt = $conn->query($sql);
    $string = $stmt->fetch_assoc();
    $min = (int)$string['total'];
    $sql = "SELECT MAX(id_nakupu) as total FROM hotove_objednavky";
    $stmt = $conn->query($sql);
    $string = $stmt->fetch_assoc();
    $max = (int)$string['total'];
    $url = $_SERVER['REQUEST_URI'];
    $array = explode('=', $url);
    $end = end($array);
    for ($i = $min; $i < $max+1; $i++) {
        $sql = "SELECT objednavka_cislo, obrazok, hotove_objednavky.pocet_kusov as pocet_kusov, nazov, cena, dorucenie, platba, email, id_pouzivatela FROM hotove_objednavky JOIN produkty USING(id_produktu) JOIN pouzivatelia USING(id_pouzivatela) WHERE id_nakupu = '$i'";
        $stmt = $conn->query($sql);
        $string = $stmt->fetch_assoc();
        if (!is_null($string)) {
            if ($string['id_pouzivatela'] == $end) { ?>
                <tr>
                    <td><img src="files/<?=$string['obrazok']?>" alt="Nature" class="objednany-obr"><?=$string['nazov']?></td>
                    <td><?=$string['pocet_kusov']?></td>
                    <td><?=$string['objednavka_cislo']?></td>
                    <td><?=$string['cena'] * $string['pocet_kusov']?> €</td>
                    <td><?=$string['dorucenie']?></td>
                    <td><?=$string['platba']?></td>
                    <td><?=$string['email']?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</table>
