<?php
	//połączenie się z bazą danych
	mysql_connect("mysql.hostinger.pl","u792759648_pm","pawelmateusz");
	mysql_select_db("u792759648_kino");

	//poprawka czasu wzgledem serwera;
	$poprawkaserwera=6*60*60;
	//konfig sali kinowej
	$liczbamiejsc=20;
	$liczba_rzedow=5;

	//funkcja do filtrowania wprowadzanych danych
	function filtruj($zmienna) 
	{
		if(get_magic_quotes_gpc())
			$zmienna = stripslashes($zmienna); // usuwamy slashe
		// usuwamy spacje, tagi html oraz niebezpieczne znaki
		return mysql_real_escape_string(htmlspecialchars(trim($zmienna))); 
	}
?>