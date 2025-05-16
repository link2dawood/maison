<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);

	//FERMETURE PREMATUREE DE LA FENETRE DUO WEBCAM DONC SUPPRIMER CONNEXION EN COURS...
	if($_GET['id_msg'] != NULL AND $_GET['id_exp'] != NULL){
		mysql_connect(BDD_SERVEUR,BDD_IDENTIFIANT,BDD_MOT_PASSE);
		mysql_select_db(BDD_BASE_DE_DONNEES);
		//1 : SUPPRESSION DU MESSENGER EN COURS...
		mysql_query("DELETE FROM ".TABLE_MESSENGER." WHERE `id`='".minuscule($_GET['id_msg'])."'") or die(mysql_error("SUPPRESSION MESSAGE IMPOSSIBLE!"));
		//2 : SUPPRESSION DU DUO EN COURS EN TANT QUE EXPEDITEUR...
		mysql_query("DELETE FROM ".TABLE_WEBCAM_DUO." WHERE `id_demande`='".minuscule($_GET['id_exp'])."'") or die(mysql_error("SUPPRESSION DUO IMPOSSIBLE!"));
		//3 : SUPPRESSION DU DUO EN COURS EN TANT QUE DESTINATAIRE...
		mysql_query("DELETE FROM ".TABLE_WEBCAM_DUO." WHERE `id_demande`='".$_SESSION['id_client']."'") or die(mysql_error("SUPPRESSION DUO IMPOSSIBLE!"));
		//4 : SUPPRESSION DU DUO EN COURS SUR LA TABLE DES CONNECTES...
		mysql_query("DELETE FROM ".TABLE_LISTE_MEMBRES_CONNECTER_DUO." WHERE `id_membre`='".$_SESSION['id_client']."'") or die(mysql_error("SUPPRESSION DUO IMPOSSIBLE!"));
		mysql_close();
	}

?>
<script type="text/javascript" onload="window.close()></script>