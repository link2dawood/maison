<?php

	$nombreMembresParPage = NOMBRE_ANNONCE_PAR_PAGE;
	
	$total = $maison->compterNombreMotCle($element_mot);					
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $metier->afficherExtraitMoteurDeRecherche($premierMembresAafficher, $nombreMembresParPage, $element_mot);
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
	}
				
?>