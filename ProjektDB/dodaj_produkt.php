<?php
require_once "dane_dostepu.php";
?>

<?php

$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];
$opis = $_POST['opis'];
$gatunek = $_POST['gatunek'];;
$trudnosc = $_POST['trudnosc'];
$bezpieczna = $_POST['bezpieczna'];
$oczyszczanie = $_POST['oczyszczanie'];
$wysokosc = $_POST['wysokosc'];
$material = $_POST['material'];
$srednica = $_POST['srednica'];
$typ = $_POST['typ'];
$na_stanie = $_POST['na_stanie'];
	
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");
$query = "INSERT INTO produkty(nazwa, cena, opis, gatunek, trudnosc, bezpieczna, oczyszczanie, wysokosc, material, srednica, typ, na_stanie) VALUES ('$nazwa', '$cena', '$opis', '$gatunek', '$trudnosc', '$bezpieczna', '$oczyszczanie', '$wysokosc', '$material', '$srednica', '$typ', '$na_stanie')";
$result = mysqli_query($conn, $query) or die($conn->error);


$conn->close();
header('Location: admin.php');
?>