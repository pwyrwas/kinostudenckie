<div id="panelzmianarangi">
	<form method="POST" action="index.php?id=69">
		<p class="wpisz_dane">ID wydarzenia<input name="identyfikator" class="pole1"></p><br><br>
		<center><input id="input" type="submit" value="Usuń wydarzenie" name="usunwydarzenie"></center>
	</form>	
</div>	
<?php
	//usuwanie wydarzen
	if (isset($_POST['usunwydarzenie'])) 
	{
		$identyfikator=$_POST['identyfikator'];
		if (mysql_num_rows(mysql_query("SELECT IDevent FROM repertuar WHERE IDevent = '$identyfikator';")) == 0)
		{
			echo '<p class="txt_niebieski_tabela">Nie ma w bazie takiego wydarzenia</p>';
		}
		else
		{
			mysql_query("DELETE FROM `repertuar` WHERE IDevent = '$identyfikator';");
			echo '<p class="txt_niebieski_tabela">Usunięto wydarzenie i rezerwacje z nim zwiazane.</p>';
		}
	}	
?>
