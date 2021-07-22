<?php
session_start();
if (!isset($_SESSION['aktywny'])) {
	header('Location: logowanie.php');
	exit();
}

include 'home.php';

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$klient = $_SESSION['id_klienta'];

?>

<h1>Dane klienta</h1>

<?php

if(isset($_POST['submit'])) {
	
	if ($_POST['imie']!="" && $_POST['nazwisko']!="") {
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$telefon = $_POST['telefon'];
		$query = "UPDATE klienci SET imie='$imie', nazwisko='$nazwisko', telefon='$telefon' WHERE id_klienta='$klient'";
		mysqli_query($conn, $query) or die($conn->error);
		header('Location: konto.php');
		exit();

	}
	else {
		echo "<p>Wymagane imie i nazwisko!</p>";
	}
}

?>

<form method="POST">
	Imię<br><input type="text" name="imie" value=<?php echo $_SESSION['imie']; ?>><br>
	Nazwisko<br><input type="text" name="nazwisko" value=<?php echo $_SESSION['nazwisko']; ?>><br>
	Telefon<br><input type="text" name="telefon" value=<?php echo $_SESSION['telefon']; ?>><br><br>
	<input type="submit" value="Zatwierdź zmiany" name="submit">
</form>

<?php

?>


<?php

?>