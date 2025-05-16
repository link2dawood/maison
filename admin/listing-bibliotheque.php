<?php
//RECHERCHE DU LISTING
	$nombreAnnoncesParPage = 5;
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierAnnoncesAafficher = ($page - 1) * $nombreAnnoncesParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $membre->getListingBibliotheque($premierAnnoncesAafficher, $nombreAnnoncesParPage);
	}
	else{
		echo '<p id="pas_de_message">Pas de résultat disponible !</p>';
	}
				
?>