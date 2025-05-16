<?php
//40 19 * * * root /usr/bin/php5 /home/kosmos17/www/rencontrez-moi.net/interface/cron.php >>/home/kosmos17/logs/cron_rencontrez_moi.txt
include('/home/myfashiowp/maison/interface/applications/commun/configuration.php');
//include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

	//************************************************************
	//             TACHE CRON ENVOI MAILING 2EME PARTIE
	//************************************************************
	
	//----- COMPTEUR NOMBRE EMAILS --------------
	mysql_connect(BDD_SERVEUR, BDD_IDENTIFIANT, BDD_MOT_PASSE);
	mysql_select_db(BDD_BASE_DE_DONNEES_MAILING);
		$reponse = mysql_query("SELECT COUNT(*) AS compter FROM `".TABLE_LISTE_EMAIL."`") or die(mysql_error());
		while ($mysql = mysql_fetch_object($reponse)){
			$nb_email = $mysql->compter;
		}
	mysql_close();
	//DEFINIR TRANCHE
	$tranche  = ceil($nb_email / 3);
	
	//------- MOULINETTE ENVOI MAIL -----------
	$metier->envoiMailinglist($tranche,$tranche);
	//-----------------------------------------
	
	//--------ENVOI MAIL DE VERIFICATION --------------------
	$destinataire = MAIL_RECEPTION_CRON;
	$entete = 'CRON MAILING 2';
	$expediteur = MAIL_CORRESPONDANCE;
	$reponse = MAIL_CORRESPONDANCE;
	
	$codehtml = '<html>' .
			'<body>' .
			'<h1 style="text-align:center;">MAILING LIST N2</h1>' .
			'<br /><br />Bonjour Christophe,' .
			'<br /><br />2ème envoi de la Mailing list:' .
			'<br /><br />Date du message : '.date("d/m/Y H:i:s", time()).'' .
			'<br />Tranche par envoi : <strong>'.$tranche.' - '.$tranche.'</strong>' .
			'<br /><br /><br />' .
			'<h3 style="text-align:center;">MESSAGE AUTOMATIQUE - NE PAS REPONDRE</h3>' .
			'</body>' .
			'</html>';
	//------ ENVOIE MAIL DE CONFIRMATION ---------------
	mail($destinataire,$entete,$codehtml,"From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
		
?>
