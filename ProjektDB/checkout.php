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

$zamowienie = $_SESSION['id_zamowienia'];

?>

<?php

if(isset($_POST['submit'])) {
	
	if ($_POST['ulica']!="" && $_POST['nr_domu']!="" && $_POST['miasto']!="" && $_POST['kod_pocztowy']!="" && $_POST['dostawa']!="") {
		$ulica = $_POST['ulica'];
		$nr_domu = $_POST['nr_domu'];
		$miasto = $_POST['miasto'];
		$kod_pocztowy = $_POST['kod_pocztowy'];
		$wojewodztwo = $_POST['wojewodztwo'];
		$dostawa = $_POST['dostawa'];
		$query = "UPDATE zamowienia SET ulica='$ulica', numer_domu='$nr_domu', miasto='$miasto', kod_pocztowy='$kod_pocztowy', wojewodztwo='$wojewodztwo', dostawa_id='$dostawa', status='oczekujace' WHERE id_zamowienia='$zamowienie'";
		mysqli_query($conn, $query) or die($conn->error);
		$query1 = "SELECT * FROM zamowienia join dostawa on id_dostawy=dostawa_id WHERE id_zamowienia='$zamowienie'";
		$result = mysqli_query($conn, $query1) or die($conn->error);
		while ($calosc = $result->fetch_assoc()):
			$koszt = $calosc['koszt_dostawy']+$_SESSION['koszt'];
		endwhile;	
		$query3 = "UPDATE zamowienia SET koszt_zamowienia='$koszt' WHERE id_zamowienia='$zamowienie'";
		mysqli_query($conn, $query3) or die($conn->error);
		exit();

	}
	else {
		echo "<p>Wypełnij wszystkie pola</p><br>";
	}
	header('Location: start.php');
}

if(isset($_POST['usun_zamowienie'])) {
	$delete = "DELETE FROM pozycje_zamowien WHERE zamowienia_id='$zamowienie'";
	mysqli_query($conn, $delete) or die($conn->error);
	$delete2 = "DELETE FROM zamowienia WHERE id_zamowienia='$zamowienie'";
	mysqli_query($conn, $delete2) or die($conn->error);
	header('Location: koszyk.php');
	exit();
}

?>

<form method="POST">
	<h1>1. Dostawa</h1>
	Sposób dostawy<br>
	<select name="dostawa">
			<option value="1">odbior osobisty 0zł</option>
			<option value="2">kurier DPD 18zł</option>
			<option value="3">kurier DPD za pobraniem 21zł</option>
			<option value="4">paczkomat 17zł</option>
	</select>
	<br><br><b>koszt produktów: <?php echo $_SESSION['koszt']; ?><b>
	<br>
	<h1>2. Adres</h1>
	ulica<br>
	<input type="text" name="ulica" value=<?php echo $_SESSION['ulica']; ?>><br>
	nr domu<br>
	<input type="text" name="nr_domu" value=<?php echo $_SESSION['nr_domu']; ?>><br>
	miasto<br>
	<input type="text" name="miasto" value=<?php echo $_SESSION['miasto']; ?>><br>
	kod_pocztowy<br>
	<input type="text" name="kod_pocztowy" value=<?php echo $_SESSION['kod_pocztowy']; ?>><br>
	wojewodztwo<br>
	<select name="wojewodztwo">
			<option value="dolnoslaskie">dolnoslaskie</option>
			<option value="kujawsko-pomorskie">kujawsko-pomorskie</option>
			<option value="lubelskie">lubelskie</option>
			<option value="lodzkie">lodzkie</option>
			<option value="malopolskie">malopolskie</option>
			<option value="mazowieckie">mazowieckie</option>
			<option value="opolskie">opolskie</option>
			<option value="podkarpackie">podkarpackie</option>
			<option value="pomorskie">pomorskie</option>
			<option value="slaskie">slaskie</option>
			<option value="swietokrzyskie">swietokrzyskie</option>
			<option value="warminsko-mazurskie">warminsko-mazurskie</option>
			<option value="wielkopolskie">wielkopolskie</option>
			<option value="zachodniopomorskie">zachodniopomorskie</option>
	</select>
	<br><br>
	<input type="submit" value="Zamawiam" name="submit">
</form>


<form method='POST'><input type="submit" value="Rezygnuje" name="usun_zamowienie"></form>
<p>(Uwaga, rezygnacja usunie cały twój koszyk!)</p>


<?php

?>