<?php
	//ustalenie daty
	$datapoczatek=date("Y-m-d G:i:s");
	$datakoniec=strtotime($datapoczatek)+60*60*24*7+$poprawkaserwera;
	$datapoczatek=strtotime($datapoczatek)+$poprawkaserwera;
	$datapoczatek=date("Y-m-d G:i:s",$datapoczatek);
	$datakoniec=date("Y-m-d G:i:s",$datakoniec);
	
	$query="SELECT * FROM repertuar WHERE (datarozpoczecia>='$datapoczatek' AND datarozpoczecia<='$datakoniec') ORDER BY datarozpoczecia";
	$result=mysql_query($query);
	$num=mysql_num_rows($result);
	$i=0;
	if ($num>0)
	{
		echo '<h1 class="naglowek_czerwony">Nadchodzące wydarzenia</h1><br><br>';
		echo '<table id="rep">';
		echo '<tr>';
		if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true) 
		{
			if ($ranga=='moderator' || $ranga=='admin') echo '<td><p class="txt_czerwony_g">IDevent</p></td>';
		}
		echo '<td><p class="txt_czerwony_g">Tytul</p></td>';
		echo '<td><p class="txt_czerwony_g">Informacje</p></td>';
		echo '<td><p class="txt_czerwony_g">Dzień</p></td>';
		echo '<td><p class="txt_czerwony_g">Godzina</p></td>';
		echo '<td><p class="txt_czerwony_g">Rezerwacja</p></td>';
		echo '</tr>';
		while ($i < $num) 
		{
			//uzyskanie danych +obrobka formatu daty
			$IDfilm=mysql_result($result,$i,"IDfilm");
				$query2="SELECT tytul FROM filmy WHERE IDfilm = $IDfilm "; //uzyskanie tytulu
				$result2=mysql_query($query2);
			$tytul=mysql_result($result2,0,"tytul");
			$IDevent=mysql_result($result,$i,"IDevent");
			$datarozpoczecia=mysql_result($result,$i,"datarozpoczecia");
			$datarozpoczecia=strtotime($datarozpoczecia);
			$godzina=date("G:i",$datarozpoczecia);
			$dzien=date("d.m",$datarozpoczecia);
			//uzupelnianie tabeli
			echo '<tr>';
			if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true) 
			{
				if ($ranga=='moderator' || $ranga=='admin') echo '<td><p class="txt_niebieski_tabela">'.$IDevent.'</p></td>';
			}
			echo '<td><p class="txt_niebieski_tabela">'.$tytul.'</p></td>';
			echo '<td><a href="index.php?id=31&IDfilm='.$IDfilm.'"><p class="txt_niebieski_tabela">Sprawdź</p></a></td>';
			echo '<td><p class="txt_niebieski_tabela">'.$dzien.'</p></td>';
			echo '<td><p class="txt_niebieski_tabela">'.$godzina.'</p></td>';
			echo '<td><a href="index.php?id=21&IDevent='.$IDevent.'"><p class="txt_niebieski_tabela">Zarezerwuj</p></a></td>';
			echo '</tr>';
			
			$i++;
		}
		echo '</table>';
	}
	else
		echo '<br><br><br><p class="txt_niebieski_tabela">Nie ma żadnych filmów.</p>';
?>