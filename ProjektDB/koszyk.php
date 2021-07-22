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
$zamowienie = $_SESSION['id_zamowienia'];

$query_k = "SELECT * FROM zamowienia WHERE id_zamowienia='$zamowienie'";
$result_k = mysqli_query($conn, $query_k);
$zam = $result_k->fetch_assoc();
$ulica = $zam['ulica'];
$nr_domu =$zam['numer_domu'];
$miasto = $zam['miasto'];
$kod_pocztowy = $zam['kod_pocztowy'];
$wojewodztwo = $zam['wojewodztwo'];


if (isset($_POST['usun'])) {
	$produkt = $_GET['id_produktu'];
	$query_usun = "DELETE FROM pozycje_zamowien WHERE zamowienia_id='$zamowienie' AND produkty_id='$produkt' LIMIT 1";
	mysqli_query($conn, $query_usun) or die($conn->error);
}


$query = "SELECT * FROM produkty JOIN pozycje_zamowien ON id_produktu=produkty_id WHERE id_produktu>0 AND zamowienia_id='$zamowienie'";
$result = mysqli_query($conn, $query) or die($conn->error);
$query_suma = "SELECT SUM(cena*sztuk) as suma FROM produkty JOIN pozycje_zamowien ON id_produktu=produkty_id WHERE id_produktu>0 AND zamowienia_id='$zamowienie'";
$r_suma = mysqli_query($conn, $query_suma) or die($conn->error);

if ($result->num_rows==0) {
	echo "<h2>Twój koszyk jest pusty.</h2>";
	echo "<p>Dokonaj swoich (nie)pierwszych zakupów!</p>";
}
else {
	echo "";
	echo "<h2>Koszyk</h2>";
	echo "<table>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
			echo "<td><a href=\"produkty.php?id_produktu={$row['id_produktu']}\">{$row['nazwa']}</a></td>";
			
			echo "<td><form method='POST' action='zmiana_koszyka.php?id_produktu=".$row['id_produktu']."'>
			<input type='number' style='width: 40px;' name='numery' min='1' value='".$row['sztuk']."'>
			<input type='submit' name='sztuki' value='zatwierdź zmianę liczby sztuk'> x ".$row['cena']."zł</form></td>";
			
			echo "<td><form method='POST' action='koszyk.php?id_produktu=".$row['id_produktu']."'><input type='submit' name='usun' value='Usuń całość'></form></td>";
		echo "</tr>";
		
		
	}
	echo "<tr>";
		echo "<td><b></b></td>";
		echo "<td><b>Suma:</b></td>";
		while ($row = $r_suma->fetch_assoc()) {
			echo "<td>".$row['suma']."</td>";
			$_SESSION['koszt']=$row['suma'];
		}
	echo "</tr>";
	echo "<tr>";
	    echo "<td><b></b></td>";
		echo "<td><b></b></td>";
		echo "<td><a href='checkout_update.php?id_zamowienia=".$zamowienie."'>Dalej</a></td>";
	echo "</tr>";
	echo "</table>";
	$_SESSION['ulica'] = $ulica;
    $_SESSION['nr_domu']= $nr_domu;
    $_SESSION['miasto']= $miasto;
	$_SESSION['kod_pocztowy']= $kod_pocztowy;
    $_SESSION['wojewodztwo']= $wojewodztwo;


}

?>