<?php
// Sécurise l'inclusion de la configuration
$configPath = $_SERVER['DOCUMENT_ROOT'] . '/maison/interface/applications/commun/configuration.php';
if (file_exists($configPath)) {
    include_once($configPath);
} else {
    die('Erreur : fichier de configuration introuvable.');
}
?>
<!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" href="<?php echo CONFIGURATION_CSS_CORRECTION_IE; ?>" />
<![endif]-->
