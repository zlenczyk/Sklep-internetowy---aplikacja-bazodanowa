<?php
session_start();
if (!isset($_SESSION['zarejestrowano'])) {
	header('Location: start.php');
}
else {
	unset($_SESSION['zarejestrowano']);
}

if (isset($_SESSION['email_good'])) unset($_SESSION['email_good']);
if (isset($_SESSION['email_error'])) unset($_SESSION['email_error']);

include 'home.php';
?>

<p style="text-align:center; font-size:20px">Rejestracja przebiegła pomyślnie.</p>
<p style="text-align:center"><a style="font-size:20px" href="logowanie.php">Zaloguj się</a></p>


<?php
?>