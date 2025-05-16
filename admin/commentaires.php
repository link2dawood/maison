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

$page = defautPage($_GET['page']);

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
		echo '<h4>[Espace LIVRE D\'OR]</h4>';
		
		//PAGE INTERNE
		echo '<h2>'.getDrapeau($_GET['lang']).' Messages ('.$_GET['action'].')</h2>';
		$total_messages = $membre->compterUnElement(TABLE_LIVRE_DOR,"accepter_message",$_GET['on']);
		
		if($_GET['action'] == "gestion"){
			echo '<table style="width:600px;padding-bottom:200px;margin:0 auto;">' .
				'<tr>' ."\n".
				'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./commentaires.php?lang='.$_GET['lang'].'&action=ajouter-commentaire">ajouter</a></td>' ."\n".
				'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./commentaires.php?lang='.$_GET['lang'].'&action=modifier-commentaire&on=ok">modifier</a></td>' ."\n".
				'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./commentaires.php?lang='.$_GET['lang'].'&action=supprimer-commentaire&on=ok">supprimer</a></td>' ."\n".
				'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./commentaires.php?lang='.$_GET['lang'].'&action=commentaire-en-attente&on=">en attente ('.$total_messages.')</a></td>' ."\n".
				'</tr>' ."\n".
				'</table>';
		}
		elseif($_GET['action'] == "ajouter-commentaire"){
			if($_GET['ctrl'] == ""){
				echo '<form action="./commentaires.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
						'<div style="width:600px;padding-bottom:200px;margin:0 auto;">' .
						'<ul style="padding:7px;">' .
						'<li style="padding-top:15px;"><span style="font-weight:bolder;">ATTENTION</span>: <strong>C\'est une rubrique LIVRE D\'OR pour mettre y déposer une opinion, un point de vue</strong> !</li>' .
						'<li style="padding-top:15px;"><textarea name="requiredDescription" rows="10" cols="65"></textarea></li>' .
						'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Déposer mon commentaire" /> <input type="reset" value="Effacer" /></li>' .
						'</ul>' .
						'</div>' .
						'</form>';
			}
			else{
				$message = textareaLibre($_POST['requiredDescription']);
				
				if(empty($message)){
					messageErreur("Nous sommes désolés mais le commentaire est vide !");
					redirection(3,HTTP_ADMIN.'commentaires.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
				}
				else{
					//INSERTION
					$metier->insertLivreDor($message,"webmaster","ok",time());
					messageErreur("Commentaire ajouté !");
					redirection(3,HTTP_ADMIN.'commentaires.php');
				}
			}
		}
		elseif($_GET['action'] == "modifier-commentaire" OR $_GET['action'] == "supprimer-commentaire" OR $_GET['action'] == "commentaire-en-attente"){
			if($_GET['ctrl'] == ""){
				//MAJ PAGINATION
				$element = majPagination(NOMBRE_ANNONCE_PAR_PAGE, $total_messages);
				$nombreDePages = $element;
				if (isset($page)){
					if ($page<=$nombreDePages OR $_GET['page'] == 0){
					//ON NE FAIT RIEN...
					}
					else{
						echo '<meta http-equiv="refresh" content="0; URL=./commentaires.php?page='.$nombreDePages.'&lang='.$_GET['lang'].'&action='.$_GET['action'].'&on='.$_GET['on'].'&ctrl='.$_GET['ctrl'].'">';
					}
				}
				?>	
				<div id="pagination">
					<table class="navigation">
						<tr>
							<td class="li_1">
								<?php 
								//---- PAGINATION RETOUR --------------
								if(is_null($page) OR $page <= 1){
									$num = 0;
									$disabled = "disabled";
								}
								else{
									$num = $page-1;
									$disabled = "";
								}
								//-------- BOUTON PAGINATION RETOUR --------------
								echo '<form action="./commentaires.php" method="get">' .
									'<input type="hidden" name="page" value="'.$num.'"/>' .
									'<input type="hidden" name="lang" value="'.$_GET['lang'].'"/>' .
									'<input type="hidden" name="action" value="'.$_GET['action'].'"/>' .
									'<input type="hidden" name="on" value="'.$_GET['on'].'"/>' .
									'<input type="hidden" name="ctrl" value="'.$_GET['ctrl'].'"/>' .
									'<input type="submit" value="< < retour" '.$disabled.'/>' .
									'</form>';
								?>
							</td>
							<td class="li_2"><?php echo $total_messages ?> résultat(s)</td>
							<td class="li_3">Page : <?php echo $page.'/'.$nombreDePages; ?></td>
							<td class="li_4">
							<?php 
								//-------- BOUTON PAGINATION AVANCER --------------
								if(is_null($page) OR $page == 0){
									$num = 1;
								}
								else{
									$num = $page+1;
								}
								echo '<form action="./commentaires.php" method="get">' .
									'<input type="hidden" name="page" value="'.$num.'"/>' .
									'<input type="hidden" name="lang" value="'.$_GET['lang'].'"/>' .
									'<input type="hidden" name="action" value="'.$_GET['action'].'"/>' .
									'<input type="hidden" name="on" value="'.$_GET['on'].'"/>' .
									'<input type="hidden" name="ctrl" value="'.$_GET['ctrl'].'"/>' .
									'<input type="submit" value="suite > >"/>' .
									'</form>';
							 ?>
							</td>
							<td class="li_5"><?php 
								//MOTEUR DE PAGINATION
								echo '<form action="./commentaires.php" method="get">' .
										'N° : ' .
										'<input type="text" name="page" value="'.$page.'" style="width:30px;"/>' .
										'<input type="hidden" name="lang" value="'.$_GET['lang'].'"/>' .
										'<input type="hidden" name="action" value="'.$_GET['action'].'"/>' .
										'<input type="hidden" name="on" value="'.$_GET['on'].'"/>' .
										'<input type="hidden" name="ctrl" value="'.$_GET['ctrl'].'"/>' .
										'<input type="submit" value="Go"/>' .
										'</form>';
								
								?>
							</td>
						</tr>
					</table>
				</div>
				<?php
				include('listing-livre-dor.php');
			}
			else{
				if($_GET['action'] == "modifier-commentaire"){
					//MODIFIER UN COMMENTAIRE
					$mon_commentaire = $membre->getChamps("commentaire_livre_dor",TABLE_LIVRE_DOR,"id_livre_dor",$_GET['id_livre_dor']);
					if(empty($_GET['cond'])){
						echo '<form action="./commentaires.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok&on='.$_GET['on'].'&cond=ok&id_livre_dor='.$_GET['id_livre_dor'].'" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<div style="width:600px;padding-bottom:200px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;"><span style="font-weight:bolder;">ATTENTION</span>: <strong>C\'est une rubrique LIVRE D\'OR pour mettre y déposer une opinion, un point de vue</strong> !</li>' .
							'<li style="padding-top:15px;"><textarea name="requiredDescription" rows="10" cols="65">'.str_replace("<br />", "", $mon_commentaire).'</textarea></li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Déposer mon commentaire" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
					}
					else{
						$membre->updateElement(TABLE_LIVRE_DOR, "commentaire_livre_dor", textareaLibre($_POST['requiredDescription']), "id_livre_dor", minuscule($_GET['id_livre_dor']));
						messageErreur("Commentaire modifié !");
						redirection(3,HTTP_ADMIN.'commentaires.php?lang=fr&action=gestion');
					}
				}
				elseif($_GET['action'] == "supprimer-commentaire"){
					//SUPPRIMER UN COMMENATIRE
					$membre->supprimerUnElement(TABLE_LIVRE_DOR, "id_livre_dor",$_GET['id_livre_dor']);
					messageErreur("Commentaire supprimé !");
					redirection(3,HTTP_ADMIN.'commentaires.php?lang=fr&action=gestion');
				}
				elseif($_GET['action'] == "commentaire-en-attente"){
					if($_GET['valid'] == "valider"){
						$membre->updateElement(TABLE_LIVRE_DOR, "accepter_message", "ok", "id_livre_dor", minuscule($_GET['id_livre_dor']));
						messageErreur("Commentaire validé !");
						redirection(3,HTTP_ADMIN.'commentaires.php?lang=fr&action=gestion');
					}
				}
				else{
					//ERREUR
					redirection(0,HTTP_ADMIN);
				}
			}
		}
		else{
			redirection(0,HTTP_ADMIN);
		}	
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>