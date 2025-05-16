<?php
//RECHERCHE DU LISTING
	$nombreMembresParPage = NOMBRE_ANNONCE_PAR_PAGE;
				
	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
	$total = $membre->compterMembresOffline($table,minuscule($_GET['type']),minuscule($_GET['choix_pays']),"liste");
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $metier->afficherExtraitAnnonces($premierMembresAafficher, $nombreMembresParPage, $table,minuscule($_GET['type']),minuscule($_GET['choix_pays']),"liste");
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
	}
				
?>