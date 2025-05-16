<?php
session_start();
define('HEADER_TITLE', 'Liste des blacklists');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', '');

define('H1_BLACKLIST', 'Membres blacklists');
define('H2_BLACKLIST', 'Liste noire');
define('H2_BLACKLIST_AJOUTER', 'Ajouter un membre dans la liste noire');
define('H2_BLACKLIST_SUPPRIMER', 'Supprimer un membre dans la liste noire');

define('PAS_DE_RESULTAT', 'Pas de rsultat disponible');
define('NOMBRE_RESULTAT', 'Nombre de blacklists : ');
define('PAGE', 'Page : ');

define('BOUTON_RETOUR_PAGINATION', '<< retour');
define('BOUTON_SUITE_PAGINATION', 'suite >>');

define('PSEUDO_BLACKLISTER', 'Pseudo en liste noire');
define('LIBELLE_PSEUDO_BLACKLISTER', 'Pseudo du contact');
define('DATE_BLACKLISTER', 'Date');
define('AJOUTER_BLACKLISTER', ' + Ajouter');
define('SUPPRIMER_BLACKLISTER', 'Retirer de la liste noire');
define('PROFIL_BLACKLISTER', 'Voir profil');
define('PROFIL', 'Voir');
define('BLACKLISTER', 'Supprimer');


define('SUBMIT_BLACKLISTER', 'Ajouter le membre');
define('MESSAGE_TEXTE_BLACKLISTER', '/!\ Attention : Le membre blacklist ne pourra plus vous contacter par mail ou par contact instantan!');

define('MEMBRE_SUPPRIMER_LISTE', 'Le membre a t supprim de la liste!');

define('ERREUR_MEMBRE_INCONNU_BLACKLIST', 'Nous sommes dsols mais ce membre n\'est pas inscrit sur notre site. Assurez-vous de l\'orthographe de celui-ci!');
define('ERREUR_MEMBRE_DEJA_BLACKLISTER', 'Nous sommes dsols mais ce membre est dj blacklist!');

define('MEMBRE_AJOUTER_SUCCES_BLACKLIST', 'Le membre a t ajout avec succs!');

define('MESSAGE_PREVENTION', 'Vous tes importun? Lon vous a manqu de respect?' .
		'<br />Alors inscrivez ces contacts malveillants dans votre <span style="color:black;font-weight:bolder;">LISTE NOIRE</span>' .
		'<br />Saisissez le pseudo de ce ou ces contacts et ils ne pourront plus' .
		'<br />vous envoyez de messages en DIRECT ni dans votre MESSAGERIE');

define('MESSAGE_CONSEIL_CONTACTER', HTTP_WARNING.' <span style="text-decoration:underline;font-weight:bolder;">Message de ladministration vacanceshome.com</span>' .
		'<br />Vous pouvez aussi  tout moment nous signaler tout contact qui vous importune et nous agirons auprs deux sous forme davertissements pouvant mener  la radiation de ce site' .
		'<br /><a href="'.HTTP_SERVEUR.FILENAME_CONTACT.'"><em>Signaler un abus</em></a>');






?>
