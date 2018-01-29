<?php
	/*pobieranie danych dla filmu*/
	$IDfilm=$_GET['IDfilm'];  
	$query="SELECT * FROM filmy WHERE IDfilm = $IDfilm";
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
	
	if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true) 
	{
		/*obsługa systemu głosowania*/
		if(mysql_num_rows(mysql_query("SELECT ocena FROM ocenyfilmy WHERE IDfilm = '$IDfilm' AND IDuser = '$IDuser';")))
		{
			$zapytanie = mysql_query("SELECT ocena FROM ocenyfilmy WHERE IDfilm = '$IDfilm' AND IDuser = '$IDuser';");
			$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
			$twojaocena=$wynikzapytania['ocena'];
		}
		else 
		{
			$twojaocena=0;
		}
		if (isset($_POST['glosuj']))
		{
			$nowaocena=$_POST['nowaocena'];
			if ($twojaocena==0)
			{
				$liczbaglosow=$liczbaglosow+1;
				$sumaocen=$sumaocen+$nowaocena;
				mysql_query("UPDATE `filmy` SET `liczbaglosow` = '$liczbaglosow' WHERE IDfilm = '$IDfilm';");
				mysql_query("INSERT INTO ocenyfilmy VALUES ('$IDuser','$IDfilm','$nowaocena')");
			}
			else
			{
				$sumaocen=$sumaocen+$nowaocena-$twojaocena;
				mysql_query("UPDATE ocenyfilmy SET ocena=$nowaocena WHERE IDfilm=$IDfilm AND IDuser=$IDuser;");
			}
			mysql_query("UPDATE `filmy` SET `sumaocen` = '$sumaocen' WHERE IDfilm = '$IDfilm';");
		}
		/*obsługa systemu komentarzy*/
		if (isset($_POST['skomentuj']))
		{
			$tresckomentarza=$_POST['tresckomentarza'];
			if (strlen($tresckomentarza)>0)
			{
				$czas=date("Y-m-d G:i:s");
				$czas1=strtotime($czas)+$poprawkaserwera;
				$czas=date("Y-m-d G:i:s",$czas1);
				mysql_query("INSERT INTO komentarze VALUES ('','$IDuser','$IDfilm','$czas','$tresckomentarza')");
			}
		}
		/*usuwanie komentarzy*/
		if (isset($_POST['usunkomentarz']))
		{
			$IDkomentarza=$_GET['komentarz'];
			mysql_query("DELETE FROM `komentarze` WHERE `komentarze`.`IDkomentarz` = ".$IDkomentarza);
		}
	}
?>

<div class="poj_film_1">
	<div class="plakaty">
     	<?php echo '<img src="'.$linkplakat.'" width="150px" height="215px"></img>' ?>
    </div>
    <div class="opis">
       	<h1 class="naglowek_czerwony"><?php echo ($tytul);?></h1>
       	<p class="txt_czerwony_m"><?php echo ($opis);?></p>   
    </div>
</div>
		
<div class="poj_film_1">
	<div class="yt">
		<h1 class="naglowek_czerwony">
		<iframe width="480" height="270" src="<?php echo ($linkyt);?>" frameborder="0" allowfullscreen></iframe>
	   </h1>
	</div>
	<div class="dane_filmu">
			<h1 class="naglowek_czerwony">Informacje</h1>
			<ul>
					<li><p class="txt_czerwony_m"><b>Gatunek: </b><?php echo $gatunek?></p></li>
					<li><p class="txt_czerwony_m"><b>Czas trwania: </b><?php echo $czastrwania?> min</p></li>
					<li><p class="txt_czerwony_m"><b>Wersja jezykowa: </b><?php echo $jezyk?></p></li>
					<li><p class="txt_czerwony_m"><b>Rok premiery: </b><?php echo $rokpremiery?></p></li>
					<li><p class="txt_czerwony_m"><b>Reżyseria: </b><?php echo $rezyser?></p></li>
					<?php
						/*wyświetlenie sredniej oceny i oceny danego uzytkownika*/
						if ($liczbaglosow>0)
						{
							echo '<li><p class="txt_czerwony_m"><b>Średnia ocena: </b>'.round($sumaocen/$liczbaglosow,3).'</p></li>';
						}
						if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true) 
						{
							if(mysql_num_rows(mysql_query("SELECT ocena FROM ocenyfilmy WHERE IDfilm = '".$IDfilm."' AND IDuser = '".$IDuser."';")))
							{
								$zapytanie = mysql_query("SELECT ocena FROM ocenyfilmy WHERE IDfilm = '".$IDfilm."' AND IDuser = '".$IDuser."';");
								$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
								$twojaocena=$wynikzapytania['ocena'];
							}
							else $twojaocena=0;
							if ($twojaocena>0)
							{
								echo '<li><p class="txt_czerwony_m"><b>Twoja ocena: </b>'.$twojaocena.'</p></li>';
							}
						}
						if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true):	
					?>
					<form method="POST" <?php echo 'action="index.php?id=31&IDfilm='.$IDfilm.'">';?>
						<select name="nowaocena" class="pole1">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
						<input id="input" type="submit" value="Zagłosuj" name="glosuj">
					</form> 
					<?php endif; ?>
					
			</ul> 
	</div>
</div>  
<div class="komentarze">
	<center><br><br><br><h1 class="naglowek_niebieki">Komentarze</h1></center>
	<?php if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true):?>
		<form method="POST" <?php echo 'action="index.php?id=31&IDfilm='.$IDfilm.'">';?>
			<center><textarea name="tresckomentarza" rows="5" cols="50"></textarea></center><br>
			<center><input id="input" type="submit" value="Skomentuj" name="skomentuj"></center>
		</form> 
	<?php endif; ?>
	<div class="komentarze_tresc">
		<?php
			$query="SELECT * FROM komentarze WHERE IDfilm = '$IDfilm' ORDER BY data DESC;";
			$result=mysql_query($query);
			$num=mysql_num_rows($result);
			$i=0;
			if ($num>0)
			{
				while ($i < $num) 
				{
					$IDkomentarz=mysql_result($result,$i,"IDkomentarz");
					$IDuser=mysql_result($result,$i,"IDuser");
					$data=mysql_result($result,$i,"data");
					$data=$data;
					$tresc=mysql_result($result,$i,"tresc");
					$zapytanie = mysql_query("SELECT login FROM uzytkownicy WHERE IDuser = '$IDuser';");
					$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
					$nazwa_usera=$wynikzapytania['login'];
					echo '<p class="txt_niebieski_m">Napisał użytkownik <b>'.$nazwa_usera.'</b> dnia '.$data.'</p>';
					echo '<p class="txt_czerwony_m"><i>'.$tresc.'</i></p>';
					if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true)
					{ 
						if ($ranga=='moderator' || $ranga=='admin' || $login==$nazwa_usera)
						{
							echo '<p><form method="POST" action="index.php?id=31&IDfilm='.$IDfilm.'&komentarz='.$IDkomentarz.'">
								<input id="usun_komentarz" type="submit" value="[Usuń komentarz]" name="usunkomentarz"><a id="usun_komentarz" href="index.php?id=32&IDkomentarz='.$IDkomentarz.'&IDfilm='.$IDfilm.'">[Edytuj komentarz]</a>
								</form></p>';
						}
					}
					$i++;
				}
			}
			else
			{
				echo '<p class="txt_niebieski_m">Nie ma żadnych komentarzy do wyświetlenia.</p>';
			}
		
		?>
	</div>
</div>

