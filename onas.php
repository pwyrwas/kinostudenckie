<?php
	$query="SELECT onas_kontakt,onas_cennik FROM trescstrony ";
	$result=mysql_query($query);
	$cennik=mysql_result($result,0,"onas_cennik");
	$kontakt=mysql_result($result,0,"onas_kontakt");
?>


<div class="zbiorczy">
	<div class="mapa">
		<p class="txt_zolty_g">Mapa dojazdu</p>
		<iframe  width="380" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.pl/maps?f=q&amp;source=s_q&amp;hl=pl&amp;geocode=&amp;q=gliwice+marii+sk%C5%82odowskiej+7&amp;aq=&amp;sll=50.301784,18.722565&amp;sspn=0.09945,0.264187&amp;ie=UTF8&amp;hq=&amp;hnear=Marii+Sk%C5%82odowskiej-Curie+7,+Gliwice,+%C5%9Bl%C4%85skie&amp;ll=50.287183,18.676255&amp;spn=0.012435,0.033023&amp;t=m&amp;z=14&amp;iwloc=r0&amp;output=embed"></iframe><br /><small><a href="https://maps.google.pl/maps?f=q&amp;source=embed&amp;hl=pl&amp;geocode=&amp;q=gliwice+marii+sk%C5%82odowskiej+7&amp;aq=&amp;sll=50.301784,18.722565&amp;sspn=0.09945,0.264187&amp;ie=UTF8&amp;hq=&amp;hnear=Marii+Sk%C5%82odowskiej-Curie+7,+Gliwice,+%C5%9Bl%C4%85skie&amp;ll=50.287183,18.676255&amp;spn=0.012435,0.033023&amp;t=m&amp;z=14&amp;iwloc=r0" style="color:#196581;text-align:left;text-decoration:none;">Wyświetl większą mapę</a></small>
	</div>
	<div class="kontakt">
		<p class="txt_zolty_g">Kontakt</p>
		<?php
			echo $kontakt;
			/*
			<p class="txt_czerwony_m">Adres:</p>
			<p class="txt_czerwony_m">ul. Niewiadoma 7</p>
			<p class="txt_czerwony_m">77-777 Nibylandia</p><br>
			<p class="txt_czerwony_m">Kontakt mailowy:</p>
			<p class="txt_czerwony_m">studenckiekino@gmail.com</p>
			*/
		?>
	</div>
	<div class="cennik">
		<p class="txt_zolty_g">Cennik</p>
		<?php
			echo $cennik;
			/*
			<ul>
			<li class="lista_czerwona">Bilet Normlany: 30zl</li>
			<li class="lista_czerwona">Bilet Ulgowy:   15zl</li>
			<li class="lista_czerwona">Bilet Rodzinny: 20zl</li>
			</ul>
			*/
		?>
	</div>
	<div class="galeria">
		<div id="galeria">
<ul>
<?php
$katalog = "obrazki";
$katalogminiaturki = "miniaturki";
$galeria = opendir( $katalog );
while ( $zdjecie = readdir( $galeria ) ){
   
$odczyt = pathinfo( $katalog.'/'.$zdjecie );
  if ( $odczyt['extension']  == 'jpg' ){

    echo '<li><a href="'.$katalog.'/'.$zdjecie.'" class="highslide" onclick="return hs.expand(this)" title="Zdjęcie: '.$zdjecie.'"><img width="200" height="133" src="'.$katalogminiaturki.'/'.$zdjecie.'" alt="Zdjęcie: '.$zdjecie.'" /></a></li>';
  }

}
closedir($galeria);
?>
</ul>
</div>
	</div>
</div>