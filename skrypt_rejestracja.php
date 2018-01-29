<div id="panel">
	<form method="POST" action="index.php?id=51">
		<p class="wpisz_dane">Nazwa użytkownika</p><input type="text" name="login" class="pole1">
		<p class="wpisz_dane">Hasło</p><input type="password" name="haslo1" class="pole1">
		<p class="wpisz_dane">Powtórz hasło:</p><input type="password" name="haslo2" class="pole1">
		<p class="wpisz_dane">Email:</p><input type="text" name="email" class="pole1"><br><br><br>
		<center><input id="input" type="submit" value="Zarejestruj" name="rejestruj"></center>
	</form>	
</div>
<?php
	//skrypt do rejestracji
	if (isset($_POST['rejestruj'])) 
	{
		$login = filtruj($_POST['login']);
		$haslo1 = filtruj($_POST['haslo1']);
		$haslo2 = filtruj($_POST['haslo2']);
		$email = filtruj($_POST['email']);
		if (strlen($login)&&strlen($haslo1)&&strlen($haslo2)&&strlen($email))
		{
			if (strlen($login)>3)
			{
				if (strlen($haslo1)>4)
				{
					if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '$login';")) == 0) 					// sprawdzamy czy login nie jest już w bazie
					{
						if ($haslo1 == $haslo2) 																						// sprawdzamy czy hasła takie same
						{
							if (filter_var($email, FILTER_VALIDATE_EMAIL))
							{
								//rejestracja
								mysql_query("INSERT INTO `uzytkownicy` (`login`, `haslo`, `email`) VALUES ('$login', '".md5($haslo1)."', '$email');");
								echo '<p class="txt_niebieski_tabela">Utworzono konto.</p>';
								//wyslanie maila
								$naglowki = "Reply-to: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
								$naglowki .= "From: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
								$naglowki .= "MIME-Version: 1.0".PHP_EOL;
								$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 
								$wiadomosc = '<html>
													<head>
														<title>Rejestracja</title> 
													</head>
													<body>
													  <p>Witamy na stronie kina studenckiego</p>
													  <p>Twój login to: '.$login.'</p>
													  <p>Twoje hasło to: '.$haslo1.'</p>
													</body>
											</html>';
								if(mail($email, 'Witaj', $wiadomosc, $naglowki))
								{
									echo '<p class="txt_niebieski_tabela">Wysłano wiadomość na podany email.</p>';
								}
								//ustawienia w profilu uzytkownika (newsletter)
								$zapytanie = mysql_query("SELECT IDuser FROM uzytkownicy WHERE login = '".$login."';");
								$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
								$IDuser=$wynikzapytania['IDuser'];
								mysql_query("INSERT INTO `preferencjenewsletter` (`IDuser`, `akcji`, `animowany`, `biograficzny`, `dramatyczny`, `scifi`, `dokumentalny`, `komediowy`, `horror`, `thriller`, `przygodowy`) VALUES ('.$IDuser.', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');");
							}
							else echo '<p class="txt_niebieski_tabela">Email nie jest poprawny</p>';
						}
						else echo '<p class="txt_niebieski_tabela">Hasła nie są takie same</p>';
					}
					else echo '<p class="txt_niebieski_tabela">Podany login jest już zajęty.</p>';
				}
				else echo '<p class="txt_niebieski_tabela">Hasło musi mieć przynajmniej 5 znaków.</p>';
			}
			else echo '<p class="txt_niebieski_tabela">Login musi mieć przynajmniej 4 znaki.</p>';		
		}
		else echo '<p class="txt_niebieski_tabela">Wszystkie pola muszą być uzupełnione.</p>';
	}
?>
