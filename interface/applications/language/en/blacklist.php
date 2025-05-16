<?php
session_start();
define('HEADER_TITLE', 'List of blacklisted');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1_BLACKLIST', 'Members blacklists');
define('H2_BLACKLIST', 'Blacklist');
define('H2_BLACKLIST_AJOUTER', 'Add a member to the blacklist');
define('H2_BLACKLIST_SUPPRIMER', 'Delete a member in the blacklist');

define('PAS_DE_RESULTAT', 'No results available');
define('NOMBRE_RESULTAT', 'Number of blacklisted : ');
define('PAGE', 'Page : ');

define('BOUTON_RETOUR_PAGINATION', '<< back');
define('BOUTON_SUITE_PAGINATION', 'next >>');

define('PSEUDO_BLACKLISTER', 'Pseudo blacklisted');
define('LIBELLE_PSEUDO_BLACKLISTER', 'Login contact');
define('DATE_BLACKLISTER', 'Date');
define('AJOUTER_BLACKLISTER', ' + Add');
define('SUPPRIMER_BLACKLISTER', 'Remove from blacklist');
define('PROFIL_BLACKLISTER', 'View Profile');
define('PROFIL', 'View');
define('BLACKLISTER', 'Delete');


define('SUBMIT_BLACKLISTER', 'Add the member');
define('MESSAGE_TEXTE_BLACKLISTER', '/!\ Warning: The blacklisted member can no longer contact you by mail or instant messenger!');

define('MEMBRE_SUPPRIMER_LISTE', 'The member was deleted from the list!');

define('ERREUR_MEMBRE_INCONNU_BLACKLIST', 'We\'re sorry but this member is not registered from the site. Make sure to spell it right!');
define('ERREUR_MEMBRE_DEJA_BLACKLISTER', 'We\'re sorry but this member is already blacklisted!');

define('MEMBRE_AJOUTER_SUCCES_BLACKLIST', 'The member was added successfully!');

define('MESSAGE_PREVENTION', 'You are disturbed by members? A member was disrespect?' .
		'<br />So write this members in your contacts <span style="color:black;font-weight:bolder;">BLACKLIST</span>' .
		'<br />Enter the name of this or these contacts and they will no longer send you' .
		'<br />messages by INSTANT MESSENGER or by MAILBOX');

define('MESSAGE_CONSEIL_CONTACTER', HTTP_WARNING.' <span style="text-decoration:underline;font-weight:bolder;">Message from the administration HOME-EXCHANGE.BIZ</span>' .
		'<br />You can also at any time contact us if members bothering you and we will act with them in the form of warnings that could lead to the cancellation of this site' .
		'<br /><a href="'.HTTP_SERVEUR.FILENAME_CONTACT.'"><em>Report</em></a>');






?>
