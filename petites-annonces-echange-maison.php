<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
// include('./interface/applications/commun/configuration.php');
include('./interface/applications/commun/fct-utile.php');
include('./config.php');
// include(INCLUDE_FCTS_UTILE);
// include(INCLUDE_CLASS_ESPACE_MEMBRE);
include('./interface/applications/classes/class.EspaceMembre.php');
$membre = new EspaceMembre();
include('./interface/applications/classes/class.Metier.php');


require_once('./interface/applications/commun/configuration.php');
$metier = new Metier();

// $metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_ANNONCES_ECHANGE_MAISON);

//****** TRAITEMENT *****************
$page = defautPage($_GET['page'] ?? '');
//R�cup�ration du type d'�change
$type_echange = $membre->getChamps("element", "rubriques_".LANGUAGE, "id", minuscule($_GET['type']));
//R�cup�ration du pays d'�change
$pays = $membre->getChamps("pays", "pays_".LANGUAGE, "id", minuscule($_GET['choix_pays']));
if($_GET['type']>0 AND $_GET['type']<=6){
	$table = TABLE_LISTING_ECHANGE_MAISON;
}
else{
	$table = TABLE_LISTING_COUCHSURFING;
}
//***********************************
$x = minuscule($_GET['x'] ?? '');
$y = minuscule($_GET['y'] ?? '');
$UrlTransformation = $_SERVER['REQUEST_URI'];
modifierUrlsExotiques($UrlTransformation, $page, minuscule($_GET['type'] ?? ''), minuscule($_GET['choix_pays'] ?? ''), $x, $y);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?></title>
	<meta name="description" content="<?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?>"/>
	<meta name="keywords" content="<?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?>"/>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo HTTP_SERVEUR; ?>annonces-rss-<?php echo minuscule($_GET['type']); ?>-<?php echo minuscule($_GET['choix_pays']); ?>.xml" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
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
		
			<h1><?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client'] ?? 'Invit�'); ?></div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"><?php include(INCLUDE_ADSENSE); ?></div>
		<!-- RECHERCHE PAR CONNEXION -->
		<div id="module_recherche"><?php include(INCLUDE_MODULE_RECHERCHE); ?></div>
		<!-- BLOC REFERENCE -->
		<div id="contenu">
			<table id="tiers">
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td class="titre_developpement">
						<div class="bord_gauche"></div>
						<div class="corps_top_developpement">

							<div id="pagination">
								<table class="navigation">
									<tr>
<td class="li_1">
    <?php 
    // Provide safe default values to avoid undefined index warnings
    $page = defautPage($_GET['page'] ?? 1);
    $type = $_GET['type'] ?? '0';
    $choix_pays = $_GET['choix_pays'] ?? '0';

    //---- PAGINATION RETOUR --------------
    if (is_null($page) || $page <= 1) {
        $num = 0;
        $disabled = "disabled";
    } else {
        $num = $page - 1;
        $disabled = "";
    }

    //-------- BOUTON PAGINATION RETOUR --------------
    echo '<form action="' . HTTP_SERVEUR . FILENAME_ANNONCES_ECHANGE_MAISON . '" method="get">' .
        '<input type="hidden" name="page" value="' . $num . '"/>' .
        '<input type="hidden" name="type" value="' . htmlspecialchars($type) . '"/>' .
        '<input type="hidden" name="choix_pays" value="' . htmlspecialchars($choix_pays) . '"/>' .
        '<input type="submit" value="' . BOUTON_RETOUR_PAGINATION . '" ' . $disabled . '/>' .
        '</form>';
    ?>
</td>
<td class="li_2">
    <?php 
    // Output count with a text suffix, replace " r�sultats" as needed
    echo $metier->compterMembresSuivantOptions($table, minuscule($type), minuscule($choix_pays), "liste") . " r�sultats"; 
    ?>
</td>
<td class="li_3">
    <?php 
    echo 'Page ' . $page . '/' . $nombreDePages; 
    ?>
</td>

										<td class="li_4">
<?php 
// Safe defaults
$page = defautPage($_GET['page'] ?? 1);
$type = $_GET['type'] ?? '0';
$choix_pays = $_GET['choix_pays'] ?? '0';

//-------- BOUTON PAGINATION AVANCER --------------
if (is_null($page) || $page == 0) {
    $num = 1;
} else {
    $num = $page + 1;
}

echo '<form action="' . HTTP_SERVEUR . FILENAME_ANNONCES_ECHANGE_MAISON . '" method="get">' .
    '<input type="hidden" name="page" value="' . $num . '"/>' .
    '<input type="hidden" name="type" value="' . htmlspecialchars($type) . '"/>' .
    '<input type="hidden" name="choix_pays" value="' . htmlspecialchars($choix_pays) . '"/>' .
    '<input type="submit" value="' . BOUTON_SUITE_PAGINATION . '"/>' .
    '</form>';
?>

										</td>
										<td class="li_5"><?php 
// Safe default values to prevent warnings
$page = defautPage($_GET['page'] ?? 1);
$type = $_GET['type'] ?? '0';
$choix_pays = $_GET['choix_pays'] ?? '0';

// MOTEUR DE PAGINATION
echo '<form action="'.HTTP_SERVEUR.FILENAME_ANNONCES_ECHANGE_MAISON.'" method="get">' .
    '<input type="text" name="page" value="'.htmlspecialchars($page).'" style="width:30px;"/>' .
    '<input type="hidden" name="type" value="'.htmlspecialchars($type).'"/>' .
    '<input type="hidden" name="choix_pays" value="'.htmlspecialchars($choix_pays).'"/>' .
    '<input type="submit" value="Go"/>' .
    '</form>';
?>

										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="bord_droit"></div>
					</td>
					<!-- PARTIE TCHAT -->
					<td class="titre_tchat">
						<div class="bord_gauche"></div>
						<div class="corps_top_tchat">
</div>
						<div class="bord_droit"></div>
					</td>
				</tr>
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td>
						 <div class="developpement">
						 	<div id="col_central"></div>
						</div>
					</td>
					<!-- PARTIE TCHAT -->
					<td>
						<div class="tchat">
							<!-- TCHAT -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo TOP_TITRE_TCHAT; ?></div>
							<div class="bord_d"></div>
							<div class="monTchat">
								<?php
								if(empty($_SESSION['pseudo_client'])){
									//BOUTON RENVOI INSCRIPTION
									echo '<p class="text_invitation_hors_connexion">'.MESSAGE_INVITATION_INSCRIPTION.'</p>';
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION.'"><img src="'.HTTP_IMAGE.'bt_inscription.jpg" alt="'.ATTRIBUT_ALT.'"/></a></div>';
								}
								else{
									//DEVELOPPEMENT DU TCHAT
									include(INCLUDE_MESSENGER);
								}
								?> 
							</div>
							<!-- PUBLICITE -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo ESPACE_PUBLICITAIRE; ?></div>
							<div class="bord_d"></div>
							<div class="maPub"></div>
							<!-- NOS CONSEILS & QUESTIONS -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo ESPACE_CONSEILS; ?></div>
							<div class="bord_d"></div>
							<div class="mesConseils">
								<p class="text1"><?php echo CONSEILS_TEXT_1; ?></p>
								<p class="text2"><?php echo CONSEILS_TEXT_2; ?></p>
								<p class="text3"><?php echo CONSEILS_TEXT_3; ?></p>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div id="derniers_inscrits"><?php include(INCLUDE_DERNIERS_INSCRITS_HORS_CONNEXION); ?></div>
		<?php echo connexionON(); ?>
	</div>
</div>
<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>
<!-- FIN EXTERIEUR -->

</body>
</html>