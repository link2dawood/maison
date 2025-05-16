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

//Enregistrer le nouveau membre connecté
if(minuscule($_GET['sl'])){
	$deja_dans_salon = $membre->compterUnElement(TABLE_TCHAT_LISTE_CONNECTES,"identifiant",$_SESSION['id_client']);
	if($deja_dans_salon < 1){
		$membre->insertNouveauMembreSalon($_SESSION['id_client'],minuscule($_GET['sl']),time());
	}
}
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
    <script language="javascript">
		new Ajax.PeriodicalUpdater(
		    'fenetre',
		    '<?php echo HTTP_SERVEUR.'interface/'.FILENAME_TCHAT_FENETRE.'?sl='.minuscule($_GET['sl']); ?>',
		    {
		        frequency: <?php echo RAFRAICHISSEMENT_MESSAGES_DUO_WEBCAMS; ?>
		    }
		);
    </script>
    <script language="javascript">
		new Ajax.PeriodicalUpdater(
		    'list_connectes',
		    '<?php echo HTTP_SERVEUR.'interface/'.FILENAME_TCHAT_LISTE_CONNECTER.'?sl='.minuscule($_GET['sl']); ?>',
		    {
		        frequency: <?php echo RAFRAICHISSEMENT_MESSAGES_DUO_WEBCAMS; ?>
		    }
		);
    </script>
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
					if(empty($_GET['sl']) OR !is_numeric($_GET['sl'])){
						messageErreur(TEXTE_2);
						redirection(3,HTTP_TCHAT);
					}
					else{
						echo '<h2>'.TEXTE_3.' <img src="'.HTTP_DRAPEAUX.minuscule($_GET['sl']).'.png" alt="icone"/>  ('.$membre->getChamps("pays","pays_".LANGUAGE,"id",minuscule($_GET['sl'])).')</h2>';
						//------------------------------------------------------------------------------------
						//                               SALON DE DISCUSSION
						//------------------------------------------------------------------------------------
						?>
						<table id="salon">
							<tr>
								<!-- ESPACE LISTE CONNECTER -->
								<th><?php echo TEXTE_4; ?></th>
								<!-- ESPACE FENETRE CENTRALE -->
								<th><?php echo TEXTE_5; ?></th>
							</tr>
							<tr>
								<!-- ESPACE LISTE CONNECTER -->
								<td class="col_g">
									<div id="list_connectes"></div>
								</td>
								<!-- ESPACE FENETRE CENTRALE -->
								<td class="col_d">
									<div id="fenetre"></div>
									<br />
									<div class="formulaire_envoi">
										<form>
											<ul>
												<li style="font-weight:bolder;"><?php echo TEXTE_6; ?></li>
												<li style="text-align:right;">
													<img src="<?php echo HTTP_IMAGE; ?>fleche_ecrire.png" alt="icone"/> <textarea name="commentaire" id="message" cols="65" rows="4" onkeypress="entreeClavier(event);"></textarea>
													<input type="hidden" id="id_client" name="id_client" value="<?php echo $_SESSION['id_client']; ?>"/>
													<input type="hidden" id="pays" name="pays" value="<?php echo minuscule($_GET['sl']); ?>"/>
												</li>
												<li class="bt_send_msg"><input type="button" name="bt_submit" onClick="nouveauMessageTchat()" value="<?php echo TEXTE_7; ?>"/></li>
											</ul>
										</form>
									</div>
								</td>
							</tr>
						</table>
						<div class="bt_out">
							<p><?php echo TEXTE_10; ?></p>
							<p style="text-align:center;margin-top:20px;"><a href="<?php echo HTTP_ESPACE_MEMBRE; ?>?out=ok"><img src="<?php echo HTTP_IMAGE; ?>bt_out.png" alt="bt_out"/></a></p>
							<p style="text-align:justify;font-size:10px;margin-top:10px;margin-left:5px;"><?php echo TEXTE_11; ?></p>
						</div>
						<p id="barre"></p>
						<?php
					}
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