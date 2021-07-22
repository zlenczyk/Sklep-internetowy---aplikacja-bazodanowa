<?php
session_start();
require_once "dane_dostepu.php";

$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$produkt = $_GET['id_produktu'];
$sztuk = $_POST['sztuk'];
$zamowienie = $_SESSION['id_zamowienia']; 
$query = "INSERT INTO pozycje_zamowien(produkty_id, zamowienia_id, sztuk) values ('$produkt', '$zamowienie', '$sztuk')";

mysqli_query($conn, $query) or die($conn->error);

$conn->close();
header('Location: start.php');
?>