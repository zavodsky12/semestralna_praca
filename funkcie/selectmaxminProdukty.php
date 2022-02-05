<?php
$sql = "SELECT MIN(id_produktu) as total FROM produkty";
$stmt = $conn->query($sql);
$string = $stmt->fetch_assoc();
$min = (int)$string['total'];
$sql = "SELECT MAX(id_produktu) as total FROM produkty";
$stmt = $conn->query($sql);
$string = $stmt->fetch_assoc();
$max = (int)$string['total'];
?>