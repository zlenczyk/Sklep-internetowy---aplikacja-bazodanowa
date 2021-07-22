<?php
session_start();
require_once "dane_dostepu.php";

$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$produkt = $_GET['id_produktu'];
$sztuki = $_POST['numery'];
$zamowienie = $_SESSION['id_zamowienia']; 
$query = "UPDATE pozycje_zamowien SET sztuk='$sztuki' WHERE zamowienia_id='$zamowienie' AND produkty_id='$produkt'";

mysqli_query($conn, $query) or die($conn->error);

$conn->close();
header('Location: koszyk.php');
?>