<?php
session_start();
if (isset($_SESSION['aktywny']) && $_SESSION['aktywny'] == true) {
	header('Location: konto.php');
	exit();
}
include 'home.php';
?>
<h2>LOGOWANIE</h2>
<form action="zalogowano.php" method="POST">
E-mail<br>
<input type="text" name="email"><br><br>
Hasło<br>
<input type="password" name="haslo"><br>
<?php
if (isset($_SESSION['blad_logowania'])) {
	echo $_SESSION['blad_logowania']."<br>";
}
?>
<br>
<input type="submit" value="Zaloguj">
</form>
<br><br><br>

Albo... <a href="rejestracja.php">Zarejestruj się.</a>

<?php

?>