<?php
session_start();
require_once "dane_dostepu.php";

$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$koszt = $_SESSION['koszt'];
$zamowienie = $_SESSION['id_zamowienia']; 
$query = "UPDATE zamowienia SET koszt_zamowienia='$koszt' WHERE id_zamowienia='$zamowienie'";
mysqli_query($conn, $query) or die($conn->error);

$conn->close();
header('Location: checkout.php?id_zamowienia='.$zamowienie.'');
?>