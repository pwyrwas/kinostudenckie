<?php
	//obsluga rezerwacji
	if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true) 
	{
		$IDevent=$_GET['IDevent'];
		$liczba_miejsc_rzad=$liczbamiejsc/$liczba_rzedow;
		if (isset($_GET['IDevent']))
		{
			$zapytanie = mysql_query("SELECT * FROM sala WHERE IDevent = '$IDevent';");
			$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
			$i=1;
			while ($i < ($liczbamiejsc+1)) 
			{
				$miejsce[$i]=$wynikzapytania['miejsce'.$i];
				$i++;
			}
			//obsluga forumalrza
			if (isset($_POST['zarezerwuj']))
			{
				$query = "UPDATE sala SET ";
				$i=1;
				$licznik=0;
				$awaria=0;
				while ($i < ($liczbamiejsc+1)) 
				{
					if (isset($_POST['rezmiejsce'.$i]))
					{
						if ($miejsce[$i]==0)
						{
							if ($licznik==0)
							{
								$query=$query." miejsce".$i."='".$_POST['rezmiejsce'.$i]."'";
							}
							else
							{
								$query=$query.", miejsce".$i."='".$_POST['rezmiejsce'.$i]."'";
							}
						}
						else
						{
							$awaria=1;
						}
						$licznik++;
					}
					$i++;
				}
				$query = $query." WHERE IDevent = '".$IDevent."';";
				if ($licznik>0)
				{
					if ($awaria==0)
					{
						mysql_query($query);
						echo  '<p class="txt_niebieski_tabela">Dokonano rezerwacji na użytkownika <b>'.$login.'</b>.</p>';
						echo  '<p class="txt_niebieski_tabela">W kinie przy zakupie biletu podaj nazwę użytkownika.</p>';
					}
					else
					{
						echo  '<p class="txt_niebieski_tabela">Niestety ktoś zarezerwował w międzyczasie jedno z wybranych miejsc.</p>';
						echo  '<p class="txt_niebieski_tabela">Spróbuj ponownie.</p>';
					}
				}
				else echo  '<p class="txt_niebieski_tabela">Nie wybrano żadnych miejsc!</p>';
			}
			else
			{
				//wyswietlanie stanu sali+formularz
				echo '<form method="POST" action="index.php?id=21&IDevent='.$IDevent.'">';
				$zapytanie = mysql_query("SELECT * FROM repertuar WHERE IDevent = '".$IDevent."';");
				$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
				$IDfilm=$wynikzapytania['IDfilm'];
				$datarozpoczecia=$wynikzapytania['datarozpoczecia'];
				$datarozpoczecia=strtotime($datarozpoczecia);
				$godzina=date("G:i",$datarozpoczecia);
				$dzien=date("d.m.Y",$datarozpoczecia);
				$query="SELECT tytul FROM filmy WHERE IDfilm=".$IDfilm;
				$zapytanie = mysql_query($query);
				$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
				$tytul=$wynikzapytania['tytul'];
							
				echo '<div class="rez1"><h1 class="naglowek_czerwony">Rezerwacja miejsc ('.$tytul.', '.$dzien.', '.$godzina.')</h1></div>';
				echo '<br>';
				echo '<div class="rez_table"><table id="rezerwacja">';
				echo '<tr class="rez">';
				echo '<td><p class="txt_czerwony_g"></p></td>';
				$i=1;
				while ($i < ($liczba_miejsc_rzad+1)) 
				{
					echo '<td><center><p class="txt_zolty_g"> '.$i.'</p><center></td>';
					$i++;
				}
				echo '</tr>';	
				$licznikmiejsca=1;
				for ($i = 1; $i < ($liczba_rzedow+1); $i++) 
				{
					echo '<tr class="rez">';
					echo '<td class="rzad"><p class="txt_zolty_g">Rząd '.$i.'</p></td>';
					for ($j = 1; $j < ($liczba_miejsc_rzad+1); $j++) 
					{
						if ($miejsce[$licznikmiejsca]==0) 
						{
							echo '<td class="miejsca"><p class="txt_niebieski_tabela">Rezerwuj<input type="checkbox" name="rezmiejsce'.$licznikmiejsca.'" value="'.$IDuser.'" /></p></td>';
						}
						else
						{
							if ($ranga=='moderator' || $ranga=='admin' || $miejsce[$licznikmiejsca]==$IDuser) 
							{
								$zapytanie = mysql_query("SELECT login FROM uzytkownicy WHERE IDuser = '".$miejsce[$licznikmiejsca]."';");
								if (mysql_num_rows($zapytanie)>0)
								{
									$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
									
									$nazwa_usera=$wynikzapytania['login'];
								}
								else $nazwa_usera='Błąd!!!';
								echo '<td class="miejsca"><p class="txt_czerwony_g">'.$nazwa_usera.'</p></td>';
							}
							else
							{
								echo '<td class="miejsca"><p class="txt_czerwony_g"><div class="zaj"></div></p></td>';
							}
						}
						$licznikmiejsca++;
					}
					echo '</tr>';
				}
				echo '</table></div>';
				echo '<br><br><br><br><center><input id="input" type="submit" value="Zarezerwuj" name="zarezerwuj"></center>';
				echo '</form>';
			}
		}
	}
	else 
	{
		echo  '<br><br><br><p class="txt_niebieski_tabela">Aby zarezerwować miejsce musisz być zalogowany. </p>';
		echo "<script type=\"text/javascript\">
				window.setTimeout(\"window.location.replace('index.php?id=5');\",2000);
				</script>";
	}
?>
