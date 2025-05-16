<?php
// Affiche les erreurs pour debug (à désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Charger le fichier de configuration
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/interface/applications/commun/configuration.php');
// Démarrage sécurisé de la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Récupération des variables de session
$id_client = $_SESSION['id_client'] ?? null;
$pseudo_client = $_SESSION['pseudo_client'] ?? 'Invité';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>

    <meta name="description" content="<?= htmlspecialchars(HEADER_DESCRIPTION ?? '') ?>"/>
    <meta name="keywords" content="<?= htmlspecialchars(HEADER_KEYWORDS ?? '') ?>"/>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?= htmlspecialchars(HTTP_SERVEUR ?? '/') ?>maison.xml" />
    <link href="<?= htmlspecialchars(CONFIGURATION_CSS ?? '') ?>" media="screen" rel="stylesheet" type="text/css" />
    
    <?= afficherMetaLangue(LANGUAGE ?? 'fr') ?>
    <?= CONFIGURATION_JS ?? '' ?>
    <?= CONFIGURATION_LIGHTBOX_JS ?? '' ?>

    <?php if (defined('INCLUDE_COMPATIBILITE_NAVIGATEURS')) include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
</head>

<body>
    <p>Bonjour <?= htmlspecialchars($pseudo_client) ?> !</p>

    <?php
    // Chargement du fichier de langue
    if (defined('RACINE') && defined('LANGUAGE') && defined('FILENAME_INDEX')) {
        includeLanguage(RACINE, LANGUAGE, FILENAME_INDEX);
    } else {
        echo "<p><i>Erreur : paramètres de langue non définis.</i></p>";
    }
    ?>

    <!-- DEBUT EXTERIEUR -->
    <div id="exterieur">
        <div id="back">
            <!-- ENTETE -->
            <div id="entete">
                <div id="logo">
                    <!-- ton logo ici -->
                </div>
            </div>

            <!-- TABLEAU CENTRAL -->
            <table class="conteneur">
                <tr>
                    <td class="info">
                        <h2 class="h2_0"><?= COL_CENTRALE_TITRE ?></h2>
                        <h2 class="h2_1"><?= COL_CENTRALE_H2_MAISON ?></h2>
                        <p class="texte"><?= COL_CENTRALE_TXT_MAISON ?></p>
                        <h2 class="h2_2"><?= COL_CENTRALE_H2_COUCH ?></h2>
                        <p class="texte"><?= COL_CENTRALE_TXT_COUCH ?></p>
                        <h2 class="h2_3"><?= COL_CENTRALE_H2_WEBCAM ?></h2>
                        <p class="texte"><?= COL_CENTRALE_TXT_WEBCAM ?></p>
                    </td>
                    <td class="rubriques">
                        <h2 class="h2_0"><?= COLONNE_DROITE_TITRE ?></h2>

                        <!-- Onglets -->
                        <div class="tabbed_box">
                            <div class="tabbed_area">
                                <ul class="tabs">
                                    <li><a href="javascript:ChangeOnglet('tab_1', 'content_1');" id="tab_1" class="active"><?= ANCHOR_1 ?></a></li>
                                    <li><a href="javascript:ChangeOnglet('tab_2', 'content_2');" id="tab_2"><?= ANCHOR_2 ?></a></li>
                                    <li><a href="javascript:ChangeOnglet('tab_3', 'content_3');" id="tab_3"><?= ANCHOR_3 ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- CONTENU ONGLET 1 -->
            <div id="content_1" class="content">
                <div id="img_1"><img src="<?= HTTP_IMAGE ?>accueil_1_fr.jpg" alt="<?= ATTRIBUT_ALT ?>" /></div>
                <p class="text"><?= ACCROCHE ?></p>

                <h3><?= MODULE_ECHANGE_MAISON_H3 ?></h3>
                <?php if (defined('INCLUDE_MODULE_ECHANGE_MAISON')) include(INCLUDE_MODULE_ECHANGE_MAISON); ?>

                <h3><?= ONGLET_MOTEUR_RECHERCHE_H3 ?></h3>
                <div id="moteur">
                    <form action="<?= HTTP_SERVEUR . FILENAME_MOTEUR_MAISON ?>" method="get">
                        <table>
                            <tr>
                                <td><input type="text" name="Rechercher" style="margin-left:137px;" /></td>
                                <td><input type="image" src="<?= HTTP_IMAGE . BOUTON_RECHERCHER ?>" class="bt_envoyer" style="margin-left:25px;" /></td>
                            </tr>
                        </table>
                    </form>
                </div>

                <h4><?= MODULE_ECHANGE_MAISON_H4 ?></h4>
                <?php if (defined('INCLUDE_MODULE_ECHANGE_MAISON_DERNIERS_INSCRITS')) include(INCLUDE_MODULE_ECHANGE_MAISON_DERNIERS_INSCRITS); ?>
            </div>

            <!-- CONTENU ONGLET 2 -->
            <div id="content_2" class="content" style="display:none;">
                <div id="img_2"><img src="<?= HTTP_IMAGE ?>accueil_3_fr.jpg" alt="<?= ATTRIBUT_ALT ?>" /></div>
                <p class="text"><?= TEXTE_COUCHSURFING ?></p>

                <h3><?= MODULE_COUCHSURFING_H3 ?></h3>
                <?php if (defined('INCLUDE_MODULE_COUCHSURFING')) include(INCLUDE_MODULE_COUCHSURFING); ?>

                <h3><?= ONGLET_MOTEUR_RECHERCHE_H3 ?></h3>
                <div id="moteur">
                    <form action="<?= HTTP_SERVEUR . FILENAME_MOTEUR_MAISON ?>" method="get">
                        <table>
                            <tr>
                                <td><input type="text" name="Rechercher" style="margin-left:137px;" /></td>
                                <td><input type="image" src="<?= HTTP_IMAGE . BOUTON_RECHERCHER ?>" class="bt_envoyer" style="margin-left:25px;" /></td>
                            </tr>
                        </table>
                    </form>
                </div>

                <h4><?= MODULE_COUCHSURFING_H4 ?></h4>
                <?php if (defined('INCLUDE_MODULE_COUCHSURFING_DERNIERS_INSCRITS')) include(INCLUDE_MODULE_COUCHSURFING_DERNIERS_INSCRITS); ?>
            </div>

            <!-- CONTENU ONGLET 3 -->
            <div id="content_3" class="content" style="display:none;">
                <div id="img_3"><img src="<?= HTTP_IMAGE ?>accueil_2_fr.jpg" alt="<?= ATTRIBUT_ALT ?>" /></div>
                <p class="text"><?= ONGLET_MOTEUR_RECHERCHE ?></p>

                <p style="font-size:14px;text-decoration:underline;padding-top:7px;"><?= ESPACE_COMMUNICATION_4 ?></p>
            </div>

        </div>
    </div>
</body>
</html>