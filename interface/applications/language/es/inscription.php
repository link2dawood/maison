<?php
session_start(); 
/*
 * PAGE INDEX LANGUAGE FRANCAIS 
 */

define('HEADER_TITLE', 'Inscription gratuite');
define('HEADER_DESCRIPTION', 'Bnficiez vous aussi de toutes les fonctionnalits qui font le succs de notre site : mettre ses contacts en favori, tchat avec nos autres membres avec votre webcam, etc... Inscrivez-vous gratuitement et rejoignez sans attendre notre communaut internationale.');
define('HEADER_KEYWORDS', 'Inscription gratuite, voyage, change de maison, humanitaire, location de vacances, gites, hotel, camping,echange d\'appartement, change appartement, change de maisons, echange demaisons, appartement, echange de maison, appartements, condo, appartement, apartement, camping-car, etranger, camping car, Home exchange, homexchange, HOMEEXCHANGE, EXCHANGE, exchanges, camping cars, change, quebec, Home Exchange, france, canada, change-maison, Quebec, France, Canada, Echanges, maison, qubec, vacances  l\'etranger');

define('H1_DE_LA_PAGE', 'Inscription gratuite');
define('H2_DE_LA_PAGE', 'Formulaire inscription gratuite');

//FORMULAIRE INSCRIPTION ACCUEIL
define('FORMULAIRE_MON_PSEUDO', 'Mon pseudo : ');
define('FORMULAIRE_MOT_DE_PASSE', 'Mot de passe : ');
define('FORMULAIRE_CONFIRMATION', 'Confirmation : ');
define('FORMULAIRE_EMAIL', 'Email : ');
define('FORMULAIRE_CODE_ANTISPAM', 'Code ANTI-SPAM:');
define('FORMULAIRE_CGU', '&nbsp;Je certifie avoir lu et compris les <a href="'.HTTP_SERVEUR.FILENAME_CGU.'" target="_blank">Conditions Gnrales</a>');
define('FORMULAIRE_IMAGE_SUBMIT', 'bt_connecter.jpg');

define('FORMULAIRE_NON_CONFORME', 'Nous sommes dsols mais tous les champs sont obligatoires');
define('FORMULAIRE_ERREUR_CARACTERES_SPECIAUX', 'Nous sommes dsols mais les caractres spciaux ne sont pas autoriss.');
define('FORMULAIRE_ERREUR_PSEUDO_DEJA_CONNU', 'Nous sommes dsols mais ce pseudo est dj utilis.');
define('FORMULAIRE_ERREUR_SYNTAXE_EMAIL', 'Nous sommes dsols mais cet email n\'est pas valide.');
define('FORMULAIRE_ERREUR_EMAIL_DEJA_UTILISE', 'Nous sommes dsols mais cet email est dj utilis par un autre compte.');
define('FORMULAIRE_INSCRIPTION_ACCEPTEE', 'Flicitation ! <br />Vous venez de vous inscrire sur notre site.<br />Connectez-vous et rejoignez nos membres qui vous attendent!');
define('FORMULAIRE_ERREUR_MOTS_DE_PASSES_DIFFERENTS', 'Nous sommes dsols mais la confirmation du mot de passe n\'est pas identique.');
define('FORMULAIRE_ERREUR_CGU_NON_COCHEE', 'Nous sommes dsols mais vous n\'avez pas coch les CGU, vous ne pouvez pas entrer sur le site.');
define('FORMULAIRE_ERREUR_EMAIL_VIDE', 'Nous sommes dsols mais vous devez renseign votre email.');
define('FORMULAIRE_ERREUR_CODE_ANTISPAM', 'Nous sommes dsols mais le code ANTI-SPAM n\'est pas valide !');


define('MAIL_ENTETE', 'Confirmation inscription');

define('TEXTE_1', 'Cher visiteur, bienvenue sur notre site dchange de maison et de couch surfing.' .
		'<br /><br /><br />Devenez membre gratuitement en remplissant le formulaire ci-dessous.' .
		'<br />Prablement, nous vous conseillons de lire nos <a href="'.HTTP_SERVEUR.FILENAME_CGU.'" target="_blank"><em>Conditions Gnrales dUtilisation</em></a> afin non seulement de prendre connaissance des rgles dusage du site mais aussi vous permettre de trouver les rponses  vos questions.' .
		'<br /><br /><br />Grce   cette inscription gratuite, vous aurez la possibilit :' .
		'<br />- De rdiger et de publier votre annonce' .
		'<br />- De rechercher et de consulter des annonces enregistres des autres membres.' .
		'<br /><br /><br />Cependant, toute action vers un autre membre (Ecrire ou lire un message, crire ou lire un message instantan ncessitera de votre part la souscription dune formule dabonnement au choix qui vous sera suggr  l\'appel de ses fonctionnalits.' .
		'<br /><br /><br />Pour toute question, crivez-nous grce  notre <a href="'.HTTP_SERVEUR.FILENAME_CONTACT.'" target="_blank"><em>formulaire de contact</em></a>, nous y rpondrons dans les plus brefs dlais.');



?>