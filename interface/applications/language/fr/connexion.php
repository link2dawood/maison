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
if (!defined('HTTP_WARNING'))define('HTTP_WARNING', 'Avertissement');
if (!defined('FILENAME_PAGE_PAIEMENT')) define('FILENAME_PAGE_PAIEMENT', 'paiement-ligne.php');
if (!defined('ATTRIBUT_ALT')) define('ATTRIBUT_ALT', 'echange maison');
if (!defined('CONNEXION_DEJA_INSCRITS'))define('CONNEXION_DEJA_INSCRITS', 'Vous tes dj inscrits');
if (!defined('CONNEXION_PSEUDO'))define('CONNEXION_PSEUDO', 'Pseudonyme');
if (!defined('CONNEXION_PASSE'))define('CONNEXION_PASSE', 'Passe : ');
if (!defined('CONNEXION_LIEN_ANCHOR'))define('CONNEXION_LIEN_ANCHOR', 'Mot de passe perdu?');
if (!defined('CONNEXION_MESSAGE_ACCUEIL'))define('CONNEXION_MESSAGE_ACCUEIL', 'Bonjour...');
if (!defined('CONNEXION_LIEN_ANCHOR_ESPACE_MEMBRE'))define('CONNEXION_LIEN_ANCHOR_ESPACE_MEMBRE', 'Espace en direct');
if (!defined('CONNEXION_LIEN_ANCHOR_DECONNEXION'))define('CONNEXION_LIEN_ANCHOR_DECONNEXION', 'Dconnexion');
if (!defined('CONNEXION_IMAGE_SUBMIT'))define('CONNEXION_IMAGE_SUBMIT', 'login_ok.gif');
if (!defined('CONNEXION_LIEN_DEVENIR_MEMBRE'))define('CONNEXION_LIEN_DEVENIR_MEMBRE', 'DEVENEZ MEMBRE GRATUITEMENT');
if (!defined('TEXT_ECHEC'))define('TEXT_ECHEC', 'Nous sommes dsols mais une erreur est survenue!<br />' .
		'Votre pseudo ou mot de passe n\'est pas conforme !<br />' .
		'Vous allez tre redirig pour un nouvel essai...');
if (!defined('TEXT_MEMBRE_DEJA_CONNECTE'))define('TEXT_MEMBRE_DEJA_CONNECTE', 'Dsol une erreur est survenue lors de la connexion. Veuillez recommencer !');	
if (!defined('ERREUR_DEJA_CONNECTER'))define('ERREUR_DEJA_CONNECTER', 'Nous sommes dsols mais un utilisateur est dj connect sur le compte.');
if (!defined('PAYS_TOP'))define('PAYS_TOP', 'Choisir un pays');
if (!defined('PAYS_FRANCE'))define('PAYS_FRANCE', 'France');
if (!defined('PAYS_FRANCE_ID'))define('PAYS_FRANCE_ID', '5');
if (!defined('PAYS_BELGIQUE'))define('PAYS_BELGIQUE', 'Belgique');
if (!defined('PAYS_BELGIQUE_ID'))define('PAYS_BELGIQUE_ID', '37');
if (!defined('PAYS_SUISSE'))define('PAYS_SUISSE', 'Suisse');
if (!defined('PAYS_SUISSE_ID'))define('PAYS_SUISSE_ID', '16');
if (!defined('PAYS_DEPARTEMENTS_TOP'))define('PAYS_DEPARTEMENTS_TOP', 'Choisir');
if (!defined('MENU_MEMBRE_OFFLINE'))define('MENU_MEMBRE_OFFLINE', 'Membres offline');
if (!defined('MENU_MEMBRE_ONLINE'))define('MENU_MEMBRE_ONLINE', 'Membres online');
if (!defined('MENU_MON_PROFIL'))define('MENU_MON_PROFIL', 'Mon profil');
if (!defined('MENU_MON_COMPTE'))define('MENU_MON_COMPTE', 'Mon compte');
if (!defined('MENU_MESSAGERIE'))define('MENU_MESSAGERIE', 'Messagerie');
if (!defined('MENU_BLACKLIST'))define('MENU_BLACKLIST', 'Liste noire');
if (!defined('MENU_VISITER_PROFIL'))define('MENU_VISITER_PROFIL', 'visite(s) sur mon profil');
if (!defined('MENU_ACCUEIL'))define('MENU_ACCUEIL', 'Accueil');
if (!defined('MENU_ESPACE_MEMBRE'))define('MENU_ESPACE_MEMBRE', 'Espace membre');
if (!defined('MENU_CGU'))define('MENU_CGU', 'CGU');
if (!defined('MENU_PUBLICITE'))define('MENU_PUBLICITE', 'Publicit');
if (!defined('MENU_CONSEILLER_SITE'))define('MENU_CONSEILLER_SITE', 'Conseiller ce site');
if (!defined('MENU_PLAN_SITE'))define('MENU_PLAN_SITE', 'Plan du site');
if (!defined('MENU_PARTENAIRES'))define('MENU_PARTENAIRES', 'Partenaires');
if (!defined('MENU_LISTES_LIENS'))define('MENU_LISTES_LIENS', 'Pays');
if (!defined('MENU_RECHERCHE_AVANCEE'))define('MENU_RECHERCHE_AVANCEE', 'Recherche avance');
if (!defined('MENU_COUCHSURFING'))define('MENU_COUCHSURFING', 'Hbergement');
if (!defined('MENU_ECHANGE_MAISON'))define('MENU_ECHANGE_MAISON', 'Echange de maison');
if (!defined('MENU_INSCRIPTION'))define('MENU_INSCRIPTION', 'Inscription');
if (!defined('MENU_BLOG'))define('MENU_BLOG', 'Blog du site');
if (!defined('MENU_DEPOT_ANNONCE'))define('MENU_DEPOT_ANNONCE', 'Dposer annonce');
if (!defined('MENU_MES_VOYAGES'))define('MENU_MES_VOYAGES', 'Mes voyages');
if (!defined('MESSAGE_INVITATION_INSCRIPTION'))define('MESSAGE_INVITATION_INSCRIPTION', HTTP_WARNING.' Ami(e) internaute.<br />' .
										'Pour bnficier de l\'ensemble de nos services, nous vous invitons  vous enregistrer gratuitement et passer votre annonce d\'<strong>change de maison</strong> ou <strong>d\'hbergement pour des vacances gratuites</strong>.<br />Bnficiez de fonctionnalits innovantes et ingalables avec une simple webcam, mettre ses contacts en favori,etc...!<br />' .
										'Enregistrez-vous gratuitement sans plus attendre !<br />' .
										'Rejoignez notre communaut internationale!');
if (!defined('AUCUNE_INFORMATION'))define('AUCUNE_INFORMATION', 'Aucune information...');
if (!defined('TITRE_DERNIERS_INSCRITS_MEMBRES'))define('TITRE_DERNIERS_INSCRITS_MEMBRES', 'Derniers inscrits');
if (!defined('BOUTON_RETOUR_PAGINATION'))define('BOUTON_RETOUR_PAGINATION', '<< retour');
if (!defined('BOUTON_SUITE_PAGINATION'))define('BOUTON_SUITE_PAGINATION', 'suite >>');
if (!defined('BOUTON_RECHERCHER'))define('BOUTON_RECHERCHER', 'bt_rechercher_fr.gif');
if (!defined('BOUTON_OK'))define('BOUTON_OK', 'ok.jpg');
if (!defined('SUBMIT'))define('SUBMIT', 'envoyer');
if (!defined('ICONE_TEXTE_MEMBRE_BLACKLISTER'))define('ICONE_TEXTE_MEMBRE_BLACKLISTER', '<span style="color:red;font-size:10px;">ne pas tre contact !</span>');
if (!defined('MESSAGE_INTERMEDIAIRE'))define('MESSAGE_INTERMEDIAIRE', 'Vous allez tre redirig !');
if (!defined('MESSAGE_EXPEDITEUR_ANNULE'))define('MESSAGE_EXPEDITEUR_ANNULE', 'ATTENTION... nous avons annul votre demande!<br />Vous vous tes envoy un message !');
if (!defined('MESSAGE_FLV_NON_PRESENT_SERVEUR'))define('MESSAGE_FLV_NON_PRESENT_SERVEUR', 'ATTENTION... nous avons annul votre demande!<br />Aucun fichier AUDIO ou VIDEO n\'a t enregistr!');
if (!defined('TEXT_MODULE_RECHERCHE_1'))define('TEXT_MODULE_RECHERCHE_1', 'Rechercher :');
if (!defined('TEXT_MODULE_RECHERCHE'))define('TEXT_MODULE_RECHERCHE', 'O :');
if (!defined('OPTION_1_MODULE_RECHERCHE'))define('OPTION_1_MODULE_RECHERCHE', 'Statut :');
if (!defined('OPTION_2_MODULE_RECHERCHE'))define('OPTION_2_MODULE_RECHERCHE', 'Connects');
if (!defined('OPTION_3_MODULE_RECHERCHE'))define('OPTION_3_MODULE_RECHERCHE', 'Non connects');
if (!defined('OPTION_4_MODULE_RECHERCHE'))define('OPTION_4_MODULE_RECHERCHE', 'Tous');
if (!defined('SUBMIT_MODULE_RECHERCHE'))define('SUBMIT_MODULE_RECHERCHE', ' Rechercher ');
if (!defined('TOP_TITRE_TCHAT'))define('TOP_TITRE_TCHAT', 'Tchat et messages instantans');
if (!defined('ESPACE_PUBLICITAIRE'))define('ESPACE_PUBLICITAIRE', 'Espace publicitaire');
if (!defined('ESPACE_PUBLICITAIRE_LIEN'))define('ESPACE_PUBLICITAIRE_LIEN', 'Votre publicit ici');
if (!defined('ESPACE_CONSEILS'))define('ESPACE_CONSEILS', 'Nos conseils & vos questions');
if (!defined('TCHAT_MESSAGES_NON_LUS'))define('TCHAT_MESSAGES_NON_LUS', 'Message(s) non lu(s):reu(s): ');
if (!defined('TCHAT_MESSAGES_NON_LUS_ENVOYES'))define('TCHAT_MESSAGES_NON_LUS_ENVOYES', ' / envoys: ');
if (!defined('NB_MESSAGES_RECEPTION'))define('NB_MESSAGES_RECEPTION', 'Messages(s) reu(s) : ');
if (!defined('LIBELLE_DATE_TOP'))define('LIBELLE_DATE_TOP', 'Le : ');
if (!defined('MAIL_OFFLINE_ENTETE'))define('MAIL_OFFLINE_ENTETE', 'Nouveau message');
if (!defined('MAIL_OFFLINE_MSG_H1'))define('MAIL_OFFLINE_MSG_H1', '<h1 style="text-align:center;">NOUVEAU MESSAGE</h1>');
if (!defined('MAIL_OFFLINE_MSG_1'))define('MAIL_OFFLINE_MSG_1', 'Bonjour ');
if (!defined('MAIL_OFFLINE_MSG_2'))define('MAIL_OFFLINE_MSG_2', 'Vous recevez ce message car le membre :');
if (!defined('MAIL_OFFLINE_MSG_3'))define('MAIL_OFFLINE_MSG_3', 'vous a envoy un nouveau message dans votre boite de messagerie!');
if (!defined('MAIL_OFFLINE_MSG_4'))define('MAIL_OFFLINE_MSG_4', 'Date d\'envoi:');
if (!defined('MAIL_OFFLINE_MSG_5'))define('MAIL_OFFLINE_MSG_5', 'Pseudo de l\'expditeur:');
if (!defined('MAIL_OFFLINE_MSG_6'))define('MAIL_OFFLINE_MSG_6', 'Sa fiche dtaille:');
if (!defined('MAIL_OFFLINE_MSG_7'))define('MAIL_OFFLINE_MSG_7', 'Type de message:');
if (!defined('MAIL_OFFLINE_MSG_8'))define('MAIL_OFFLINE_MSG_8', 'Message texte');
if (!defined('MAIL_OFFLINE_MSG_9'))define('MAIL_OFFLINE_MSG_9', 'Message audio');
if (!defined('MAIL_OFFLINE_MSG_10'))define('MAIL_OFFLINE_MSG_10', 'Message vido');
if (!defined('MAIL_OFFLINE_MSG_11'))define('MAIL_OFFLINE_MSG_11', 'Pour lire celui-ci, veuillez suivre le lien suivant: <a href="'.HTTP_SERVEUR.'">Mon espace membre</a>');
if (!defined('MAIL_OFFLINE_MSG_12'))define('MAIL_OFFLINE_MSG_12', 'Toute l\'quipe de www.vacanceshome.com vous remercie vivement de votre confiance et vous souhaite d\'excellentes vacances !' .
		'<br />Echange de logements et d\'hbergement pour des vacances gratuites avec webcam' .
		'<br /><a href="'.HTTP_SERVEUR.'">'.HTTP_SERVEUR.'</a>');
if (!defined('MAIL_OFFLINE_MSG_14'))define('MAIL_OFFLINE_MSG_14', '<h4 style="text-align:center;">NE PAS REPONDRE - MAIL AUTOMATIQUE</h4>');
if (!defined('MAIL_OFFLINE_MSG_15'))define('MAIL_OFFLINE_MSG_15', 'Voir ma fiche');
if (!defined('MODULE_ECHANGE_MAISON_H3'))define('MODULE_ECHANGE_MAISON_H3', '<span style="text-transform:uppercase;">Rechercher un change de maison</span>');
if (!defined('MODULE_ECHANGE_MAISON_H4'))define('MODULE_ECHANGE_MAISON_H4', 'Nos dernires annonces');
if (!defined('MODULE_ECHANGE_MAISON_SELECT_ECHANGE'))define('MODULE_ECHANGE_MAISON_SELECT_ECHANGE', 'Choix disponibles');
if (!defined('MODULE_COUCHSURFING_H3'))define('MODULE_COUCHSURFING_H3', '<span style="text-transform:uppercase;">Rechercher un hbergement gratuit</span>');
if (!defined('MODULE_COUCHSURFING_H4'))define('MODULE_COUCHSURFING_H4', 'Nos dernires annonces');
if (!defined('MODULE_RECHERCHE_h3'))define('MODULE_RECHERCHE_h3', 'Moteur de recherche');
if (!defined('MODULE_RECHERCHE_LIBELLE'))define('MODULE_RECHERCHE_LIBELLE', 'Mot-cl:');
if (!defined('MODULE_RECHERCHE_LIBELLE_LIST'))define('MODULE_RECHERCHE_LIBELLE_LIST', 'Liste:');
if (!defined('MODULE_RECHERCHE_LIBELLE_LIST_TITLE'))define('MODULE_RECHERCHE_LIBELLE_LIST_TITLE', 'Liste des recherches');
if (!defined('MODULE_RECHERCHE_LIBELLE_LIST_TITLE_2'))define('MODULE_RECHERCHE_LIBELLE_LIST_TITLE_2', 'Mots-cls utiliss par les internautes ');
if (!defined('TITRE_STOCKAGE'))define('TITRE_STOCKAGE', 'Espace de stockage');
if (!defined('TEXT_STOCKAGE'))define('TEXT_STOCKAGE', '(limite 100 messages)');
if (!defined('FILTRE_EMAIL'))define('FILTRE_EMAIL', ' ');
if (!defined('CONSEILS_TEXT_1'))define('CONSEILS_TEXT_1', 'Pour vos voyages et vacances,<br />ayez l\'esprit tranquille et scuris!');
if (!defined('CONSEILS_TEXT_2'))define('CONSEILS_TEXT_2', 'Retrouvez dans cette rubrique tous nos conseils et rponses  vos questions afin d\'changer votre maison, partir chez ou recevoir un hte.');
if (!defined('CONSEILS_TEXT_3'))define('CONSEILS_TEXT_3', '<a href="'.HTTP_SERVEUR.FILENAME_CONSEILS.'">'.ESPACE_CONSEILS.'</a>');
if (!defined('FORMULAIRE_LOGIN_TEXTE'))define('FORMULAIRE_LOGIN_TEXTE', 'ESPACE RESTREINT');
if (!defined('FORMULAIRE_LOGIN_PSEUDO'))define('FORMULAIRE_LOGIN_PSEUDO', 'Votre pseudo:');
if (!defined('FORMULAIRE_LOGIN_PASSE'))define('FORMULAIRE_LOGIN_PASSE', 'Mot de passe:');
if (!defined('FORMULAIRE_LOGIN_SUBMIT'))define('FORMULAIRE_LOGIN_SUBMIT', 'bt_connecter.jpg');
if (!defined('ACCES_PAGE_REFUSEE'))define('ACCES_PAGE_REFUSEE', 'Nous sommes dsols mais l\'accs  cette page fait office d\'une souscription  un de nos abonnements.' .
		'<br />Veuillez suivre le lien suivant pour choisir votre formule:' .
		'<br /><br /><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_PAGE_PAIEMENT.'" style="text-decoration:underline;font-style:italic;">Choisir ma formule</a>');
if (!defined('NON_COMMUNIQUE'))define('NON_COMMUNIQUE', '<span id="non_communique">non communiqu</span>');
if (!defined('CONFIRMATION_MESSAGE_JAVASCRIPT'))define('CONFIRMATION_MESSAGE_JAVASCRIPT', 'Voulez-vous confirmer cette action?');
if (!defined('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE'))define('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE', 'Suppression en cours de votre annonce...');
if (!defined('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE_KO'))define('CONFIRMATION_MESSAGE_SUPPRESSION_ANNONCE_KO', 'Opration annule !');
if (!defined('ICONE_MINI_ANNONCE_COURRIER_VIDEO'))define('ICONE_MINI_ANNONCE_COURRIER_VIDEO', 'ic-courrier-video.png');
if (!defined('ICONE_MINI_ANNONCE_COURRIER_AUDIO'))define('ICONE_MINI_ANNONCE_COURRIER_AUDIO', 'ic-courrier-audio.png');
if (!defined('ICONE_MINI_ANNONCE_COURRIER_TEXTE'))define('ICONE_MINI_ANNONCE_COURRIER_TEXTE', 'ic-courrier-txt.png');
if (!defined('ICONE_MINI_ANNONCE_TCHAT_VIDEO'))define('ICONE_MINI_ANNONCE_TCHAT_VIDEO', 'ic-tchat-video.png');
if (!defined('ICONE_MINI_ANNONCE_TCHAT_AUDIO'))define('ICONE_MINI_ANNONCE_TCHAT_AUDIO', 'ic-tchat-audio.png');
if (!defined('ICONE_MINI_ANNONCE_TCHAT_TEXTE'))define('ICONE_MINI_ANNONCE_TCHAT_TEXTE', 'ic-tchat-txt.png');
if (!defined('ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF'))define('ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF', 'ic-tchat-video-off.png');
if (!defined('ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF'))define('ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF', 'ic-tchat-audio-off.png');
if (!defined('ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF'))define('ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF', 'ic-tchat-txt-off.png');
if (!defined('DU'))define('DU', 'Du');
if (!defined('AU'))define('AU', 'au');
if (!defined('ANCHOR_LISTING_FAVORI'))define('ANCHOR_LISTING_FAVORI', '+Ajouter ce contact');
if (!defined('ANCHOR_LISTING_FAVORI_DEJA_AJOUTE'))define('ANCHOR_LISTING_FAVORI_DEJA_AJOUTE', '<span style="color:red;font-size:10px;">Contact ajout !</span>');
if (!defined('LIBELLE_SALON_DISCUSSION_OFFLINE'))define('LIBELLE_SALON_DISCUSSION_OFFLINE', 'Salon OFFLINE');
if (!defined('LIBELLE_SALON_DISCUSSION_ONLINE'))define('LIBELLE_SALON_DISCUSSION_ONLINE', 'Salon');
if (!defined('LIBELLE_FAVORI'))define('LIBELLE_FAVORI', 'Echange de maison et d\'hbergement pour des vacances gratuites');
if (!defined('ALERTE_MESSAGE_CONTROLE_EQUIPE'))define('ALERTE_MESSAGE_CONTROLE_EQUIPE', HTTP_WARNING.' Attention, nous tenons  informer notre aimable communaut que nous pouvons tre assujettis  contrler tout message envoy qu\'il soit de nature tchat en direct ou message courrier afin de vous assurer une entire confiance dans nos services. Tout manquement  nos conditions gnrales d\'utilisation peut office de sanction jusqu\' la radiation du compte.');
if (!defined('RESULTAT_INDISPONIBLE'))define('RESULTAT_INDISPONIBLE', 'Rsultat indisponible');
if (!defined('LOGO'))define('LOGO', '<span class="txt_1">vacanceshome</span><span class="txt_2"></span><span class="txt_3"></span><span class="txt_2">.com</span>');
if (!defined('PHRASE_LOGO'))define('PHRASE_LOGO', '<span class="txt_4">Le 1er site d\'<span class="txt_5">change de maison</span> et <span class="txt_6">d\'hbergement</span> avec webcam</span>');
if (!defined('TEXTE_BANNIERE_ACCUEIL'))define('TEXTE_BANNIERE_ACCUEIL', 'Le 1er site d\'echange de maison et<br />d\'hebergement avec <span class="txt_7">votre</span> webcam');



?>