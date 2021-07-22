<?php
session_start();
if (isset($_SESSION['aktywny']) && $_SESSION['aktywny'] == true) {
	header('Location: konto.php');
	exit();
}

if (isset($_POST['email'])) {
	$poprawne_dane = true;
		
	$imie = $_POST['imie'];	
	if (strlen($imie)<2 || strlen($imie)>40) {
		$poprawne_dane = false;
		$_SESSION['imie_error'] = "Wymagane od 3 do 40 znaków";
	}
	
	$nazwisko = $_POST['nazwisko'];	
	if (strlen($nazwisko)<2 || strlen($nazwisko)>45) {
		$poprawne_dane = false;
		$_SESSION['nazwisko_error'] = "Wymagane od 3 do 45 znaków";
	}
	
	$telefon= $_POST['telefon'];
	if (!ctype_digit($telefon)) {
		$poprawne_dane = false;
		$_SESSION['telefon_error'] = "Wymagane cyfry, bez spacji";
	}
	
	$email = $_POST['email'];
	$test = filter_var($email, FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) || ($email != $test)) {
		$poprawne_dane = false;
		$_SESSION['email_error'] = "Wpisz poprawny email";
	}
	
	if (strlen($email)<5 || strlen($email)>60) {
		$poprawne_dane = false;
		$_SESSION['email_error'] = "Wpisz poprawny email";
	}
	
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	
	if (strlen($haslo1)<8 || strlen($haslo1)>40) {
		$poprawne_dane = false;
		$_SESSION['haslo_error'] = "Wymagane od 8 do 40 znaków";
	}
	
	if ($haslo1 != $haslo2) {
		$poprawne_dane = false;
		$_SESSION['haslo_error'] = "Powtórzone hasło musi być identyczne";
	}
	
	$_SESSION['email_check'] = $email;
	
	require_once "dane_dostepu.php";
	$conn = new mysqli($host, $username, $password, $database_name);
	if (!$conn) die("Połączenie zerwane");
	
	$unikatowy_mail = "SELECT id_klienta FROM klienci WHERE email='$email'";
	$result = mysqli_query($conn, $unikatowy_mail) or die($conn->error);
	
	$maile=$result->num_rows;
	if ($maile>0) {
		$poprawne_dane= false;
		$_SESSION['email_error'] = "Ten użytkownik już istnieje.";
	}	

	if ($poprawne_dane) {
		$haslo1 = md5($haslo1);
		$nowy_klient = "INSERT INTO klienci (imie, nazwisko, telefon, email, haslo) VALUES ('$imie', '$nazwisko', '$telefon', '$email', '$haslo1')";
		if ($conn->query($nowy_klient)) {
			$_SESSION['zarejestrowano'] = true;
			header('Location: zarejestrowano.php');
		}
	}
}

include 'home.php';
?>

<h2>REJESTRACJA</h2>

<form method="POST">
    Imie<br>
	<input type="text" name="imie" value="<?php 
		if (isset($_SESSION['imie_error'])) {
			echo $_SESSION['imie_error'];
			unset ($_SESSION['imie_error']);
		}?>"><br>
	Nazwisko<br>
	<input type="text" name="nazwisko" value="<?php 
		if (isset($_SESSION['nazwisko_error'])) {
			echo $_SESSION['nazwisko_error'];
			unset ($_SESSION['nazwisko_error']);
		}?>"><br>
	Telefon<br>
	<input type="text" name="telefon" value="<?php 
		if (isset($_SESSION['telefon_error'])) {
			echo $_SESSION['telefon_error'];
			unset ($_SESSION['telefon_error']);
		}?>"><br>
	E-mail<br>
	<input type="text" name="email" value="<?php 
		if (isset($_SESSION['email_check'])) {
			echo $_SESSION['email_check'];
			unset ($_SESSION['email_check']);
		}?>"><br>
	<?php 
		if (isset($_SESSION['email_error'])) {
			echo '<div class="blad">'.$_SESSION['email_error'].'</div>';
			unset($_SESSION['email_error']);
		}?><br>
	Hasło<br>
	<input type="password" name="haslo1"><br>
	<?php 
		if (isset($_SESSION['haslo_error'])) {
			echo '<div class="blad">'.$_SESSION['haslo_error'].'</div>';
			unset($_SESSION['haslo_error']);
		}	
	?>
	Powtórz hasło<br>
	<input type="password" name="haslo2"><br>
	<br><input type="submit" value="Zarejestruj się">
</form>
<br><br>
Albo... <a href="logowanie.php">Zaloguj się.</a>

<?php
?>