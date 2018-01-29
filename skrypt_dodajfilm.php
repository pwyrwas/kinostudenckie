<div id="panelfilm">
	<form action="index.php?id=62" method="post">
		<p class="wpisz_dane">Tytuł <input type="text" name="tytul" class="pole1" size="30"></p>
		<p class="wpisz_dane">Opis </p>
		<textarea name="opis" rows="5" cols="55"></textarea>
		<p class="wpisz_dane">Gatunek
			<select type="text" name="gatunek" class="pole1">
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
		<p class="wpisz_dane">Link do plakatu <input type="text" name="linkplakat" class="pole1" size="30"></p>	
		<p class="wpisz_dane">Link do youtube <input type="text" name="linkyt" class="pole1" size="30"></p>	
		<p class="wpisz_dane">Czas trwania (minuty) <input type="text" name="czastrwania" class="pole1" size="30">	</p>
		<p class="wpisz_dane">Wersja jezykowa
			<select type="text" name="jezyk" class="pole1">
				<option>polskie napisy</option>
				<option>polski lektor</option>
				<option>polski dubbing</option>
			</select>
		</p>
		<p class="wpisz_dane">Rok premiery <input type="text" name="rokpremiery" class="pole1" size="30">	</p>
		<p class="wpisz_dane">Reżyser <input type="text" name="rezyser" class="pole1" size="30"></p><br>
		<p><center><input id="input" type="submit" value="Dodaj" name="dodaj"></center></p>
	</form>

	<?php
		/*skrypt dodawania filmow*/
		if(isset($_POST['dodaj'])) 
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
				if (mysql_num_rows(mysql_query("SELECT tytul FROM filmy WHERE tytul = '$tytul';")) == 0)   //Sprawdza czy film o tytule już istnieje (zapobiega dodawaniu kolejny raz wpisu po odświerzeniu strony).
				{
					if (strlen($tytul)&&strlen($czastrwania)&&strlen($jezyk)&&strlen($rokpremiery)&&strlen($rezyser) != 0)  //sprawdza czy w polach tytul, czastrwania, jezyk, rokpremiery, rezyser podane są jakieś wartości.
					{
								$query = "INSERT INTO filmy VALUES ('','$tytul','$opis','$gatunek','','','$linkplakat','$linkyt','$czastrwania','$jezyk','$rokpremiery','$rezyser')";
								mysql_query($query);
								echo  '<p class="txt_niebieski_tabela">Dodano film do bazy danych</p>';
					} 
					else 
					{	
						echo  '<p class="txt_niebieski_tabela">Wprowadź wszystkie dane!</p>';
					}
				} 
				else 
				{	
					echo '<p class="txt_niebieski_tabela>Podany film już istnieje w bazie danych!</p>';
				}
		}
	?>
</div>