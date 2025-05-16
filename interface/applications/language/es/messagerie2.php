<?php
session_start();
define('HEADER_TITLE', 'Boite de messagerie');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1_ONLINE', 'Tchat en direct');
define('H1_OFFLINE', 'Courrier');

define('MESSENGER_ACCEPTATION_MESSAGE_TEXTE', 'Tchat envoy !');
define('MESSENGER_ACCEPTATION_MESSAGE_DEMANDE_DUO', 'Mail envoy !');

define('MESSENGER_LIRE_MESSAGE', 'Accepter');
define('MESSENGER_ACCEPTER_MESSAGE', 'Accepter');
define('MESSENGER_SUPPRIMER_MESSAGE', 'Refuser');

define('TOTAL_EN_COURS_MESSENGER', '');
define('TOTAL_EN_COURS_MESSENGER_TEXTE', '- Tchat envoy&eacute;(s) non lu(s):');
define('TOTAL_EN_COURS_MESSENGER_DUO', '');

define('MESSAGE_CONFIRMATION_DUO', 'Tchat accept&eacute;e !');

define('LIBELLE_1_TCHAT', 'Msg Tchat:');
define('LIBELLE_2_TCHAT', 'Msg Audio:');
define('LIBELLE_3_TCHAT', 'Msg Vido:');

define('MESSAGE_ACCES_TCHAT', 'Accs direct : <a href="'.HTTP_TCHAT.'" style="text-decoration:underline;" target="_top">Salon de discussion</a>');
?>
