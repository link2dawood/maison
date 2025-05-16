<?php
// Sécurise l'inclusion de la configuration
$configPath = $_SERVER['DOCUMENT_ROOT'] . '//homepages/10/d4299005927/htdocs/maison/interface/applications/language/fr).';
if (file_exists($configPath)) {
    include($configPath);
} else {
    die('Erreur : fichier configuration introuvable.');
}
?>
<!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" href="<?php echo CONFIGURATION_CSS_CORRECTION_IE; ?>" />
<![endif]-->
