<div id="panelzmianarangi">
	<form method="POST" action="index.php?id=63">
		<p class="wpisz_dane">Login użytkownika<input name="loginusera" class="pole1"></p>
		<p class="wpisz_dane">Wybierz poziom uprawnień
		<select type="text" name="nowaranga" class="pole1">
				<option>user</option>
				<option>moderator</option>
				<option>admin</option>
		</select><br><br>
		</p>
		<center><input id="input" type="submit" value="Zmień poziom uprawnień" name="zmianarangi"></center>
	</form>	
</div>	
<?php
	if (isset($_POST['zmianarangi'])) 
	{
		$loginusera=$_POST['loginusera'];
		$nowaranga=$_POST['nowaranga'];
		if ($loginusera!=$login)
		{
			if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '$loginusera';")) == 0)
			{
				echo '<p class="txt_niebieski_tabela">Nie ma w bazie użytkownika o podanym loginie.</p>';
			}
			else
			{
				mysql_query("UPDATE `uzytkownicy` SET `ranga` = '$nowaranga' WHERE login = '$loginusera';");
				echo '<p class="txt_niebieski_tabela">Zmieniono poziom uprawnień użytkownika</p>';
				
				$query="SELECT email FROM uzytkownicy WHERE login='$loginusera'";
				$result=mysql_query($query);
				$mailusera=mysql_result($result,0,"email");
				
				$naglowki = "Reply-to: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
				$naglowki .= "From: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
				$naglowki .= "MIME-Version: 1.0".PHP_EOL;
				$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 
				$wiadomosc = '<html>
									<head>
										<title>Zmiana uprawnień</title> 
									</head>
									<body>
									  <p>Witaj '.$loginusera.'</p>
									  <p>Poziom uprawnień na Twoim koncie został zmieniony.</p>
									  <p>Aktualny poziom uprawnień: '.$nowaranga.'</p>
									</body>
							</html>';
				if(mail($mailusera, 'Zmiana uprawnień', $wiadomosc, $naglowki))
				{
					echo '<p class="txt_niebieski_tabela">Wysłano wiadomość na email użytkownika.</p>';
				}
			}
		}
		else
			echo '<p class="txt_niebieski_tabela">Nie możesz zmienać swojego poziomu uprawnień</p>'; 
	}	
?>
