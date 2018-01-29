<div id="panel">
	<form method="POST" action="index.php?id=61">
		<p class="wpisz_dane">Stare hasło:</p><input type="password" name="starehaslo" class="pole1">
		<p class="wpisz_dane">Nowe hasło:</p><input type="password" name="haslo1" class="pole1">
		<p class="wpisz_dane">Powtórz hasło:</p> <input type="password" name="haslo2" class="pole1"><br><br><br>
		<center><input id="input" type="submit" value="Zmień hasło" name="zmianahasla"></center>
	</form>	
</div>	
	<?php
		if (isset($_POST['zmianahasla'])) 
		{
			$starehaslo = $_POST['starehaslo'];
			$haslo1 = $_POST['haslo1'];
			$haslo2 = $_POST['haslo2'];
			$zapytanie = mysql_query("SELECT haslo,email FROM uzytkownicy WHERE login = '$login';");
			$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
			$haslowbazie=$wynikzapytania['haslo'];
			$email=$wynikzapytania['email'];
			if (strlen($haslo1)>4)
			{
				if (md5($starehaslo)==$haslowbazie)
				{
					if ($haslo1 == $haslo2) 																						
					{
						mysql_query("UPDATE `uzytkownicy` SET `haslo` = '".md5($haslo1)."' WHERE login = '.$login';");
						echo '<p class="txt_niebieski_tabela">Hasło zostało zmienione.</p>';
						$naglowki = "Reply-to: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
						$naglowki .= "From: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
						$naglowki .= "MIME-Version: 1.0".PHP_EOL;
						$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 
						$wiadomosc = '<html>
											<head>
												<title>Wiadomość e-mail</title> 
											</head>
											<body>
											  <p>Zmieniono hasło do konta</p>
											  <p>Nowe hasło to: '.$haslo1.'</p>
											</body>
									</html>';
						if(mail($email, 'Zmiana hasła', $wiadomosc, $naglowki))
						{
							echo '<p class="txt_niebieski_tabela">Wysłano wiadomość na podany email</p>';
						}
					}
					else echo '<p class="txt_niebieski_tabela">Hasła nie są takie same.</p></center>';
				}
				else echo '<p class="txt_niebieski_tabela">Podane stare hasło nie jest poprawne.</p>';
			}
			else echo '<p class="txt_niebieski_tabela">Hasło musi mieć przynajmniej 5 znaków.</p>';	
		}
	?>
