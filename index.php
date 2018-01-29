<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Kino Studenckie</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" /> 
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="javascript/highslide-with-gallery.js"></script>
		<script type="text/javascript">
			hs.graphicsDir = 'javascript/images/';
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'rounded-white';
			hs.fadeInOut = true;
			//hs.dimmingOpacity = 0.75;
			// Add the controlbar
			if (hs.addSlideshow) hs.addSlideshow({
				//slideshowGroup: 'group1',
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .75,
					position: 'bottom center',
					hideOnMouseOut: true
				}
			});
		</script>
    </head>
    <body>
		<?php
			session_start();
			include 'config.php';
		?>
		<div id="container">
			<div id="menubar"><br>
				<div id="log"><a id="home" href="index.php?id=1" title"Strona główna"></a></div>
			</div>
		</div>
		<div id="bar">
			<ul>
				<li><a class="li" href="index.php?id=1">Aktualności</a></li>
				<li><a class="li" class="li" href="index.php?id=2">Repertuar</a></li>
				<li><a class="li" href="index.php?id=3">Filmy</a></li>
				<li><a class="li" href="index.php?id=4">O Nas</a></li>
				<?php
					if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true)
					{
						$login=$_SESSION['login'];
						$ranga=$_SESSION['ranga'];
						$IDuser=$_SESSION['IDuser'];
						echo '<li><a href="index.php?id=5&wyloguj=1">Wyloguj</a></li>';
						echo '<div id="opcje"><a href="index.php?id=6"><p class="naglowek_niebieki">Opcje['.$login.']</p></a></div>';
					}
					else
						echo '<li><a class="li_opcje" href="index.php?id=5">Zaloguj</a></li>';
					
				?>
				<?php
					if (isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==true&&(isset($_GET['wyloguj'])==0));
					else
						$_SESSION['zalogowany']=false;
				?>
			</ul>
		</div>
		<div id="forma">
			<?php
				$id=1;
				if (isset($_GET['id']))
					$id=$_GET['id'];
				switch($id)
				{
					case '2':
						include 'repertuar.php';
						break;
					case '21':
						include 'skrypt_rezerwacja.php';
						break;
					case '3':
						include 'wyszukiwarkafilmy.php';
						break;
					case '31':
						include 'film.php';
						break;
					case '32':
						include 'skrypt_edytujkomentarz.php';
						break;			
					case '4':
						include 'onas.php';
						break;
					case '5':
						include 'skrypt_logowanie.php';
						break;
					case '51':
						include 'skrypt_rejestracja.php';
						break;	
					case '6':
						include 'opcje.php';
						break;
					case '61':
						include 'skrypt_zmianahasla.php';
						break;
					case '62':
						include 'skrypt_dodajfilm.php';
						break;
					case '63':
						include 'skrypt_zmianarangi.php';
						break;							
					case '64':
						include 'skrypt_dodajwydarzenie.php';
						break;
					case '65':
						include 'skrypt_preferencjenewsletter.php';
						break;
					case '66':
						include 'skrypt_wyslijnewsletter.php';
						break;
					case '67':
						include 'skrypt_usunusera.php';
						break;
					case '68':
						include 'skrypt_usunfilm.php';
						break;
					case '69':
						include 'skrypt_usunevent.php';
						break;
					case '610':
						include 'skrypt_zarzadzanie.php';
						break;
					case '611':
						include 'skrypt_edytujfilm.php';
						break;
					default:
						include 'aktualnosci.php';
				}
				mysql_close();
			?>
		</div>
	</body>
</html>