<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Activer les erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Chargement configuration
$configPath = '/homepages/10/d4299005927/htdocs/maison/interface/applications/commun/configuration.php';
if (file_exists($configPath)) {
    include_once($configPath);
}

// Sécurité : valeurs de secours si les constantes ne sont pas définies
if (!defined('CONFIGURATION_CONTENT')) define('CONFIGURATION_CONTENT', 'text/html');
if (!defined('CONFIGURATION_CHARSET')) define('CONFIGURATION_CHARSET', 'ISO-8859-1');
if (!defined('HEADER_DESCRIPTION')) define('HEADER_DESCRIPTION', 'Erreur 404');
if (!defined('HEADER_KEYWORDS')) define('HEADER_KEYWORDS', '404, erreur');
if (!defined('H1_DE_LA_PAGE')) define('H1_DE_LA_PAGE', 'Erreur 404');
if (!defined('H2_DE_LA_PAGE')) define('H2_DE_LA_PAGE', 'Page introuvable');
if (!defined('TEXTE_1')) define('TEXTE_1', 'La page demandée est introuvable. Veuillez vérifier l’URL ou revenir à l’accueil.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo H1_DE_LA_PAGE; ?></title>
    <meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>" />
    <meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>" />
    <meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
            padding: 100px 20px;
        }
        h1 {
            font-size: 36px;
            color: #e74c3c;
        }
        h2 {
            font-size: 24px;
            margin-top: 20px;
        }
        p {
            font-size: 18px;
            margin-top: 15px;
        }
        a.btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        a.btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1><?php echo H1_DE_LA_PAGE; ?></h1>
    <h2><?php echo H2_DE_LA_PAGE; ?></h2>
    <p><?php echo TEXTE_1; ?></p>
    <a href="/maison/index.php" class="btn">Retour à l'accueil</a>
</body>
</html>
