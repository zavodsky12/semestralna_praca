<?php
$sql = "SELECT MIN(id_nakupu) as total FROM objednavky";
$stmt = $conn->query($sql);
$string = $stmt->fetch_assoc();
$min = (int)$string['total'];
$sql = "SELECT MAX(id_nakupu) as total FROM objednavky";
$stmt = $conn->query($sql);
$string = $stmt->fetch_assoc();
$max = (int)$string['total'];
?>