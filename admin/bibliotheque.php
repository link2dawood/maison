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
    <link href="<?php echo CONFIGURATION_CSS_ADMIN; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>	
</head>
<body style="background-color:#01327D;">
<div id="bibliotheque">
<!-- DEBUT EXTERIEUR -->
<?php
	if(empty($_SESSION['admin'])){
		//RENVOI ACCUEIL
		echo afficherLoginAdmin();
	}
	else{
		echo '<h1>[Espace BIBLIOTHEQUE]</h1>';
		echo '<p id="menu"><a href="./bibliotheque.php?action=ajout">+ ajouter</a> .:. <a href="./bibliotheque.php">liste</a></p>';
		
		if(empty($_GET['action'])){
			$total = $membre->compterBibliotheque();
			$element = majPagination(5, $total);
			$nombreDePages = $element;
			if (isset($page)){
				if ($page<=$nombreDePages OR $_GET['page'] == 0){
				//ON NE FAIT RIEN...
				}
				else{
					echo '<meta http-equiv="refresh" content="0; URL=./bibliotheque.php?page='.$nombreDePages.'">';
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
							echo '<form action="./bibliotheque.php" method="get">' .
								'<input type="hidden" name="page" value="'.$num.'"/>' .
								'<input type="submit" value="< < retour" '.$disabled.'/>' .
								'</form>';
							?>
						</td>
						<td class="li_2"><?php echo $total ?> résultat(s)</td>
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
							echo '<form action="./bibliotheque.php" method="get">' .
								'<input type="hidden" name="page" value="'.$num.'"/>' .
								'<input type="submit" value="suite > >"/>' .
								'</form>';
						 ?>
						</td>
						<td class="li_5"><?php 
							//MOTEUR DE PAGINATION
							echo '<form action="./bibliotheque.php" method="get">' .
									'N° : ' .
									'<input type="text" name="page" value="'.$page.'" style="width:30px;"/>' .
									'<input type="submit" value="Go"/>' .
									'</form>';
							
							?>
						</td>
					</tr>
				</table>
			</div>
		<?php
			include('listing-bibliotheque.php');
		}
		else{
			if(empty($_GET['up'])){
				//FORMULAIRE DE CHARGEMENT IMAGES
				echo '<div class="form_upload">' .
					'<form action="./bibliotheque.php?up=ok&action=ajout" method="post" onSubmit="return checkrequired(this)" name="formulaire" enctype="multipart/form-data">' .
					'<ul>' .
					'<li class="titre">AJOUTER UNE PHOTO</li>' .
					'<li><input type="file" name="photo"/></li>' .
					'<li>fomats acceptés : JPG, PNG et GIF</li>' .
					'<li style="text-align:center;"><input type="submit" value="envoyer"/></li>' .
					'</ul>' .
					'</form>' .
					'</div>';
			}
			else{
				if($_GET['up'] == "ok"){
					//TRAITEMENT...
					$photo_size = $_FILES['photo']['size'];
					$photo_name = $_FILES['photo']['name'];
					$photo_tmp_name = $_FILES['photo']['tmp_name'];
							
					if(empty($photo_name)){
						//ON NE FAIT RIEN...
						echo '<h3 style="color:white;text-align:center;margin-top:80px;">Nous sommes désolés mais cette image n\'est pas valide !</h3>';
					}
					else{
						//CREATION STOCKAGE REPERTOIRE PAR ID
						$inc = $membre->getIncrementation();
						
						if($inc){
							$incrementation = defautPage($inc) + 1;
						}
						else{
							$incrementation = defautPage($inc);
						}
						
						creationRepertoireStockage(nommageRepertoire($incrementation));
						
						$tab_photo = $metier->chargementPhoto($photo_tmp_name, $photo_size, $photo_name, REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($incrementation), REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($incrementation), REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($incrementation), $incrementation, nommageRepertoire($incrementation));
						
						if(is_numeric($tab_photo)){
							//ON NE FAIT RIEN...
							echo '<h3 style="color:white;text-align:center;margin-top:80px;">Nous sommes désolés mais cette image n\'est pas valide !</h3>';
						}
						else{
							$membre->insertPhotosBibliotheque($tab_photo);
							echo '<h3 style="color:white;text-align:center;margin-top:80px;">Image chargée dans la bibliothèque !</h3>';
						}
					}
				}
				elseif($_GET['up'] == "sup"){
					if($_GET['id_img']){
						$extension = $membre->getChamps("extension",TABLE_BIBLIOTHEQUE,"id",$_GET['id_img']);
						$membre->supprimerUnElement(TABLE_BIBLIOTHEQUE,"id",$_GET['id_img']);
						supprimerImage($_GET['id_img'],$_GET['id_img'],$extension);
						echo '<h3 style="color:white;text-align:center;margin-top:80px;">Image supprimée !</h3>';
					}
				}
				else{
					//AUCUNE ACTION...
				}
			}
		}
	}
?>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>