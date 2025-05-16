<?php

//RECHERCHE DU LISTING
	$nombreMembresParPage = NOMBRE_ANNONCE_PAR_PAGE;
				
	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
	$total = $metier->compterAnnoncesParDept($table,minuscule($_GET['select_echange']),minuscule($_GET['select_pays']),minuscule($_GET['select_departement']));
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $metier->afficherExtraitParDept($premierMembresAafficher, $nombreMembresParPage, $table,minuscule($_GET['select_echange']),minuscule($_GET['select_pays']),minuscule($_GET['select_departement']));
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
	}
				
?>