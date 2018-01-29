<div id="panelzmianarangi">
	<form method="POST" action="index.php?id=611">
		<p class="wpisz_dane">Tytul filmu<input name="tytul" class="pole1"></p>
		<center><input id="input" type="submit" value="Edytuj film" name="edytujfilm"></center>
	</form>	
</div>	
<?php
	if (isset($_POST['edytujfilm'])) 
	{
		$tytul=$_POST['tytul'];
		if (mysql_num_rows(mysql_query("SELECT tytul FROM filmy WHERE tytul = '$tytul';")) == 0)
		{
			echo '<p class="txt_niebieski_tabela">Nie ma w bazie filmu o takim tytule</p>';
		}
		else
		{
			$query="SELECT * FROM filmy WHERE tytul = '$tytul'";
			$result=mysql_query($query);
			$tytul=mysql_result($result,0,"tytul");
			$opis=mysql_result($result,0,"opis");
			$gatunek=mysql_result($result,0,"gatunek");
			$sumaocen=mysql_result($result,0,"sumaocen");
			$liczbaglosow=mysql_result($result,0,"liczbaglosow");
			$linkplakat=mysql_result($result,0,"linkplakat");
			$linkyt=mysql_result($result,0,"linkyt");
			$czastrwania=mysql_result($result,0,"czastrwania");
			$jezyk=mysql_result($result,0,"jezyk");
			$rokpremiery=mysql_result($result,0,"rokpremiery");
			$rezyser=mysql_result($result,0,"rezyser");
			
			echo '<div id="panelfilm"><form action="index.php?id=611" method="post">
				<p class="wpisz_dane">Tytuł <input type="text" name="tytul" class="pole1" size="30" value="'.$tytul.'"></p>
				<p class="wpisz_dane">Opis </p>
				<textarea name="opis" rows="5" cols="55">'.$opis.'</textarea>
				<p class="wpisz_dane">Gatunek
					<select type="text" name="gatunek" class="pole1">
						<option>'.$gatunek.'</option>
						<option>akcji</option>
						<option>animowany</option>
						<option>biograficzny</option>
						<option>dramatyczny</option>
						<option>scifi</option>
						<option>dokumentalny</option>
						<option>komediowy</option>
						<option>horror</option>
						<option>thriller</option>
						<option>przygodowy</option>
					</select>
				</p>
				<p class="wpisz_dane">Link do plakatu <input type="text" name="linkplakat" class="pole1" size="30" value="'.$linkplakat.'"></p>	
				<p class="wpisz_dane">Link do youtube <input type="text" name="linkyt" class="pole1" size="30" value="'.$linkyt.'"></p>	
				<p class="wpisz_dane">Czas trwania (minuty) <input type="text" name="czastrwania" class="pole1" size="30" value="'.$czastrwania.'">	</p>
				<p class="wpisz_dane">Wersja jezykowa
					<select type="text" name="jezyk" class="pole1">
						<option>'.$jezyk.'</option>
						<option>polskie napisy</option>
						<option>polski lektor</option>
						<option>polski dubbing</option>
					</select>
				</p>
				<p class="wpisz_dane">Rok premiery <input type="text" name="rokpremiery" class="pole1" size="30" value="'.$rokpremiery.'">	</p>
				<p class="wpisz_dane">Reżyser <input type="text" name="rezyser" class="pole1" size="30" value="'.$rezyser.'"></p><br>
				<p><center><input id="input" type="submit" value="Zaktualizuj informacje" name="aktualizuj"></center></p>
			</form></div>';
			
		}
	}	
?>


<?php
	/*skrypt edytowania filmu*/
	if(isset($_POST['aktualizuj'])) 
	{
			$tytul=$_POST['tytul'];
			$opis=$_POST['opis'];
			$gatunek=$_POST['gatunek'];
			$linkplakat=$_POST['linkplakat'];
			$linkyt=$_POST['linkyt'];
			$czastrwania=$_POST['czastrwania'];
			$jezyk=$_POST['jezyk'];
			$rokpremiery=$_POST['rokpremiery'];
			$rezyser=$_POST['rezyser'];
			
			if (strlen($tytul)&&strlen($czastrwania)&&strlen($jezyk)&&strlen($rokpremiery)&&strlen($rezyser) != 0)  //sprawdza czy w polach tytul, czastrwania, jezyk, rokpremiery, rezyser podane są jakieś wartości.
			{
				$query = "UPDATE `filmy` SET `opis`='$opis', `gatunek`='$gatunek', `linkplakat`='$linkplakat', `linkyt`='$linkyt', `czastrwania`='$czastrwania', `jezyk`='$jezyk', `rokpremiery`='$rokpremiery', `rezyser`='$rezyser' WHERE `tytul`='$tytul'";
				mysql_query($query);
				echo  '<p class="txt_niebieski_tabela">Zaktualizowano informacje o filmie</p>';
			} 
			else 
			{	
				echo  '<p class="txt_niebieski_tabela">Wprowadź wszystkie dane!</p>';
			}
			
	}
?>
