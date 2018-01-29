<div id="panelwydarzenie">
	<?php
		if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true)
		{
			echo '<h1 class="naglowek_czerwony">Dostępne opcje dla tego konta:</h1>';
			
			// Dla rangi >=user
			echo '<li><a href="index.php?id=61">Zmień hasło</a></li>';
			echo '<li><a href="index.php?id=65">Konfiguruj system powiadomień</a></li>';
			echo '<br>';
			// Dla rangi >=moderator
			if ($ranga=='moderator' || $ranga=='admin')
			{
				echo '<li><a href="index.php?id=62">Dodaj film</a></li>';
				echo '<li><a href="index.php?id=611">Edytuj film</a></li>';
				echo '<li><a href="index.php?id=64">Dodaj wydarzenie</a></li>';
				echo '<li><a href="index.php?id=66">Wyślij newslettery</a></li>';
				echo '<li><a href="index.php?id=610">Zarządzaj treścią strony</a></li>';
				echo '<br>';
			}
			
			// Dla admina
			if ($ranga=='admin')
			{
				echo '<li><a href="index.php?id=63">Zmień rangę użytkownika</a></li>';
				echo '<li><a href="index.php?id=67">Usuń użytkownika</a></li>';
				echo '<li><a href="index.php?id=68">Usuń film</a></li>';
				echo '<li><a href="index.php?id=69">Usuń wydarzenie</a></li>';
			}
		}
		else
		{
			echo '<center><p class="txt_niebieski_m">Błąd! Nie możesz tu przebywać</p></center>';
			echo "<script type=\"text/javascript\">
					window.setTimeout(\"window.location.replace('index.php?id=1');\",2000);
					</script>";
		}
	?>
</div>