<?php
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);

if(!empty($_POST['id_client']) 
   AND !empty($_POST['id_client']) 
   AND !empty($_POST['pseudo_client']) 
   AND !empty($_POST['id_exp']) 
   AND !empty($_POST['p_exp']) 
   AND !empty($_POST['message'])){
	mysql_connect(BDD_SERVEUR,BDD_IDENTIFIANT,BDD_MOT_PASSE);
	mysql_select_db(BDD_BASE_DE_DONNEES);
	mysql_query("INSERT INTO ".TABLE_WEBCAM_DUO."" .
				"(`id_demande`, `pseudo_demande`, `id_client_accepter` , `pseudo_client_accepter`, `commentaire` , `date_debut`, `date_cloture` , `date_creation_message`) " .
				"VALUES ('".minuscule($_POST['id_client'])."'," .
						" '".minuscule($_POST['pseudo_client'])."'," .
						" '".minuscule($_POST['id_exp'])."'," .
						" '".minuscule($_POST['p_exp'])."'," .
						" '".utf8_decode(mysql_real_escape_string($_POST['message'])) ."'," .
						" '".time()."'," .
						" '".time()."'," .
						" '".time()."')") 
				or die(mysql_error("INSERTION NOUVEAU MESSAGE IMPOSSIBLE!"));
	mysql_close();
}
?>

