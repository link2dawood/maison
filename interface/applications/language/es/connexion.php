<?php
session_start(); 
/*
 * PAGE INDEX LANGUAGE FRANCAIS 
 */
define('HEADER_TITLE', 'Inicie la sesin');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('CONNEXION_DEJA_INSCRITS', 'Ya est registrado');
define('CONNEXION_PSEUDO', 'Usario');
define('CONNEXION_PASSE', 'Contrasea : ');
define('CONNEXION_LIEN_ANCHOR', 'Contrasea olvidada?');
define('CONNEXION_MESSAGE_ACCUEIL', 'Hola...');
define('CONNEXION_LIEN_ANCHOR_ESPACE_MEMBRE', 'Espacio in live');
define('CONNEXION_LIEN_ANCHOR_DECONNEXION', 'Logout');
define('CONNEXION_IMAGE_SUBMIT', 'login_ok.gif');
define('CONNEXION_LIEN_DEVENIR_MEMBRE', 'INSCRIPCIN GRATUITA');

define('TEXT_ECHEC', ' Lo siento pero se ha producido un error !<br />' .
		' La contrasea no cumple !<br />' .
		'Va a ser redirigido a una otra vez...');
define('TEXT_MEMBRE_DEJA_CONNECTE', ' Lo siento ha ocurrido un error durante la conexin. Por favor, enseya otra vez !');
		
define('ERREUR_DEJA_CONNECTER', ' Lo siento pero un usuario ya est conectado a la cuenta.');

define('PAYS_TOP', 'Seleccione un pas');
define('PAYS_FRANCE', 'Francia');
define('PAYS_FRANCE_ID', '5');
define('PAYS_BELGIQUE', 'Blgica');
define('PAYS_BELGIQUE_ID', '37');
define('PAYS_SUISSE', 'Suiza');
define('PAYS_SUISSE_ID', '16');
define('PAYS_DEPARTEMENTS_TOP', 'Seleccione');

define('MENU_MEMBRE_OFFLINE', 'Miembros offline');
define('MENU_MEMBRE_ONLINE', 'Miembros online');
define('MENU_MON_PROFIL', 'Mi perfil');
define('MENU_MON_COMPTE', 'Mi cuenta');
define('MENU_MESSAGERIE', 'Mensajera');
define('MENU_BLACKLIST', 'Blacklist');
//PARTIE MENU CLIENT...
define('MENU_ACCUEIL', 'Inicio');
define('MENU_ESPACE_MEMBRE', 'Area miembro');
define('MENU_CGU', 'Condiciones de uso');
define('MENU_PUBLICITE', 'Publicidad');
define('MENU_CONSEILLER_SITE', 'Consejar este sitio');
define('MENU_PLAN_SITE', 'Mapa del sitio');
define('MENU_PARTENAIRES', 'Socios');
define('MENU_LISTES_LIENS', 'Paises');
define('MENU_RECHERCHE_AVANCEE', 'Bsqueda avanzada');
define('MENU_COUCHSURFING', 'Alojamiento');
define('MENU_ECHANGE_MAISON', 'Intercambio de casa');
define('MENU_INSCRIPTION', 'Inscripcin');
define('MENU_BLOG', 'Blog');
define('MENU_DEPOT_ANNONCE', 'Aadir anuncio');
define('MENU_MES_VOYAGES', 'Mis viajes');

define('MESSAGE_INVITATION_INSCRIPTION', HTTP_WARNING.' Amiga(o) de internet.<br />' .
										'Pour bnficier de l\'ensemble de nos services, nous vous invitons  vous enregistrer gratuitement et passer votre annonce d\'<strong>change de maison</strong> ou <strong>couchsurfing</strong>.<br />Bnficiez de fonctionnalits innovantes et ingalables avec une simple webcam, mettre ses contacts en favori,etc...!<br />' .
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
define('MAIL_OFFLINE_MSG_12', 'Toute l\'quipe de www.echange-maison.biz vous remercie vivement de votre confiance et vous souhaite d\'excellentes vacances !' .
		'<br />Echange de logements et couchsurfing avec webcam' .
		'<br /><a href="'.HTTP_SERVEUR.'">'.HTTP_SERVEUR.'</a>');
define('MAIL_OFFLINE_MSG_14', '<h4 style="text-align:center;">NE PAS REPONDRE - MAIL AUTOMATIQUE</h4>');
define('MAIL_OFFLINE_MSG_15', 'Voir ma fiche');

define('ATTRIBUT_ALT', 'echange maison');

define('MODULE_ECHANGE_MAISON_H3', '<span style="text-transform:uppercase;">Rechercher un change de maison</span>');
define('MODULE_ECHANGE_MAISON_H4', 'Nos dernires annonces');
define('MODULE_ECHANGE_MAISON_SELECT_ECHANGE', 'Choix disponibles');
define('MODULE_COUCHSURFING_H3', '<span style="text-transform:uppercase;">Rechercher un couch surfing</span>');
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

define('LIBELLE_FAVORI', 'Echange de maison et couchsurfing');

define('ALERTE_MESSAGE_CONTROLE_EQUIPE', HTTP_WARNING.' Attention, nous tenons  informer notre aimable communaut que nous pouvons tre assujettis  contrler tout message envoy qu\'il soit de nature tchat en direct ou message courrier afin de vous assurer une entire confiance dans nos services. Tout manquement  nos conditions gnrales d\'utilisation peut office de sanction jusqu\' la radiation du compte.');

define('RESULTAT_INDISPONIBLE', 'Rsultat indisponible');

define('LOGO', '<span class="txt_1">echange</span><span class="txt_2">-</span><span class="txt_3">maison</span><span class="txt_2">.biz</span>');
define('PHRASE_LOGO', '<span class="txt_4">Le 1er site d\'<span class="txt_5">change de maison</span> et <span class="txt_6">couchsurfing</span> avec webcam</span>');
define('TEXTE_BANNIERE_ACCUEIL', 'Le 1er site d\'change de maison et<br />couchsurfing avec <span class="txt_7">votre</span> webcam');



?>