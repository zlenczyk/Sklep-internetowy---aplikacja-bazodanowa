<?php
include 'home.php';

require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");

$query = "SELECT * FROM dostawa";
$result = mysqli_query($conn, $query) or die($conn->error);
?>

<div>
    <h4>Aby dokonać zakupów w naszym sklepie musisz być zarejestrowanym użytkownikiem.</h4>
	<br>
	<p>Po zalogowaniu wybierz interesujące Cię produkty. Następnie uzupełnij adres, wybierz<p>
	<p>sposób dostawy i potwierdź to poprzez opcję złożenia zamówienia. Wchodząc w zakładkę<p>
	<p>ze swoimi zamówieniami,  zobaczysz  informację  o  numerze swojego zamówienia i jego<p>
	<p>statusie. Teraz możesz dokonać przelewu na nasze konto:</p>
	<br>
	<p>12 3456 789 1011 1213 1415 1617</p>
	<p>Sklep Roślinny</p>
    <p>ul. Roślinna 1/1, 12-345, Roślinowo</p><br>
	<p>podając w tytule <b>tylko</b> numer swojego zamówienia. Po zaksięgowaniu płatności</p>
	<p>status twojego zamówienia zmieni się na "zapłacono", a swoje zamówienie otrzymasz</p>
	<p>w ciągu 14 dni roboczych. Wszelkie potrzebne informacje na temat swojego zamówienia</p>
	<p>otrzymasz na mailu.</p><br>
	<p>Pozdrawiamy,<br>zespół Roślinnego Sklepu :)</p>
	<br><br>
	<p><b>W naszym sklepie możesz wybrać wygodny dla Ciebie sposób dostawy.<b></p>
	<br>
	<table>
		<?php
			while ($row = $result->fetch_assoc()): ?>
		<tr>
			<td><?php echo $row['sposob_dostawy'];?></td>
			<td><?php echo $row['koszt_dostawy'];?> zł</td>
		</tr>
		<?php endwhile; ?>
	</table>
</div>

<?php
?>