<?php
session_start() ;

if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_INSCRIPTION_GRATUITE);

					//TRAITEMENT DE LA PAGE DU FORMULAIRE
					if(empty($_POST['je_suis']) 
					OR empty($_POST['je_cherche']) 
					OR empty($_POST['pseudo']) 
					OR empty($_POST['mot_de_passe']) 
					OR empty($_POST['mot_de_passe_confirmation']) 
					OR empty($_POST['recherche_pays']) 
					OR empty($_POST['jour']) 
					OR empty($_POST['mois']) 
					OR empty($_POST['annee'])){
						redirection('0', HTTP_SERVEUR);
					}
					else{
						//PASSONS LES DIFFERENTS CAS DE TRAITEMENTS
						$formulaire_je_suis = minuscule($_POST['je_suis']);
						$formulaire_je_cherche = minuscule($_POST['je_cherche']);
						$formulaire_pseudo = minuscule($_POST['pseudo']);
						$formulaire_mot_de_passe = textLibre($_POST['mot_de_passe']);
						$formulaire_mot_de_passe_confirmation = textLibre($_POST['mot_de_passe_confirmation']);
						$formulaire_domiciliation = minuscule($_POST['recherche_pays']);
						$formulaire_departement = minuscule($_POST['departement']);
						$formulaire_jour_non = minuscule($_POST['jour']);
						$formulaire_mois_non = minuscule($_POST['mois']);
						$formulaire_annee = minuscule($_POST['annee']);
						$formulaire_email = minuscule($_POST['email']);
						$formulaire_photo = minuscule($_POST['photo']);
						//FORMATAGE DES CHIFFRES...
						$formulaire_jour = formaterChiffre($formulaire_jour_non);
						$formulaire_mois = formaterChiffre($formulaire_mois_non);
						
						$photo_size = $_FILES['photo']['size'];
						$photo_name = $_FILES['photo']['name'];
						$photo_tmp_name = $_FILES['photo']['tmp_name'];
						
						//-------- METTRE LES ELEMENTS EN SESSION -------------------
						if(empty($_SESSION['form_inscpt_je_suis'])){
							$_SESSION['form_inscpt_je_suis'] = $formulaire_je_suis;
						}
						else{
							unset($_SESSION['form_inscpt_je_suis']);
							$_SESSION['form_inscpt_je_suis'] = $formulaire_je_suis;
						}
						if(empty($_SESSION['form_inscpt_je_recherche'])){
							$_SESSION['form_inscpt_je_recherche'] = $formulaire_je_cherche;
						}
						else{
							unset($_SESSION['form_inscpt_je_recherche']);
							$_SESSION['form_inscpt_je_recherche'] = $formulaire_je_cherche;
						}
						if(empty($_SESSION['form_inscpt_pseudo'])){
							$_SESSION['form_inscpt_pseudo'] = $formulaire_pseudo;
						}
						else{
							unset($_SESSION['form_inscpt_pseudo']);
							$_SESSION['form_inscpt_pseudo'] = $formulaire_pseudo;
						}
						if(empty($_SESSION['form_inscpt_jour'])){
							$_SESSION['form_inscpt_jour'] = $formulaire_jour;
						}
						else{
							unset($_SESSION['form_inscpt_jour']);
							$_SESSION['form_inscpt_jour'] = $formulaire_jour;
						}
						if(empty($_SESSION['form_inscpt_mois'])){
							$_SESSION['form_inscpt_mois'] = $formulaire_mois;
						}
						else{
							unset($_SESSION['form_inscpt_mois']);
							$_SESSION['form_inscpt_mois'] = $formulaire_mois;
						}
						if(empty($_SESSION['form_inscpt_annee'])){
							$_SESSION['form_inscpt_annee'] = $formulaire_annee;
						}
						else{
							unset($_SESSION['form_inscpt_annee']);
							$_SESSION['form_inscpt_annee'] = $formulaire_annee;
						}
						if(empty($_SESSION['form_inscpt_email'])){
							$_SESSION['form_inscpt_email'] = $formulaire_email;
						}
						else{
							unset($_SESSION['form_inscpt_email']);
							$_SESSION['form_inscpt_email'] = $formulaire_email;
						}
						//-----------------------------------------------------------
						
						$ControleBasePseudo = $metier->controleExistence('pseudo', $formulaire_pseudo, TABLE_INSCRIPTION);
						$syntaxeEmail = conformEmail($formulaire_email);
						$ControleBaseEmail = $metier->controleExistence('email', $formulaire_email, TABLE_INSCRIPTION);
						
						//CAS 1 : VERIFIER SI LE PSEUDO EST SANS CARACTERES SPECIAUX
						$caractersSpeciauxPseudo = caractSpeciaux($formulaire_pseudo);
						if($caractersSpeciauxPseudo == 1){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_CARACTERES_SPECIAUX.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 2 : VERIFIER SI LE PSEUDO EST DEJA UTILISE
						elseif($ControleBasePseudo > 0){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_PSEUDO_DEJA_CONNU.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 3 : LES MOTS DE PASSES SONT DIFFERENTS
						elseif($formulaire_mot_de_passe != $formulaire_mot_de_passe_confirmation){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_MOTS_DE_PASSES_DIFFERENTS.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 4 : VERIFIER SI LA DATE DE NAISSANCE EST VALIDE
						elseif(!is_numeric($formulaire_jour) OR !is_numeric($formulaire_mois) OR !is_numeric($formulaire_annee)){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_DATE_DE_NAISSANCE.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 4-1 : VERIFIER SI ANNEE DE NAISSANCE EST VALIDE SUR 4 CHIFFRES
						elseif(strlen($formulaire_jour)!= 2 OR strlen($formulaire_mois)!= 2 OR strlen($formulaire_annee)!= 4 OR $formulaire_jour < 01 OR $formulaire_jour > 31 OR $formulaire_mois < 01 OR $formulaire_mois > 12 OR $formulaire_annee < 1930 OR $formulaire_annee > date('Y', time())){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_DATE_DE_NAISSANCE_FORMAT.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 4-2 : VERIFIER SI ANNEE DE NAISSANCE EST INFERIEUR A LA LIMITE AGE MAJORITE
						elseif($formulaire_annee > (date('Y', time()) - LIMITE_AGE_MAJORITE)){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_DATE_DE_NAISSANCE_MINEUR.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 5 : VERIFIER SI LES CGU SONT COCHEES
						elseif(empty($_POST['acceptation'])){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_CGU_NON_COCHEE.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 5-1 : VERIFIER SI EMAIL EST VALIDE
						elseif($syntaxeEmail == 0){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_SYNTAXE_EMAIL.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 5-2 : VERIFIER SI EMAIL EST RENSEIGNE
						elseif(empty($formulaire_email)){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_EMAIL_VIDE.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 6 : VERIFIER SI EMAIL DEJA UTILISE PAR AUTRE COMPTE
						elseif($ControleBaseEmail > 0){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_EMAIL_DEJA_UTILISE.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 6 : VERIFIER SI PAYS EST CORRECT
						elseif($formulaire_domiciliation == 0){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_PAYS_NON_SELECTIONNE.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						//CAS 7 : VERIFIER SI PAYS FRANCE MAIS DEPARTEMENT PAS RENSEIGNE
						elseif($formulaire_domiciliation == 5 AND $formulaire_departement == "x"){
							echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_DEPARTEMENT_NON_SELECTIONNE.'</p>';
							redirection('3', HTTP_SERVEUR);
						}
						else{
							$naissance = $formulaire_jour."/".$formulaire_mois."/".$formulaire_annee;
							$metier->insertNouveauCompte($formulaire_pseudo, 
														$formulaire_mot_de_passe, 
														time(), 
														$formulaire_je_suis, 
														$formulaire_je_cherche, 
														$formulaire_email, 
														recupIP(), 
														$formulaire_domiciliation, 
														$formulaire_departement, 
														$naissance);
														
							//C'est bon, place à la connexion
							$id_pseudo = $metier->getIdPseudo($formulaire_pseudo, $formulaire_mot_de_passe);
							commencerSession();
							$_SESSION['id_client'] = $id_pseudo;//ID CLIENT
							$_SESSION['pseudo_client'] = $formulaire_pseudo;// PSEUDO DU CLIENT
							$_SESSION['type_membre'] = $formulaire_je_suis;// TYPE DE MEMBRE
							$_SESSION['type_recherche'] = $formulaire_je_cherche;// TYPE DE RECHERCHE
							//AFFICHER LE TABLEAU DE CORRESPONDANCE POUR LA RECHERCHE
							$equivalence = $metier->equivalenceRecherche($formulaire_je_suis, $formulaire_je_cherche);
							$_SESSION['equivalence'] = $equivalence;// TABLEAU DES EQUIVALENCES
							
							//--------- RENSEIGNER TABLE DES CONNECTES -----------------------
							$date_de_cloture = time() + PERIODE_CONNEXION;
							//SE DECLARER DANS LA TABLE DES CONNECTES
							//$metier->ouvrirConnexionMetier($id_pseudo, $formulaire_pseudo, time(), $date_de_cloture);
							$metier->ajouterConnexion($_SESSION['id_client'],//identifiant
													$_SESSION['pseudo_client'],//pseudo 
													time(),//heure de connexion
													$date_de_cloture, //heure de deconnexion
													$formulaire_je_suis, //je suis
													$formulaire_je_cherche, //je recherche
													$formulaire_email, //email
													$formulaire_domiciliation, //pays
													$formulaire_departement, //departement
													$naissance);//date de naissance
							//--------------------------------------------------------------------
								
							//----- SUPPRIMER LES SESSIONS INSCRIPTIONS EN COURS --------
							unset($_SESSION['form_inscpt_je_suis']);
							unset($_SESSION['form_inscpt_je_recherche']);
							unset($_SESSION['form_inscpt_pseudo']);
							unset($_SESSION['form_inscpt_jour']);
							unset($_SESSION['form_inscpt_mois']);
							unset($_SESSION['form_inscpt_annee']);
							unset($_SESSION['form_inscpt_email']);
							//-----------------------------------------------------------
							
							//---------------------- CHARGEMENT DES IMAGES --------------------------------------------
							if(empty($photo_name)){
								//ON NE FAIT RIEN...
							}
							else{
								//CREATION STOCKAGE REPERTOIRE PAR ID
								creationRepertoireStockage(nommageRepertoire($_SESSION['id_client']));
								
								$tab_photo = $metier->chargementPhoto($photo_tmp_name, $photo_size, $photo_name, REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($_SESSION['id_client']), $_SESSION['pseudo_client'], nommageRepertoire($_SESSION['id_client']));
								
								if(is_numeric($tab_photo)){
									//ON NE FAIT RIEN...
								}
								else{
									//MISE A JOUR SUR LES TABLES INSCRIPTION ET CONNECTES
									$metier->updatePhotos(TABLE_INSCRIPTION ,$tab_photo, "id", $_SESSION['id_client']);
									$metier->updatePhotos(TABLE_ONLINE ,$tab_photo, "pseudo", $_SESSION['pseudo_client']);
								}	
							}
							//-----------------------------------------------------------------------------------------
							
							//RENSEIGNER LA TABLE DES NOUVEAUX INSCRITS
							$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $id_pseudo);
							if(empty($modif_existante) AND $id_pseudo == $_SESSION['id_client']){
								$metier->insertNouvelleInscription($id_pseudo, time()); 
							}
							echo afficherAlerte("<img src=\"".HTTP_IMAGE."progressbar.gif\" alt=\"progressbar\" /><br />".MESSAGE_INTERMEDIAIRE);
							redirection(3, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
							//ENVOI MAIL DE SERVICE
							envoiMailAlerte(MAIL_ENTETE, $_SESSION['pseudo_client'], $formulaire_mot_de_passe, $formulaire_email);
							
							
							$cloture = date("Y-m-d H:i:s", time());
							//INSERTION DANS LA TABLE
							$metier->ajouterPaiement($formulaire_pseudo,$cloture);
						}
					}
?>