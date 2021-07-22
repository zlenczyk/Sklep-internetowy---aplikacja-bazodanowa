<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl"><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div id="nav">
	<a class="menu" href="start.php">Sklep</a>
	<a class="menu" href="dostawa.php">Płatności i dostawa</a>
	<a class="menu" href="kontakt.php">Kontakt</a>
	<?php if (isset($_SESSION['aktywny']) && $_SESSION['aktywny'] == true) :?>
	<a class="menu" href="koszyk.php">Koszyk</a>
	<?php endif;?>
	<?php 
	if (isset($_SESSION['aktywny']) && $_SESSION['aktywny'] == true) {
		echo '<a class="menu" href="konto.php">Konto</a>';
    }
	else {
		echo '<a class="menu" href="rejestracja.php">Rejestracja </a>';
		echo '<a class="menu" href="logowanie.php">Logowanie </a>';
    }
	?>
</div>

<div id="main">