<div id="panelwydarzenie">
<?php
	function wyslij () 
	{
		//tablica z filmammi na ten tydzien
		$datapoczatek=date("Y-m-d G:i:s");
		$datakoniec=strtotime($datapoczatek)+60*60*24*7;
		$datakoniec=date("Y-m-d G:i:s",$datakoniec);
		$query="SELECT * FROM repertuar WHERE (datarozpoczecia>='$datapoczatek' AND datarozpoczecia<='$datakoniec') ORDER BY datarozpoczecia";
		$result=mysql_query($query);
		$liczbaprojekcji=mysql_num_rows($result);
		for ($i=0 ; $i<$liczbaprojekcji; $i++) 
		{
			$tabfilmy[$i][0]=mysql_result($result,$i,"IDevent");
			$tabfilmy[$i][1]=mysql_result($result,$i,"datarozpoczecia");
				$IDfilm=mysql_result($result,$i,"IDfilm");
				$zapytanie = mysql_query("SELECT tytul,gatunek FROM filmy WHERE IDfilm = '$IDfilm';");
				$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
			$tabfilmy[$i][2]=$wynikzapytania['tytul'];
			$tabfilmy[$i][3]=$wynikzapytania['gatunek'];
		}
		
		// lista aktywnych userow
		$query="SELECT IDuser,login,email FROM uzytkownicy WHERE aktywacjanewsletter=1 ORDER BY login";
		$result=mysql_query($query);
		$num=mysql_num_rows($result);
		$licznikuserow=0;
		if ($num>0)
		{
			echo "<p class='txt_niebieski_m'>Wysłano wiadomość do następujących użytkowników:</p><ul>";
			while ($licznikuserow<$num)
			{
				//zdobycie info o uzytkowniku aktywowanym
				$IDuser=mysql_result($result,$licznikuserow,"IDuser");
				$loginusera=mysql_result($result,$licznikuserow,"login");
				$mailusera=mysql_result($result,$licznikuserow,"email");
				
				//zdobycie info o preferencjach
				$zapytanie = mysql_query("SELECT * FROM preferencjenewsletter WHERE IDuser=".$IDuser);
				$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
				$akcji=$wynikzapytania['akcji'];
				$animowany=$wynikzapytania['animowany'];
				$biograficzny=$wynikzapytania['biograficzny'];
				$dramatyczny=$wynikzapytania['dramatyczny'];
				$scifi=$wynikzapytania['scifi'];
				$dokumentalny=$wynikzapytania['dokumentalny'];
				$komediowy=$wynikzapytania['komediowy'];
				$horror=$wynikzapytania['horror'];
				$thriller=$wynikzapytania['thriller'];
				$przygodowy=$wynikzapytania['przygodowy'];
				
				$wiadomosc = '<html>
							<head>
								<title>Wiadomość e-mail</title> 
							</head>
							<body>
								<p>Witaj '.$loginusera.'</p>
								<p>Filmy mogące Cię zainteresować w tym tygodniu:</p><table>';
				
				$licznikpropozycji=0;
				$wiadomosc=$wiadomosc."<tr><td>Tytuł</td><td>Gatunek</td><td>Data projekcji</td></tr>";
				if ($akcji>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='akcji') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
					}
				}
				if ($animowany>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='animowany') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
					}
				}
				if ($biograficzny>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='biograficzny') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($dramatyczny>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='dramatyczny') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($scifi>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='scifi') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($dokumentalny>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='dokumentalny') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($komediowy>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='komediowy') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($horror>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='horror') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($thriller>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='thriller') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}
				if ($przygodowy>0)
				{
					for ($i=0 ; $i<$liczbaprojekcji; $i++) 
					{
						if ($tabfilmy[$i][3]=='przygodowy') 
						{
							$wiadomosc=$wiadomosc."<tr><td><b>".$tabfilmy[$i][2]."<b></td><td>".$tabfilmy[$i][3]."</td><td>".$tabfilmy[$i][1]."</td></tr>";
							$licznikpropozycji++;
						}
						
					}
				}

				
				$wiadomosc=$wiadomosc.'</table></body></html>';
				if ($licznikpropozycji>0)
				{
					$naglowki = "Reply-to: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
					$naglowki .= "From: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
					$naglowki .= "MIME-Version: 1.0".PHP_EOL;
					$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 
					if(mail($mailusera, 'Newsletter', $wiadomosc, $naglowki))
						{
							echo '<li><p class="txt_niebieski_m"><b>'.$loginusera.'</b> ('.$mailusera.')</p></li>';
						}
				}
				$licznikuserow++;
			}
			echo "</ul";
		}
		else
		{
			echo "<center><p class='txt_niebieski_m'>Nie wysłano żadnych maili - brak użytkowników</p></center>";
		}
	}
	
	//potwierdzenie wysylania
	if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true)
	{
		if ($ranga=='moderator' || $ranga=='admin')
		{
			if (isset($_GET['potwierdzenie'])&&$_GET['potwierdzenie']==1)
			{
				wyslij();
			}			
			else
			{
				echo "<center><p class='txt_niebieski_g'>Czy na pewno chcesz wysłać newslettery (może to chwilę potrwać)?</p></center>";
				echo '<center><a href="index.php?id=66&potwierdzenie=1"><p class="txt_niebieski_g">Potwierdź</p></a></center>';
			}
		}
		else
		{
			echo '<center><p class="txt_niebieski_m">Błąd! Nie możesz tu przebywać</p></center>';
			echo "<script type=\"text/javascript\">
					window.setTimeout(\"window.location.replace('index.php?id=1');\",2000);
					</script>";
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