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
	<script language="javascript" type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
		tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
			plugins : "advimage, style, emotions",
			theme_advanced_buttons3_add : "styleprops, emotions",
			relative_urls : false
		});
		</script>
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
		echo '<h4>[Espace BLOG]</h4>';
		echo '<p style="text-align:right;">'.fenetrePopUp("bibliotheque.php",860,650,"+ Accès bibliothèque").'</p>';
		
		
		if(empty($_GET['action'])){
			//PAGE ACCUEIL DU BLOG
			echo '<table style="width:100%;margin-bottom:200px;">' .
					'<tr>' ."\n".
					'<td style="text-align:center;padding-top:40px;"><a href="./blog.php?lang=fr&action=gestion"><img src="'.HTTP_IMAGE.'blog_fr.png" alt="drapeau"/></a></td>' ."\n".
					'<td style="text-align:center;padding-top:40px;"><a href="./blog.php?lang=en&action=gestion"><img src="'.HTTP_IMAGE.'blog_en.png" alt="drapeau"/></a></td>' ."\n".
					'<td style="text-align:center;padding-top:40px;"><a href="./blog.php?lang=es&action=gestion"><img src="'.HTTP_IMAGE.'blog_es.png" alt="drapeau"/></a></td>' ."\n".
					'</tr>' ."\n".
					'</table>';
		}
		else{
			//PAGE INTERNE
			echo '<h2>'.getDrapeau($_GET['lang']).' Blog ('.$_GET['action'].')</h2>';
			
			if($_GET['action'] == "gestion"){
				echo '<table style="width:600px;padding-bottom:200px;margin:0 auto;">' .
					'<tr>' ."\n".
					'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./blog.php?lang='.$_GET['lang'].'&action=ajouter-categorie">ajouter une catégorie</a></td>' ."\n".
					'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./blog.php?lang='.$_GET['lang'].'&action=modifier-categorie">modifier une catégorie</a></td>' ."\n".
					'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./blog.php?lang='.$_GET['lang'].'&action=supprimer-categorie">supprimer une catégorie</a></td>' ."\n".
					'</tr>' ."\n".
					'<tr>' ."\n".
					'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./blog.php?lang='.$_GET['lang'].'&action=ajouter-article">ajouter un article</a></td>' ."\n".
					'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./blog.php?lang='.$_GET['lang'].'&action=modifier-article">modifier un article</a></td>' ."\n".
					'<td style="padding-top:20px;">'.afficherIconeDrapeau($_GET['lang']).' <a href="./blog.php?lang='.$_GET['lang'].'&action=supprimer-article">supprimer un article</a></td>' ."\n".
					'</tr>' ."\n".
					'</table>';
			}
			elseif($_GET['action'] == "ajouter-categorie"){
				if($_GET['ctrl'] == ""){
					echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<div style="width:600px;padding-bottom:200px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;"><span style="font-weight:bolder;">ATTENTION</span>: Le nom de la catégorie doit être un mot ou un groupe de mots mais <strong>pas une phrase</strong> !</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégories actuellement en ligne</span>:';
						
						$tab = $metier->getMenuDeroulant("catArticle", $_GET['lang'], "", TABLE_BLOG_CATEGORIES,"id_cat","cat");
						
						foreach($tab as $cle){
							echo $cle;
						}
						
						echo '</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Nom de la nouvelle catégorie</span>: <input type="text" name="requiredNouvelleCat" size="50" /></li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Continuer" /> <input type="reset" value="Effacer" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
				}
				else{
					$nouvelle_categorie = textFormater($_POST['requiredNouvelleCat']);
					$categorie_presente = $metier->controleExistence("cat",$nouvelle_categorie, TABLE_BLOG_CATEGORIES.$_GET['lang']);
					
					if(empty($nouvelle_categorie)){
						messageErreur("Nous sommes désolés mais la catégorie est vide !");
						redirection(3,HTTP_ADMIN.'blog.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
					}
					elseif($categorie_presente > 0){
						messageErreur("Nous sommes désolés mais cette catégorie est déjà présente !");
						redirection(3,HTTP_ADMIN.'blog.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
					}
					else{
						//INSERTION
						$metier->insertionNouvelleCategorie($nouvelle_categorie,$_GET['lang']);
						messageErreur("Catégorie ajoutée !");
						redirection(3,HTTP_ADMIN.'blog.php');
					}
				}
			}
			elseif($_GET['action'] == "modifier-categorie"){
				if($_GET['ctrl'] == ""){
					echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<div style="width:600px;padding-bottom:200px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;"><span style="font-weight:bolder;">ATTENTION</span>: Le nom de la catégorie doit être un mot ou un groupe de mots mais <strong>pas une phrase</strong> !</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégories actuellement en ligne</span>:</li>';
						
						$key = $membre->getTableElement(TABLE_BLOG_CATEGORIES.$_GET['lang'],"id_cat");
						
						for($i=0;$i<=count($key)-1;$i++){
							echo '<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégorie n°'.$key[$i].'</span>: <input type="text" name="requiredCat'.$key[$i].'" value="'.$membre->getChamps("cat",TABLE_BLOG_CATEGORIES.$_GET['lang'],"id_cat",$key[$i]).'" size="50" /></li>';
						}
						
						echo '<li style="text-align:center;padding-top:15px;"><input type="submit" value="Continuer" /> <input type="reset" value="Effacer" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
				}
				else{
					$key = $membre->getTableElement(TABLE_BLOG_CATEGORIES.$_GET['lang'],"id_cat");
						
					for($i=0;$i<=count($key)-1;$i++){
						$ma_categorie = textFormater($_POST['requiredCat'.$key[$i]]);
						
						if($ma_categorie){
							$metier->updateCategorie($ma_categorie,$key[$i],TABLE_BLOG_CATEGORIES.$_GET['lang']);
						}
					}
					messageErreur("Catégorie modifiée !");
					redirection(3,HTTP_ADMIN.'blog.php');
				}
			}
			elseif($_GET['action'] == "supprimer-categorie"){
				if($_GET['ctrl'] == ""){	
					echo '<div style="width:600px;padding-bottom:200px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;color:red;"><span style="font-weight:bolder;">ATTENTION</span>: <strong>supprimer une catégorie va rendre inutilisable les articles de sa catégorie !</strong></li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégories actuellement en ligne</span>:</li>';
						
						$key = $membre->getTableElement(TABLE_BLOG_CATEGORIES.$_GET['lang'],"id_cat");
						
						for($i=0;$i<=count($key)-1;$i++){
							echo '<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégorie n°'.$key[$i].'</span>: <strong>'.$membre->getChamps("cat",TABLE_BLOG_CATEGORIES.$_GET['lang'],"id_cat",$key[$i]).'</strong> <a href="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok&id_cat='.$key[$i].'" style="font-size:10px;">[supprimer]</a></li>';
						}
						
						echo '</ul>' .
							'</div>';
				}
				else{
					$membre->supprimerUnElement(TABLE_BLOG_CATEGORIES.$_GET['lang'], "id_cat",$_GET['id_cat']);
					messageErreur("Catégorie supprimée !");
					redirection(3,HTTP_ADMIN.'blog.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
				}
			}
			elseif($_GET['action'] == "ajouter-article"){
				if($_GET['ctrl'] == ""){
					echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<div style="width:840px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;color:red;font-weight:bolder;">ATTENTION: Il faut absolument choisir une catégorie pour assigner l\'article dans celle-ci !</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégories disponibles</span>:';
						
						$tab = $metier->getMenuDeroulant("catArticle", $_GET['lang'], "", TABLE_BLOG_CATEGORIES,"id_cat","cat");
						
						foreach($tab as $cle){
							echo $cle;
						}
						
						echo '</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Titre de l\'article</span>: <input type="text" name="requiredTitre" /> <em>60 caract. maxi environ 5 ou 6 mots</em></li>' .
							'<li style="padding-top:15px;text-align:center;">Développement de l\'article: <br /><textarea name="requiredDescription" rows="25" cols="100"></textarea></li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Continuer" /> <input type="reset" value="Effacer" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
				}
				else{
					if(empty($_POST['catArticle']) OR empty($_POST['requiredTitre']) OR empty($_POST['requiredDescription'])){
						messageErreur("Nous sommes désolés mais tous les champs sont obligatoires !");
						redirection(3,HTTP_ADMIN.'blog.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
					}
					else{
						//INSERTION
						$metier->insertionArticleBlog(textFormater($_POST['requiredTitre']), $_POST['requiredDescription'], minuscule($_POST['catArticle']), time(), $_GET['lang']);
						messageErreur("Article en ligne !");
						redirection(3,HTTP_ADMIN.'blog.php');
					}
				}
			}
			elseif($_GET['action'] == "modifier-article"){
				if($_GET['ctrl'] == ""){
					echo '<h3 style="text-align:center;margin-top:20px;">ETAPE 1</h3>';
					echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<div style="width:450px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;color:red;font-weight:bolder;">ATTENTION: Veuillez choisir la catégorie...</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégories disponibles</span>:';
						
						$tab = $metier->getMenuDeroulant("catArticle", $_GET['lang'], "", TABLE_BLOG_CATEGORIES,"id_cat","cat");
						
						foreach($tab as $cle){
							echo $cle;
						}
						
						echo '</li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Etape 2" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
				}
				else{
					if($_GET['section'] == ""){
						echo '<h3 style="text-align:center;margin-top:20px;">ETAPE 2</h3>';
						echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok&section=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
								'<div style="width:450px;margin:0 auto;">' .
								'<ul style="padding:7px;">' .
								'<li style="padding-top:15px;color:red;font-weight:bolder;">ATTENTION: Veuillez le titre de l\'article...</li>' .
								'<li style="padding-top:15px;"><input type="hidden" name="catArticle" value="'.minuscule($_POST['catArticle']).'"/> <span style="text-decoration:underline;">Titres disponibles</span>:';
						
						$tab = $metier->getMenuDeroulant("art|".minuscule($_POST['catArticle'])."|id_cat", $_GET['lang'], "", TABLE_BLOG,"id_article","titre_article");
						
						foreach($tab as $cle){
							echo $cle;
						}
						
						echo '</li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Etape 3" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
					}
					else{
						//MODIFICATION
						if($_GET['modif-form'] == ""){
							$article = $membre->getTable(TABLE_BLOG.$_GET['lang'],"id_article",minuscule($_POST['art']));
							
							echo '<h3 style="text-align:center;margin-top:20px;">ETAPE 3</h3>';
							echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok&section=ok&modif-form=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
								'<div style="width:840px;margin:0 auto;">' .
								'<ul style="padding:7px;">' .
								'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégorie</span>: <span style="font-size:18px;font-weight:bolder;">'.$membre->getChamps("cat",TABLE_BLOG_CATEGORIES.$_GET['lang'],"id_cat",minuscule($_POST['catArticle'])).'</span></li>' .
								'<li style="padding-top:15px;"><span style="text-decoration:underline;">Titre de l\'article</span>: <input type="hidden" name="art" value="'.minuscule($_POST['art']).'"/> <input type="text" name="requiredTitre" value="'.$article->titre_article.'"/> <em>60 caract. maxi environ 5 ou 6 mots</em></li>' .
								'<li style="padding-top:15px;text-align:center;">Développement de l\'article: <br /><textarea name="requiredDescription" rows="25" cols="100">'.$article->texte_article.'</textarea></li>' .
								'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Etape 4" /></li>' .
								'</ul>' .
								'</div>' .
								'</form>';
						}
						else{
							echo '<h3 style="text-align:center;margin-top:20px;">ETAPE 4</h3>';
							
							if(empty($_POST['art']) OR empty($_POST['requiredTitre']) OR empty($_POST['requiredDescription'])){
								messageErreur("Nous sommes désolés mais tous les champs sont obligatoires !");
								redirection(3,HTTP_ADMIN.'blog.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
							}
							else{
								//INSERTION
								$membre->updateElement(TABLE_BLOG.$_GET['lang'], "titre_article", textFormater($_POST['requiredTitre']), "id_article", minuscule($_POST['art']));
								$membre->updateElement(TABLE_BLOG.$_GET['lang'], "texte_article", $_POST['requiredDescription'], "id_article", minuscule($_POST['art']));
								messageErreur("Article modifié et mis en ligne !");
								redirection(3,HTTP_ADMIN.'blog.php');
							}
						}
					}
				}
			}
			elseif($_GET['action'] == "supprimer-article"){
				if($_GET['ctrl'] == ""){
					echo '<h3 style="text-align:center;margin-top:20px;">ETAPE 1</h3>';
					echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<div style="width:450px;margin:0 auto;">' .
							'<ul style="padding:7px;">' .
							'<li style="padding-top:15px;color:red;font-weight:bolder;">ATTENTION: Veuillez choisir la catégorie...</li>' .
							'<li style="padding-top:15px;"><span style="text-decoration:underline;">Catégories disponibles</span>:';
						
						$tab = $metier->getMenuDeroulant("catArticle", $_GET['lang'], "", TABLE_BLOG_CATEGORIES,"id_cat","cat");
						
						foreach($tab as $cle){
							echo $cle;
						}
						
						echo '</li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Etape 2" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
				}
				else{
					if($_GET['section'] == ""){
						echo '<h3 style="text-align:center;margin-top:20px;">ETAPE 2</h3>';
						echo '<form action="./blog.php?lang='.$_GET['lang'].'&action='.$_GET['action'].'&ctrl=ok&section=ok" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
								'<div style="width:450px;margin:0 auto;">' .
								'<ul style="padding:7px;">' .
								'<li style="padding-top:15px;color:red;font-weight:bolder;">ATTENTION: Veuillez le titre de l\'article...</li>' .
								'<li style="padding-top:15px;"><span style="text-decoration:underline;">Titres disponibles</span>:';
						
						$tab = $metier->getMenuDeroulant("art|".$_POST['catArticle']."|id_cat", $_GET['lang'], "", TABLE_BLOG,"id_article","titre_article");
						
						foreach($tab as $cle){
							echo $cle;
						}
						
						echo '</li>' .
							'<li style="text-align:center;padding-top:15px;"><input type="submit" value="Supprimer" /></li>' .
							'</ul>' .
							'</div>' .
							'</form>';
					}
					else{
						//SUPPRESSION
						$membre->supprimerUnElement(TABLE_BLOG.$_GET['lang'], "id_article",$_POST['art']);
						messageErreur("Article supprimé !");
						redirection(3,HTTP_ADMIN.'blog.php?lang='.$_GET['lang'].'&action='.$_GET['action']);
					}
				}
			}
			else{
				redirection(0,HTTP_ADMIN);
			}
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>