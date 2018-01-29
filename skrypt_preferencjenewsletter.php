<div id="panelfilm">
	<?php
		$zapytanie = mysql_query("SELECT aktywacjanewsletter FROM uzytkownicy WHERE IDuser = '$IDuser';");
		$wynikzapytania = mysql_fetch_array($zapytanie) or die(mysql_error());
		$aktywacjanewsletter=$wynikzapytania['aktywacjanewsletter'];

			
	?>
	
	<?php
		$akcji= '0';
		$animowany= '0';
		$biograficzny= '0';
		$dramatyczny= '0';
		$scifi= '0';
		$dokumentalny= '0';
		$komediowy= '0';
		$horror= '0';
		$thriller= '0';
		$przygodowy= '0';
		
		if(isset($_POST['aktywuj'])) 
		{
			$query1 = "UPDATE uzytkownicy SET aktywacjanewsletter = 1  WHERE IDuser = $IDuser;";
			mysql_query($query1);
			echo "<script type=\"text/javascript\">
				window.setTimeout(\"window.location.replace('index.php?id=65');\",1);
				</script>";
		}
		
		if(isset($_POST['dezaktywuj'])) 
		{
			$query1 = "UPDATE uzytkownicy SET aktywacjanewsletter = 0  WHERE IDuser = $IDuser;";
			mysql_query($query1);
			echo "<script type=\"text/javascript\">
				window.setTimeout(\"window.location.replace('index.php?id=65');\",1);
				</script>";
		}

		
		if(isset($_POST['dodaj'])) 
		{		
			if(isset($_POST['wlacz'])) $wlacz=$_POST['wlacz'];
			if(isset($_POST['akcji'])) $akcji=$_POST['akcji'];
			if(isset($_POST['animowany'])) $animowany=$_POST['animowany'];
			if(isset($_POST['biograficzny'])) $biograficzny=$_POST['biograficzny'];
			if(isset($_POST['dramatyczny'])) $dramatyczny=$_POST['dramatyczny'];
			if(isset($_POST['scifi'])) $scifi=$_POST['scifi'];
			if(isset($_POST['dokumentalny'])) $dokumentalny=$_POST['dokumentalny'];
			if(isset($_POST['komediowy'])) $komediowy=$_POST['komediowy'];
			if(isset($_POST['horror'])) $horror=$_POST['horror'];
			if(isset($_POST['thriller'])) $thriller=$_POST['thriller'];
			if(isset($_POST['przygodowy'])) $przygodowy=$_POST['przygodowy'];
			
			$query = "UPDATE preferencjenewsletter SET akcji = $akcji, animowany = $animowany, biograficzny = $biograficzny, dramatyczny = $dramatyczny, komediowy = $komediowy, scifi = $scifi, dokumentalny = $dokumentalny, horror = $horror, thriller = $thriller, przygodowy = $przygodowy  WHERE IDuser = $IDuser ;";
			mysql_query($query);
						
		}
	?>
	<?php 
		if(isset($_POST['dodaj'])) 
		{
			echo '<center><p class="txt_niebieski_m">Dodano preferencje do bazy danych</p></center>';
			echo "<script type=\"text/javascript\">
					window.setTimeout(\"window.location.replace('index.php?id=65');\",2000);
					</script>";
		}
		else
		{
		if ($aktywacjanewsletter)
		{
			echo '<p class="txt_czerwony_m">Status systemu powiadomień: <b>AKTYWNY</b></p>';
			echo '<form action="index.php?id=65" method="post">
					<p><center><input id="input" type="submit" value="Dezaktywuj" name="dezaktywuj"></center></p>
				</form>';
		}
		else
		{
			echo '<p class="txt_czerwony_m">Status systemu powiadomień: <b>NIEAKTYWNY</b></p>';
			echo '<form action="index.php?id=65" method="post">
					<p><center><input id="input" type="submit" value="Aktywuj" name="aktywuj"></center></p>
				</form>';
		}
		if ($aktywacjanewsletter):?>
		<form action="index.php?id=65" method="post">
			<p class="txt_czerwony_m">Czy chcesz dodać nowe preferencje newslettera?<input type="checkbox" name="wlacz" value="1" onclick="document.getElementById('identyfikator').style.display = this.checked ? 'block' : 'none'; this.form.elements['akcji'].disabled = this.form.elements['animowany'].disabled = !this.checked"></input></p>
			<div id="identyfikator" style="display: none">
					<p class="wpisz_dane">Akcji:<input type="checkbox" name="akcji" class="pole1" value="1" size="30"></p>
					<p class="wpisz_dane">Animowany:<input type="checkbox" name="animowany" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Biograficzny:<input type="checkbox" name="biograficzny" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Dramatyczny:<input type="checkbox" name="dramatyczny" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Science-Fiction:<input type="checkbox" name="scifi" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Dokumentalny:<input type="checkbox" name="dokumentalny" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Komediowy:<input type="checkbox" name="komediowy" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Horror:<input type="checkbox" name="horror" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Thriller:<input type="checkbox" name="thriller" value="1" class="pole1" size="30"></p>
					<p class="wpisz_dane">Przygodowy:<input type="checkbox" name="przygodowy" value="1" class="pole1" size="30"></p>
					<p><center><input id="input" type="submit" value="Dodaj" name="dodaj"></center></p>
			</div>
		</form>
	<?php endif; }?>
</div>

	

