<?php
if (isset($_SESSION['id_klienta'])) {
	$klient=$_SESSION['id_klienta'];
}
else {
	$klient="nieaktywny";
}

include 'home.php';

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$produkt = $_GET['id_produktu'];
$query = "SELECT * FROM produkty WHERE id_produktu='$produkt'";
$result = mysqli_query($conn, $query) or die(conn->error);
$row = $result->fetch_assoc();

echo "<h2>".$row['nazwa']."</h2>";
echo $row['cena']." zł<br>";
echo "<h3>Wysokość: ".$row['wysokosc']." cm, średnica: ".$row['srednica']." cm</h3>";
echo $row['opis']."<br><br>";

if($row['typ']=='roslina'){
	echo "<b>Przeznaczenie: </b>".$row['trudnosc']."<br>";
	echo "<b>Roślina bezpieczna dla dzieci i zwierząt: </b>".$row['bezpieczna']."<br>";
	echo "<b>Oczyszczanie powietrza: </b>".$row['oczyszczanie']."<br>";
}
elseif($row['typ']=='oslonka'){
	echo "<b>Wykonanie: </b>".$row['material']."<br>";
}
?>

<?php
$conn->close();
?>