<div id="panelzmianarangi">
	<form method="POST" action="index.php?id=610">
		<p class="zolty_m">Aktualności</p>
		<p class="wpisz_dane">Pierwszy film<input name="film1" class="pole1"></p>
		<p class="wpisz_dane">Drugi film<input name="film2" class="pole1"></p>
		<p class="zolty_m">O Nas</p>
		<p class="wpisz_dane">Kontakt </p>
		<textarea name="kontakt" rows="5" cols="46"></textarea>
		<p class="wpisz_dane">Cennik </p>
		<textarea name="cennik" rows="5" cols="46"></textarea>
		<br><br>
		<center><input id="input" type="submit" value="Zmień ustawienia" name="zmianaustawien"></center>
	</form>	
</div>	
<?php
	//obsluga formularza zmieniajacego tresc wyswietlana na stronie glownej i podstronie "O nas"
	if (isset($_POST['zmianaustawien'])) 
	{
		$film1=$_POST['film1'];
		$film2=$_POST['film2'];
		$kontakt=$_POST['kontakt'];
		$cennik=$_POST['cennik'];
		if (strlen($film1)>0)
		{
			if (mysql_num_rows(mysql_query("SELECT IDfilm FROM filmy WHERE tytul = '$film1';")) == 0)
			{
				echo '<p class="txt_niebieski_tabela">Nie ma w bazie filmu o takim tytule (pierwszy film)</p>';
			}
			else
			{
				$query="SELECT IDfilm FROM filmy WHERE tytul = '$film1';";
				$result=mysql_query($query);
				$film1ID=mysql_result($result,0,"IDfilm");
				mysql_query("UPDATE `trescstrony` SET `aktualnosci_idfilm1` = '$film1ID';");
				echo '<p class="txt_niebieski_tabela">Zamieniono pierwszy film</p>';
			}
		}
		if (strlen($film2)>0)
		{
			if (mysql_num_rows(mysql_query("SELECT IDfilm FROM filmy WHERE tytul = '$film2';")) == 0)
			{
				echo '<p class="txt_niebieski_tabela">Nie ma w bazie filmu o takim tytule (drugi film)</p>';
			}
			else
			{
				$query="SELECT IDfilm FROM filmy WHERE tytul = '$film2';";
				$result=mysql_query($query);
				$film2ID=mysql_result($result,0,"IDfilm");
				mysql_query("UPDATE `trescstrony` SET `aktualnosci_idfilm2` = '$film2ID';");
				echo '<p class="txt_niebieski_tabela">Zamieniono drugi film</p>';
			}
		}
		if (strlen($kontakt)>0)
		{
			mysql_query("UPDATE `trescstrony` SET `onas_kontakt` = '$kontakt';");
			echo '<p class="txt_niebieski_tabela">Zmieniono kontakt</p>';
		}
		if (strlen($cennik)>0)
		{
			mysql_query("UPDATE `trescstrony` SET `onas_cennik` = '$cennik';");
			echo '<p class="txt_niebieski_tabela">Zmieniono cennik</p>';
		}
	
	}	
?>
