<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

if(is_numeric($_GET['id_msg'])){
	$entete = '<html>' ."\n".
				'<body>' ."\n".
				'<table style="width:700px;margin:0px auto;border:1px solid #00327C;">' ."\n".
				  '<tr>' .
				  '<td><img src="'.HTTP_IMAGE.'top_mail.png" alt="images"/></td>' .
				  '</tr>' .
				  '<tr>' ."\n".
				  '<td>' ."\n".
				  '<h1 style="text-align:center;font-size:20px;padding-top:7px;">NEWSLETTER</h1>' ."\n".
				  '<div style="padding:3px;">';
						  
	$fin_news = '</div>' .
				'<p style="text-align:left;padding-top:10px;">Echange de logements et hébergement vacances gratuites</p>' .
				'<p style="text-align:left;"><a href="'.HTTP_SERVEUR.'">www.vacanceshome.com</a></p>' .
				'<h3 style="text-align:center;padding-top:10px;">MAIL AUTOMATIQUE - NE PAS REPONDRE</h3>' .
				'</td>' .
				'</tr>' .
				'</table>';
				
	$corps = $metier->getChamps("contenu", TABLE_ECRIRE_NEWSLETTER, "id", $_GET['id_msg']);
	$codehtml = $entete.$corps.$fin_news;
	//MAIL
	mail(MAIL_CORRESPONDANCE,"A découvrir",$codehtml,"From: ".MAIL_CORRESPONDANCE."\r\nReply-To: ".MAIL_CORRESPONDANCE."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
	
	echo '<h1 style="text-align:center;margin-top:130px;">Vous pouvez fermer la fenêtre...' .
			'<br/>Contrôler votre boite de messagerie : <span style="color:red;">"'.MAIL_CORRESPONDANCE.'"</span></h1>';
}
else{
	//RAS...
	echo '<h1 style="text-align:center;margin-top:130px;">Vous pouvez fermer la fenêtre...' .
			'<br/>ERREUR !!</h1>';
}
?>
