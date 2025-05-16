<?php 
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_DUO_WEBCAMS);

	//ON PROTEGE LA CONNEXION CONSTANTE...
	//ON CHARGE LA NOUVELLE PERIODE
	$nouvelle_periode = time() + TEMPS_MAJ_CONNEXION;
	$membre->updateConnexion($nouvelle_periode, $_SESSION['id_client'], $_SESSION['pseudo_client']);
	
	//AFFICHER UN MESSAGE DE SIGNALISATION POUR INDIQUER SI LE MEMBRE EST CONNECTE OU NON SUR LE DUO WEBCAM...
	$controle_id_expediteur = $membre->getChamps("id_expediteur", TABLE_MESSENGER, "id", $_GET['id_msg']);
	$controle_id_destinataire = $membre->getChamps("id_destinataire", TABLE_MESSENGER, "id", $_GET['id_msg']);
	$verif_id = $membre->getChamps("id", TABLE_LISTE_MEMBRES_CONNECTER_DUO, "id_membre", $_GET['id_exp']);
	
	if(($controle_id_expediteur == $_GET['id_exp'] OR $controle_id_destinataire == $_GET['id_exp']) AND $verif_id == NULL){
		//CAS : LE MEMBRE N'EST PAS ENCORE CONNECTE SUR LE DUO WEBCAM...
		echo '<p style="font-weight:bolder;">'.MESSAGE_ALERTE_CONNECTER_DUO_1.' <span style="color:#F5772A;font-size:14px;">'.$_GET['p_exp'].'</span> '.MESSAGE_ALERTE_CONNECTER_DUO_2.'</p>';
		
	}
	else{
		// CAS : LE MEMBRE N'EST PLUS CONNECTE SUR LE DUO WEBCAM...
		if($controle_id_expediteur != $_GET['id_exp'] AND $verif_id == NULL){
			echo '<p style="font-weight:bolder;">'.MESSAGE_ALERTE_MEMBRE_DECONNECTER_1.' <span style="color:#F5772A;font-size:14px;">'.$_GET['p_exp'].'</span> '.MESSAGE_ALERTE_MEMBRE_DECONNECTER_2.'</p>';
			
		}
		
	}	
	echo '<ul>';
   	echo $membre->listerMessagesDuoWebcam($_SESSION['id_client'], $_SESSION['pseudo_client'], $_GET['id_exp'], $_GET['p_exp']);
   	echo '</ul>';		
	
			
?>