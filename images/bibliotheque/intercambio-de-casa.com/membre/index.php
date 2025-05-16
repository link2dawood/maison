<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

$out = minuscule($_GET['out']);
if($out == "ok"){
	$membre->supprimerUnElement(TABLE_TCHAT_DISCUSSION,"identifiant",$_SESSION['id_client']);
	$membre->supprimerUnElement(TABLE_TCHAT_LISTE_CONNECTES,"identifiant",$_SESSION['id_client']);
}

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_ESPACE_MEMBRE_INDEX);
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
			<?php echo afficherLogin($_SESSION['pseudo_client'], HTTP_SERVEUR); ?>
			<h1><?php echo H1_DE_LA_PAGE; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client']); ?></div>
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
						<div class="corps_top_developpement"><?php echo H2_DE_LA_PAGE; ?></div>
						<div class="bord_droit"></div>
					</td>
					<!-- PARTIE TCHAT -->
					<td class="titre_tchat">
						<div class="bord_gauche"></div>
						<div class="corps_top_tchat">
						<?php
						if(empty($_SESSION['pseudo_client'])){
							//ON NE FAIT RIEN...
						}
						else{
							$msg_envoyes = $membre->compterMessagesDuMembreCommeExpediteur(TABLE_MESSENGER, $_SESSION['id_client'], $_SESSION['pseudo_client'], "non");
							$recus = $membre->compterMessagesDuMembreCommeDestinataire(TABLE_MESSENGER, $_SESSION['id_client'], $_SESSION['pseudo_client'], "non");
						}
						echo afficherCompteurMessages($_SESSION['pseudo_client'], $recus, $msg_envoyes);
						?></div>
						<div class="bord_droit"></div>
					</td>
				</tr>
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td>
						 <div class="developpement">
						 	<?php
						 	if(empty($_SESSION['pseudo_client'])){
						 		include(INCLUDE_LOGIN);
						 	}
						 	else{
						 		$compte = $metier->getOnlineMembre($_SESSION['id_client']);
						 		$identite = $membre->getTable(TABLE_IDENTITE, "identifiant", $_SESSION['id_client']);
						 		$paiement = $membre->getTable(TABLE_PAIEMENTS, "pseudo", $_SESSION['pseudo_client']);
						 		?>
						 		<ul id="espace_membre">
						 			<li class="mon_identite">
						 				<table>
						 					<tr>
						 						<td colspan="5" class="titre"><?php echo IDENTITE_TITRE; ?></td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo IDENTITE_PSEUDO; ?></td>
						 						<td class="donnees"><?php echo $_SESSION['pseudo_client']; ?></td>
						 						<td class="data"><?php echo IDENTITE_PASSE; ?></td>
						 						<td class="donnees"><div style="color:red;" onClick="montrerPasse('<?php echo FENETRE_ACTIVE_PASSE_ALERTE; ?><?php echo $compte->passe; ?>')"> >> <?php echo FENETRE_ACTIVE_PASSE; ?></div></td>
						 						<td class="lien"></td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo IDENTITE_NOM; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($identite->nom); ?></td>
						 						<td class="data"><?php echo IDENTITE_PRENOM; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($identite->prenom); ?></td>
						 						<td class="lien">
						 							<?php
						 							 if(empty($identite->nom)){
						 							 	echo '<span id="non_communique">'.IDENTITE_BOUTON.'</span>';
						 							 }
						 							 else{
						 							 	echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=1',400,200,IDENTITE_BOUTON);
						 							 }
						 							 ?>
						 						</td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo IDENTITE_ADRESSE; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($identite->adresse); ?></td>
						 						<td class="data"><?php echo IDENTITE_CODE_POSTAL; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($identite->code_postal); ?></td>
						 						<td class="lien">
						 							<?php
						 							 if(empty($identite->adresse)){
						 							 	echo '<span id="non_communique">'.IDENTITE_BOUTON.'</span>';
						 							 }
						 							 else{
						 							 	echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=2',400,200,IDENTITE_BOUTON);
						 							 }
						 							 ?>
						 						</td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo IDENTITE_VILLE; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($identite->ville); ?></td>
						 						<td class="data"><?php echo IDENTITE_PAYS; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($membre->getChamps("pays", "pays_".LANGUAGE, "id",$identite->pays)); ?></td>
						 						<td class="lien">
						 							<?php
						 							 if(empty($identite->ville)){
						 							 	echo '<span id="non_communique">'.IDENTITE_BOUTON.'</span>';
						 							 }
						 							 else{
						 							 	echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=3',400,200,IDENTITE_BOUTON);
						 							 }
						 							 ?>
						 						</td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo IDENTITE_EMAIL; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($compte->email); ?></td>
						 						<td class="data"><?php echo IDENTITE_PROFESSION; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($metier->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange)); ?></td>
						 						<td class="lien">
						 							<?php
						 							if($identite->type_echange > 0 AND $identite->type_echange <= 6){
														$section = 'echange';
													}
													else{
														$section = 'couchsurfing';
													}
						 							 
						 							 if(empty($identite->type_echange)){
						 							 	echo '<span id="non_communique">'.IDENTITE_BOUTON.'</span>';
						 							 }
						 							 else{
						 							 	echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=4&tpe='.$section,400,200,IDENTITE_BOUTON);
						 							 }
						 							 ?>
						 						</td>
						 					</tr>
						 				</table>
						 			</li>
						 			<li class="mon_annonce">
						 				<div class="espacement_1"></div>
						 				<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_DEPOT_ANNONCE; ?>" method="get">
						 				<table>
						 					<tr>
						 						<td colspan="4" class="titre"><?php echo MON_ANNONCE_TITRE; ?></td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo MON_ANNONCE_DEPOSER; ?> <input type="hidden" name="action" value="aj"/></td>
						 						<td class="data1"><input type="radio" class="radio" name="tpe" value="echange" /> <?php echo MON_ANNONCE_LIBELLE_ECHANGE; ?></td>
						 						<td class="data2"><input type="radio" class="radio" name="tpe" value="couchsurfing" /> <?php echo MON_ANNONCE_LIBELLE_COUCHSURFING; ?></td>
						 						<td class="submit"><input type="submit" value="<?php echo MON_ANNONCE_VALIDER; ?>" /></td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo MON_ANNONCE_EN_COURS; ?></td>
						 						<td class="lien">
						 							<?php
						 							 if(empty($identite->nom)){
						 							 	echo '<span id="non_communique">'.MON_ANNONCE_VOIR.'</span>';
						 							 }
						 							 else{
						 							 	
						 							 	if($identite->nom){
						 							 		if($compte->en_ligne == "ok"){
						 							 			echo '<a href="'.HTTP_SERVEUR.'profil-'.$_SESSION['id_client'].'.php">'.MON_ANNONCE_VOIR.'</a> '.MESSAGE_INFO_ANNONCE_VALIDE ;
						 							 		}
						 							 		else{
						 							 			echo '<a href="'.HTTP_SERVEUR.'profil-'.$_SESSION['id_client'].'.php">'.MON_ANNONCE_VOIR.'</a> '.MESSAGE_INFO_ANNONCE_EN_ATTENTE;
						 							 		}
						 							 	}
						 							 	else{
						 							 		echo '<span id="non_communique">'.MON_ANNONCE_VOIR.'</span>';
						 							 	}
						 							 }
						 							 ?>
						 						</td>
						 						<td class="lien">
						 							<?php
						 							 if(empty($identite->nom)){
						 							 	echo '<span id="non_communique">'.MON_ANNONCE_MODIFIER.'</span>';
						 							 }
						 							 else{
						 							 	if($compte->type_annonce == TABLE_LISTING_COUCHSURFING){
						 							 		echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_ACTION_SUR_ANNONCE.'?action=md&tpe=couchsurfing">'.MON_ANNONCE_MODIFIER.'</a>';
						 							 	}
						 							 	elseif($compte->type_annonce == TABLE_LISTING_ECHANGE_MAISON){
						 							 		echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_ACTION_SUR_ANNONCE.'?action=md&tpe=echange">'.MON_ANNONCE_MODIFIER.'</a>';
						 							 	}
						 							 	else{
						 							 		echo '<span id="non_communique">'.MON_ANNONCE_MODIFIER.'</span>';
						 							 	}
						 							 }
						 							 ?>
						 						</td>
						 						<td class="lien">
						 							<?php
						 							 if(empty($identite->nom)){
						 							 	echo '<span id="non_communique">'.MON_ANNONCE_SUPPRIMER.'</span>';
						 							 }
						 							 else{
						 							 	if($compte->type_annonce == TABLE_LISTING_COUCHSURFING){
						 							 		?>
						 							 		<form>
						 							 			<input type="button" onClick="confirmRefresh('<?php echo HTTP_SERVEUR.'interface/'.FILENAME_ACTION_SUR_ANNONCE.'?action=sm&tpe=couchsurfing'; ?>','<?php echo CONFIRMATION_MESSAGE_JAVASCRIPT; ?>','<?php echo CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE; ?>','<?php echo CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE_KO; ?>')" value="<?php echo MON_ANNONCE_SUPPRIMER; ?>"/>
						 							 		</form>
						 							 		<?php
						 							 	}
						 							 	elseif($compte->type_annonce == TABLE_LISTING_ECHANGE_MAISON){
						 							 		?>
						 							 		<form>
						 							 			<input type="button" onClick="confirmRefresh('<?php echo HTTP_SERVEUR.'interface/'.FILENAME_ACTION_SUR_ANNONCE.'?action=sm&tpe=echange'; ?>','<?php echo CONFIRMATION_MESSAGE_JAVASCRIPT; ?>','<?php echo CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE; ?>','<?php echo CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE_KO; ?>')" value="<?php echo MON_ANNONCE_SUPPRIMER; ?>"/>
						 							 		</form>
						 							 		<?php
						 							 	}
						 							 	else{
						 							 		echo '<span id="non_communique">'.MON_ANNONCE_SUPPRIMER.'</span>';
						 							 	}
						 							 }
						 							 ?>
						 						</td>
						 					</tr>
						 				</table>
						 				</form>
						 			</li>
						 			<li class="mon_abonnement">
						 				<div class="espacement_1"></div>
						 				<table>
						 					<tr>
						 						<td colspan="6" class="titre"><?php echo MON_ABONNEMENT_TITRE; ?></td>
						 					</tr>
						 					<tr>
						 						<td class="data"><?php echo MON_ABONNEMENT_DATE_DEBUT; ?></td>
						 						<td class="donnees"><?php echo nonCommunique($paiement->date_debut); ?></td>
						 						<td class="data"><?php echo MON_ABONNEMENT_DATE_FIN; ?></td>
						 						<td class="donnees">
						 							<?php
						 							if($paiement->gratuit == 1){
						 								echo MON_ABONNEMENT_GRATUIT;
						 							} 
						 							else{
						 								echo nonCommunique($paiement->date_fin);
						 							}
						 							?>
						 						</td>
						 						<td class="lien">
						 							<?php
						 							$historique = $membre->compterUnElement(TABLE_HISTORIQUE_PAIEMENT,"pseudo",$_SESSION['pseudo_client']);
						 							
						 							if($historique > 0){
						 								echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_HISTORIQUE_PAIEMENT.'">'.MON_ABONNEMENT_HISTORIQUE.'</a>';
						 							} 
						 							else{
						 								echo '<span id="non_communique">'.MON_ABONNEMENT_HISTORIQUE.'</span>';
						 							}
						 							?>
						 						</td>
						 						<td class="lien_1">
						 							<?php
						 							if($paiement->gratuit == 0 AND $paiement->online == 0 AND strtotime($paiement->date_fin) < time()){
						 								echo '<a href="'.HTTP_PAIEMENT.'">'.MON_ABONNEMENT_SOUSCRIRE.'</a>';
						 							} 
						 							else{
						 								if($paiement->gratuit == 1){
							 								echo '<span id="non_communique">'.MON_ABONNEMENT_SOUSCRIRE.'</span>';
							 							} 
							 							else{
							 								//RENOUVELLER SON ABONNEMENT
							 								echo '<a href="'.HTTP_PAIEMENT.'">'.MON_ABONNEMENT_RENOUVELLEMENT.'</a>';
							 							}
						 							}
						 							?>
						 						</td>
						 					</tr>
						 				</table>
						 			</li>
						 			<li class="moteur_pseudo">
						 				<div class="espacement_1"></div>	
						 				<div id="espace_service_easyPseudo">
											<p><?php echo EASYPSEUDO_TITRE; ?></p>
											<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MOTEUR_EASYPSEUDO; ?>" method="post">
												<table>
													<tr>
														<td class="libelle"><?php echo EASYPSEUDO_LIBELLE; ?></td>
														<td class="input"><input type="text" name="easypseudo" value="............" /></td>
														<td class="submit"><input type="submit" value="<?php echo EASYPSEUDO_SUBMIT; ?>" /></td>
													</tr>
												</table>
											</form>
										</div>
						 			</li>
						 			<li class="mes_contacts_favoris">
						 				<div class="espacement_1"></div>
						 				<p><?php echo FAVORI_TITRE; ?></p>
							 			<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_FAVORIS; ?>" method="post">
							 				<table class="mes_favoris">
							 					<tr>
							 						<td class="fav_1">
							 						<input type="hidden" name="supp" value="suppression" />
							 						<?php
										 				//LISTING DES FAVORIS
										 				$favori = $membre->getFavori($_SESSION['id_client'],"supprimer",0,10);
										 				foreach($favori as $cle){
										 					echo $cle;
										 				}
										 				?>
							 						</td>
							 						<td class="fav_2">
							 							<?php
							 							 $compter_favori = $membre->compterVisitesParIdClient($_SESSION['id_client']);
							 							 if($compter_favori == 0){
							 							 	echo '<input type="submit" value="'.MON_ANNONCE_SUPPRIMER.'" disabled/>';
							 							 	echo '<br /><span id="non_communique">'.FAVORI_ANCHOR.'</span>';
							 							 }
							 							 else{
							 							 	echo '<input type="submit" value="'.MON_ANNONCE_SUPPRIMER.'" />';
							 							 	echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_FAVORIS.'">'.FAVORI_ANCHOR.'</a>';
							 							 }
							 							 ?>
							 						</td>
							 					<tr>
							 				</table>
							 			</form>
						 			</li>
						 			<li class="mes_voyages">
						 				<div class="espacement_1"></div>
						 				<p><?php echo VOYAGES_COMMENTAIRES_TITRE; ?></p>
						 				<table>
											 <tr>
											 	<td class="data"><?php echo VOYAGES_COMMENTAIRES_TEXTE; ?></td>
											 	<td class="lien">
											 		<?php
											 		$mon_commentaire = $membre->getTable(TABLE_LIVRE_DOR,"pseudo_livre_dor",$_SESSION['pseudo_client']);
											 		if($mon_commentaire->commentaire_livre_dor){
											 			if($mon_commentaire->accepter_message){
											 				echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_COMMENTAIRES_GESTION.'?act=2">'.VOYAGES_COMMENTAIRES_EN_LIGNE.'</a>';
											 			}
											 			else{
											 				echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_COMMENTAIRES_GESTION.'?act=3">'.VOYAGES_COMMENTAIRES_EN_ATTENTE.'</a>';
											 			}
											 		}
											 		else{
											 			echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_COMMENTAIRES_GESTION.'?act=1">'.VOYAGES_COMMENTAIRES_AJOUTER.'</a>';
											 		}
											 		?>
											 	</td>
											 	<td class="data"><?php echo VOYAGES_COMMENTAIRES_BLOG; ?></td>
											 	<td class="lien"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION; ?>"><?php echo VOYAGES_COMMENTAIRES_BLOG_CREER; ?></a></td>
											 </tr>
										</table>
						 			</li>
						 			<li class="mes_blacklistes">
						 				<div class="espacement_1"></div>
						 				<p class="titre"><?php echo ESPACE_BLACKLISTAGE_TITRE; ?></p>
						 				<table>
						 					<tr>
						 						<td><p class="texte"><?php echo ESPACE_BLACKLISTAGE_TEXTE; ?></p></td>
						 						<td class="lien"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_BLACKLIST; ?>"><?php echo MENU_BLACKLIST; ?></a></td>
						 					</tr>
						 				</table>
						 			</li>
						 			<li class="mon_compte">
						 				<div class="espacement_1"></div>
						 				<p class="titre"><?php echo MON_COMPTE_TITRE; ?></p>
						 				<div id="desincription">
						 					<form method="post" action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MON_COMPTE; ?>">
						 						<table class="desinscription1">
						 							<tr>
						 								<td>
						 									<table class="desinscription2">
											 					<tr>
											 						<td class="data"><?php echo MON_COMPTE_PASSE_1; ?></td>
											 						<td class="input"><input type="password" name="passe1" /></td>
											 					</tr>
											 					<tr>
											 						<td class="data"><?php echo MON_COMPTE_PASSE_2; ?></td>
											 						<td class="input"><input type="password" name="passe2" /></td>
											 					</tr>
											 				</table>
						 								</td>
						 								<td class="submit"><input type="submit" value="<?php echo MON_COMPTE__DESINSCRIPTION; ?>" /></td>
						 							</tr>
						 						</table>
						 					</form>
						 					<p class="texte"><em><?php echo MON_COMPTE_DESCRIPTION; ?></em></p>
						 				</div>
						 			</li>
						 		</ul>
						 		<?php
						 	}
						 	?>
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
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_A); ?></div>
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