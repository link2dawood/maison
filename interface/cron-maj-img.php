<?php
include('/home/myfashiowp/maison/interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

	//************************************************************
	//TACHE CRON NETTOYAGE DES IMAGES CHARGEES MAIS PAS CONFIRMER
	//************************************************************
	//---- Suppression Albums photos dépot annonce -----------
	$membre->majImages();
	//----- Suppression des photos galerie ------------------
	$membre->majGaleriePhotos();
	
	$destinataire = MAIL_RECEPTION_CRON;
	$entete = 'CRON MAJ IMAGES';
	$expediteur = MAIL_CORRESPONDANCE;
	$reponse = MAIL_CORRESPONDANCE;
	
	$codehtml = '<html>' .
				'<body>' .
				'<h1 style="text-align:center;">CRON ALBUM + GALERIE</h1>' .
				'<br /><br />Bonjour Christophe,' .
				'<br /><br />La mise à jour des images chargées sur le serveur s\'est bien passée:' .
				'<br /><br />Date du message : '.date("d/m/Y H:i:s", time()).'' .
				'<br /><br />A demain   ;)' .
				'<br /><br /><br />' .
				'<h3 style="text-align:center;">MESSAGE AUTOMATIQUE - NE PAS REPONDRE</h3>' .
				'</body>' .
				'</html>';
	//------ ENVOIE MAIL DE CONFIRMATION ---------------
	mail($destinataire,$entete,".$codehtml.","From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
		
?>
