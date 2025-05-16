<?php

/*
	 * LISTING DES DERNIERS INSCRITS ECHANGE MAISON
	 * 
	*/
	 echo '<table style="width:100%;">' .
	 		'<tr>';
		$tab_inscrits = $metier->afficherDerniersInscrits("echange", 4);
		//BOUCLE AFFICHAGE
		foreach($tab_inscrits as $cle){
			echo $cle;
		}
		echo '</tr>' .
			 	'</table>';
?>
