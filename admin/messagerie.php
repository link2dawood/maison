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

if($_GET['action'] == "modifier_message"){
	$messenger = $membre->getMessagerie($_GET['id']);
	//DESTINATAIRE
	$destinataire = $membre->getInscription($messenger[4]);
	//VERIFIER SI MEMBRE ONLINE
	$ident_dest = $membre->getChamps("identifiant", TABLE_ONLINE, "pseudo", $destinataire->pseudo);
	$dest_connecter = etatConnecter($ident_dest);
	$album = $membre->getTable(TABLE_ALBUM_PHOTO,"identifiant",$_GET['id']);
	$identite = $membre->getTable(TABLE_IDENTITE,"identifiant",$destinataire->id);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ADMINISTRATION</title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>	
</head>
<body>
<div id="ext_ad">
<!-- DEBUT EXTERIEUR -->
<?php
	if(empty($_SESSION['admin'])){
		//RENVOI ACCUEIL
		echo afficherLoginAdmin();
	}
	else{
		//DEVELOPPEMENT ESPACE MEMBRE
		include('menu.php');
		include('info.php');
		
		echo '<h1>Administration</h1>';
		echo '<h4>['.ucfirst($_GET['type']).']</h4>';
		
		if($_GET['type'] == "courrier"){
			//*********************************************************************
			//                BOITE DE MESSAGERIE COURRIER
			//*********************************************************************
			if(empty($_GET['action']) OR $_GET['action'] == "detail"){
				//Lister l'ensemble des messages envoyés
				$nombreMembresParPage = 8;
				
				$TotalMembres = $membre->compterTousLesMessages(TABLE_MESSAGERIE,$_GET['id_compte']);
				
				// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
				$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
										
				$page = defautPage($_GET['page']);
								 
				// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
				$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
											
				$NombreMembresMaxi = $page + 20;
											
				$NombreMembresMini = pageMini($page);
				
				echo '<table style="width:100%;margin-bottom:5px;">' ."\n".
					'<tr>' ."\n".
					'<td style="text-align:left;font-weight:bolder;">Total messages : '.$TotalMembres.'</td>' ."\n".
					'<td style="text-align:right;font-weight:bolder;">Page : '.$page.'/'.$nombreDePages.'</td>' ."\n".
					'</tr>' ."\n".
					'</table>'."\n";
				
				echo '<div id="tab_listing_compte">' ."\n".
				'<table style="width:100%;">' ."\n".
				'<tr>' ."\n".
				'<th>REF</th>' ."\n".
				'<th>MINIATURE</th>' ."\n".
				'<th>PSEUDO</th>' ."\n".
				'<th>GENRE</th>' .
				'<th>STATUT</th>' ."\n".
				'<th>EXTRAIT</th>' ."\n".
				'<th>CONSULTER</th>' ."\n".
				'<th>MODIFIER</th>' ."\n".
				'<th>SUPPRIMER</th>' ."\n".
				'</tr>'."\n";
				//**********************************************************************************
				//                      RECUPERATION DU LISTING
				//**********************************************************************************
				if($TotalMembres > 0){
					echo $membre->afficherAllMessages($premierMembresAafficher, $nombreMembresParPage, TABLE_MESSAGERIE,$page,$_GET['type'],$_GET['id_compte']);
				}
				else{
					echo '<tr><td colspan="9" style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">Pas de résultat...</td></tr>';
				}
							
				echo '</table>' .
						'</div>';
									
				echo '<p style="text-align:center;padding-top:7px;"><a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$NombreMembresMini.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'"><img src="'.HTTP_IMAGE.'fleche_droite.png" alt="fleche"/></a>';
				//-----DEFINIR LE NOMBRE DE PAGES--------------------
				if (isset($page)){
					if ($page<=$nombreDePages OR $page == 1){
						$MaxiPagesAffichees = $page + 9;
							for ($a = $page ; $a <= $MaxiPagesAffichees ; $a++)	{
								echo ' <a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$a.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'">'.$a.'</a> |';
							}
						}
					else{
						echo '<meta http-equiv="refresh" content="0; URL='.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$nombreDePages.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'">';
					}
				}
				echo '<a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$NombreMembresMaxi.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="fleche"/></a></p>';
			}
			elseif($_GET['action'] == "modifier_message"){
				//Modifier un message en particulier
				if($_GET['genre'] == "message-texte"){
					$icone = '<img src="'.HTTP_IMAGE.'message_texte.png" alt="icone"/>';
				}
				elseif($_GET['genre'] == "message-audio"){
					$icone = '<img src="'.HTTP_IMAGE.'message_audio.png" alt="icone"/>';
				}
				elseif($_GET['genre'] == "message-video"){
					$icone = '<img src="'.HTTP_IMAGE.'message_webcam.png" alt="icone"/>';
				}
				else{
					$icone = "";
				}
				if($_POST['bouton'] != "1"){
					echo '<div style="margin:0 auto;width:800px;margin-top:10px;">' .
						'<div id="form_messenger">' ."\n".
						'<form action="'.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&action='.$_GET['action'].'&type='.$_GET['type'].'&id='.$_GET['id'].'&id_compte='.$_GET['id_compte'].'" method="post">' .
						'<table style="width:100%;">' ."\n".
						'<tr>' ."\n".
						'<td class="img_form">'.afficherMiniature($destinataire->id, $destinataire->pseudo, $album->img1, $album->controle).'</td>' ."\n".
						'<td class="text_top_form"><strong>'.$destinataire->pseudo.'</strong><br />'.$identite->ville.'<br />'.$metier->getChamps('pays', TABLE_PAYS_FR, 'id', $identite->pays).'<br />'.iconeConnexion($ident_dest).'</td>' ."\n".
						'<td class="icone_form">'.$icone.'</td>' ."\n".
						'</tr>' ."\n".
						'<tr>' ."\n".
						'<td class="com_txt" colspan="3"><input type="hidden" name="bouton" value="1"/> <textarea name="requiredCommentaire" rows="20" cols="81">'.str_replace('<br />', '', $messenger[7]).'</textarea></td>' ."\n".
						'</tr>' ."\n".
						'<tr>' .
						'<td colspan="3" style="text-align:center;"><input type="submit" value="Modifier ce message"/></td>' .
						'</tr>' .
						'</table>' ."\n".
						'</form>' .
						'</div>' .
						'</div>' ."\n";
				}
				else{
					$commentaire = textareaLibre($_POST['requiredCommentaire']);
					$membre->updateElement(TABLE_MESSAGERIE, "msg_texte", $commentaire, "id", $_GET['id']);
					afficherAlerte("Le message a été modifié !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
			}
			elseif($_GET['action'] == "supprimer_message"){
				if($_GET['genre'] == "message-texte"){
					$membre->supprimerUnElement(TABLE_MESSAGERIE, "id", $_GET['id']);
					afficherAlerte("Le message a été supprimé !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
				elseif($_GET['genre'] == "message-audio"){
					$audio = $membre->getChamps("msg_audio", TABLE_MESSAGERIE, "id", $_GET['id']);
					$membre->ajouterFichierFLV($audio, time(), nommageRepertoire($_GET['id_exp']));
					$membre->supprimerUnElement(TABLE_MESSAGERIE, "id", $_GET['id']);
					afficherAlerte("Le message a été supprimé !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
				elseif($_GET['genre'] == "message-video"){
					$video = $membre->getChamps("msg_video", TABLE_MESSAGERIE, "id", $_GET['id']);
					$membre->ajouterFichierFLV($video, time(), nommageRepertoire($_GET['id_exp']));
					$membre->supprimerUnElement(TABLE_MESSAGERIE, "id", $_GET['id']);
					afficherAlerte("Le message a été supprimé !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
				else{
					//ERREUR
					redirection(0, HTTP_ADMIN);
				}
			}
			else{
				//ERREUR
				redirection(0, HTTP_ADMIN);
			}
			//*********************************************************************
		}
		elseif($_GET['type'] == "tchat"){
			//*********************************************************************
			//                MESSAGERIE EN DIRECTE TCHAT
			//*********************************************************************
			if(empty($_GET['action']) OR $_GET['action'] == "detail"){
				//Lister l'ensemble des messages envoyés
				$nombreMembresParPage = 8;
				
				$TotalMembres = $membre->compterTousLesMessages(TABLE_MESSENGER,$_GET['id_compte']);
				
				// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
				$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
										
				$page = defautPage($_GET['page']);
								 
				// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
				$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
											
				$NombreMembresMaxi = $page + 20;
											
				$NombreMembresMini = pageMini($page);
				
				echo '<table style="width:100%;margin-bottom:5px;">' ."\n".
					'<tr>' ."\n".
					'<td style="text-align:left;font-weight:bolder;">Total messages : '.$TotalMembres.'</td>' ."\n".
					'<td style="text-align:right;font-weight:bolder;">Page : '.$page.'/'.$nombreDePages.'</td>' ."\n".
					'</tr>' ."\n".
					'</table>'."\n";
				
				echo '<div id="tab_listing_compte">' ."\n".
				'<table style="width:100%;">' ."\n".
				'<tr>' ."\n".
				'<th>REF</th>' ."\n".
				'<th>MINIATURE</th>' ."\n".
				'<th>PSEUDO</th>' ."\n".
				'<th>GENRE</th>' .
				'<th>STATUT</th>' ."\n".
				'<th>EXTRAIT</th>' ."\n".
				'<th>CONSULTER</th>' ."\n".
				'<th>MODIFIER</th>' ."\n".
				'<th>SUPPRIMER</th>' ."\n".
				'</tr>'."\n";
				//**********************************************************************************
				//                      RECUPERATION DU LISTING
				//**********************************************************************************
				if($TotalMembres > 0){
					echo $membre->afficherAllMessages($premierMembresAafficher, $nombreMembresParPage, TABLE_MESSENGER,$page,$_GET['type'],$_GET['id_compte']);
				}
				else{
					echo '<tr><td colspan="9" style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">Pas de résultat...</td></tr>';
				}
							
				echo '</table>' .
						'</div>';
									
				echo '<p style="text-align:center;padding-top:7px;"><a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$NombreMembresMini.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'"><img src="'.HTTP_IMAGE.'fleche_droite.png" alt="fleche"/></a>';
				//-----DEFINIR LE NOMBRE DE PAGES--------------------
				if (isset($page)){
					if ($page<=$nombreDePages OR $page == 1){
						$MaxiPagesAffichees = $page + 9;
							for ($a = $page ; $a <= $MaxiPagesAffichees ; $a++)	{
								echo ' <a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$a.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'">'.$a.'</a> |';
							}
						}
					else{
						echo '<meta http-equiv="refresh" content="0; URL='.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$nombreDePages.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'">';
					}
				}
				echo '<a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$NombreMembresMaxi.'&action='.$_GET['action'].'&type='.$_GET['type'].'&id_compte='.$_GET['id_compte'].'"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="fleche"/></a></p>';
			}
			elseif($_GET['action'] == "modifier_message"){
				//Modifier un message en particulier
				if($_GET['genre'] == "message-texte"){
					$icone = '<img src="'.HTTP_IMAGE.'message_texte.png" alt="icone"/>';
				}
				elseif($_GET['genre'] == "message-audio"){
					$icone = '<img src="'.HTTP_IMAGE.'message_audio.png" alt="icone"/>';
				}
				elseif($_GET['genre'] == "message-video"){
					$icone = '<img src="'.HTTP_IMAGE.'message_webcam.png" alt="icone"/>';
				}
				else{
					$icone = "";
				}
				if($_POST['bouton'] != "1"){
					echo '<div style="margin:0 auto;width:800px;margin-top:10px;">' .
						'<div id="form_messenger">' ."\n".
						'<form action="'.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&action='.$_GET['action'].'&type='.$_GET['type'].'&id='.$_GET['id'].'&id_compte='.$_GET['id_compte'].'" method="post">' .
						'<table style="width:100%;">' ."\n".
						'<tr>' ."\n".
						'<td class="img_form">'.afficherMiniature($destinataire->id, $destinataire->pseudo, $album->img1, $album->controle).'</td>' ."\n".
						'<td class="text_top_form"><strong>'.$destinataire->pseudo.'</strong><br />'.$identite->ville.'<br />'.$metier->getChamps('pays', TABLE_PAYS_FR, 'id', $identite->pays).'<br />'.iconeConnexion($ident_dest).'</td>' ."\n".
						'<td class="icone_form">'.$icone.'</td>' ."\n".
						'</tr>' ."\n".
						'<tr>' ."\n".
						'<td class="com_txt" colspan="3"><input type="hidden" name="bouton" value="1"/> <textarea name="requiredCommentaire" rows="20" cols="81">'.str_replace('<br />', '', $messenger[7]).'</textarea></td>' ."\n".
						'</tr>' ."\n".
						'<tr>' .
						'<td colspan="3" style="text-align:center;"><input type="submit" value="Modifier ce message"/></td>' .
						'</tr>' .
						'</table>' ."\n".
						'</form>' .
						'</div>' .
						'</div>' ."\n";
				}
				else{
					$commentaire = textareaLibre($_POST['requiredCommentaire']);
					$membre->updateElement(TABLE_MESSENGER, "msg_texte", $commentaire, "id", $_GET['id']);
					afficherAlerte("Le message a été modifié !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
			}
			elseif($_GET['action'] == "supprimer_message"){
				if($_GET['genre'] == "message-texte"){
					$membre->supprimerUnElement(TABLE_MESSENGER, "id", $_GET['id']);
					afficherAlerte("Le message a été supprimé !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
				elseif($_GET['genre'] == "message-audio"){
					$audio = $membre->getChamps("msg_audio", TABLE_MESSENGER, "id", $_GET['id']);
					$membre->ajouterFichierFLV($audio, time(), nommageRepertoire($_GET['id_exp']));
					$membre->supprimerUnElement(TABLE_MESSENGER, "id", $_GET['id']);
					afficherAlerte("Le message a été supprimé !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
				elseif($_GET['genre'] == "message-video"){
					$video = $membre->getChamps("msg_video", TABLE_MESSENGER, "id", $_GET['id']);
					$membre->ajouterFichierFLV($video, time(), nommageRepertoire($_GET['id_exp']));
					$membre->supprimerUnElement(TABLE_MESSENGER, "id", $_GET['id']);
					afficherAlerte("Le message a été supprimé !");
					if($_GET['id_compte']){
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type'].'&action=detail&id_compte='.$_GET['id_compte']);
					}
					else{
						redirection(3,HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.defautPage($_GET['page']).'&type='.$_GET['type']);
					}
				}
				else{
					//ERREUR
					redirection(0, HTTP_ADMIN);
				}
			}
			else{
				//ERREUR
				redirection(0, HTTP_ADMIN);
			}
			//*********************************************************************
		}
		else{
			//ERREUR
			redirection(0, HTTP_ADMIN);
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>