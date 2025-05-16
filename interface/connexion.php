<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
header('Content-Type: text/html; charset=ISO-8859-1'); // écrase l'entête utf-8 envoyé par php
ini_set( 'default_charset', 'ISO-8859-1' );
include('applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_LOGIN);
$login = new Login();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_CONNEXION);

	if(empty($_SESSION['pseudo_client'])){
		//PAS CONNECTER
		if(empty($_POST['login']) OR empty($_POST['passe'])){
			//RENVOI ACCUEIL
			redirection(0, HTTP_SERVEUR);
		}
		else{
			//ON TESTE
			$login_post = minuscule($_POST['login']);
			$passe_post_1 = textLibre($_POST['passe']);
			$passe_post = md5($passe_post_1);
			//RECUPERATION DES ELEMENTS
			$result_connexion =  $login->controleLogin($login_post, $passe_post_1);
			
			if($login_post == $result_connexion[1] AND $passe_post == md5($result_connexion[2])){
				//VERIFIER SI LE MEMBRE EST DEJA EN CONNEXION
				$deja_connecter = $login->controleExistenceConnexion('pseudo', $login_post, TABLE_ONLINE);
				
				if($deja_connecter > 0){
					//DEJA CONNECTER
					echo '<p style="font-size:20px;text-align:center;margin-top:80px;">'.TEXT_MEMBRE_DEJA_CONNECTE.'</p>';
					
					$metier->deleteConnexionMetier($result_connexion[0], $result_connexion[1]);
					//SUPPRIMER LA SESSION EN COURS
					redirection(4, HTTP_SERVEUR);
				}
				else{
					//LES ELEMENTS SONT BONS, RENVOI SUR ESPACE MEMBRE
					//C'est bon, place à la connexion
					commencerSession();
					
					$_SESSION['id_client'] = $result_connexion[0];//ID CLIENT
					$_SESSION['pseudo_client'] = $result_connexion[1];// PSEUDO DU CLIENT
					
					$date_de_cloture = time() + PERIODE_CONNEXION;
					//SE DECLARER DANS LA TABLE DES CONNECTES
					$login->ouvrirConnexion($result_connexion[0], 
											$result_connexion[1],
											$result_connexion[2], 
											time(), 
											$date_de_cloture, 
											$result_connexion[4], 
											$result_connexion[7], 
											$result_connexion[8],
											$result_connexion[9]);
					
					echo afficherAlerte("<img src=\"".HTTP_IMAGE."progressbar.gif\" alt=\"progressbar\" /><br />".MESSAGE_INTERMEDIAIRE);
					$type_annonce = $metier->getChamps("type_annonce",TABLE_INSCRIPTION,"id",$result_connexion[0]);
					if($type_annonce == TABLE_LISTING_ECHANGE_MAISON){
						//ECHANGE DE MAISON
						redirection(3, HTTP_SERVEUR.FILENAME_ECHANGE_MAISON);
					}
					elseif($type_annonce == TABLE_LISTING_COUCHSURFING){
						//COUCHSURFING
						redirection(3, HTTP_SERVEUR.FILENAME_COUCHSURFING);
					}
					else{
						redirection(3, HTTP_ESPACE_MEMBRE);
					}
					
				}
			}
			else{
				//ERREUR
				redirection(5, HTTP_SERVEUR);
				echo '<p style="font-size:20px;text-align:center;margin-top:80px;">'.TEXT_ECHEC.'</p>';
			}
		}
	}
	else{
		//RENVOI ACCUEIL
		redirection(0, HTTP_SERVEUR);
	}
?>