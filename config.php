<?php
define('RACINE', __DIR__ . '/');
define('LANGUAGE', 'fr');
define('FILENAME_INDEX', 'interface/applications/language/fr/index.php'); // Fixed path
define('HTTP_SERVEUR', 'http://localhost/maison/');

function includeLanguage($racine, $langue, $fichier) {
    $chemin = $racine . $fichier;
    if (file_exists($chemin)) {
        include_once($chemin);
    } else {
        echo "<p><i>Erreur : fichier de langue introuvable ($chemin).</i></p>";
    }
}

includeLanguage(RACINE, LANGUAGE, FILENAME_INDEX);
