<?php
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);

if(!empty($_POST['id_client']) AND !empty($_POST['pays']) AND !empty($_POST['message'])){
	mysql_connect(BDD_SERVEUR,BDD_IDENTIFIANT,BDD_MOT_PASSE);
	mysql_select_db(BDD_BASE_DE_DONNEES);
	mysql_query("INSERT INTO ".TABLE_TCHAT_DISCUSSION."" .
				"(`identifiant`, `id_pays`, `commentaire` , `heure_creation`) " .
				"VALUES ('".minuscule($_POST['id_client'])."'," .
						" '".minuscule($_POST['pays'])."'," .
						" '".utf8_decode(mysql_real_escape_string($_POST['message']))."'," .
						" '".time()."')") 
				or die(mysql_error("INSERTION NOUVEAU MESSAGE IMPOSSIBLE!"));
	mysql_close();
}
?>

