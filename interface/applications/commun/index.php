<?php
// Démarrage sécurisé de session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir le chemin absolu du fichier de configuration
$configPath = __DIR__ . '/interface/applications/commun/configuration.php';
if (file_exists($configPath)) {
    include_once($configPath);
} else {
    die('Erreur : fichier .');
}

// Inclusion des fonctions et classes (ces constantes doivent être définies dans configuration.php)
include_once(INCLUDE_FCTS_UTILE);
include_once(INCLUDE_CLASS_LOGIN);
include_once(INCLUDE_CLASS_METIER);

// Initialisation des objets
$login = new Login();
$metier = new Metier();

// Chargement des traductions (fichier langue)
$langPath = INCLUDE_LANGUAGE . LANGUAGE . '/' . FILENAME_INDEX;
if (file_exists($langPath)) {
    include_once($langPath);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="<?php echo CONFIGURATION_CHARSET; ?>" />
    <meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>" />
    <meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>" />
    <title><?php echo HEADER_TITLE; ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/style.css" />

    <!-- Correction IE6 -->
    <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="<?php echo CONFIGURATION_CSS_CORRECTION_IE; ?>" />
    <![endif]-->
</head>
<body>

<h1><?php echo H1_DE_LA_PAGE ?? 'Bienvenue sur Échange de maison'; ?></h1>

<p><?php echo TEXTE_1 ?? 'Page d’accueil du site. À personnaliser.'; ?></p>

</body>
</html>
