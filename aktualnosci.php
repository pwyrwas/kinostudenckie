<?php
	/*pobranie danych dla filmow na stronie głownej*/
	$query="SELECT aktualnosci_idfilm1,aktualnosci_idfilm2 FROM trescstrony ";
	$result=mysql_query($query);
	$idfilmu1=mysql_result($result,0,"aktualnosci_idfilm1");
	$idfilmu2=mysql_result($result,0,"aktualnosci_idfilm2");
	
	$query="SELECT * FROM filmy WHERE IDfilm = $idfilmu1";
	$result=mysql_query($query);
	$tytul1=mysql_result($result,0,"tytul");
	$opis1=mysql_result($result,0,"opis");
	$linkplakat1=mysql_result($result,0,"linkplakat");
	
	$query="SELECT * FROM filmy WHERE IDfilm = $idfilmu2";
	$result=mysql_query($query);
	$tytul2=mysql_result($result,0,"tytul");
	$opis2=mysql_result($result,0,"opis");
	$linkplakat2=mysql_result($result,0,"linkplakat");
?>

<div class="lewa">  
	<div class="col_1"> 
		<?php
			echo '<a href="index.php?id=31&IDfilm='.$idfilmu1.'"><h1 class="naglowek_czerwony">'.$tytul1.'</h1></a>';
		?>
		<div class="plakat1"> 
			<?php
			echo '<a href="index.php?id=31&IDfilm='.$idfilmu1.'"><img src="'.$linkplakat1.'" width="150px" height="215px"></img></a>';
			?>
		</div>
        <div class="opis1">
			<?php
				echo '<p class="txt_czerwony_m">'.$opis1.'</p>';
			?>
        </div> 	       
    </div>
	<div class="col_2"> 
		<?php
			echo '<a href="index.php?id=31&IDfilm='.$idfilmu2.'"><h1 class="naglowek_czerwony">'.$tytul2.'</h1></a>';
		?>
		<div class="plakat2"> 
			<?php
			echo '<a href="index.php?id=31&IDfilm='.$idfilmu2.'"><img src="'.$linkplakat2.'" width="150px" height="215px"></img></a>';
			?>
		</div>
        <div class="opis2">
			<?php
				echo '<p class="txt_czerwony_m">'.$opis2.'</p>';
			?>
        </div> 	       
    </div>
</div>
<div class="prawa">
    <h1 class="naglowek_zolty">Nadchodzące</h1>
    <div class="prostokat"></div>
    <div class="repertuar_na_dzis">
		<p class="txt_zolty_m">
		<?php
			//pobranie czasu
			$datapoczatek=date("Y-m-d G:i:s");
			$datakoniec=strtotime($datapoczatek)+60*60*24+$poprawkaserwera;
			$datapoczatek=strtotime($datapoczatek)+$poprawkaserwera;
			$datapoczatek=date("Y-m-d G:i:s",$datapoczatek);
			$datakoniec=date("Y-m-d G:i:s",$datakoniec);
			//pobranie filmu w podanym przedziale czasowym
			$query="SELECT * FROM repertuar WHERE (datarozpoczecia>='$datapoczatek' AND datarozpoczecia<='$datakoniec') ORDER BY datarozpoczecia";
			$result=mysql_query($query);
			$num=mysql_num_rows($result);
			$i=0;
			if ($num>0)
			{
				echo '<Table id="nadchodzace">';
				while ($i < $num) 
				{	
					$IDfilm=mysql_result($result,$i,"IDfilm");
					//uzyskanie tytulu
						$query2="SELECT tytul FROM filmy WHERE IDfilm = $IDfilm ";
						$result2=mysql_query($query2);
						$num2=mysql_num_rows($result2);
						$j=0;
					
							echo '<tr>';
							while ($j < $num2) 
							{
								$tytul=mysql_result($result2,$j,"tytul");
								$j++;
							}
					//uzyskanie daty projekcji + edycja formatu czasu
					$datarozpoczecia=mysql_result($result,$i,"datarozpoczecia");
					$datarozpoczecia=strtotime($datarozpoczecia);
					$godzina=date("G:i",$datarozpoczecia);
					$dzien=date("d.m",$datarozpoczecia);
					echo '<td><p class="txt_zolty_m">'.$tytul.'</p></td>';
					echo '<td><p class="txt_zolty_m">'.$dzien.'</p></td>';
					echo '<td><p class="txt_zolty_m">'.$godzina.'</p></td>';
									
					$i++;
					echo '</tr>';
				}
				echo '</Table>';
			}
			else
				echo '<center>Nie ma żadnych filmów.</center>';
		?>
		</p>
	</div>
 </div>