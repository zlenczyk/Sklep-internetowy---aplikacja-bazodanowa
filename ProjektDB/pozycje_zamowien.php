<?php

include 'home.php';
$klient = $_SESSION['id_klienta'];
$zamowienie = $_SESSION['id_zamowienia'];
$zam = $_GET['zamowienia_id'];

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$query = "SELECT * FROM zamowienia join pozycje_zamowien on id_zamowienia=zamowienia_id join produkty on id_produktu=produkty_id join dostawa on id_dostawy=dostawa_id WHERE id_zamowienia='$zam' ORDER BY id_zamowienia DESC";
$query2 = "SELECT SUM(cena*sztuk) as koszt FROM zamowienia join pozycje_zamowien on id_zamowienia=zamowienia_id join produkty on id_produktu=produkty_id join dostawa on id_dostawy=dostawa_id WHERE id_zamowienia='$zamowienie'";
$query3 = "SELECT sposob_dostawy, koszt_dostawy FROM zamowienia join dostawa on id_dostawy=dostawa_id WHERE id_zamowienia='$zamowienie'";
$query4 = "SELECT koszt_zamowienia FROM zamowienia WHERE id_zamowienia='$zamowienie'";
$result = mysqli_query($conn, $query) or die($conn->error);
$result1 = mysqli_query($conn, $query) or die($conn->error);
$result2 = mysqli_query($conn, $query2) or die($conn->error);
$result3 = mysqli_query($conn, $query3) or die($conn->error);
$result4 = mysqli_query($conn, $query4) or die($conn->error);
$row1 = $result1->fetch_assoc();


?>

<div>
	<table>
		<tr>
			<td><b>Zamówienie</b></td>
			<td><b>#</b><?php echo $_GET['zamowienia_id']; ?></td>
			<td><?php echo $row1['data']; ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php
			while ($row = $result->fetch_assoc()):?>
				<tr>
					<td><?php echo $row['nazwa'];?></td>
					<td><b></b></td>
					<td><?php echo $row['sztuk'];?>x<?php echo $row['cena'];?></td>
				</tr>
		<?php endwhile; ?>
		<?php
			while ($row2 = $result2->fetch_assoc()):?>
				<tr>
					<td><b>Suma:</b></td>
					<td><b></b></td>
					<td><?php echo $row2['koszt'] ?></td>
				</tr>
		<?php endwhile; ?>
		
		<tr>
		<?php
			while ($row = $result3->fetch_assoc()):?>
				<td><b>Dostawa:</b></td>
				<td><?php echo $row['sposob_dostawy'];?></td>
				<td><?php echo $row['koszt_dostawy'];?></td>
		<?php endwhile; ?>	
		</tr>
		
		<tr>
		<?php
			while ($row = $result4->fetch_assoc()):?>
				<td><b></b></td>
				<td>Razem:</td>
				<td><?php echo $row['koszt_zamowienia'];?></td>
		<?php endwhile; ?>	
		</tr>
	</table>
</div>

<?php
$conn->close();

?>