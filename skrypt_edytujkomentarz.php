<?php
	if (isset($_GET['IDkomentarz'])&&isset($_GET['IDfilm']))
	{
		$IDkomentarz=$_GET['IDkomentarz'];
		$IDfilm=$_GET['IDfilm'];
		$query="SELECT tresc FROM komentarze WHERE IDkomentarz = '$IDkomentarz';";
		$result=mysql_query($query);
		$tresc=mysql_result($result,0,"tresc");
		echo '<div class="komentarze">
		<form method="POST" action="index.php?id=32&IDfilm='.$IDfilm.'&IDkomentarz='.$IDkomentarz.'">
			<center><textarea name="tresckomentarza" rows="5" cols="50">'.$tresc.'</textarea></center><br>
			<center><input id="input" type="submit" value="Zaktualizuj treść komentarza" name="skomentuj"></center>
		</form> 
		</div>';
		if (isset($_POST['skomentuj']))
		{
			$tresckomentarza=$_POST['tresckomentarza'];
			if (strlen($tresckomentarza)>0)
			{
				mysql_query("UPDATE komentarze SET tresc='$tresckomentarza' WHERE IDkomentarz='$IDkomentarz'");
				echo '<p class="txt_niebieski_tabela">Komentarz został zaktualizowany</p>';
				echo "<script type=\"text/javascript\">
				window.setTimeout(\"window.location.replace('index.php?id=31&IDfilm=$IDfilm');\",2000);
				</script>";
			}
			else
			{
				echo '<p class="txt_niebieski_tabela">Komentarz nie może zostać pusty</p>';
			}
		}
	}
	else
	{
		echo '<p class="txt_niebieski_tabela">Błąd! Nie możesz tu przebywać</p>';
		echo "<script type=\"text/javascript\">
				window.setTimeout(\"window.location.replace('index.php?id=1');\",2000);
				</script>";
	}
?>


