<div id="panelzmianarangi">
	<form method="POST" action="index.php?id=68">
		<p class="wpisz_dane">Tytul filmu<input name="tytul" class="pole1"></p><br><br>
		<center><input id="input" type="submit" value="Usuń film" name="usunfilm"></center>
	</form>	
</div>	
<?php
	if (isset($_POST['usunfilm'])) 
	{
		$tytul=$_POST['tytul'];
		if (mysql_num_rows(mysql_query("SELECT tytul FROM filmy WHERE tytul = '$tytul';")) == 0)
		{
			echo '<p class="txt_niebieski_tabela">Nie ma w bazie filmu o takim tytule</p>';
		}
		else
		{
			mysql_query("DELETE FROM `filmy` WHERE tytul = '$tytul';");
			echo '<p class="txt_niebieski_tabela">Usunięto film <b>'.$tytul.'</b> i wszystkie wydarzenia, rezerwacje, komentarze z nim zwiazane.</p>';
		}
	}	
?>
