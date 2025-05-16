<?php
session_start();
define('HEADER_TITLE', 'Mailbox');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1_ONLINE', 'Tchat in live');
define('H1_OFFLINE', 'Mail');

define('MESSENGER_ACCEPTATION_MESSAGE_TEXTE', 'Tchat sent !');
define('MESSENGER_ACCEPTATION_MESSAGE_DEMANDE_DUO', 'Mail sent !');

define('MESSENGER_LIRE_MESSAGE', 'Accept');
define('MESSENGER_ACCEPTER_MESSAGE', 'Accept');
define('MESSENGER_SUPPRIMER_MESSAGE', 'Deny');

define('TOTAL_EN_COURS_MESSENGER', '');
define('TOTAL_EN_COURS_MESSENGER_TEXTE', '- Tchat sent unread:');
define('TOTAL_EN_COURS_MESSENGER_DUO', '');

define('MESSAGE_CONFIRMATION_DUO', 'Tchat accepted !');

define('LIBELLE_1_TCHAT', 'Msg Tchat:');
define('LIBELLE_2_TCHAT', 'Msg Audio:');
define('LIBELLE_3_TCHAT', 'Msg Vido:');

define('MESSAGE_ACCES_TCHAT', 'Direct access : <a href="'.HTTP_TCHAT.'" style="text-decoration:underline;" target="_top">Over than 240 chatrooms in live</a>');
?>
