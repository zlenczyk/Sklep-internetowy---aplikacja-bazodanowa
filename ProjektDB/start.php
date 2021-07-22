<?php
include 'home.php';
?>

<?php
require_once "dane_dostepu.php";

$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");
$query = "SELECT * FROM produkty ORDER BY id_produktu DESC";
$result = mysqli_query($conn, $query) or die($conn->error);

?>
<h1>Najnowsze produkty</h1>
<div>
	<table>
		<?php
			while ($row = $result->fetch_assoc()): ?>
		<tr>
			<td><?php echo "<a href=\"produkty.php?id_produktu={$row['id_produktu']}\">{$row['nazwa']}, {$row['cena']}</a>" ?></td>
			
			<?php if (isset($_SESSION['aktywny']) && $_SESSION['aktywny'] == true) : ?>
			
			<?php if ($row['na_stanie']>0) : ?>
			<td><form method="POST" action="add.php?id_produktu=<?php echo $row['id_produktu'];?>">
			<input type="number" style="width: 40px;" name="sztuk" min="1" value="1">
			<input type="submit" name="koszyk" value="Dodaj do koszyka"></form></td>
			<?php else : ?>
			<td>brak towaru</td>
			<?php endif; ?>
			
			<?php endif; ?>
		</tr>
		<?php endwhile; ?>
	</table>
</div>



<?php

$conn->close();

?>