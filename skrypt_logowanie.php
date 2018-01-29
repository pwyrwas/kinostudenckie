<div id="panel">
	<?php if ($_SESSION['zalogowany']==false&&isset($_GET['wyloguj'])==0): ?>
		<form method="POST" action="index.php?id=5">
			<p class="wpisz_dane">Nazwa użytkownika</p>
			<input type="text" name="login" class="pole1"><br>
			<p class="wpisz_dane">Hasło</p>
			<input type="password" name="haslo" class="pole1"><br>
			<div class="log_rej">
				<a href="index.php?id=51">Rejestracja</a>
				<input id="input" type="submit" value="Zaloguj" name="loguj">
			</div>
		</form> 
</div>
	<?php endif; ?>
	<?php	
		if (isset($_GET['wyloguj'])==1) 
		{
			$_SESSION['zalogowany'] = false;
			session_destroy();
			echo '<p class="txt_niebieski_tabela">Zostałeś wylogowany</p>';
			echo "<script type=\"text/javascript\">
					window.setTimeout(\"window.location.replace('index.php?id=5');\",1000);
					</script>";
			
		}
	?>
	<?php
		if (isset($_POST['loguj'])) 
		{
			$login = filtruj($_POST['login']);
			$haslo = filtruj($_POST['haslo']);
			if (mysql_num_rows(mysql_query("SELECT login, haslo FROM uzytkownicy WHERE login = '$login' AND haslo = '".md5($haslo)."';")) > 0) 	// sprawdzamy czy login i hasło są dobre
			{	
				$zapytanie = mysql_query("SELECT IDuser,ranga FROM uzytkownicy WHERE login = '$login';");
				$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
				$IDuser=$wynikzapytania['IDuser'];
				$ranga=$wynikzapytania['ranga'];	
				$_SESSION['zalogowany'] = true;
				$_SESSION['login'] = $login;
				$_SESSION['IDuser'] = $IDuser;
				$_SESSION['ranga'] = $ranga;
				echo "<script type=\"text/javascript\">
					window.setTimeout(\"window.location.replace('index.php?id=5');\",1);
					</script>";
				
			}
			else echo '<p class="txt_niebieski_tabela">Wpisano złe dane.</p>';
		}
		if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true)
		{
			echo '<p class="txt_niebieski_tabela">Zostałes zalogowany</p>';
			echo "<script type=\"text/javascript\">
					window.setTimeout(\"window.location.replace('index.php?id=1');\",1000);
					</script>";
		}
	?>
