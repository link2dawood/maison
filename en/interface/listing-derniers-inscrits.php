<?php
	//derniers inscrits
					
	$tab_inscrits = $membre->afficherDerniersInscritsEspaceMembre($_SESSION['equivalence'], 8);
	//BOUCLE AFFICHAGE
	foreach($tab_inscrits as $cle){
		echo $cle;
	}
?>
