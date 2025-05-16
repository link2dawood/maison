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

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_MOTEUR_RECHERCHE_PSEUDO);

	if(empty($_SESSION['pseudo_client'])){
		//RENVOI ACCUEIL
		echo redirection('0', HTTP_SERVEUR);
	}
	else{
		//TRAITEMENT DE LA PAGE DE RECHERCHE
		if(empty($_POST['search_pseudo'])){
			//RENVOI ACCUEIL
			echo redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_MEMBRE_OFFLINE);
		}
		else{
			$search_pseudo = minuscule($_POST['search_pseudo']);
			
			$result =  $metier->controleExistence('pseudo', $search_pseudo, TABLE_INSCRIPTION);
			$compte_actif =  $metier->getChamps('compte_actif', TABLE_INSCRIPTION, 'pseudo', $search_pseudo);
			if($result == 0 OR $compte_actif != 0){
				//ERREUR
				echo redirection('4', HTTP_SERVEUR.'interface/'.FILENAME_MEMBRE_OFFLINE);
				echo '<p style="font-size:20px;text-align:center;margin-top:80px;">'.TEXT_ECHEC.'</p>';
			}
			else{
				//REUSSITE
				$pseudo_id = $metier->getChamps('id', TABLE_INSCRIPTION, 'pseudo', $search_pseudo);
				
				echo redirection('4', HTTP_SERVEUR.'interface/'.FILENAME_PROFIL.'?id='.$pseudo_id.'&m='.$search_pseudo);
				echo '<p style="font-size:20px;text-align:center;margin-top:80px;">'.TEXT_REUSSITE.'</p>';
			}
		}
	}

?>
