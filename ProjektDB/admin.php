<?php
include 'home.php';

session_unset();

?>


<div>
    <b>Dodawanie nowego produktu</b><br>
	<br><form action="dodaj_produkt.php" method="POST">
		nazwa <input type="text" name="nazwa" style="width: 250px;"><br>
		cena <input type="number" name="cena" step="0.01" min="1.00" style="width: 70px;" value="1.00"><br>
		opis <input type="text" name="opis" style="width: 700px;"><br>
		gatunek <select name="gatunek">
			<option value="aglaonema">Aglaonema</option>
			<option value="alokazja">Alokazja</option>
			<option value="anturium">Anturium</option>
			<option value="begonia">Begonia</option>
			<option value="epipremnum i scindapsus">Epipremnum i scindapsus</option>
			<option value="filodendron">Filodendron</option>
			<option value="kaktusy i sukulenty">Kaktusy i sukulenty</option>
			<option value="marantowate">Marantowate</option>
			<option value="syngonium">Syngonium</option>
			<option value="inne">Inne</option>
			<option value="null">NULL</option>
		</select><br>
		trudnosc <select name="trudnosc">
			<option value="dla amatorow">Dla amatorow</option>
			<option value="dla zaawansowanych">Dla zaawansowanych</option>
			<option value="null">NULL</option>
		</select><br>
		bezpieczna <select name="bezpieczna">
			<option value="bezpieczna">Bezpieczna</option>
			<option value="szkodliwa">Szkodliwa</option>
			<option value="null">NULL</option>
		</select><br>
		oczyszczanie <select name="oczyszczanie">
			<option value="tak">Tak</option>
			<option value="nie">Nie</option>
			<option value="null">NULL</option>
		</select><br>
		wysokosc <input type="number" name="wysokosc" min="0" style="width: 40px;" value="1"><br>
		material <select name="material">
			<option value="plastikowa">plastikowa</option>
			<option value="ceramiczna">ceramiczna</option>
			<option value="szklana">szklana</option>
			<option value="metalowa">metalowa</option>
			<option value="betonowa">betonowa</option>
			<option value="gliniana">gliniana</option>
			<option value="inna">inna</option>
			<option value="null">NULL</option>
		</select><br>
		srednica <input type="number" name="srednica" min="0.0" style="width: 40px;" value="1.0"><br>
		typ <select name="typ">
			<option value="roslina">roslina</option>
			<option value="oslonka">oslonka</option>
		</select><br>
		na stanie <input type="number" name="na_stanie" min="1" max="300" value="1"><br>
		<input type="submit" value="Dodaj">
	</form>
</div>


<?php
require_once "dane_dostepu.php";
$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) die("Połączenie zerwane");
?>

<?php
$conn->close();
?>