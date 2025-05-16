<?php
session_start();
define('HEADER_TITLE', 'My mailbox');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1', 'My mailbox');

define('H2_RECEPTION', 'Welcome to my mailbox"');
define('H2_MESSAGES_ENVOYES', 'Messages sent');
define('H2_CORBEILLE', 'Trash');

define('INTITULE_MENU_MESSAGERIE', 'Menu :');

define('PAS_DE_RESULTAT', 'No results available');
define('NOMBRE_RESULTAT', 'Result:');
define('PAGE', 'Page:');

define('BOUTON_RETOUR_PAGINATION', '<< back');
define('BOUTON_SUITE_PAGINATION', 'next >>');

define('ETAT_MESSAGE_NON_LU', '(message unread)');
define('ETAT_MESSAGE_LU', '(message read)');
define('ETAT_MESSAGE_SUPPRIMER', '(message deleted)');
define('NOUVEAU_MESSAGE', '<em>new</em>');
define('REPONSE_MESSAGE', '<em>reply</em>');

define('DESCRIPTION_MESSAGE', '<span style="text-decoration:underline;">Extract:</span> ');

define('MESSENGER_LIRE_MESSAGE_TEXTE', ' Read a text message');
define('MESSENGER_LIRE_MESSAGE_AUDIO', ' Read an audio message');
define('MESSENGER_LIRE_MESSAGE_VIDEO', ' Read a video message');
define('MESSENGER_ACCEPTER_MESSAGE', ' ERROR !!! ');
define('SUPPRIMER_MESSAGE', ' Ignore ');

define('DATE_MESSAGE', '<span style="text-decoration:underline;">Date:</span> ');
define('EXPEDITEUR_MESSAGE', '<span style="text-decoration:underline;">Login:</span> ');
define('ETAT_MESSAGE', '<span style="text-decoration:underline;">Statut:</span> ');

define('MESSENGER_GESTION_LIRE_MESSAGE_TEXTE', 'Read the message of : ');
define('MESSENGER_GESTION_LIRE_MESSAGE_DEMANDE_DUO', 'Reply to : ');

define('MESSENGER_GESTION_REPONDRE_MESSAGE', 'Reply');
define('MESSENGER_GESTION_SUPPRIMER_MESSAGE', 'Ignore');
define('MESSENGER_GESTION_ACCEPTER_MESSAGE', 'Accept');
define('MESSENGER_GESTION_ANNULER_MESSAGE', 'Cancel');
define('MESSENGER_GESTION_REPONDRE_MESSAGE_TEXTE', 'Reply message ');

define('MESSENGER_GESTION_OPTIONS_REPONSES', 'You prefer to respond by :');

define('MESSENGER_GESTION_ANCHOR_MESSAGE_TEXTE', 'text message');
define('MESSENGER_GESTION_ANCHOR_MESSAGE_AUDIO', 'audio message');
define('MESSENGER_GESTION_ANCHOR_MESSAGE_VIDEO', 'video message');

define('MESSENGER_SUPPRESSION_MESSAGE', 'The message was ignored !');
define('MESSENGER_SUPPRESSION_MESSAGE_OFF', 'The message has been deleted !');
define('MESSAGE_ENVOYE', 'The message has been sent !');

define('MESSENGER_REPONDRE_MESSAGE_TEXTE', 'Reply by text message');
define('MESSENGER_REPONDRE_MESSAGE_AUDIO', 'Reply by audio message');
define('MESSENGER_REPONDRE_MESSAGE_VIDEO', 'Reply by video message');

define('PHRASE_MESSAGE_TEXTE', 'Type your message in the field below and then click SEND');
								
define('COMMENTAIRE_TEXTAREA', 'Free text...');

define('CONTACTER_PAR_MESSENGER', 'NOTE: The member is online... <br />Do you want to contact him directly? <br />Please, follow this link :');
define('BT_CONTACTER_PAR_MESSENGER', ' Tchat ');

define('TEXTE_BOUTON_DESACTIVER', 'We\'re sorry but we have disabled the reply button because you\'ve already contacted him but it has not yet answered...<br />Thank you for your understanding !');
define('ANCHOR_BOUTON_DESACTIVER', '<span style="font-weight:bolder;color:red;">- OFF BUTTON -</span>');
define('DESACTIVER_OPTIONS_MESSAGERIE', ' - ANSWERS OFF OPTIONS -');

define('BOUTON_SUPPRIMER_OFF', 'Delete permanently');

define('TEXTE_PSEUDO_A_CONTACTER', '<em>/!\ member to contact</em>');
define('PSEUDO_A_CONTACTER', 'Login to contact:');
define('LIBELLE_MESSAGE', 'Message:');

define('MESSAGE_ALERTE_SUPPRESSION_MESSAGE', '* WARNING : click on "<strong>Delete permanently</strong>" and your message will be completely erased from the mail box of your correspondent !');

define('TITRE_COL_GAUCHE_INFO', 'Send a message');
define('TEXTE_COL_GAUCHE_INFO', 'With your mailbox, you can send TEXT messages, VIDEO and AUDIO to all your contacts !');
define('TITRE_SELECTION_MESSAGE', 'Choice of message : TEXTE / VIDEO / AUDIO');
define('SELECTION_MESSAGE_TEXTE', 'Write and send a text message');
define('SELECTION_MESSAGE_AUDIO', 'Write and send a audio message');
define('SELECTION_MESSAGE_VIDEO', 'Write and send a video message');
define('COL_GAUCHE_MENU_TITRE', 'My messages');
define('COL_GAUCHE_MENU_RECEPTION', 'Mailbox');
define('COL_GAUCHE_MENU_ENVOYES', 'Messages sent');
define('COL_GAUCHE_MENU_SUPPRIMES', 'Messages deleted');
define('TYPE_DEV_MESSAGERIE', 'Type');
define('ETAT_DEV_MESSAGERIE', 'Statut');
define('EXP_DEV_MESSAGERIE', 'From');
define('OBJET_DEV_MESSAGERIE', 'Object');
define('DATE_DEV_MESSAGERIE', 'Received on');
define('BOITE_DE_MESSAGERIE', 'Mailbox');
define('TITRE_LEGENDE', 'Legend');
define('TEXTE_LEGENDE', HTTP_WARNING.' To delete a message, you must check the message and click on the icon representing the trash. The message will be permanently deleted.');

define('TITRE_PAGINATION', 'Navigation');

define('H2_ECRIRE_MESSAGE_TEXTE', ' "My mail" - send a text message');
define('H2_ECRIRE_MESSAGE_AUDIO', ' "My mail" - send a audio message');
define('H2_ECRIRE_MESSAGE_VIDEO', ' "My mail" - send a video message');

define('BOUTON_SUBMIT_TEXTE', 'bt_mess_texte_fr.jpg');
define('BOUTON_SUBMIT_AUDIO', 'bt_mess_audio_fr.jpg');
define('BOUTON_SUBMIT_VIDEO', 'bt_mess_video_fr.jpg');

define('BOUTON_REPONSE_TEXTE', 'bt_rep_txt_fr.jpg');
define('BOUTON_REPONSE_AUDIO', 'bt_rep_audio_fr.jpg');
define('BOUTON_REPONSE_VIDEO', 'bt_rep_video_fr.jpg');
define('BOUTON_SUPPRIMER_MESSAGE', 'bt_del_fr.jpg');
define('BOUTON_REPONSE_TCHAT', 'bt_rep_tchat_fr.jpg');
define('BOUTON_REPONSE_TCHAT_OFF', 'bt_rep_tchat_fr_off.jpg');

define('MESSAGE_EXPLICATIF_BOUTON_REPONSE', HTTP_WARNING.' To reply to this message, click on the button of your choice.<br />' .
		'The button OFFLINE/ONLINE allows you to contact your friend immediately by tchat if his/her is connected.');
?>
