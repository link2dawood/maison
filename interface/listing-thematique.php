<?php

//RECHERCHE DU LISTING
	$nombreMembresParPage = NOMBRE_ANNONCE_PAR_PAGE;
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $metier->afficherExtraitOFFLINEetONLINEAnnoncesAvecOptions($premierMembresAafficher, $nombreMembresParPage, $table,$type,"","couchsurfing");
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;"></p>';
	}
				
?>