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
    <link href="<?php echo CONFIGURATION_CSS_ADMIN; ?>" media="screen" rel="stylesheet" type="text/css" />
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
		echo '<h4>[Espace CARNET DE VOYAGE]</h4>';
		//---------------------------------
		$page = defautPage($_GET['page']);
		$total = $membre->compterCarnetVoyage();
		$nombreDePages = majPagination(NOMBRE_ANNONCE_PAR_PAGE, $total);
		//---------------------------------
		if (isset($page)){
			if ($page<=$nombreDePages OR $_GET['page'] == 0){
				//ON NE FAIT RIEN...
			}
			else{
				echo '<meta http-equiv="refresh" content="0; URL=./carnet.php?page='.$nombreDePages.'">';
			}
		}
		
		if($_GET['action'] == ""){
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
							echo '<form action="./carnet.php" method="get">' .
								'<input type="hidden" name="page" value="'.$num.'"/>' .
								'<input type="submit" value="< < retour" '.$disabled.'/>' .
								'</form>';
							?>
						</td>
						<td class="li_2"><?php echo $total.' résultat(s)'; ?></td>
						<td class="li_3"><?php echo 'Page(s) : '.$page.'/'.$nombreDePages; ?></td>
						<td class="li_4">
							<?php 
							//-------- BOUTON PAGINATION AVANCER --------------
							if(is_null($page) OR $page == 0){
								$num = 1;
							}
							else{
								$num = $page+1;
							}
							echo '<form action="./carnet.php" method="get">' .
								'<input type="hidden" name="page" value="'.$num.'"/>' .
								'<input type="submit" value="suite > >"/>' .
								'</form>';
							 ?>
						</td>
						<td class="li_5">
							<?php 
							//MOTEUR DE PAGINATION
							echo '<form action="./carnet.php" method="get">' .
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
			if($total > 0){
				$nombreAnnoncesParPage = NOMBRE_ANNONCE_PAR_PAGE;
				$premierAnnoncesAafficher = ($page - 1) * $nombreAnnoncesParPage;
								
				echo $metier->afficherExtraitCarnetDeVoyageAdmin($premierAnnoncesAafficher, $nombreAnnoncesParPage);
			}
			else{
				echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">Pas de résultat disponible...</p>';
			}
		}
		elseif($_GET['action'] == "supprimer"){
			
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