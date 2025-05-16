<?php

	$nombreMembresParPage = NOMBRE_ANNONCE_PAR_PAGE;
				
	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
	$compter_mot_cle = $membre->compterUnElement(TABLE_MOTS_CLES,"element_mot",textFormater($_GET['Rechercher']));	
	if($compter_mot_cle <= 0 AND $_GET['Rechercher'] != ""){
		//--------
		$dateEnregistrement = time();
		//Enregistrer le mot-clé en base
		$maison->insertionMotCle(textFormater($_GET['Rechercher']), encodage($_GET['Rechercher']), $dateEnregistrement);
		//---------
	}
	$total = $maison->compterNombreMotCle(textFormater($_GET['Rechercher']));					
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total > 0){
		echo $metier->afficherExtraitMoteurDeRecherche($premierMembresAafficher, $nombreMembresParPage, textFormater($_GET['Rechercher']));
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
	}
				
?>