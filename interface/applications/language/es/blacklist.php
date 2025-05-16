<?php
session_start();
define('HEADER_TITLE', 'Blacklist');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1_BLACKLIST', 'Usarios blacklist');
define('H2_BLACKLIST', 'Blacklist');
define('H2_BLACKLIST_AJOUTER', 'Aadir un miembro a la blacklist');
define('H2_BLACKLIST_SUPPRIMER', 'Borrar un miembro en la blacklist');

define('PAS_DE_RESULTAT', 'No hay resultados disponibles');
define('NOMBRE_RESULTAT', 'Numbre de la blacklist : ');
define('PAGE', 'Pgina : ');

define('BOUTON_RETOUR_PAGINATION', '<< antes');
define('BOUTON_SUITE_PAGINATION', 'despues >>');

define('PSEUDO_BLACKLISTER', 'Login en blacklist');
define('LIBELLE_PSEUDO_BLACKLISTER', 'Login del contacto');
define('DATE_BLACKLISTER', 'Fecha');
define('AJOUTER_BLACKLISTER', ' + Aadir');
define('SUPPRIMER_BLACKLISTER', 'Borrar de la blacklist');
define('PROFIL_BLACKLISTER', 'Ver Perfil');
define('PROFIL', 'Ver');
define('BLACKLISTER', 'Borrar');


define('SUBMIT_BLACKLISTER', 'Aadir el miembro');
define('MESSAGE_TEXTE_BLACKLISTER', '/!\ Cuidado : El miembro blacklist ya no puede en contacto con usted por correo electrnico o contacto instantneo!');

define('MEMBRE_SUPPRIMER_LISTE', 'El miembro se ha borrado de la lista!');

define('ERREUR_MEMBRE_INCONNU_BLACKLIST', 'Lo siento pero este usuario no est registrado en nuestro sitio.');
define('ERREUR_MEMBRE_DEJA_BLACKLISTER', 'Lo siento pero este usuario ya esta en la lista negra!');

define('MEMBRE_AJOUTER_SUCCES_BLACKLIST', 'El usuario se ha aadido!');

define('MESSAGE_PREVENTION', 'Aqu la falta de respeto?' .
		'<br />As que escribe este usarios en sus contactos <span style="color:black;font-weight:bolder;">BLACKLIST</span>' .
		'<br />Introduzca el usario o estos usarios y' .
		'<br />despues no podran enviar mensajes !');

define('MESSAGE_CONSEIL_CONTACTER', HTTP_WARNING.' <span style="text-decoration:underline;font-weight:bolder;">Mensaje de la administracin-INTERCAMBIO-DE-CASA.COM</span>' .
		'<br />Tambin puede usted en todo momento en contacto con nosotros que moleste usted y vamos a actuar con ellos en forma de advertencias de que podra dar lugar a la cancelacin de este sitio' .
		'<br /><a href="'.HTTP_SERVEUR.FILENAME_CONTACT.'"><em>Contactarnos</em></a>');


?>
