<?php
session_start();
define('HEADER_TITLE', 'Ma boite de messagerie');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1', 'Ma boite de messagerie');

define('H2_RECEPTION', 'Bienvenue dans ma "messagerie"');
define('H2_MESSAGES_ENVOYES', 'Messages envoys');
define('H2_CORBEILLE', 'Corbeille');

define('INTITULE_MENU_MESSAGERIE', 'Menu :');

define('PAS_DE_RESULTAT', 'Pas de rsultat disponible');
define('NOMBRE_RESULTAT', 'Rsultat:');
define('PAGE', 'Page:');

define('BOUTON_RETOUR_PAGINATION', '<< retour');
define('BOUTON_SUITE_PAGINATION', 'suite >>');

define('ETAT_MESSAGE_NON_LU', '(message non lu)');
define('ETAT_MESSAGE_LU', '(message lu)');
define('ETAT_MESSAGE_SUPPRIMER', '(message supprim)');
define('NOUVEAU_MESSAGE', '<em>nouveau</em>');
define('REPONSE_MESSAGE', '<em>rponse</em>');

define('DESCRIPTION_MESSAGE', '<span style="text-decoration:underline;">Extrait:</span> ');

define('MESSENGER_LIRE_MESSAGE_TEXTE', ' Lire un message texte');
define('MESSENGER_LIRE_MESSAGE_AUDIO', ' Lire un message audio');
define('MESSENGER_LIRE_MESSAGE_VIDEO', ' Lire un message vido');
define('MESSENGER_ACCEPTER_MESSAGE', ' ERREUR !!! ');
define('SUPPRIMER_MESSAGE', ' Ignorer ');

define('DATE_MESSAGE', '<span style="text-decoration:underline;">Date:</span> ');
define('EXPEDITEUR_MESSAGE', '<span style="text-decoration:underline;">Pseudo:</span> ');
define('ETAT_MESSAGE', '<span style="text-decoration:underline;">Etat:</span> ');

define('MESSENGER_GESTION_LIRE_MESSAGE_TEXTE', 'Lire le message de : ');
define('MESSENGER_GESTION_LIRE_MESSAGE_DEMANDE_DUO', 'Rpondre au message de : ');

define('MESSENGER_GESTION_REPONDRE_MESSAGE', 'Rpondre');
define('MESSENGER_GESTION_SUPPRIMER_MESSAGE', 'Ignorer');
define('MESSENGER_GESTION_ACCEPTER_MESSAGE', 'Accepter');
define('MESSENGER_GESTION_ANNULER_MESSAGE', 'Annuler');
define('MESSENGER_GESTION_REPONDRE_MESSAGE_TEXTE', 'Rpondre message ');

define('MESSENGER_GESTION_AGE', 'ans');

define('MESSENGER_GESTION_OPTIONS_REPONSES', 'Vous prfrez rpondre par :');

define('MESSENGER_GESTION_ANCHOR_MESSAGE_TEXTE', 'message texte');
define('MESSENGER_GESTION_ANCHOR_MESSAGE_AUDIO', 'message audio');
define('MESSENGER_GESTION_ANCHOR_MESSAGE_VIDEO', 'message vido');

define('MESSENGER_SUPPRESSION_MESSAGE', 'Le message a t ignor !');
define('MESSENGER_SUPPRESSION_MESSAGE_OFF', 'Le message a t dfinitivement supprim !');
define('MESSAGE_ENVOYE', 'Le message a t envoy !');

define('MESSENGER_REPONDRE_MESSAGE_TEXTE', 'Rpondre par message texte');
define('MESSENGER_REPONDRE_MESSAGE_AUDIO', 'Rpondre par message audio');
define('MESSENGER_REPONDRE_MESSAGE_VIDEO', 'Rpondre par message vido');

define('PHRASE_MESSAGE_TEXTE', 'Tapez votre message dans l\'encart ci-contre puis cliquer sur ENVOYER');
								
define('COMMENTAIRE_TEXTAREA', 'Texte libre pour vous prsenter...');

define('CONTACTER_PAR_MESSENGER', 'NOTA : Le membre est actuellement connect sur le site... <br />Souhaitez-vous lui le contacter directement? <br />Pour cela suivez ce lien :');
define('BT_CONTACTER_PAR_MESSENGER', ' Tchat ');

define('TEXTE_BOUTON_DESACTIVER', 'Nous sommes dsols mais nous avons dsactiv le bouton REPONDRE car vous avez dj contact ce membre mais celui-ci n\'a pas encore rpondu...<br />Merci de votre comprhension !');
define('ANCHOR_BOUTON_DESACTIVER', '<span style="font-weight:bolder;color:red;">- BOUTON DESACTIVE -</span>');
define('DESACTIVER_OPTIONS_MESSAGERIE', ' - OPTIONS REPONSES DESACTIVEES -');

define('BOUTON_SUPPRIMER_OFF', 'Supprimer dfinitivement');

define('TEXTE_PSEUDO_A_CONTACTER', '<em>/!\ membre  contacter</em>');
define('PSEUDO_A_CONTACTER', 'Pseudo du contact:');
define('LIBELLE_MESSAGE', 'Message:');

define('MESSAGE_ALERTE_SUPPRESSION_MESSAGE', '* ATTENTION : cliquer sur "<strong>Supprimer dfinitivement</strong>" et votre message sera effac intgralement de la boite de messagerie de votre interlocuteur !');

define('TITRE_COL_GAUCHE_INFO', 'Envoyer un message');
define('TEXTE_COL_GAUCHE_INFO', 'Grce  votre messagerie vous pouvez envoyer des messages TEXTES, VIDEO et AUDIO  tous vos contacts !');
define('TITRE_SELECTION_MESSAGE', 'Choix du message : TEXTE / VIDEO / AUDIO');
define('SELECTION_MESSAGE_TEXTE', 'Ecrire et envoyer un message texte');
define('SELECTION_MESSAGE_AUDIO', 'Ecrire et envoyer un message audio');
define('SELECTION_MESSAGE_VIDEO', 'Ecrire et envoyer un message vido');
define('COL_GAUCHE_MENU_TITRE', 'Ma messagerie');
define('COL_GAUCHE_MENU_RECEPTION', 'Boite de reception');
define('COL_GAUCHE_MENU_ENVOYES', 'Messages envoys');
define('COL_GAUCHE_MENU_SUPPRIMES', 'Messages supprims');
define('TYPE_DEV_MESSAGERIE', 'Type');
define('ETAT_DEV_MESSAGERIE', 'Etat');
define('EXP_DEV_MESSAGERIE', 'De');
define('OBJET_DEV_MESSAGERIE', 'Objet');
define('DATE_DEV_MESSAGERIE', 'Reu le');
define('BOITE_DE_MESSAGERIE', 'Boite de rception');
define('TITRE_LEGENDE', 'Legende');
define('TEXTE_LEGENDE', HTTP_WARNING.' Pour supprimer un message, vous devez cocher le message concern et cliquer sur l\'icone reprsentant la corbeille. Le message sera dfinitivement effac.');

define('TITRE_PAGINATION', 'Navigation');

define('H2_ECRIRE_MESSAGE_TEXTE', ' "Ma messagerie" - envoyer un message texte');
define('H2_ECRIRE_MESSAGE_AUDIO', ' "Ma messagerie" - envoyer un message audio');
define('H2_ECRIRE_MESSAGE_VIDEO', ' "Ma messagerie" - envoyer un message vido');

define('BOUTON_SUBMIT_TEXTE', 'bt_mess_texte_fr.jpg');
define('BOUTON_SUBMIT_AUDIO', 'bt_mess_audio_fr.jpg');
define('BOUTON_SUBMIT_VIDEO', 'bt_mess_video_fr.jpg');

define('BOUTON_REPONSE_TEXTE', 'bt_rep_txt_fr.jpg');
define('BOUTON_REPONSE_AUDIO', 'bt_rep_audio_fr.jpg');
define('BOUTON_REPONSE_VIDEO', 'bt_rep_video_fr.jpg');
define('BOUTON_SUPPRIMER_MESSAGE', 'bt_del_fr.jpg');
define('BOUTON_REPONSE_TCHAT', 'bt_rep_tchat_fr.jpg');
define('BOUTON_REPONSE_TCHAT_OFF', 'bt_rep_tchat_fr_off.jpg');

define('MESSAGE_EXPLICATIF_BOUTON_REPONSE', HTTP_WARNING.' Pour rpondre  ce message, cliquer sur le bouton de votre choix.<br />' .
		'Le bouton OFFLINE/ONLINE vous permet de contacter votre expditeur immdiatement par tchat si celui-ci est connect actuellement sur le site.');
?>
