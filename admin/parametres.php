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

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_INDEX);
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
		echo '<h4>[Paramètres]</h4>';
		
		if(empty($_GET['action'])){
			echo '<div id="tab_listing_compte">' .
					'<table style="width:100%;">' .
						'<tr>' .
							'<th>DESCRIPTION</th>' ."\n".
							'<th>CONSULTER</th>' ."\n".
							'<th>MODIFIER</th>' ."\n".
						'</tr>' .
						'<tr>' .
							'<td>'.afficherIconeDrapeau("fr").' Gestion des libellés/Options</td>' .
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=consulter&type=libelle&lang=fr" title="Consulter les libéllés"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' ."\n".
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=libelle&lang=fr" title="Modifier les libéllés"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' ."\n".
						'</tr>' .
						'<tr>' .
							'<td style="background-color:#EFEFEF;">'.afficherIconeDrapeau("en").' Gestion des libellés/Options</td>' .
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=consulter&type=libelle&lang=en" title="Consulter les libéllés"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' ."\n".
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=libelle&lang=en" title="Modifier les libéllés"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' ."\n".
						'</tr>' .
						'<tr>' .
							'<td>'.afficherIconeDrapeau("es").' Gestion des libellés/Options</td>' .
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=consulter&type=libelle&lang=es" title="Consulter les libéllés"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' ."\n".
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=libelle&lang=es" title="Modifier les libéllés"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' ."\n".
						'</tr>' .
						'<tr>' .
							'<td style="background-color:#EFEFEF;">Paramètrage de la grille tarifaire</td>' .
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=consulter&type=tarif" title="Consulter la grille tarifaire"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' ."\n".
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=tarif" title="Modifier la grille tarifaire"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' ."\n".
						'</tr>' .
						'<tr>' .
							'<td>Condition de gratuité</td>' .
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=consulter&type=condition" title="Consulter les conditions de gratuité"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' ."\n".
							'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=condition" title="Modifier les conditions de gratuité"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' ."\n".
						'</tr>' .
					'</table>' .
				  '</div>';
		}
		elseif($_GET['action'] == "consulter"){
			if($_GET['type'] == "libelle"){
				include(INCLUDE_ADMIN_LIBELLES);
			}
			elseif($_GET['type'] == "tarif"){
				include(INCLUDE_ADMIN_TABLEAU_TARIF);
			}
			elseif($_GET['type'] == "condition"){
				include(INCLUDE_ADMIN_CONDITION_GRATUITE);
			}
			else{
				redirection(0, HTTP_ADMIN.FILENAME_PARAMETRES);
			}	
		}
		elseif($_GET['action'] == "modifier"){
			if($_GET['type'] == "libelle"){
				include(INCLUDE_ADMIN_MODIFIER_LIBELLES);
			}
			elseif($_GET['type'] == "tarif"){
				if(empty($_GET['section'])){
					include(INCLUDE_ADMIN_TABLEAU_TARIF);
				}
				elseif($_GET['section'] == "confirmation"){
					//TRAITEMENT DES DONNEES
					// Partie HOMME
					$abo_1_homme = minuscule($_POST['abo_1_homme']);
					$abo_3_homme = minuscule($_POST['abo_3_homme']);
					$abo_6_homme = minuscule($_POST['abo_6_homme']);
					$abo_12_homme = minuscule($_POST['abo_12_homme']);
					if(is_numeric($abo_1_homme) 
					AND is_numeric($abo_3_homme)
					AND is_numeric($abo_6_homme) 
					AND is_numeric($abo_12_homme)){
						//ENREGISTREMENT EN BASE --> HOMME
						$membre->updateElement(TABLE_ABO_HOMME, "formule", $abo_1_homme, "duree", 1);
						$membre->updateElement(TABLE_ABO_HOMME, "formule", $abo_3_homme, "duree", 3);
						$membre->updateElement(TABLE_ABO_HOMME, "formule", $abo_6_homme, "duree", 6);
						$membre->updateElement(TABLE_ABO_HOMME, "formule", $abo_12_homme, "duree", 12);
						
						messageErreur("Félicitation... Tables tarifaires mises à jour !");
						redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
					}
					else{
						//ERREUR
						messageErreur("Nous sommes désolés mais il est très important de mettre uniquement des caractères numériques !");
						redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
					}
				}
				else{
					redirection(0, HTTP_ADMIN.FILENAME_PARAMETRES);
				}
			}
			elseif($_GET['type'] == "condition"){
				if(empty($_GET['section'])){
					include(INCLUDE_ADMIN_CONDITION_GRATUITE);
				}
				elseif($_GET['section'] == "confirmation"){
					//TRAITEMENT DES DONNEES
					$compteur = $membre->compterCondition();
					for($i=1;$i<$compteur+1;$i++){
						$membre->updateElement(TABLE_CONDITION, "except", minuscule($_POST['except'.$i]), "id", minuscule($_POST['id_cond']));
					}
					messageErreur("Félicitation... la table des conditions a été mise à jour avec succès !");
					redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
				}
				elseif($_GET['section'] == "supprimer"){
					//TRAITEMENT DES DONNEES
					$membre->supprimerUnElement(TABLE_CONDITION,"id", minuscule($_GET['id_cond']));
					messageErreur("Félicitation... la table des conditions a été mise à jour avec succès !");
					redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
				}
				elseif($_GET['section'] == "off"){
					//Initialiser la tables des conditions
					$membre->initialiserTable(TABLE_CONDITION);
					messageErreur("Félicitation... la table des conditions a été ré-initialisé !");
					redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
				}
				else{
					redirection(0, HTTP_ADMIN.FILENAME_PARAMETRES);
				}
			}
			else{
				redirection(0, HTTP_ADMIN.FILENAME_PARAMETRES);
			}	
		}
		elseif($_GET['action'] == "ajouter"){
			//TRAITEMENT DES DONNEES
			if($_GET['type'] == "condition"){
				if($_GET['section'] == "confirmation"){
					//TRAITEMENT DES DONNEES
					$condition_existance = $metier->controleExistence("except",minuscule($_POST['except']),TABLE_CONDITION);
					
					if($condition_existance > 0){
						messageErreur("Nous sommes désolés mais cette condition est déjà référencée !");
						redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
					}
					elseif(minuscule($_POST['except']) == '0'){
						messageErreur("Nous sommes désolés mais cette condition est nul !");
						redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
					}
					else{
						$membre->insertionCondition(minuscule($_POST['except']));
						messageErreur("Félicitation... cette condition a été ajouté avec succès !");
						redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
					}
				}
				else{
					include(INCLUDE_ADMIN_CONDITION_GRATUITE);
				}	
			}
			else{
				redirection(0, HTTP_ADMIN.FILENAME_PARAMETRES);
			}
		}
		elseif($_GET['action'] == "confirmation-libelle"){
			$libelle = $membre->getTableId(TABLE_RUBRIQUES_ECHANGE.$_GET['lang']);
			
			foreach($libelle as $cle){
				$set_champs = minuscule($_POST['options'.$cle]);
				$membre->updateTableAdmin(TABLE_RUBRIQUES_ECHANGE.$_GET['lang'], "element", $set_champs, "id", $cle);
			}
			messageErreur("Félicitation... la table des libellés a été mise à jour avec succès !");
			redirection(3, HTTP_ADMIN.FILENAME_PARAMETRES);
		}	
		else{
			redirection(0, HTTP_ADMIN.FILENAME_PARAMETRES);
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>
