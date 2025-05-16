<?php
//0 4 * * * root /usr/bin/php5 /home/kemmat/www/echange-maison.biz/interface/cron.php >>/home/kemmat/logs/cron_echange_maison_biz.txt
include('/home/myfashiowp/maison/interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

	//************************************************************
	//             TACHE CRON NETTOYAGE FICHIERS FLV
	//************************************************************
	$compteur = $membre->garbageFLV();
	
	$destinataire = MAIL_RECEPTION_CRON;
	$entete = 'CRON ECHANGE-MAISON';
	$expediteur = MAIL_CORRESPONDANCE;
	$reponse = MAIL_CORRESPONDANCE;
	
	$codehtml = '<html>' .
			'<body>' .
			'<h1 style="text-align:center;">MAJ FICHIERS FLV</h1>' .
			'<br /><br />Bonjour,' .
			'<br /><br />La mise à jour des fichiers FLV sur le serveur s\'est bien passée et voici ci-dessous les infos que je transmets:' .
			'<br /><br />Date du message : '.date("d/m/Y H:i:s", time()).'' .
			'<br />Nombre de fichiers supprimés : '.($compteur - 1).'' .
			'<br /><br />Mise à jour aussi des affichages publicitaires   ;)' .
			'<br /><br /><br />' .
			'<h3 style="text-align:center;">MESSAGE AUTOMATIQUE - NE PAS REPONDRE</h3>' .
			'</body>' .
			'</html>';
	//------ ENVOIE MAIL DE CONFIRMATION ---------------
	mail($destinataire,$entete,".$codehtml.","From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
	
	//-------------------- MISE A JOUR DES AFFICHAGES PUBLICITAIRES ----------------------------
	$metier->controleValiditePub(time());   
	         
	//--------------------- REMISE A ZERO COMPTEUR TABLES  ------------------------
	$membre->initialiserTable(TABLE_ARCHIVE_FLV);
	$membre->initialiserTable(TABLE_PAIEMENT_ATTENTE_CONFIRMATION);
	$membre->initialiserTable(TABLE_CONTROLEUR_MEDIA);
	
		
?>
