<?php
session_start();

if (!isset($_POST['email'])||!isset($_POST['haslo'])) {
	header('Location: logowanie.php');
	exit();
}

$email = $_POST['email'];
$haslo = $_POST['haslo'];
$haslo = md5($haslo); 

$email = htmlentities($email, ENT_QUOTES, "UTF-8");
$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");
	
$result = mysqli_query($conn, sprintf("SELECT * FROM klienci WHERE BINARY email='%s' AND BINARY haslo='%s'", 
mysqli_real_escape_string($conn, $email),
mysqli_real_escape_string($conn, $haslo))) or die($conn->error);

$wynik = $result->num_rows;
if ($wynik > 0) {
	$row = $result->fetch_assoc();
	$_SESSION['user'] = $row['email'];
	$_SESSION['aktywny'] = true;
	$klient = $row['id_klienta'];
	$_SESSION['id_klienta'] = $klient;
	$query = "SELECT id_zamowienia FROM zamowienia WHERE status='w_trakcie' AND klienci_id='$klient'";
	$wynik_query = mysqli_query($conn, $query) or die($conn->error);

	
	if ($wynik_query->num_rows==0) {
		$new = "INSERT INTO zamowienia(klienci_id) values ('$klient')";
		mysqli_query($conn, $new) or die($conn->error);
		$wynik_query = mysqli_query($conn, $query) or die($conn->error);
	}

	$zamowienie = $wynik_query->fetch_assoc();
	$_SESSION['id_zamowienia'] = $zamowienie['id_zamowienia'];
	
	
	unset($_SESSION['blad_logowania']);
	header('Location: konto.php');
}
else {
	$_SESSION['blad_logowania'] = '<span style="color:red">Błędny email lub hasło!</span>';
	header('Location: logowanie.php');
}

$conn->close();

?>
