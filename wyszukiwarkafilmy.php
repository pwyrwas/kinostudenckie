<div id="panel">
	<form action="index.php?id=3" method="post">
	<p class="wpisz_dane">Wpisz tytuł filmu</p><input type="text" name="tytul" class="pole1">
	<center><p><input id="input" type="submit" value="Wyszukaj" name="wyszukaj"></p><center>
	</form>
</div>
<?php
	/*obsluga wyszukiwarki*/
	if(isset($_POST['wyszukaj'])) 
	{
		$szukanytytul=($_POST['tytul']);
		echo '<div id="tabela_filmow">';
		if (strlen($szukanytytul)>0)
		{
			$query="Select IDfilm,tytul From filmy Where tytul Like '%{$szukanytytul}%' ORDER BY tytul";
			$result=mysql_query($query);
			$num=mysql_numrows($result);
			$i=0;
			if ($num>0)
			{
				echo '<p class="txt_niebieski_m">Wyniki wyszukiwania dla "'.$szukanytytul.'":</p>';
				echo '<ul>';
				while ($i < $num) 
				{
					$tytul=mysql_result($result,$i,"tytul");
					$IDfilm=mysql_result($result,$i,"IDfilm");
					echo '<li><a href="index.php?id=31&IDfilm='.$IDfilm.'"><p class="txt_niebieski_m">'.$tytul.'</p></a></li>';
					$i++;
				}
				echo '</ul>';
			}
			else
				echo '<p class="txt_niebieski_tabela">Brak wyników.</p>';
			
		}
		else
			echo '<p class="txt_niebieski_tabela">Nie wpisano tytułu.</p>';
		echo '</div>';
	}
	
?>
