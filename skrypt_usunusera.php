<div id="panelzmianarangi">
	<form method="POST" action="index.php?id=67">
		<p class="wpisz_dane">Login użytkownika<input name="loginusera" class="pole1"></p>
		<p class="wpisz_dane">Powód </p>
		<textarea name="powod" rows="5" cols="46"></textarea><br><br>
		<center><input id="input" type="submit" value="Usuń użytkownika" name="usunusera"></center>
	</form>	
</div>	
<?php
	//skrypt usuwajacy uzytkownika
	if (isset($_POST['usunusera'])) 
	{
		$loginusera=$_POST['loginusera'];
		$powod=$_POST['powod'];
		if ($loginusera!=$login)
		{
			if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '$loginusera';")) == 0)
			{
				echo '<p class="txt_niebieski_tabela">Nie ma w bazie użytkownika o podanym loginie.</p>';
			}
			else
			{
				$query="SELECT IDuser,email FROM uzytkownicy WHERE login='$loginusera'";
				$result=mysql_query($query);
				$mailusera=mysql_result($result,0,"email");
				$identyfikatorusera=mysql_result($result,0,"IDuser");
				
				//usuniecieusera
				mysql_query("DELETE FROM `uzytkownicy` WHERE login = '$loginusera';");
				
				//usuniecie rezerwacji
				$query="SELECT * FROM sala WHERE miejsce1='$identyfikatorusera'";
				for ($i=2; $i<($liczbamiejsc+1); $i++)
				{
					$query=$query." OR miejsce$i='$identyfikatorusera'";
				}
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				$licznikseansow=0;
				if ($num>0)
				{
					while ($licznikseansow<$num)
					{
						$IDevent=mysql_result($result,$licznikseansow,'IDevent');
						for ($i=1; $i<($liczbamiejsc+1); $i++)
						{
							$miejsce[$i]=mysql_result($result,$licznikseansow,'miejsce'.$i);
						}
						for ($i=1; $i<($liczbamiejsc+1); $i++)
						{
							if ($miejsce[$i]==$identyfikatorusera)
							{
								$miejsce[$i]=0;
							}
						}
						$query2 = "UPDATE sala SET ";
						for ($i=1; $i<($liczbamiejsc+1); $i++)
						{
							if ($i==1)
							{
								$query2=$query2." miejsce".$i."='".$miejsce[$i]."'";
							}
							else
							{
								$query2=$query2.", miejsce".$i."='".$miejsce[$i]."'";
							}
						}
						$query2 = $query2." WHERE IDevent = '".$IDevent."';";
						mysql_query($query2);
						$licznikseansow++;
					}
				}
				
				
				echo '<p class="txt_niebieski_tabela">Usunięto użytkownika <b>'.$loginusera.'</b> i wszystkie jego komentarze i rezerwacje </p>';
				
				
				//mail
				$naglowki = "Reply-to: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
				$naglowki .= "From: 'KINO STUDENCKIE' <studenckiekino@gmail.com>".PHP_EOL;
				$naglowki .= "MIME-Version: 1.0".PHP_EOL;
				$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 
				$wiadomosc = '<html>
									<head>
										<title>Usuniecie</title> 
									</head>
									<body>
									  <p>Witaj '.$loginusera.'</p>
									  <p>Twoje konto zostało usunięte.</p>
									  <p>Powód:</p>
									  <p>'.$powod.'</p>
									</body>
							</html>';
				if(mail($mailusera, 'Usuniecie', $wiadomosc, $naglowki))
				{
					echo '<p class="txt_niebieski_tabela">Wysłano wiadomość na email użytkownika.</p>';
				}
			}
		}
		else
			echo '<p class="txt_niebieski_tabela">Nie możesz usunąć swojego konta</p>'; 
	}	
?>
