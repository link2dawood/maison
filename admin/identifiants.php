<?php
// Activer l'affichage des erreurs (utile en développement)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
define('BDD_SERVEUR', '127.0.0.1');
define('BDD_IDENTIFIANT', 'root');
define('BDD_MOT_PASSE', '');
define('BDD_BASE_DE_DONNEES', 'maison');

// Connexion mysqli
$link = mysqli_connect(BDD_SERVEUR, BDD_IDENTIFIANT, BDD_MOT_PASSE, BDD_BASE_DE_DONNEES);
if (!$link) {
    die('Erreur de connexion MySQL : ' . mysqli_connect_error());
}
mysqli_set_charset($link, "utf8");

// Chargement des paramètres depuis la table "configuration"
$config = [];

$query = "SELECT * FROM configuration ORDER BY id ASC";
$result = mysqli_query($link, $query);

if ($result) {
    while ($row = mysqli_fetch_object($result)) {
        $config[] = $row->parametrage ?? '';
    }
    mysqli_free_result($result);
} else {
    // Gestion d'erreur si la requête échoue
    error_log("Erreur lors de la requête SQL : " . mysqli_error($link));
}
mysqli_close($link);

// Constantes générales
define('RACINE', $config[0] ?? '');
define('RACINE_VIRTUEL', $_SERVER['DOCUMENT_ROOT'] ?? '');
define('HTTP_HOST', $config[1] ?? '');

// Constantes de chemins de fichiers
define('INCLUDE_FCTS_UTILE', RACINE . '/interface/applications/commun/fonctions_utile.php');
define('INCLUDE_CLASS_ESPACE_MEMBRE', RACINE . '/interface/applications/commun/class.EspaceMembre.php');
define('INCLUDE_CLASS_METIER', RACINE . '/interface/applications/commun/class.Metier.php');
define('INCLUDE_COMPATIBILITE_NAVIGATEURS', RACINE . '/interface/applications/commun/compatibilite_navigateurs.php');
define('INCLUDE_ADSENSE', RACINE . '/interface/applications/commun/bloc_adsense.php');
define('INCLUDE_MODULE_ECHANGE_MAISON', RACINE . '/interface/applications/commun/module_echange_maison.php');
define('INCLUDE_MODULE_ECHANGE_MAISON_DERNIERS_INSCRITS', RACINE . '/interface/applications/commun/module_echange_maison_derniers.php');
define('INCLUDE_MODULE_COUCHSURFING', RACINE . '/interface/applications/commun/module_couchsurfing.php');
define('INCLUDE_MODULE_COUCHSURFING_DERNIERS_INSCRITS', RACINE . '/interface/applications/commun/module_couchsurfing_derniers.php');
define('INCLUDE_MODULE_DERNIERS_ARTICLES_BLOG', RACINE . '/interface/applications/commun/module_blog.php');
define('INCLUDE_FOOTER_LIENS', RACINE . '/interface/applications/commun/footer_liens.php');
define('INCLUDE_FOOTER_PARTENAIRES', RACINE . '/interface/applications/commun/footer_partenaires.php');
define('INCLUDE_FOOTER', RACINE . '/interface/applications/commun/footer.php');

// Constantes de configuration HTML (valeurs par défaut si non définies)
if (!defined('CONFIGURATION_CONTENT')) {
    define('CONFIGURATION_CONTENT', 'text/html');
}
if (!defined('CONFIGURATION_CHARSET')) {
    define('CONFIGURATION_CHARSET', 'utf-8');
}

define('CONFIGURATION_CSS', '/interface/css/style.css');
define('CONFIGURATION_LIGHTBOX_CSS', '/interface/css/lightbox.css');
define('CONFIGURATION_LIGHTBOX_JS', '<script src="/interface/js/lightbox.js"></script>');
define('CONFIGURATION_JS', '<script src="/interface/js/global.js"></script>');
define('CONFIGURATION_ROBOTS_NOFOLLOW', '<meta name="robots" content="noindex,nofollow" />');

// Langue par défaut
define('LANGUAGE', 'fr');

// Nom des fichiers utilisés dans les includes
define('FILENAME_INDEX', 'index.php');
define('FILENAME_ADMIN_CONFIGURATION', 'admin_configuration.php');
define('FILENAME_CONSEILS', 'conseils.php');
define('FILENAME_MOTEUR_MAISON', 'moteur.php');
define('FILENAME_CONSEILLER_SITE_AMI', 'conseiller_ami.php');
define('FILENAME_CONTACT', 'contact.php');
