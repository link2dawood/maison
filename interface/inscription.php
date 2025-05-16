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
includeLanguage(RACINE, LANGUAGE, FILENAME_FICHE_INSCRIPTION);

//TRAITEMENT DE LA PAGE DU FORMULAIRE
								if(empty($_POST['pseudo']) 
								OR empty($_POST['mot_de_passe']) 
								OR empty($_POST['mot_de_passe_confirmation']) 
								OR empty($_POST['num']) 
								OR empty($_POST['email']) 
								OR empty($_POST['image']) 
								OR empty($_POST['acceptation'])){
									echo afficherAlerte(FORMULAIRE_NON_CONFORME);
									redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
								}
								else{
									//PASSONS LES DIFFERENTS CAS DE TRAITEMENTS
									$formulaire_pseudo = minuscule($_POST['pseudo']);
									$formulaire_mot_de_passe = textLibre($_POST['mot_de_passe']);
									$formulaire_mot_de_passe_confirmation = textLibre($_POST['mot_de_passe_confirmation']);
									$formulaire_num = 'K'.minuscule($_POST['num']).'s';
									$formulaire_email = minuscule($_POST['email']);
									$formulaire_image = $_POST['image'];
									
									//-------- METTRE LES ELEMENTS EN SESSION -------------------
									if(empty($_SESSION['form_inscpt_pseudo'])){
										$_SESSION['form_inscpt_pseudo'] = $formulaire_pseudo;
									}
									else{
										unset($_SESSION['form_inscpt_pseudo']);
										$_SESSION['form_inscpt_pseudo'] = $formulaire_pseudo;
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
									if($formulaire_num != $formulaire_image){
										echo afficherAlerte(FORMULAIRE_ERREUR_CODE_ANTISPAM);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 2 : VERIFIER SI PAS DE CARACTERES SPECIAUX
									elseif($caractersSpeciauxPseudo == 1){
										echo afficherAlerte(FORMULAIRE_ERREUR_CARACTERES_SPECIAUX);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 3 : VERIFIER SI LE PSEUDO EST DEJA UTILISE
									elseif($ControleBasePseudo > 0){
										echo afficherAlerte(FORMULAIRE_ERREUR_PSEUDO_DEJA_CONNU);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 4 : LES MOTS DE PASSES SONT DIFFERENTS
									elseif($formulaire_mot_de_passe != $formulaire_mot_de_passe_confirmation){
										echo afficherAlerte(FORMULAIRE_ERREUR_MOTS_DE_PASSES_DIFFERENTS);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 5 : VERIFIER SI LES CGU SONT COCHEES
									elseif(empty($_POST['acceptation'])){
										echo afficherAlerte(FORMULAIRE_ERREUR_CGU_NON_COCHEE);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 6 : VERIFIER SI EMAIL EST VALIDE
									elseif($syntaxeEmail == 0){
										echo afficherAlerte(FORMULAIRE_ERREUR_SYNTAXE_EMAIL);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 7 : VERIFIER SI EMAIL EST RENSEIGNE
									elseif(empty($formulaire_email)){
										echo afficherAlerte(FORMULAIRE_ERREUR_EMAIL_VIDE);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									//CAS 8 : VERIFIER SI EMAIL DEJA UTILISE PAR AUTRE COMPTE
									elseif($ControleBaseEmail > 0){
										echo afficherAlerte(FORMULAIRE_ERREUR_EMAIL_DEJA_UTILISE);
										redirection('3', HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION);
									}
									else{
										
										$metier->insertNouveauCompte($formulaire_pseudo, 
																	$formulaire_mot_de_passe, 
																	time(), 
																	$formulaire_email, 
																	recupIP());
																	
										//C'est bon, place à la connexion
										$id_pseudo = $metier->getIdPseudo($formulaire_pseudo, $formulaire_mot_de_passe);
										commencerSession();
										$_SESSION['id_client'] = $id_pseudo;//ID CLIENT
										$_SESSION['pseudo_client'] = $formulaire_pseudo;// PSEUDO DU CLIENT
										//AFFICHER LE TABLEAU DE CORRESPONDANCE POUR LA RECHERCHE
										
										//--------- RENSEIGNER TABLE DES CONNECTES -----------------------
										$date_de_cloture = time() + PERIODE_CONNEXION;
										//SE DECLARER DANS LA TABLE DES CONNECTES
										$metier->ajouterConnexion($_SESSION['id_client'],//identifiant
																$_SESSION['pseudo_client'],//pseudo 
																$formulaire_mot_de_passe,//mot de passe
																time(),//heure de connexion
																$date_de_cloture, //heure de deconnexion
																$formulaire_email);//date de naissance
										//----- SUPPRIMER LES SESSIONS INSCRIPTIONS EN COURS --------
										unset($_SESSION['form_inscpt_pseudo']);
										unset($_SESSION['form_inscpt_email']);
										//----------------------------------------------------------
										
										//RENSEIGNER LA TABLE DES NOUVEAUX INSCRITS
										$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $id_pseudo);
										if(empty($modif_existante) AND $id_pseudo == $_SESSION['id_client']){
											$metier->insertNouvelleInscription($id_pseudo, time()); 
										}
										redirection(0, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
										//ENVOI MAIL DE SERVICE
										envoiMailAlerte(MAIL_ENTETE, $_SESSION['pseudo_client'], $formulaire_mot_de_passe, $formulaire_email);
										
										$cloture = date("Y-m-d H:i:s", time());
										//INSERTION DANS LA TABLE
										$metier->ajouterPaiement($formulaire_pseudo,$cloture);
									}
								}
?>
