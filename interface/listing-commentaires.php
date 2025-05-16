<?php

//RECHERCHE DU LISTING
	$nombreAnnoncesParPage = NOMBRE_ANNONCE_PAR_PAGE;
				
	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
	$total = $membre->compterUnElement(TABLE_LIVRE_DOR,"accepter_message","ok");
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierAnnoncesAafficher = ($page - 1) * $nombreAnnoncesParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $metier->getCommentairesLivreDor($premierAnnoncesAafficher, $nombreAnnoncesParPage);
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
	}
				
?>