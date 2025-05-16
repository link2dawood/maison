<?php
session_start(); 
/*
 * PAGE INDEX LANGUAGE FRANCAIS 
 */
define('HEADER_TITLE', 'Log on to our site');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('CONNEXION_DEJA_INSCRITS', 'Already registered');
define('CONNEXION_PSEUDO', 'Username');
define('CONNEXION_PASSE', 'Password : ');
define('CONNEXION_LIEN_ANCHOR', 'Lost password?');
define('CONNEXION_MESSAGE_ACCUEIL', 'hello...');
define('CONNEXION_LIEN_ANCHOR_ESPACE_MEMBRE', 'Online area');
define('CONNEXION_LIEN_ANCHOR_DECONNEXION', 'Logout');
define('CONNEXION_IMAGE_SUBMIT', 'login_ok.gif');
define('CONNEXION_LIEN_DEVENIR_MEMBRE', 'BECOME MEMBER FOR FREE');

define('TEXT_ECHEC', 'WE are sorry but an error came out!<br />' .
		'your login or password is not valid !<br />' .
		'Try again...');
define('TEXT_MEMBRE_DEJA_CONNECTE', 'We are sorry but an error was occured while connecting. Please, try again !');
		
define('ERREUR_DEJA_CONNECTER', 'We are sorry but an user is already connected on this account !');

define('PAYS_TOP', 'Select a country');
define('PAYS_FRANCE', 'France');
define('PAYS_FRANCE_ID', '5');
define('PAYS_BELGIQUE', 'Belgium');
define('PAYS_BELGIQUE_ID', '37');
define('PAYS_SUISSE', 'Switzerland');
define('PAYS_SUISSE_ID', '16');
define('PAYS_DEPARTEMENTS_TOP', 'Select');

define('MENU_MEMBRE_OFFLINE', 'Offline members');
define('MENU_MEMBRE_ONLINE', 'Online members');
define('MENU_MON_PROFIL', 'My profile');
define('MENU_MON_COMPTE', 'My account');
define('MENU_MESSAGERIE', 'Mailbox');
define('MENU_BLACKLIST', 'Blacklist');
define('MENU_VISITER_PROFIL', 'visited my profile');
//PARTIE MENU CLIENT...
define('MENU_ACCUEIL', 'home');
define('MENU_ESPACE_MEMBRE', 'Member area');
define('MENU_CGU', 'Terms');
define('MENU_PUBLICITE', 'Advertising');
define('MENU_CONSEILLER_SITE', 'Recommend this site');
define('MENU_PLAN_SITE', 'Sitemap');
define('MENU_PARTENAIRES', 'Partners');
define('MENU_LISTES_LIENS', 'Country');
define('MENU_RECHERCHE_AVANCEE', 'Advanced search');
define('MENU_COUCHSURFING', 'Accomodation');
define('MENU_ECHANGE_MAISON', 'Home exchange');
define('MENU_INSCRIPTION', 'Registration');
define('MENU_BLOG', 'Blog of site');
define('MENU_DEPOT_ANNONCE', 'Submit listing');
define('MENU_MES_VOYAGES', 'My trips');

define('MESSAGE_INVITATION_INSCRIPTION', HTTP_WARNING.' Dear internet user.<br />' .
										'To beneficit all services, we invite you to register for free and add your listing as <strong>home exchange</strong> or <strong>free holidays accommodation</strong>.<br />Enjoy innovative and amazing functionalities with a simple webcam, keep your favorite contacts, etc...!<br />' .
										'Register for free now !<br />' .
										'Join our international community!');
define('AUCUNE_INFORMATION', 'No information...');
define('TITRE_DERNIERS_INSCRITS_MEMBRES', 'Last Members');

define('BOUTON_RETOUR_PAGINATION', '<< back');
define('BOUTON_SUITE_PAGINATION', 'next >>');
define('BOUTON_RECHERCHER', 'bt_rechercher_fr.gif');
define('BOUTON_OK', 'ok.jpg');

define('SUBMIT', 'send');

define('ICONE_TEXTE_MEMBRE_BLACKLISTER', '<span style="color:red;font-size:10px;">to be not contacted !</span>');

define('MESSAGE_INTERMEDIAIRE', 'You will be redirected !');

define('MESSAGE_EXPEDITEUR_ANNULE', 'WARNING... we have cancelled your request!<br />This message was for yourself !');
define('MESSAGE_FLV_NON_PRESENT_SERVEUR', 'WARNING... we have cancelled your request!<br />No AUDIO or VIDEO file have been registered!');

define('TEXT_MODULE_RECHERCHE_1', 'Search :');
define('TEXT_MODULE_RECHERCHE', 'Where :');
define('OPTION_1_MODULE_RECHERCHE', 'Statut :');
define('OPTION_2_MODULE_RECHERCHE', 'Connected');
define('OPTION_3_MODULE_RECHERCHE', 'No connected');
define('OPTION_4_MODULE_RECHERCHE', 'All');
define('SUBMIT_MODULE_RECHERCHE', ' Search ');

define('TOP_TITRE_TCHAT', 'Tchat and Instant messenger');
define('ESPACE_PUBLICITAIRE', 'Advertising area');
define('ESPACE_PUBLICITAIRE_LIEN', 'Your link here');
define('ESPACE_CONSEILS', 'Our advices & questions');
define('TCHAT_MESSAGES_NON_LUS', 'Message(s) unread:received: ');
define('TCHAT_MESSAGES_NON_LUS_ENVOYES', ' / sent: ');

define('NB_MESSAGES_RECEPTION', 'Messages(s) received : ');
define('LIBELLE_DATE_TOP', 'From : ');

define('MAIL_OFFLINE_ENTETE', 'New message');
define('MAIL_OFFLINE_MSG_H1', '<h1 style="text-align:center;">NEW MESSAGE</h1>');
define('MAIL_OFFLINE_MSG_1', 'Hello ');
define('MAIL_OFFLINE_MSG_2', 'You get this message because the member :');
define('MAIL_OFFLINE_MSG_3', 'have sent to you a message into your mailbox!');
define('MAIL_OFFLINE_MSG_4', 'Date of sent:');
define('MAIL_OFFLINE_MSG_5', 'Login:');
define('MAIL_OFFLINE_MSG_6', 'His profile detailed:');
define('MAIL_OFFLINE_MSG_7', 'Type of message:');
define('MAIL_OFFLINE_MSG_8', 'Text message');
define('MAIL_OFFLINE_MSG_9', 'Audio message');
define('MAIL_OFFLINE_MSG_10', 'Video message');
define('MAIL_OFFLINE_MSG_11', 'To read it, please follow this link: <a href="'.HTTP_SERVEUR.'">My member area</a>');
define('MAIL_OFFLINE_MSG_12', 'All the team of www.home-exchange.biz thanks you so much for your trust in ours services !' .
		'<br />Home exchange and free holidays accommodation by webcam' .
		'<br /><a href="'.HTTP_SERVEUR.'">'.HTTP_SERVEUR.'</a>');
define('MAIL_OFFLINE_MSG_14', '<h4 style="text-align:center;">DO NOT ANSWER - AUTOMATIC MAIL</h4>');
define('MAIL_OFFLINE_MSG_15', 'See my listing');

define('ATTRIBUT_ALT', 'home exchange');

define('MODULE_ECHANGE_MAISON_H3', '<span style="text-transform:uppercase;">Search home exchange</span>');
define('MODULE_ECHANGE_MAISON_H4', 'Our latest ads');
define('MODULE_ECHANGE_MAISON_SELECT_ECHANGE', 'Choices availables');
define('MODULE_COUCHSURFING_H3', '<span style="text-transform:uppercase;">Search free accommodation</span>');
define('MODULE_COUCHSURFING_H4', 'Our latest ads');
define('MODULE_RECHERCHE_h3', 'Search engine');
define('MODULE_RECHERCHE_LIBELLE', 'Keywords:');
define('MODULE_RECHERCHE_LIBELLE_LIST', 'List:');
define('MODULE_RECHERCHE_LIBELLE_LIST_TITLE', 'List of researches');
define('MODULE_RECHERCHE_LIBELLE_LIST_TITLE_2', 'Populars keywords ');

define('TITRE_STOCKAGE', 'Storage area');
define('TEXT_STOCKAGE', '(limited to 100 messages)');
define('FILTRE_EMAIL', ' ');

define('CONSEILS_TEXT_1', 'For yours travels and holidays,<br />Feel free and secured!');
define('CONSEILS_TEXT_2', 'Find out in this section, all our advices and answers to your questions to exchange house, go to or to be invited by guests at home.');
define('CONSEILS_TEXT_3', '<a href="'.HTTP_SERVEUR.FILENAME_CONSEILS.'">'.ESPACE_CONSEILS.'</a>');


define('FORMULAIRE_LOGIN_TEXTE', 'RESTRICTED AREA');
define('FORMULAIRE_LOGIN_PSEUDO', 'Your login:');
define('FORMULAIRE_LOGIN_PASSE', 'Password:');
define('FORMULAIRE_LOGIN_SUBMIT', 'bt_connecter.jpg');

define('ACCES_PAGE_REFUSEE', 'We\'re sorry, but to access to this page is restricted. You have to subscribe to one of our subscriptions.' .
		'<br />Please follow the link below to choose your subscription:' .
		'<br /><br /><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_PAGE_PAIEMENT.'" style="text-decoration:underline;font-style:italic;">Choose my subscription</a>');

define('NON_COMMUNIQUE', '<span id="non_communique">nc</span>');

define('CONFIRMATION_MESSAGE_JAVASCRIPT', 'Would you confirm this action?');
define('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE', 'Removing your current listing...');
define('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE_KO', 'Operation canceled !');

define('ICONE_MINI_ANNONCE_COURRIER_VIDEO', 'ic-courrier-video.png');
define('ICONE_MINI_ANNONCE_COURRIER_AUDIO', 'ic-courrier-audio.png');
define('ICONE_MINI_ANNONCE_COURRIER_TEXTE', 'ic-courrier-txt.png');
define('ICONE_MINI_ANNONCE_TCHAT_VIDEO', 'ic-tchat-video.png');
define('ICONE_MINI_ANNONCE_TCHAT_AUDIO', 'ic-tchat-audio.png');
define('ICONE_MINI_ANNONCE_TCHAT_TEXTE', 'ic-tchat-txt.png');
define('ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF', 'ic-tchat-video-off.png');
define('ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF', 'ic-tchat-audio-off.png');
define('ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF', 'ic-tchat-txt-off.png');

define('DU', 'From');
define('AU', 'to');
define('ANCHOR_LISTING_FAVORI', '+Add this member');
define('ANCHOR_LISTING_FAVORI_DEJA_AJOUTE', '<span style="color:red;font-size:10px;">Member added !</span>');

define('LIBELLE_SALON_DISCUSSION_OFFLINE', 'Tchat OFFLINE');
define('LIBELLE_SALON_DISCUSSION_ONLINE', 'Tchat');

define('LIBELLE_FAVORI', 'Home exchange and free accommodation');

define('ALERTE_MESSAGE_CONTROLE_EQUIPE', HTTP_WARNING.' WARNING, we wish to inform our friendly community that we can be subject to control any message as by tchat or by mail to ensure full confidence in our services. Any breach of our terms of use may act to remove the account member.');

define('RESULTAT_INDISPONIBLE', 'Results unavailable');

define('LOGO', '<span class="txt_1"></span><span class="txt_2"></span><span class="txt_3">vacanceshome</span><span class="txt_2">.com</span>');
define('PHRASE_LOGO', '<span class="txt_4">The first website of <span class="txt_5">home exchange</span> and <span class="txt_6">free accommodation</span> by webcam</span>');
define('TEXTE_BANNIERE_ACCUEIL', 'The first website of home exchange and<br />free accommodation with <span class="txt_7">your</span> webcam');

define('BT_INSCRIPTION_GRATUITE', 'bt_inscription_en.jpg');

?>