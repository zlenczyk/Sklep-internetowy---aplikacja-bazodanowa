<?php

session_start();
if (!isset($_SESSION['aktywny'])) {
	header('Location: logowanie.php');
	exit();
}

include 'home.php';
$klient = $_SESSION['id_klienta'];
$zamowienie = $_SESSION['id_zamowienia'];

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");


if (isset($_POST['usun'])) {
	
	$query_klient = "UPDATE klienci SET imie='Brak', nazwisko='Brak', telefon='Brak', haslo='Brak', email='$klient' WHERE id_klienta='$klient'";
	mysqli_query($conn, $query_klient) or die($conn->error);
		
	session_unset();
	header('Location: start.php');
}
?>
<h2>Usuń konto</h2>
<br>
<p>Po usunięciu konta, nie będzie możliwości ponownego zalogowania się do panelu sklepu.</p>
<br><br><br>

<form method="POST"><input type="submit" value="Zatwierdź" name="usun"></form>

<?php
$conn->close();
?>