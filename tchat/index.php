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

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_TCHAT_INDEX);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>"/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_TCHAT_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
	<?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
</head>
<body>
<!-- DEBUT EXTERIEUR -->
<div id="exterieur">
	<div id="grey_back">
		<!-- PARTIE ENTETE -->
		<div id="entete">
			<div id="logo">
				<ul>
					<li><a href="<?php echo HTTP_SERVEUR; ?>"><?php echo LOGO; ?></a></li>
					<li><?php echo PHRASE_LOGO; ?></li>
				</ul>
			</div>
			<?php echo afficherLogin($_SESSION['pseudo_client'], HTTP_SERVEUR); ?>
			<h1><?php echo H1_DE_LA_PAGE; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client']); ?></div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"><?php include(INCLUDE_ADSENSE); ?></div>
		
		<!-- BLOC REFERENCE -->
		<div id="int_corps">
			<?php
			if(empty($_SESSION['pseudo_client'])){
				include(INCLUDE_LOGIN);
			}
			else{
				$paiement = activerPaiement($_SESSION['pseudo_client']);
				if($paiement == 0){
					//AUTORISATION REFUSEE
					echo afficherErreur(ACCES_PAGE_REFUSEE);
				}
				else{
					//DEVELOPPEMENT DU TCHAT
					echo '<h2>'.TEXTE_1.'</h2>';
					
					$compteur = $membre->compterMembresParPaysSalon();
					if($compteur == ""){
						$compteur_pays = 0;
					}
					else{
						$compteur_pays = $compteur;
					}
					
					echo '<p style="text-align:center;">(<span style="color:red;font-weight:bolder;font-size:14px;">'.$membre->compterMembresSalon().'</span>) '.TEXTE_8.' (<span style="color:red;font-weight:bolder;font-size:14px;">'.$compteur_pays.'</span>) '.TEXTE_9.'</p>';
					
					echo '<table id="listDrapeaux">' .
						 '<tr>' .
						 '<td>';
						 $listing_pays = $metier->listeCompleteTchatPays(LANGUAGE,0,50);
						 foreach($listing_pays as $cle){
						 	echo $cle;
						 }
						 echo '</td>' .
						 	'<td>';
						 $listing_pays_1 = $metier->listeCompleteTchatPays(LANGUAGE,50,50);
						 foreach($listing_pays_1 as $cle){
						 	echo $cle;
						 }
						 echo '</td>' .
						 	'<td>';
						 $listing_pays_2 = $metier->listeCompleteTchatPays(LANGUAGE,100,50);
						 foreach($listing_pays_2 as $cle){
						 	echo $cle;
						 }	
						 echo '</td>' .
						 	'<td>';
						 $listing_pays_3 = $metier->listeCompleteTchatPays(LANGUAGE,150,50);
						 foreach($listing_pays_3 as $cle){
						 	echo $cle;
						 }
						 echo '</td>' .
						 		'<td>';
						 $listing_pays_4 = $metier->listeCompleteTchatPays(LANGUAGE,200,50);
						 foreach($listing_pays_4 as $cle){
						 	echo $cle;
						 }		
						 echo '</td>' .
						 		'</tr>' .
						 		'</table>';
						 echo '<p id="init"></p>';
				}
			}
			?>
		</div>
		<?php echo connexionON(); ?>
	</div>
</div>
<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>
<!-- FIN EXTERIEUR -->
</body>
</html>