<?php
// Définition des constantes de configuration
define('RACINE', __DIR__ . '/');
define('LANGUAGE', 'fr');
define('FILENAME_INDEX', 'lang/index_fr.php');

// Fonction de chargement de la langue
function includeLanguage($racine, $langue, $fichier) {
    $chemin = $racine . $fichier;
    if (file_exists($chemin)) {
        include_once($chemin);
    } else {
        echo "<p><i>Erreur : fichier de langue introuvable ($chemin).</i></p>";
    }
}
