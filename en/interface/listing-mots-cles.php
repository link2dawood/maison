<?php

	$nombreAnnoncesParPage = 100;
				
	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
	$total = $maison->compterTotalMotsCles();					
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierAnnoncesAafficher = ($page - 1) * $nombreAnnoncesParPage;
	
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo '<ul id="mot_cle"><li>';
		echo $maison->getListingParMotsCles($premierAnnoncesAafficher, $nombreAnnoncesParPage);
		echo '</li></ul>';
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
	}
				
?>