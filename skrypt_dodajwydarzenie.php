<div id="panelwydarzenie">
	<form action="index.php?id=64" method="post">
		<p class="wpisz_dane">Tytuł <input type="text" name="tytul" class="pole1" size="30"></p>
		<p class="wpisz_dane">Data (RRRR-MM-DD hh:mm:ss) <input type="text" name="datarozpoczecia" class="pole1" size="30"></p>
		<p><center><input id="input" type="submit" value="Dodaj" name="dodajevent"></center></p>
	</form>

	<?php
		/*skrypt dodawania wydarzen*/
		if(isset($_POST['dodajevent'])) 
		{
			$tytul=$_POST['tytul'];
			$datarozpoczecia=$_POST['datarozpoczecia'];
			$typpoprawnejdaty=strlen("RRRR-MM-DD hh:mm:ss");
			$i=0;
			if (strlen($tytul)&&strlen($datarozpoczecia) != 0)
			{
				if (mysql_num_rows(mysql_query("SELECT tytul FROM filmy WHERE tytul = '$tytul';")) == 1) 
				{
					if (strlen($datarozpoczecia) == $typpoprawnejdaty)
					{	
						$query="SELECT IDfilm,tytul,czastrwania FROM filmy WHERE tytul = '$tytul';";
						$result=mysql_query($query);
						$IDfilm=mysql_result($result,0,"IDfilm");
						$tytul=mysql_result($result,0,"tytul");
						$czastrwania=mysql_result($result,0,"czastrwania");
						$czassprzatania=15;
						$datazakonczenia=strtotime($datarozpoczecia)+$czastrwania*60+$czassprzatania*60;
						$datazakonczenia=date("Y-m-d G:i:s",$datazakonczenia);
						$query2="SELECT * FROM  `repertuar` WHERE (datazakonczenia >= '$datarozpoczecia' AND datazakonczenia <='$datazakonczenia') OR ( datarozpoczecia<= '$datazakonczenia' AND datarozpoczecia >='$datarozpoczecia')";
						if (mysql_num_rows(mysql_query($query2)) == 0 && (strtotime($datarozpoczecia)>time()))
						{									
							$query = "INSERT INTO repertuar VALUES ('','$IDfilm','$datarozpoczecia','$datazakonczenia')";
							mysql_query($query);
							$zapytanie = mysql_query("SELECT IDevent FROM repertuar WHERE datarozpoczecia = '$datarozpoczecia';");
							$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
							$IDevent=$wynikzapytania['IDevent'];
							$query = "INSERT INTO sala VALUES ('$IDevent','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";
							mysql_query($query);
							echo  '<p class="txt_niebieski_tabela">Dodano wydarzenie!</p>';
						}
						else
						{
							echo  '<p class="txt_niebieski_tabela">Nie można dodać wydarzenia w tym czasie</p>';
						}
					}
					else
					{
						echo  '<p class="txt_niebieski_tabela">Data nie została wprowadzona prawidłowo</p>';
					}
				} 
				else 
				{	
					echo '<p class="txt_niebieski_tabela">W bazie nie ma filmu o podanym tytule</p>';
				}
			} 
			else 
			{	
				echo  '<p class="txt_niebieski_tabela">Wprowadź wszystkie dane!</p>';
			}
		}
	?>
</div>