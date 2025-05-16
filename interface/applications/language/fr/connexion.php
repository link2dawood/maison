<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


/*
 * PAGE INDEX LANGUAGE FRANCAIS 
 */
if (!defined('HEADER_TITLE')) define('HEADER_TITLE', '...');
if (!defined('HEADER_DESCRIPTION')) define('HEADER_DESCRIPTION', '...');
if (!defined('HEADER_KEYWORDS')) define('HEADER_KEYWORDS', '...');
define('HTTP_WARNING', 'Avertissement');
if (!defined('FILENAME_PAGE_PAIEMENT')) define('FILENAME_PAGE_PAIEMENT', 'paiement-ligne.php');

define('CONNEXION_DEJA_INSCRITS', 'Vous tes dj inscrits');
define('CONNEXION_PSEUDO', 'Pseudonyme');
define('CONNEXION_PASSE', 'Passe : ');
define('CONNEXION_LIEN_ANCHOR', 'Mot de passe perdu?');
define('CONNEXION_MESSAGE_ACCUEIL', 'Bonjour...');
define('CONNEXION_LIEN_ANCHOR_ESPACE_MEMBRE', 'Espace en direct');
define('CONNEXION_LIEN_ANCHOR_DECONNEXION', 'Dconnexion');
define('CONNEXION_IMAGE_SUBMIT', 'login_ok.gif');
define('CONNEXION_LIEN_DEVENIR_MEMBRE', 'DEVENEZ MEMBRE GRATUITEMENT');

define('TEXT_ECHEC', 'Nous sommes dsols mais une erreur est survenue!<br />' .
		'Votre pseudo ou mot de passe n\'est pas conforme !<br />' .
		'Vous allez tre redirig pour un nouvel essai...');
define('TEXT_MEMBRE_DEJA_CONNECTE', 'Dsol une erreur est survenue lors de la connexion. Veuillez recommencer !');
		
define('ERREUR_DEJA_CONNECTER', 'Nous sommes dsols mais un utilisateur est dj connect sur le compte.');

define('PAYS_TOP', 'Choisir un pays');
define('PAYS_FRANCE', 'France');
define('PAYS_FRANCE_ID', '5');
define('PAYS_BELGIQUE', 'Belgique');
define('PAYS_BELGIQUE_ID', '37');
define('PAYS_SUISSE', 'Suisse');
define('PAYS_SUISSE_ID', '16');
define('PAYS_DEPARTEMENTS_TOP', 'Choisir');

define('MENU_MEMBRE_OFFLINE', 'Membres offline');
define('MENU_MEMBRE_ONLINE', 'Membres online');
define('MENU_MON_PROFIL', 'Mon profil');
define('MENU_MON_COMPTE', 'Mon compte');
define('MENU_MESSAGERIE', 'Messagerie');
define('MENU_BLACKLIST', 'Liste noire');
define('MENU_VISITER_PROFIL', 'visite(s) sur mon profil');
//PARTIE MENU CLIENT...
define('MENU_ACCUEIL', 'Accueil');
define('MENU_ESPACE_MEMBRE', 'Espace membre');
define('MENU_CGU', 'CGU');
define('MENU_PUBLICITE', 'Publicit');
define('MENU_CONSEILLER_SITE', 'Conseiller ce site');
define('MENU_PLAN_SITE', 'Plan du site');
define('MENU_PARTENAIRES', 'Partenaires');
define('MENU_LISTES_LIENS', 'Pays');
define('MENU_RECHERCHE_AVANCEE', 'Recherche avance');
define('MENU_COUCHSURFING', 'Hbergement');
define('MENU_ECHANGE_MAISON', 'Echange de maison');
define('MENU_INSCRIPTION', 'Inscription');
define('MENU_BLOG', 'Blog du site');
define('MENU_DEPOT_ANNONCE', 'Dposer annonce');
define('MENU_MES_VOYAGES', 'Mes voyages');

define('MESSAGE_INVITATION_INSCRIPTION', HTTP_WARNING.' Ami(e) internaute.<br />' .
										'Pour bnficier de l\'ensemble de nos services, nous vous invitons  vous enregistrer gratuitement et passer votre annonce d\'<strong>change de maison</strong> ou <strong>d\'hbergement pour des vacances gratuites</strong>.<br />Bnficiez de fonctionnalits innovantes et ingalables avec une simple webcam, mettre ses contacts en favori,etc...!<br />' .
										'Enregistrez-vous gratuitement sans plus attendre !<br />' .
										'Rejoignez notre communaut internationale!');
define('AUCUNE_INFORMATION', 'Aucune information...');
define('TITRE_DERNIERS_INSCRITS_MEMBRES', 'Derniers inscrits');

define('BOUTON_RETOUR_PAGINATION', '<< retour');
define('BOUTON_SUITE_PAGINATION', 'suite >>');
define('BOUTON_RECHERCHER', 'bt_rechercher_fr.gif');
define('BOUTON_OK', 'ok.jpg');

define('SUBMIT', 'envoyer');

define('ICONE_TEXTE_MEMBRE_BLACKLISTER', '<span style="color:red;font-size:10px;">ne pas tre contact !</span>');

define('MESSAGE_INTERMEDIAIRE', 'Vous allez tre redirig !');

define('MESSAGE_EXPEDITEUR_ANNULE', 'ATTENTION... nous avons annul votre demande!<br />Vous vous tes envoy un message !');
define('MESSAGE_FLV_NON_PRESENT_SERVEUR', 'ATTENTION... nous avons annul votre demande!<br />Aucun fichier AUDIO ou VIDEO n\'a t enregistr!');

define('TEXT_MODULE_RECHERCHE_1', 'Rechercher :');
define('TEXT_MODULE_RECHERCHE', 'O :');
define('OPTION_1_MODULE_RECHERCHE', 'Statut :');
define('OPTION_2_MODULE_RECHERCHE', 'Connects');
define('OPTION_3_MODULE_RECHERCHE', 'Non connects');
define('OPTION_4_MODULE_RECHERCHE', 'Tous');
define('SUBMIT_MODULE_RECHERCHE', ' Rechercher ');

define('TOP_TITRE_TCHAT', 'Tchat et messages instantans');
define('ESPACE_PUBLICITAIRE', 'Espace publicitaire');
define('ESPACE_PUBLICITAIRE_LIEN', 'Votre publicit ici');
define('ESPACE_CONSEILS', 'Nos conseils & vos questions');
define('TCHAT_MESSAGES_NON_LUS', 'Message(s) non lu(s):reu(s): ');
define('TCHAT_MESSAGES_NON_LUS_ENVOYES', ' / envoys: ');

define('NB_MESSAGES_RECEPTION', 'Messages(s) reu(s) : ');
define('LIBELLE_DATE_TOP', 'Le : ');

define('MAIL_OFFLINE_ENTETE', 'Nouveau message');
define('MAIL_OFFLINE_MSG_H1', '<h1 style="text-align:center;">NOUVEAU MESSAGE</h1>');
define('MAIL_OFFLINE_MSG_1', 'Bonjour ');
define('MAIL_OFFLINE_MSG_2', 'Vous recevez ce message car le membre :');
define('MAIL_OFFLINE_MSG_3', 'vous a envoy un nouveau message dans votre boite de messagerie!');
define('MAIL_OFFLINE_MSG_4', 'Date d\'envoi:');
define('MAIL_OFFLINE_MSG_5', 'Pseudo de l\'expditeur:');
define('MAIL_OFFLINE_MSG_6', 'Sa fiche dtaille:');
define('MAIL_OFFLINE_MSG_7', 'Type de message:');
define('MAIL_OFFLINE_MSG_8', 'Message texte');
define('MAIL_OFFLINE_MSG_9', 'Message audio');
define('MAIL_OFFLINE_MSG_10', 'Message vido');
define('MAIL_OFFLINE_MSG_11', 'Pour lire celui-ci, veuillez suivre le lien suivant: <a href="'.HTTP_SERVEUR.'">Mon espace membre</a>');
define('MAIL_OFFLINE_MSG_12', 'Toute l\'quipe de www.vacanceshome.com vous remercie vivement de votre confiance et vous souhaite d\'excellentes vacances !' .
		'<br />Echange de logements et d\'hbergement pour des vacances gratuites avec webcam' .
		'<br /><a href="'.HTTP_SERVEUR.'">'.HTTP_SERVEUR.'</a>');
define('MAIL_OFFLINE_MSG_14', '<h4 style="text-align:center;">NE PAS REPONDRE - MAIL AUTOMATIQUE</h4>');
define('MAIL_OFFLINE_MSG_15', 'Voir ma fiche');

if (!defined('ATTRIBUT_ALT')) define('ATTRIBUT_ALT', 'echange maison');


define('MODULE_ECHANGE_MAISON_H3', '<span style="text-transform:uppercase;">Rechercher un change de maison</span>');
define('MODULE_ECHANGE_MAISON_H4', 'Nos dernires annonces');
define('MODULE_ECHANGE_MAISON_SELECT_ECHANGE', 'Choix disponibles');
define('MODULE_COUCHSURFING_H3', '<span style="text-transform:uppercase;">Rechercher un hbergement gratuit</span>');
define('MODULE_COUCHSURFING_H4', 'Nos dernires annonces');
define('MODULE_RECHERCHE_h3', 'Moteur de recherche');
define('MODULE_RECHERCHE_LIBELLE', 'Mot-cl:');
define('MODULE_RECHERCHE_LIBELLE_LIST', 'Liste:');
define('MODULE_RECHERCHE_LIBELLE_LIST_TITLE', 'Liste des recherches');
define('MODULE_RECHERCHE_LIBELLE_LIST_TITLE_2', 'Mots-cls utiliss par les internautes ');

define('TITRE_STOCKAGE', 'Espace de stockage');
define('TEXT_STOCKAGE', '(limite 100 messages)');
define('FILTRE_EMAIL', ' ');

define('CONSEILS_TEXT_1', 'Pour vos voyages et vacances,<br />ayez l\'esprit tranquille et scuris!');
define('CONSEILS_TEXT_2', 'Retrouvez dans cette rubrique tous nos conseils et rponses  vos questions afin d\'changer votre maison, partir chez ou recevoir un hte.');
define('CONSEILS_TEXT_3', '<a href="'.HTTP_SERVEUR.FILENAME_CONSEILS.'">'.ESPACE_CONSEILS.'</a>');


define('FORMULAIRE_LOGIN_TEXTE', 'ESPACE RESTREINT');
define('FORMULAIRE_LOGIN_PSEUDO', 'Votre pseudo:');
define('FORMULAIRE_LOGIN_PASSE', 'Mot de passe:');
define('FORMULAIRE_LOGIN_SUBMIT', 'bt_connecter.jpg');

define('ACCES_PAGE_REFUSEE', 'Nous sommes dsols mais l\'accs  cette page fait office d\'une souscription  un de nos abonnements.' .
		'<br />Veuillez suivre le lien suivant pour choisir votre formule:' .
		'<br /><br /><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_PAGE_PAIEMENT.'" style="text-decoration:underline;font-style:italic;">Choisir ma formule</a>');

define('NON_COMMUNIQUE', '<span id="non_communique">non communiqu</span>');

define('CONFIRMATION_MESSAGE_JAVASCRIPT', 'Voulez-vous confirmer cette action?');
define('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE', 'Suppression en cours de votre annonce...');
define('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE_KO', 'Opration annule !');

define('ICONE_MINI_ANNONCE_COURRIER_VIDEO', 'ic-courrier-video.png');
define('ICONE_MINI_ANNONCE_COURRIER_AUDIO', 'ic-courrier-audio.png');
define('ICONE_MINI_ANNONCE_COURRIER_TEXTE', 'ic-courrier-txt.png');
define('ICONE_MINI_ANNONCE_TCHAT_VIDEO', 'ic-tchat-video.png');
define('ICONE_MINI_ANNONCE_TCHAT_AUDIO', 'ic-tchat-audio.png');
define('ICONE_MINI_ANNONCE_TCHAT_TEXTE', 'ic-tchat-txt.png');
define('ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF', 'ic-tchat-video-off.png');
define('ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF', 'ic-tchat-audio-off.png');
define('ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF', 'ic-tchat-txt-off.png');

define('DU', 'Du');
define('AU', 'au');
define('ANCHOR_LISTING_FAVORI', '+Ajouter ce contact');
define('ANCHOR_LISTING_FAVORI_DEJA_AJOUTE', '<span style="color:red;font-size:10px;">Contact ajout !</span>');

define('LIBELLE_SALON_DISCUSSION_OFFLINE', 'Salon OFFLINE');
define('LIBELLE_SALON_DISCUSSION_ONLINE', 'Salon');

define('LIBELLE_FAVORI', 'Echange de maison et d\'hbergement pour des vacances gratuites');

define('ALERTE_MESSAGE_CONTROLE_EQUIPE', HTTP_WARNING.' Attention, nous tenons  informer notre aimable communaut que nous pouvons tre assujettis  contrler tout message envoy qu\'il soit de nature tchat en direct ou message courrier afin de vous assurer une entire confiance dans nos services. Tout manquement  nos conditions gnrales d\'utilisation peut office de sanction jusqu\' la radiation du compte.');

define('RESULTAT_INDISPONIBLE', 'Rsultat indisponible');

define('LOGO', '<span class="txt_1">vacanceshome</span><span class="txt_2"></span><span class="txt_3"></span><span class="txt_2">.com</span>');
define('PHRASE_LOGO', '<span class="txt_4">Le 1er site d\'<span class="txt_5">change de maison</span> et <span class="txt_6">d\'hbergement</span> avec webcam</span>');
define('TEXTE_BANNIERE_ACCUEIL', 'Le 1er site d\'echange de maison et<br />d\'hebergement avec <span class="txt_7">votre</span> webcam');



?>