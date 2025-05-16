<?php
// config.php
define('RACINE', __DIR__ . '/');
define('LANGUAGE', 'fr');
define('FILENAME_INDEX', 'index.php');
define('FILENAME_PAGE_PAIEMENT', 'interface/paiement-ligne.php');
define('HTTP_SERVEUR', 'http://localhost/maison/');
define('FILENAME_CONSEILS', '');


require_once RACINE . 'interface/applications/commun/fct-utile.php';

includeLanguage(RACINE, LANGUAGE, FILENAME_INDEX);


