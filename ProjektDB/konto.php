<?php
session_start();
if (!isset($_SESSION['aktywny'])) {
	header('Location: logowanie.php');
	exit();
}

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

include 'home.php';

$klient_id = $_SESSION['id_klienta'];
$query_k = "SELECT * FROM klienci WHERE id_klienta='$klient_id'";
$result_k = mysqli_query($conn, $query_k);
$query_z = "SELECT * FROM zamowienia WHERE klienci_id='$klient_id' and status!='w_trakcie'";
$result_z = mysqli_query($conn, $query_z);


$klient = $result_k->fetch_assoc();
$imie = $klient['imie'];
$nazwisko = $klient['nazwisko'];
$telefon = $klient['telefon'];
$email = $klient['email'];
?>
<h2>Dane kupującego</h2>
<?php

echo $imie." ".$nazwisko,"<br><br>";
echo $email."<br><br>";
if ($telefon!=""){echo "tel.: ".$telefon."<br><br><br>";}
echo "<i><a href='klient_edycja.php?dane=1'>Edytuj dane</a></i><br><br>";
$_SESSION['imie'] = $imie;
$_SESSION['nazwisko']= $nazwisko;
$_SESSION['telefon']= $telefon;

?>

<?php

?>
<br>
<h4>Historia zamówień</h4>

	<table>
		<?php
			while ($row = $result_z->fetch_assoc()): ?>
		<tr>
			<td><a href="pozycje_zamowien.php?zamowienia_id=<?php echo $row['id_zamowienia'];?>">#<?php echo $row['id_zamowienia']; ?></a></td>
			<td><?php echo $row['data']; ?></td>
			<td><?php echo $row['status']; ?></td>
			<td><?php echo $row['koszt_zamowienia']; ?>
		</tr>
		<?php endwhile; ?>
	</table>

<br><br>
<i><a href="wyloguj.php">Wyloguj </a><i><br><br>

<i><b><a href="klient_delete.php">Usuń konto</a></b></i>


<?php
?>