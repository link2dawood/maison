<?php
session_start(); 
/*
 * PAGE INDEX LANGUAGE FRANCAIS 
 */

define('HEADER_TITLE', 'Free Registration');
define('HEADER_DESCRIPTION', 'You also enjoy all the features that make the success of our site : save contacts bookmark, tchat with ours others members with your webcam, etc... Register for free and without waiting for join our international community.');
define('HEADER_KEYWORDS', 'home exchange, webcam, free accomodation, free holidays accommodation, coach surfing, apartment exchange, webcam home exchange, webcam free accomodation, vacation, vacations, vacations exchange, exchange, travel, holidays, holidays exchange');

define('H1_DE_LA_PAGE', 'Free Registration');
define('H2_DE_LA_PAGE', 'Free registration form');

//FORMULAIRE INSCRIPTION ACCUEIL
define('FORMULAIRE_MON_PSEUDO', 'My login : ');
define('FORMULAIRE_MOT_DE_PASSE', 'Password : ');
define('FORMULAIRE_CONFIRMATION', 'Confirmation : ');
define('FORMULAIRE_EMAIL', 'Email : ');
define('FORMULAIRE_CODE_ANTISPAM', 'ANTI-SPAM code:');
define('FORMULAIRE_CGU', '&nbsp;I certify that I have read and understood <a href="'.HTTP_SERVEUR.FILENAME_CGU.'" target="_blank">Terms of use</a>');
define('FORMULAIRE_IMAGE_SUBMIT', 'bt_connecter.jpg');

define('FORMULAIRE_NON_CONFORME', 'We are sorry but all fields are required !');
define('FORMULAIRE_ERREUR_CARACTERES_SPECIAUX', 'We\'re sorry, but special characters are not allowed.');
define('FORMULAIRE_ERREUR_PSEUDO_DEJA_CONNU', 'We\'re sorry but this login is already used.');
define('FORMULAIRE_ERREUR_SYNTAXE_EMAIL', 'We\'re sorry but this email is not valid.');
define('FORMULAIRE_ERREUR_EMAIL_DEJA_UTILISE', 'We\'re sorry but this email is already used by another account.');
define('FORMULAIRE_INSCRIPTION_ACCEPTEE', 'Congratulations ! <br />You just register on our site.<br />Log in and join our members who are waiting for you!');
define('FORMULAIRE_ERREUR_MOTS_DE_PASSES_DIFFERENTS', 'We\'re sorry but the confirmation password is not matching.');
define('FORMULAIRE_ERREUR_CGU_NON_COCHEE', 'We\'re sorry but you have not checked the Terms of use, you can not enter the site.');
define('FORMULAIRE_ERREUR_EMAIL_VIDE', 'We\'re sorry but you must enter your email.');
define('FORMULAIRE_ERREUR_CODE_ANTISPAM', 'We\'re sorry but the ANTI-SPAM code is invalid!');

define('MAIL_ENTETE', 'Registration Confirmation');

define('TEXTE_1', 'Dear user, welcome to home exchange and free holidays accommodation.' .
		'<br /><br /><br />Become a member for free by fill in the form below.' .
		'<br />First, we suggest you to read ours <a href="'.HTTP_SERVEUR.FILENAME_CGU.'" target="_blank"><em>Terms of use</em></a> not only to read the rules of the site but also allow you to find answers to your questions.' .
		'<br /><br /><br />With this free registration you\'ll be able to:' .
		'<br />- Write and publish your ad' .
		'<br />- To search and read detailed profile.' .
		'<br /><br /><br />However, any action to another member (Write or read a message, write or read an instant messenger will require to get a subscription).' .
		'<br /><br /><br />For questions, contact us <a href="'.HTTP_SERVEUR.FILENAME_CONTACT.'" target="_blank"><em>contact form</em></a>, we will respond as soon as possible.');



?>