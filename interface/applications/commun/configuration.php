<?php
// Démarrage de la session (si pas déjà active)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// En environnement de développement uniquement
// À DÉSACTIVER EN PRODUCTION
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuration de la base de données
$db_config = [
    'host' => 'localhost',
    'name' => 'maison',
    'user' => 'root',
    'pass' => ''
];

// Connexion à la base de données avec gestion d'erreurs améliorée
try {
    $link = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
    
    // Vérification de la connexion
    if ($link->connect_error) {
        throw new Exception('Erreur de connexion (' . $link->connect_errno . ') : ' . $link->connect_error);
    }
    
    // Définir le charset en UTF-8
    if (!$link->set_charset('utf8')) {
        throw new Exception('Erreur lors de la configuration du charset UTF-8');
    }
} catch (Exception $e) {
    // Log l'erreur (en production, éviter d'afficher les détails de connexion)
    error_log('Erreur de base de données: ' . $e->getMessage());
    die('Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.');
}

// Chargement des valeurs de configuration dynamiques
$array = [];
$result = $link->query("SELECT valeur FROM configuration ORDER BY id ASC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $array[] = $row['valeur'];
    }
    $result->free(); // Libérer la mémoire du résultat
} else {
    // Gérer l'erreur si aucune configuration trouvée
    error_log('Avertissement: Aucune configuration trouvée dans la base de données');
}

// Compléter avec des chaînes vides si nécessaire pour éviter les erreurs d'index
$array += array_fill(0, 34, '');

// Définir les constantes critiques avec vérification
if (!defined('RACINE')) define('RACINE', $array[0]);;
if (!defined('RACINE_VIRTUEL')) define('RACINE_VIRTUEL', $_SERVER['DOCUMENT_ROOT']);
if (!defined('HTTP_HOST')) define('HTTP_HOST', $array[1]);

// Langues et racines par langue
// URLs complètes (domaines ou sous-domaines)
if (!defined('HTTP_FRANCAIS')) define('HTTP_FRANCAIS', 'https://echangesamaison.com/fr/');
if (!defined('HTTP_ANGLAIS')) define('HTTP_ANGLAIS', 'https://echangesamaison.com/en/');
if (!defined('HTTP_ESPAGNOL')) define('HTTP_ESPAGNOL', 'https://echangesamaison.com/es/');
if (!defined('HTTP_ALLEMANDE')) define('HTTP_ALLEMANDE', 'https://echangesamaison.com/de/');

// Racines internes
if (!defined('RACINE_ANGLAIS')) define('RACINE_ANGLAIS', '/en/');
if (!defined('RACINE_ESPAGNOL')) define('RACINE_ESPAGNOL', '/es/');
if (!defined('RACINE_ALLEMANDE')) define('RACINE_ALLEMANDE', '/de/');


// Détection de la langue avec structure améliorée
if (!defined('HTTP_SERVEUR') && !defined('LANGUAGE')) {
    if (RACINE_VIRTUEL == RACINE_ANGLAIS) {
        define('HTTP_SERVEUR', HTTP_ANGLAIS);
        define('LANGUAGE', 'en');
    } elseif (RACINE_VIRTUEL == RACINE_ESPAGNOL) {
        define('HTTP_SERVEUR', HTTP_ESPAGNOL);
        define('LANGUAGE', 'es');
    } elseif (RACINE_VIRTUEL == RACINE_ALLEMANDE) {
        define('HTTP_SERVEUR', HTTP_ALLEMANDE);
        define('LANGUAGE', 'de');
    } else {
        define('HTTP_SERVEUR', HTTP_FRANCAIS);
        define('LANGUAGE', 'fr');
    }
}
define('HTTP_HOST', 'http://localhost/maison/');

// Fichiers inclus essentiels avec vérification
if (!defined('INCLUDE_FCTS_UTILE')) define('INCLUDE_FCTS_UTILE', RACINE.'/interface/applications/commun/fct-utile.php');
if (!defined('INCLUDE_CLASS_METIER')) define('INCLUDE_CLASS_METIER', RACINE.'/interface/applications/classes/class.Metier.php');
if (!defined('INCLUDE_CLASS_ESPACE_MEMBRE')) define('INCLUDE_CLASS_ESPACE_MEMBRE', RACINE.'/interface/applications/classes/class.EspaceMembre.php');
if (!defined('INCLUDE_CLASS_LOGIN')) define('INCLUDE_CLASS_LOGIN', RACINE.'/interface/applications/classes/class.Login.php');

// Constantes applicatives avec vérification
if (!defined('TABLE_INFORMATIONS_DIRECT')) define('TABLE_INFORMATIONS_DIRECT', 'informations_direct');
if (!defined('LIMITE_AGE_MAJORITE')) define('LIMITE_AGE_MAJORITE', $array[20]);
if (!defined('RAFRAICHISSEMENT_MESSENGER')) define('RAFRAICHISSEMENT_MESSENGER', $array[21]);
if (!defined('LIMITE_AFFICHAGE_INFORMATIONS')) define('LIMITE_AFFICHAGE_INFORMATIONS', $array[22]);

// Fallback pour éviter erreurs avec vérification
if (!defined('ATTRIBUT_ALT')) define('ATTRIBUT_ALT', 'Image');
if (!defined('HTTP_WARNING')) define('HTTP_WARNING', '<img src="'.HTTP_HOST.'/images/warning.gif" alt="'.ATTRIBUT_ALT.'"/>');
if (!defined('HTTP_PROGRESS')) define('HTTP_PROGRESS', '<img src="'.HTTP_HOST.'/images/progressbar.gif" alt="'.ATTRIBUT_ALT.'"/>');
if (!defined('FILENAME_PAGE_PAIEMENT')) define('FILENAME_PAGE_PAIEMENT', 'paiement-ligne.php');
if (!defined('FILENAME_CONSEILS')) define('FILENAME_CONSEILS', 'conseils.php');
if (!defined('FILENAME_CONTACT')) define('FILENAME_CONTACT', 'contact.php');
if (!defined('FILENAME_INDEX')) define('FILENAME_INDEX', 'index.php');
 define('CONFIGURATION_CSS', HTTP_HOST.'/css/styles.css');
 define('CONFIGURATION_CSS_ADMIN', HTTP_HOST.'/css/admin.css');
 define('CONFIGURATION_LIGHTBOX_CSS', HTTP_HOST.'/css/lightbox.css');
 // ----------------------------------------
// Définition des fichiers JavaScript
// ----------------------------------------

if (!defined('CONFIGURATION_JS')) {
    define('CONFIGURATION_JS', '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/java.js"></script>' . "\n");
}

if (!defined('CONFIGURATION_ONGLETS_JS')) {
    define('CONFIGURATION_ONGLETS_JS', '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/onglets.js"></script>' . "\n");
}

if (!defined('CONFIGURATION_LIGHTBOX_JS')) {
    define('CONFIGURATION_LIGHTBOX_JS',
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/prototype.js"></script>' . "\n" .
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/scriptaculous.js?load=effects,builder"></script>' . "\n" .
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/lightbox.js"></script>' . "\n" .
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/effet_images.js"></script>' . "\n"
    );
}

if (!defined('CONFIGURATION_GALERIE_JS')) {
    define('CONFIGURATION_GALERIE_JS', '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/motiongallery.js"></script>' . "\n");
}

if (!defined('CONFIGURATION_ACCORDEON_JS')) {
    define('CONFIGURATION_ACCORDEON_JS',
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/slide/js/accordion.js"></script>' . "\n" .
        '<link href="' . HTTP_HOST . '/interface/applications/commun/slide/css/accordion_glam.css" media="screen" rel="stylesheet" type="text/css" />' . "\n"
    );
}

 define('CONFIGURATION_TCHAT_CSS', HTTP_HOST.'/css/tchat.css');
 define('CONFIGURATION_GALERIE_CSS', HTTP_HOST.'/css/galerie.css');
 //Définition de la page correctif CSS pour IE
 define('CONFIGURATION_CSS_CORRECTION_IE', HTTP_HOST.'/css/corrections_ie.css');
 define('CONFIGURATION_CSS_CALENDRIER', HTTP_HOST.'/css/calendrier.css');
 // Déclaration des balises meta noindex
if (!defined('CONFIGURATION_ROBOTS_NOFOLLOW')) {
    define('CONFIGURATION_ROBOTS_NOFOLLOW',
        '<meta name="robots" content="nofollow,noindex"/>' . "\n" .
        '<meta name="googlebot" content="noindex, nofollow"/>' . "\n" .
        '<meta name="robots" content="all"/>' . "\n"
    );
}
// Définition des scripts JavaScript
if (!defined('CONFIGURATION_JS')) {
    define('CONFIGURATION_JS', '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/java.js"></script>' . "\n");
}

if (!defined('CONFIGURATION_LIGHTBOX_JS')) {
    define('CONFIGURATION_LIGHTBOX_JS',
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/prototype.js"></script>' . "\n" .
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/scriptaculous.js?load=effects,builder"></script>' . "\n" .
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/lightbox.js"></script>' . "\n" .
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/lightbox/effet_images.js"></script>' . "\n"
    );
}


if (!defined('CONFIGURATION_GALERIE_JS')) {
    define('CONFIGURATION_GALERIE_JS', '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/motiongallery.js"></script>' . "\n");
}

if (!defined('CONFIGURATION_ACCORDEON_JS')) {
    define('CONFIGURATION_ACCORDEON_JS',
        '<script type="text/javascript" src="' . HTTP_HOST . '/interface/applications/commun/slide/js/accordion.js"></script>' . "\n" .
        '<link href="' . HTTP_HOST . '/interface/applications/commun/slide/css/accordion_glam.css" media="screen" rel="stylesheet" type="text/css" />' . "\n"
    );
}

// Affichage des drapeaux
if (!defined('DRAPEAU_FRANCAIS')) {
    define('DRAPEAU_FRANCAIS', HTTP_HOST . '/images/drapeau_francais.gif');
}

if (!defined('DRAPEAU_ANGLAIS')) {
    define('DRAPEAU_ANGLAIS', HTTP_HOST . '/images/drapeau_anglais.gif');
}

if (!defined('DRAPEAU_ALLEMAND')) {
    define('DRAPEAU_ALLEMAND', HTTP_HOST . '/images/drapeau_allemand.gif');
}

if (!defined('DRAPEAU_ESPAGNOL')) {
    define('DRAPEAU_ESPAGNOL', HTTP_HOST . '/images/drapeau_espagnol.gif');
}

if (!defined('KOSMOPOLYTE')) {
    define('KOSMOPOLYTE', 'http://www.kosmopolyte.com/');
}
/*
 *                 PAGES INCLUDES
 */

// utiliser les fonctions communes
if (!defined('INCLUDE_CLASS_BLOG')) {
    define('INCLUDE_CLASS_BLOG', RACINE . '/interface/applications/classes/class.Blog.php');
}
if (!defined('INCLUDE_CLASS_ESPACE_MEMBRE')) {
    define('INCLUDE_CLASS_ESPACE_MEMBRE', RACINE . '/interface/applications/classes/class.EspaceMembre.php');
}
if (!defined('INCLUDE_CLASS_FLUX_XML')) {
    define('INCLUDE_CLASS_FLUX_XML', RACINE . '/interface/applications/classes/class.FluxXml.php');
}
if (!defined('INCLUDE_CLASS_LOGIN')) {
    define('INCLUDE_CLASS_LOGIN', RACINE . '/interface/applications/classes/class.Login.php');
}
if (!defined('INCLUDE_CLASS_METIER')) {
    define('INCLUDE_CLASS_METIER', RACINE . '/interface/applications/classes/class.Metier.php');
}
if (!defined('INCLUDE_CLASS_MOTEUR_MAISON')) {
    define('INCLUDE_CLASS_MOTEUR_MAISON', RACINE . '/interface/applications/classes/class.MoteurMaison.php');
}
if (!defined('INCLUDE_CLASS_RECHERCHE_AVANCEE')) {
    define('INCLUDE_CLASS_RECHERCHE_AVANCEE', RACINE . '/interface/applications/classes/class.RechercheAvancee.php');
}
if (!defined('INCLUDE_CLASS_SERVEUR_SOCKET')) {
    define('INCLUDE_CLASS_SERVEUR_SOCKET', RACINE . '/interface/applications/classes/class.ServeurSocket.php');
}

// includes admin
if (!defined('INCLUDE_ADMIN_ANNONCE')) {
    define('INCLUDE_ADMIN_ANNONCE', RACINE . '/admin/inc-annonce.php');
}
if (!defined('INCLUDE_ADMIN_ANNONCE_MODIFIER')) {
    define('INCLUDE_ADMIN_ANNONCE_MODIFIER', RACINE . '/admin/inc-annonce-modifier.php');
}
if (!defined('INCLUDE_ADMIN_DETAIL_ANNONCE')) {
    define('INCLUDE_ADMIN_DETAIL_ANNONCE', RACINE . '/admin/detail.php');
}
if (!defined('INCLUDE_ADMIN_FORMULAIRE_COMPTE')) {
    define('INCLUDE_ADMIN_FORMULAIRE_COMPTE', RACINE . '/admin/formulaire-compte.php');
}
if (!defined('INCLUDE_ADMIN_CONFIGURATION')) {
    define('INCLUDE_ADMIN_CONFIGURATION', RACINE . '/admin/config.php');
}
if (!defined('INCLUDE_ADMIN_LIBELLES')) {
    define('INCLUDE_ADMIN_LIBELLES', RACINE . '/admin/libelle.php');
}
if (!defined('INCLUDE_ADMIN_RELATION')) {
    define('INCLUDE_ADMIN_RELATION', RACINE . '/admin/relation.php');
}
if (!defined('INCLUDE_ADMIN_MEDIA')) {
    define('INCLUDE_ADMIN_MEDIA', RACINE . '/admin/inc-media.php');
}
if (!defined('INCLUDE_ADMIN_MODIFIER_LIBELLES')) {
    define('INCLUDE_ADMIN_MODIFIER_LIBELLES', RACINE . '/admin/modifier-libelle.php');
}
if (!defined('INCLUDE_ADMIN_MODIFIER_RELATION')) {
    define('INCLUDE_ADMIN_MODIFIER_RELATION', RACINE . '/admin/modifier-relation.php');
}

 if (!defined('INCLUDE_DEPARTEMENT')) {
    define('INCLUDE_DEPARTEMENT', RACINE . '/membre/departement.php');
}
if (!defined('INCLUDE_DEPARTEMENT_ACCUEIL')) {
    define('INCLUDE_DEPARTEMENT_ACCUEIL', RACINE . '/departement.php');
}
if (!defined('INCLUDE_DEPARTEMENT_INSCRIPTION')) {
    define('INCLUDE_DEPARTEMENT_INSCRIPTION', RACINE . '/interface/departement.php');
}
if (!defined('INCLUDE_DERNIERS_INSCRITS')) {
    define('INCLUDE_DERNIERS_INSCRITS', RACINE . '/interface/listing-derniers-inscrits.php');
}
if (!defined('INCLUDE_FCTS_UTILE')) {
    define('INCLUDE_FCTS_UTILE', RACINE . '/interface/applications/commun/fct-utile.php');
}
if (!defined('INCLUDE_FORMULAIRE_INSCRIPTION')) {
    define('INCLUDE_FORMULAIRE_INSCRIPTION', RACINE . '/interface/inc-formulaire-inscription.php');
}
if (!defined('INCLUDE_FORMULAIRE_INSCRIPTION_ACCUEIL')) {
    define('INCLUDE_FORMULAIRE_INSCRIPTION_ACCUEIL', RACINE . '/interface/formulaire-inscription-accueil.php');
}
if (!defined('INCLUDE_MENU')) {
    define('INCLUDE_MENU', RACINE . '/interface/menu.php');
}
if (!defined('INCLUDE_MENU_ESPACE_MEMBRE')) {
    define('INCLUDE_MENU_ESPACE_MEMBRE', RACINE . '/interface/menu-espace-membre.php');
}
if (!defined('INCLUDE_MENU_ESPACE_MEMBRE_2')) {
    define('INCLUDE_MENU_ESPACE_MEMBRE_2', RACINE . '/interface/menu-espace-membre-2.php');
}
if (!defined('INCLUDE_FOOTER')) {
    define('INCLUDE_FOOTER', RACINE . '/interface/footer.php');
}
if (!defined('INCLUDE_MESSENGER')) {
    define('INCLUDE_MESSENGER', RACINE . '/interface/messenger.php');
}
if (!defined('INCLUDE_SCRIPT_MAJ_CONNEXION')) {
    define('INCLUDE_SCRIPT_MAJ_CONNEXION', RACINE . '/interface/script-maj-connexion.php');
}
if (!defined('INCLUDE_MAJ_MESSAGES_DUO')) {
    define('INCLUDE_MAJ_MESSAGES_DUO', RACINE . '/interface/maj-duo-webcam.php');
}
if (!defined('INCLUDE_LISTING_COMMENTAIRES')) {
    define('INCLUDE_LISTING_COMMENTAIRES', RACINE . '/interface/listing-commentaires.php');
}
if (!defined('INCLUDE_LISTING_ESPACE_LIVE')) {
    define('INCLUDE_LISTING_ESPACE_LIVE', RACINE . '/interface/listing-espace-live.php');
}
if (!defined('INCLUDE_LISTING_MEMBRES_ONLINE')) {
    define('INCLUDE_LISTING_MEMBRES_ONLINE', RACINE . '/interface/listing-membres-online.php');
}
if (!defined('INCLUDE_LISTING_MEMBRES_OFFLINE')) {
    define('INCLUDE_LISTING_MEMBRES_OFFLINE', RACINE . '/interface/listing-membres-offline.php');
}
if (!defined('INCLUDE_LISTING_MOTS_CLES')) {
    define('INCLUDE_LISTING_MOTS_CLES', RACINE . '/interface/listing-mots-cles.php');
}
if (!defined('INCLUDE_LISTING_RECHERCHE_PAR_MOTS_CLES')) {
    define('INCLUDE_LISTING_RECHERCHE_PAR_MOTS_CLES', RACINE . '/interface/listing-recherche-mots-cles.php');
}
if (!defined('INCLUDE_LISTING_RECHERCHE_PAR_MOTS_CLES_DEPARTEMENT')) {
    define('INCLUDE_LISTING_RECHERCHE_PAR_MOTS_CLES_DEPARTEMENT', RACINE . '/interface/listing-recherche-par-dept.php');
}
if (!defined('INCLUDE_LISTING_RESULTAT_MOTS_CLES')) {
    define('INCLUDE_LISTING_RESULTAT_MOTS_CLES', RACINE . '/interface/listing-resultat-mots-cles.php');
}
if (!defined('INCLUDE_LISTING_THEMATIQUE')) {
    define('INCLUDE_LISTING_THEMATIQUE', RACINE . '/interface/listing-thematique.php');
}
if (!defined('INCLUDE_MENU_GENERAL')) {
    define('INCLUDE_MENU_GENERAL', RACINE . '/interface/menu-general.php');
}
if (!defined('INCLUDE_ANNONCE_PUBLICITE')) {
    define('INCLUDE_ANNONCE_PUBLICITE', RACINE . '/interface/pub.php');
}
if (!defined('INCLUDE_ADSENSE')) {
    define('INCLUDE_ADSENSE', RACINE . '/interface/adsense.php');
}
if (!defined('INCLUDE_MODULE_RECHERCHE_CONNEXION')) {
    define('INCLUDE_MODULE_RECHERCHE_CONNEXION', RACINE . '/interface/module-recherche-connexion.php');
}
if (!defined('INCLUDE_MODULE_RECHERCHE')) {
    define('INCLUDE_MODULE_RECHERCHE', RACINE . '/interface/module-recherche.php');
}
if (!defined('INCLUDE_MODULE_ECHANGE_MAISON')) {
    define('INCLUDE_MODULE_ECHANGE_MAISON', RACINE . '/interface/module-echange-maison.php');
}
if (!defined('INCLUDE_MODULE_ECHANGE_MAISON_DERNIERS_INSCRITS')) {
    define('INCLUDE_MODULE_ECHANGE_MAISON_DERNIERS_INSCRITS', RACINE . '/interface/module-echange-maison-derniers-inscrits.php');
}
if (!defined('INCLUDE_MODULE_COUCHSURFING_DERNIERS_INSCRITS')) {
    define('INCLUDE_MODULE_COUCHSURFING_DERNIERS_INSCRITS', RACINE . '/interface/module-couchsurfing-derniers-inscrits.php');
}
if (!defined('INCLUDE_MODULE_COUCHSURFING')) {
    define('INCLUDE_MODULE_COUCHSURFING', RACINE . '/interface/module-couchsurfing.php');
}
if (!defined('INCLUDE_MODULE_MOTEUR_DE_RECHERCHE')) {
    define('INCLUDE_MODULE_MOTEUR_DE_RECHERCHE', RACINE . '/interface/module-moteur-de-recherche.php');
}
if (!defined('INCLUDE_MODULE_DERNIERS_ARTICLES_BLOG')) {
    define('INCLUDE_MODULE_DERNIERS_ARTICLES_BLOG', RACINE . '/interface/module-derniers-articles-blog.php');
}
if (!defined('INCLUDE_DERNIERS_INSCRITS_HORS_CONNEXION')) {
    define('INCLUDE_DERNIERS_INSCRITS_HORS_CONNEXION', RACINE . '/interface/derniers-inscrits.php');
}
if (!defined('INCLUDE_MA_PUBLICITE_A')) {
    define('INCLUDE_MA_PUBLICITE_A', RACINE . '/interface/ma-publicite_A.php');
}
if (!defined('INCLUDE_MA_PUBLICITE_B')) {
    define('INCLUDE_MA_PUBLICITE_B', RACINE . '/interface/ma-publicite_B.php');
}
if (!defined('INCLUDE_MA_PUBLICITE_C')) {
    define('INCLUDE_MA_PUBLICITE_C', RACINE . '/interface/ma-publicite_C.php');
}
if (!defined('INCLUDE_MA_PUBLICITE_D')) {
    define('INCLUDE_MA_PUBLICITE_D', RACINE . '/interface/ma-publicite_D.php');
}
if (!defined('INCLUDE_ADMIN_TABLEAU_TARIF')) {
    define('INCLUDE_ADMIN_TABLEAU_TARIF', RACINE . '/admin/tableau-tarifaire.php');
}
if (!defined('INCLUDE_ADMIN_CONDITION_GRATUITE')) {
    define('INCLUDE_ADMIN_CONDITION_GRATUITE', RACINE . '/admin/condition-gratuite.php');
}
if (!defined('INCLUDE_COMPATIBILITE_NAVIGATEURS')) {
    define('INCLUDE_COMPATIBILITE_NAVIGATEURS', RACINE . '/interface/compatibilite-navigateurs.php');
}
if (!defined('INCLUDE_FOOTER_LIENS')) {
    define('INCLUDE_FOOTER_LIENS', RACINE . '/interface/liens-footer.php');
}
if (!defined('INCLUDE_FOOTER_PARTENAIRES')) {
    define('INCLUDE_FOOTER_PARTENAIRES', RACINE . '/interface/partenaires-footer.php');
}
if (!defined('INCLUDE_LOGIN')) {
    define('INCLUDE_LOGIN', RACINE . '/interface/login.php');
}
if (!defined('INCLUDE_MAJ_MESSAGES_TCHAT')) {
    define('INCLUDE_MAJ_MESSAGES_TCHAT', RACINE . '/interface/maj-tchat.php');
}
if (!defined('INCLUDE_FORMULAIRE_DEPOT_ANNONCE')) {
    define('INCLUDE_FORMULAIRE_DEPOT_ANNONCE', RACINE . '/interface/formulaire-depot.php');
}
if (!defined('INCLUDE_SCRIPT_CALENDRIER_JS')) {
    define('INCLUDE_SCRIPT_CALENDRIER_JS', RACINE . '/interface/script-calendrier-js.php');
}
if (!defined('INCLUDE_IFRAME_MULTIMEDIA')) {
    define('INCLUDE_IFRAME_MULTIMEDIA', RACINE . '/interface/iframe-multimedia.php');
}
if (!defined('INCLUDE_FICHE_DETAIL')) {
    define('INCLUDE_FICHE_DETAIL', RACINE . '/interface/inc-fiche-detail.php');
}
if (!defined('INCLUDE_MULTIMEDIA')) {
    define('INCLUDE_MULTIMEDIA', RACINE . '/interface/inc-multimedia.php');
}
if (!defined('INCLUDE_CATEGORIES_BLOG')) {
    define('INCLUDE_CATEGORIES_BLOG', RACINE . '/interface/lister-categories-blog.php');
}
if (!defined('INCLUDE_SALON_LISTE_CONNECTER')) {
    define('INCLUDE_SALON_LISTE_CONNECTER', RACINE . '/interface/inc-liste-connecter-salon.php');
}
if (!defined('INCLUDE_SALON_FENETRE')) {
    define('INCLUDE_SALON_FENETRE', RACINE . '/interface/inc-tchat-fenetre.php');
}

 /*
  *             CORRESPONDANCE DES PAGES/LANGUES
  */
  //SUPPORT DE LANGUES
 
 if (!defined('FILENAME_404')) {
    define('FILENAME_404', '404.php');
}
if (!defined('FILENAME_ACTION_SUR_ANNONCE')) {
    define('FILENAME_ACTION_SUR_ANNONCE', 'mon-annonce.php');
}
if (!defined('FILENAME_ADMIN_COMPTES')) {
    define('FILENAME_ADMIN_COMPTES', 'comptes.php');
}
if (!defined('FILENAME_ADMIN_CONFIGURATION')) {
    define('FILENAME_ADMIN_CONFIGURATION', 'configuration.php');
}
if (!defined('FILENAME_ADMIN_FAQ')) {
    define('FILENAME_ADMIN_FAQ', 'faq.php');
}
if (!defined('FILENAME_ADMIN_FORMULAIRE_COMPTE')) {
    define('FILENAME_ADMIN_FORMULAIRE_COMPTE', 'formulaire-compte.php');
}
if (!defined('FILENAME_ADMIN_NOUVEAUX_INSCRITS')) {
    define('FILENAME_ADMIN_NOUVEAUX_INSCRITS', 'nouveaux-inscrits.php');
}
if (!defined('FILENAME_ADSENSE')) {
    define('FILENAME_ADSENSE', 'adsense.php');
}
if (!defined('FILENAME_ANNONCES_ECHANGE_MAISON')) {
    define('FILENAME_ANNONCES_ECHANGE_MAISON', 'petites-annonces-echange-maison.php');
}
if (!defined('FILENAME_ANNONCE_PUBLICITE')) {
    define('FILENAME_ANNONCE_PUBLICITE', 'pub.php');
}
if (!defined('FILENAME_BLACKLIST')) {
    define('FILENAME_BLACKLIST', 'blacklist.php');
}
if (!defined('FILENAME_BLACKLIST_2')) {
    define('FILENAME_BLACKLIST_2', 'blacklist2.php');
}
if (!defined('FILENAME_BLOG_ARTICLE')) {
    define('FILENAME_BLOG_ARTICLE', 'article.php');
}
if (!defined('FILENAME_BLOG_CATEGORIE')) {
    define('FILENAME_BLOG_CATEGORIE', 'categorie.php');
}
if (!defined('FILENAME_BLOG_INDEX')) {
    define('FILENAME_BLOG_INDEX', 'blog-index.php');
}
if (!defined('FILENAME_CARNET_DE_VOYAGE')) {
    define('FILENAME_CARNET_DE_VOYAGE', 'carnet-de-voyage.php');
}
if (!defined('FILENAME_CARNET_DE_VOYAGE_GESTION')) {
    define('FILENAME_CARNET_DE_VOYAGE_GESTION', 'carnet-de-voyage-gestion.php');
}
if (!defined('FILENAME_CGU')) {
    define('FILENAME_CGU', 'cgu.php');
}
if (!defined('FILENAME_CLIENT_PUBLICITE')) {
    define('FILENAME_CLIENT_PUBLICITE', 'espace-client-pub.php');
}
if (!defined('FILENAME_COMMENTAIRES')) {
    define('FILENAME_COMMENTAIRES', 'commentaires.php');
}
if (!defined('FILENAME_COMMENTAIRES_GESTION')) {
    define('FILENAME_COMMENTAIRES_GESTION', 'gestion-comm.php');
}
if (!defined('FILENAME_CONNEXION')) {
    define('FILENAME_CONNEXION', 'connexion.php');
}
if (!defined('FILENAME_CONSEILLER_SITE_AMI')) {
    define('FILENAME_CONSEILLER_SITE_AMI', 'ami.php');
}
if (!defined('FILENAME_CONSEILS')) {
    define('FILENAME_CONSEILS', 'conseils.php');
}
if (!defined('FILENAME_CONTACT')) {
    define('FILENAME_CONTACT', 'contact.php');
}

 if (!defined('FILENAME_COUCHSURFING')) {
    define('FILENAME_COUCHSURFING', 'couch-surfing.php');
}
if (!defined('FILENAME_COURRIER')) {
    define('FILENAME_COURRIER', 'courrier.php');
}
if (!defined('FILENAME_DECONNEXION')) {
    define('FILENAME_DECONNEXION', 'deconnexion.php');
}
if (!defined('FILENAME_DEPARTEMENT')) {
    define('FILENAME_DEPARTEMENT', 'departement.php');
}
if (!defined('FILENAME_DEPARTEMENTS_ALGERIE')) {
    define('FILENAME_DEPARTEMENTS_ALGERIE', 'departements-algerie.php');
}
if (!defined('FILENAME_DEPARTEMENTS_ALLEMAGNE')) {
    define('FILENAME_DEPARTEMENTS_ALLEMAGNE', 'departements-allemagne.php');
}
if (!defined('FILENAME_DEPARTEMENTS_FRANCE')) {
    define('FILENAME_DEPARTEMENTS_FRANCE', 'departements-france.php');
}
if (!defined('FILENAME_DEPARTEMENTS_GUADELOUPE')) {
    define('FILENAME_DEPARTEMENTS_GUADELOUPE', 'departements-guadeloupe.php');
}
if (!defined('FILENAME_DEPARTEMENTS_GUYANE_FR')) {
    define('FILENAME_DEPARTEMENTS_GUYANE_FR', 'departements-guyane-fr.php');
}
if (!defined('FILENAME_DEPARTEMENTS_MAROC')) {
    define('FILENAME_DEPARTEMENTS_MAROC', 'departements-maroc.php');
}
if (!defined('FILENAME_DEPOT_ANNONCE')) {
    define('FILENAME_DEPOT_ANNONCE', 'depot.php');
}
if (!defined('FILENAME_DEPOT_ANNONCE_1')) {
    define('FILENAME_DEPOT_ANNONCE_1', 'depot_1.php');
}
if (!defined('FILENAME_DERNIERS_INSCRITS_HORS_CONNEXION')) {
    define('FILENAME_DERNIERS_INSCRITS_HORS_CONNEXION', 'derniers-inscrits.php');
}
if (!defined('FILENAME_DUO_WEBCAMS')) {
    define('FILENAME_DUO_WEBCAMS', 'duo-webcams.php');
}
if (!defined('FILENAME_INDEX')) {
    define('FILENAME_INDEX', 'index.php');
}
if (!defined('FILENAME_ECHANGE')) {
    define('FILENAME_ECHANGE', 'echange.php');
}
if (!defined('FILENAME_ECHANGE_MAISON')) {
    define('FILENAME_ECHANGE_MAISON', 'echange-logement.php');
}
if (!defined('FILENAME_ESPACE_MEMBRE')) {
    define('FILENAME_ESPACE_MEMBRE', 'membre/');
}
if (!defined('FILENAME_ESPACE_MEMBRE_INDEX')) {
    define('FILENAME_ESPACE_MEMBRE_INDEX', 'membre.php');
}
if (!defined('FILENAME_FAVORIS')) {
    define('FILENAME_FAVORIS', 'favori.php');
}
if (!defined('FILENAME_FICHE_INSCRIPTION')) {
    define('FILENAME_FICHE_INSCRIPTION', 'inscription.php');
}
if (!defined('FILENAME_FLUX_XML')) {
    define('FILENAME_FLUX_XML', 'flux-xml.php');
}
if (!defined('FILENAME_FORMULAIRE_ENVOYER_MESSAGES_DUO')) {
    define('FILENAME_FORMULAIRE_ENVOYER_MESSAGES_DUO', 'envoyer-messages-duo-webcam.php');
}
if (!defined('FILENAME_FRAME_MESSENGER')) {
    define('FILENAME_FRAME_MESSENGER', 'frame-messenger.php');
}

 if (!defined('FILENAME_GESTION_COURRIER')) {
    define('FILENAME_GESTION_COURRIER', 'gestion-courrier.php');
}
if (!defined('FILENAME_GESTION_COURRIER_2')) {
    define('FILENAME_GESTION_COURRIER_2', 'gestion-courrier2.php');
}
if (!defined('FILENAME_GESTION_COURRIER_3')) {
    define('FILENAME_GESTION_COURRIER_3', 'gestion-courrier3.php');
}
if (!defined('FILENAME_GESTION_MESSAGERIE')) {
    define('FILENAME_GESTION_MESSAGERIE', 'gestion-messagerie.php');
}
if (!defined('FILENAME_GOOGLE_MAPS')) {
    define('FILENAME_GOOGLE_MAPS', 'google-maps.php');
}
if (!defined('FILENAME_HISTORIQUE_PAIEMENT')) {
    define('FILENAME_HISTORIQUE_PAIEMENT', 'hist-paiement.php');
}
if (!defined('FILENAME_IDENTIFIANTS')) {
    define('FILENAME_IDENTIFIANTS', 'identifiants.php');
}
if (!defined('FILENAME_IFRAME_MULTIMEDIA')) {
    define('FILENAME_IFRAME_MULTIMEDIA', 'iframe-multimedia.php');
}
if (!defined('FILENAME_INC_MULTIMEDIA')) {
    define('FILENAME_INC_MULTIMEDIA', 'inc-multimedia.php');
}
if (!defined('FILENAME_INSCRIPTION')) {
    define('FILENAME_INSCRIPTION', 'inscription.php');
}
if (!defined('FILENAME_INSCRIPTION_GRATUITE')) {
    define('FILENAME_INSCRIPTION_GRATUITE', 'inscription-gratuite.php');
}
if (!defined('FILENAME_JAVASCRIPT')) {
    define('FILENAME_JAVASCRIPT', 'java.js');
}
if (!defined('FILENAME_LIBELLE')) {
    define('FILENAME_LIBELLE', 'libelle.php');
}
if (!defined('FILENAME_LIBELLE_MODIFIER')) {
    define('FILENAME_LIBELLE_MODIFIER', 'modifier-libelle.php');
}
if (!defined('FILENAME_LISTING_ESPACE_LIVE')) {
    define('FILENAME_LISTING_ESPACE_LIVE', 'listing-espace-live.php');
}
if (!defined('FILENAME_LISTING_MEMBRES')) {
    define('FILENAME_LISTING_MEMBRES', 'listing.php');
}
if (!defined('FILENAME_LISTING_MEMBRES_OFFLINE')) {
    define('FILENAME_LISTING_MEMBRES_OFFLINE', 'listing-membres-offline.php');
}
if (!defined('FILENAME_LISTING_MEMBRES_ONLINE')) {
    define('FILENAME_LISTING_MEMBRES_ONLINE', 'listing-membres-online.php');
}
if (!defined('FILENAME_LISTING_MOTS_CLES')) {
    define('FILENAME_LISTING_MOTS_CLES', 'listingSearch.php');
}
if (!defined('FILENAME_LISTING_SEARCH')) {
    define('FILENAME_LISTING_SEARCH', 'listingSearch.php');
}
if (!defined('FILENAME_LISTING_THEMATIQUE')) {
    define('FILENAME_LISTING_THEMATIQUE', 'listing-thematique.php');
}
if (!defined('FILENAME_MA_PUBLICITE_A')) {
    define('FILENAME_MA_PUBLICITE_A', 'ma-publicite_A.php');
}
if (!defined('FILENAME_MA_PUBLICITE_B')) {
    define('FILENAME_MA_PUBLICITE_B', 'ma-publicite_B.php');
}
if (!defined('FILENAME_MA_PUBLICITE_C')) {
    define('FILENAME_MA_PUBLICITE_C', 'ma-publicite_C.php');
}
if (!defined('FILENAME_MA_PUBLICITE_D')) {
    define('FILENAME_MA_PUBLICITE_D', 'ma-publicite_D.php');
}
if (!defined('FILENAME_MAJ_CONNEXIONS')) {
    define('FILENAME_MAJ_CONNEXIONS', 'script-maj-connexion.php');
}
if (!defined('FILENAME_MAJ_CONNEXION_DUO_WEBCAMS')) {
    define('FILENAME_MAJ_CONNEXION_DUO_WEBCAMS', 'maj-connexion-duo-webcam.php');
}
if (!defined('FILENAME_MAJ_MESSAGES_DUO')) {
    define('FILENAME_MAJ_MESSAGES_DUO', 'maj-duo-webcam.php');
}

 if (!defined('FILENAME_MAJ_MESSAGES_TCHAT')) {
    define('FILENAME_MAJ_MESSAGES_TCHAT', 'maj-tchat.php');
}
if (!defined('FILENAME_MEMBRE_OFFLINE')) {
    define('FILENAME_MEMBRE_OFFLINE', 'membres-offline.php');
}
if (!defined('FILENAME_MEMBRE_ONLINE')) {
    define('FILENAME_MEMBRE_ONLINE', 'membres-online.php');
}
if (!defined('FILENAME_MES_FICHIERS')) {
    define('FILENAME_MES_FICHIERS', 'mes-fichiers.php');
}
if (!defined('FILENAME_MES_VOYAGES')) {
    define('FILENAME_MES_VOYAGES', 'voyage.php');
}
if (!defined('FILENAME_MENU_GENERAL')) {
    define('FILENAME_MENU_GENERAL', 'menu-general.php');
}
if (!defined('FILENAME_MESSAGERIE')) {
    define('FILENAME_MESSAGERIE', 'messagerie.php');
}
if (!defined('FILENAME_MESSAGERIE_2')) {
    define('FILENAME_MESSAGERIE_2', 'messagerie2.php');
}
if (!defined('FILENAME_MESSAGERIE_3')) {
    define('FILENAME_MESSAGERIE_3', 'messagerie3.php');
}
if (!defined('FILENAME_MODULE_RECHERCHE_CONNEXION')) {
    define('FILENAME_MODULE_RECHERCHE_CONNEXION', 'module-recherche-connexion.php');
}
if (!defined('FILENAME_MON_COMPTE')) {
    define('FILENAME_MON_COMPTE', 'compte.php');
}
if (!defined('FILENAME_MOTEUR_ADDITIONNEL')) {
    define('FILENAME_MOTEUR_ADDITIONNEL', 'moteur-ad.php');
}
if (!defined('FILENAME_MOTEUR_EASYPSEUDO')) {
    define('FILENAME_MOTEUR_EASYPSEUDO', 'easypseudo.php');
}
if (!defined('FILENAME_MOTEUR_MAISON')) {
    define('FILENAME_MOTEUR_MAISON', 'moteur-maison.php');
}
if (!defined('FILENAME_MOTEUR_RECHERCHE_PSEUDO')) {
    define('FILENAME_MOTEUR_RECHERCHE_PSEUDO', 'moteur-recherche-pseudo.php');
}
if (!defined('FILENAME_PAGE_PAIEMENT')) {
    define('FILENAME_PAGE_PAIEMENT', 'paiement-ligne.php');
}
if (!defined('FILENAME_PAIEMENT_ABO_ACCEPTE')) {
    define('FILENAME_PAIEMENT_ABO_ACCEPTE', 'paiement-abonnement.php');
}
if (!defined('FILENAME_PAIEMENT_ABO_REFUSE')) {
    define('FILENAME_PAIEMENT_ABO_REFUSE', 'erreur-abonnement.php');
}
if (!defined('FILENAME_PAIEMENT_ACCEPTE')) {
    define('FILENAME_PAIEMENT_ACCEPTE', 'paiement.php');
}
if (!defined('FILENAME_PAIEMENT_REFUSE')) {
    define('FILENAME_PAIEMENT_REFUSE', 'erreur.php');
}
if (!defined('FILENAME_PAIEMENT_SECURISE')) {
    define('FILENAME_PAIEMENT_SECURISE', 'paiement-securise.php');
}
if (!defined('FILENAME_PARAMETRES')) {
    define('FILENAME_PARAMETRES', 'parametres.php');
}
if (!defined('FILENAME_PARTENAIRE')) {
    define('FILENAME_PARTENAIRE', 'partenaire.php');
}
if (!defined('FILENAME_PASSE_PERDU')) {
    define('FILENAME_PASSE_PERDU', 'passe-perdu.php');
}
if (!defined('FILENAME_PLAN_DEPT')) {
    define('FILENAME_PLAN_DEPT', 'plan-dept.php');
}
if (!defined('FILENAME_PLAN_DEPT_ALGERIE')) {
    define('FILENAME_PLAN_DEPT_ALGERIE', 'plan-dept-algerie.php');
}
if (!defined('FILENAME_PLAN_DEPT_ALLEMAGNE')) {
    define('FILENAME_PLAN_DEPT_ALLEMAGNE', 'plan-dept-allemagne.php');
}
if (!defined('FILENAME_PLAN_DEPT_FRANCE')) {
    define('FILENAME_PLAN_DEPT_FRANCE', 'plan-dept-france.php');
}
if (!defined('FILENAME_PLAN_DEPT_GUADELOUPE')) {
    define('FILENAME_PLAN_DEPT_GUADELOUPE', 'plan-dept-guadeloupe.php');
}
if (!defined('FILENAME_PLAN_DEPT_GUYANE_FR')) {
    define('FILENAME_PLAN_DEPT_GUYANE_FR', 'plan-dept-guyane-fr.php');
}
if (!defined('FILENAME_PLAN_DEPT_MAROC')) {
    define('FILENAME_PLAN_DEPT_MAROC', 'plan-dept-maroc.php');
}
if (!defined('FILENAME_PLAN_SITE')) {
    define('FILENAME_PLAN_SITE', 'plan.php');
}
if (!defined('FILENAME_PLAN_ECHANGE_APPARTEMENT')) {
    define('FILENAME_PLAN_ECHANGE_APPARTEMENT', 'echange-appartement.php');
}
if (!defined('FILENAME_PLAN_ECHANGE_DE_CHAMBRE')) {
    define('FILENAME_PLAN_ECHANGE_DE_CHAMBRE', 'echange-de-chambre.php');
}
if (!defined('FILENAME_PLAN_ECHANGE_DE_CHATEAU')) {
    define('FILENAME_PLAN_ECHANGE_DE_CHATEAU', 'echange-de-chateau.php');
}
if (!defined('FILENAME_PLAN_ECHANGE_DE_MAISON')) {
    define('FILENAME_PLAN_ECHANGE_DE_MAISON', 'echange-de-maison.php');
}
if (!defined('FILENAME_PLAN_ECHANGE_DE_MANOIR')) {
    define('FILENAME_PLAN_ECHANGE_DE_MANOIR', 'echange-de-manoir.php');
}
if (!defined('FILENAME_PLAN_ECHANGE_DE_VILLA')) {
    define('FILENAME_PLAN_ECHANGE_DE_VILLA', 'echange-de-villa.php');
}
if (!defined('FILENAME_PLAN_RECEVOIR_A_DOMICILE')) {
    define('FILENAME_PLAN_RECEVOIR_A_DOMICILE', 'recevoir-a-domicile.php');
}
if (!defined('FILENAME_PLAN_RECHERCHE_HEBERGEMENT')) {
    define('FILENAME_PLAN_RECHERCHE_HEBERGEMENT', 'recherche-hebergement.php');
}
if (!defined('FILENAME_POPUP_IDENTITE')) {
    define('FILENAME_POPUP_IDENTITE', 'popup-identite.php');
}
if (!defined('FILENAME_POPUP_INFO_CATEGORIE')) {
    define('FILENAME_POPUP_INFO_CATEGORIE', 'info-categories.php');
}
if (!defined('FILENAME_POPUP_PROFIL_FLV')) {
    define('FILENAME_POPUP_PROFIL_FLV', 'access-flv.php');
}
if (!defined('FILENAME_PROFIL')) {
    define('FILENAME_PROFIL', 'profil.php');
}
if (!defined('FILENAME_PROFIL_ACCUEIL')) {
    define('FILENAME_PROFIL_ACCUEIL', 'profil-detail.php');
}

 if (!defined('FILENAME_PROFIL_MEMBRE')) {
    define('FILENAME_PROFIL_MEMBRE', 'mon-profil.php');
}
if (!defined('FILENAME_PROFIL_MODIFIER')) {
    define('FILENAME_PROFIL_MODIFIER', 'modifier-profil.php');
}
if (!defined('FILENAME_PROFIL_MODIFIER_2')) {
    define('FILENAME_PROFIL_MODIFIER_2', 'modifier-profil2.php');
}
if (!defined('FILENAME_PUBLICITE')) {
    define('FILENAME_PUBLICITE', 'espace-pub.php');
}
if (!defined('FILENAME_RECHERCHE_AVANCEE')) {
    define('FILENAME_RECHERCHE_AVANCEE', 'recherche-avancee.php');
}
if (!defined('FILENAME_RECHERCHE_AVANCEE_1')) {
    define('FILENAME_RECHERCHE_AVANCEE_1', 'recherche-avancee1.php');
}
if (!defined('FILENAME_RELATION')) {
    define('FILENAME_RELATION', 'relation.php');
}
if (!defined('FILENAME_RELATION_MODIFIER')) {
    define('FILENAME_RELATION_MODIFIER', 'modifier-relation.php');
}
if (!defined('FILENAME_TCHAT_FENETRE')) {
    define('FILENAME_TCHAT_FENETRE', 'tchat-fenetre.php');
}
if (!defined('FILENAME_TCHAT_LISTE_CONNECTER')) {
    define('FILENAME_TCHAT_LISTE_CONNECTER', 'inc-liste-connecter-salon.php');
}
if (!defined('FILENAME_TCHAT_INCLUDE_FENETRE')) {
    define('FILENAME_TCHAT_INCLUDE_FENETRE', 'inc-tchat-fenetre.php');
}
if (!defined('FILENAME_TCHAT_INDEX')) {
    define('FILENAME_TCHAT_INDEX', 'tchat-index.php');
}
if (!defined('FILENAME_TCHAT')) {
    define('FILENAME_TCHAT', 'tchat.php');
}
if (!defined('FILENAME_VOYAGE')) {
    define('FILENAME_VOYAGE', 'voyage.php');
}

 
  /*
  *             ENSEMBLE DES TABLES SQL
  */
  if (!defined('TABLE_ABO_FEMME')) {
    define('TABLE_ABO_FEMME', 'abo_femme');
}
if (!defined('TABLE_ABO_HOMME')) {
    define('TABLE_ABO_HOMME', 'abo_homme');
}
if (!defined('TABLE_ABO_LIBERTIN')) {
    define('TABLE_ABO_LIBERTIN', 'abo_libertin');
}
if (!defined('TABLE_ADMINISTRATION')) {
    define('TABLE_ADMINISTRATION', 'admin');
}
if (!defined('TABLE_AFFICHAGE')) {
    define('TABLE_AFFICHAGE', 'affichage');
}
if (!defined('TABLE_ALBUM_PHOTO')) {
    define('TABLE_ALBUM_PHOTO', 'album_photo');
}
if (!defined('TABLE_ANIMAUX')) {
    define('TABLE_ANIMAUX', 'animaux_');
}
if (!defined('TABLE_ARCHIVE_FLV')) {
    define('TABLE_ARCHIVE_FLV', 'archive_flv');
}
if (!defined('TABLE_BARBECUE')) {
    define('TABLE_BARBECUE', 'barbecue_');
}
if (!defined('TABLE_BIBLIOTHEQUE')) {
    define('TABLE_BIBLIOTHEQUE', 'bibliotheque');
}
if (!defined('TABLE_BLACKLISTER')) {
    define('TABLE_BLACKLISTER', 'blacklist');
}
if (!defined('TABLE_BLOG')) {
    define('TABLE_BLOG', 'blog_');
}
if (!defined('TABLE_BLOG_CATEGORIES')) {
    define('TABLE_BLOG_CATEGORIES', 'blog_categories_');
}

  if (!defined('TABLE_CANAPE_LIT')) {
    define('TABLE_CANAPE_LIT', 'canape_lit_');
}
if (!defined('TABLE_CAPACITE_ACCUEIL')) {
    define('TABLE_CAPACITE_ACCUEIL', 'capacite_accueil_');
}
if (!defined('TABLE_CARNET_DE_VOYAGE')) {
    define('TABLE_CARNET_DE_VOYAGE', 'carnet_de_voyage');
}
if (!defined('TABLE_CHAMBRE_ADULTE')) {
    define('TABLE_CHAMBRE_ADULTE', 'chambre_adulte_');
}
if (!defined('TABLE_CHAMBRE_ENFANT')) {
    define('TABLE_CHAMBRE_ENFANT', 'chambre_enfant_');
}
if (!defined('TABLE_COMPTEUR_PROFIL')) {
    define('TABLE_COMPTEUR_PROFIL', 'compteur_profil');
}
if (!defined('TABLE_CONDITION')) {
    define('TABLE_CONDITION', 'condition');
}
if (!defined('TABLE_CONFIGURATION')) {
    define('TABLE_CONFIGURATION', 'configuration');
}
if (!defined('TABLE_CONNEXION')) {
    define('TABLE_CONNEXION', 'connexion');
}
if (!defined('TABLE_CONTROLEUR_MEDIA')) {
    define('TABLE_CONTROLEUR_MEDIA', 'controleur_media');
}
if (!defined('TABLE_CONVERSATION_ONLINE')) {
    define('TABLE_CONVERSATION_ONLINE', 'conversation_directe');
}
if (!defined('TABLE_CUISINE')) {
    define('TABLE_CUISINE', 'cuisine_');
}
if (!defined('TABLE_CRON_MAILINGLIST')) {
    define('TABLE_CRON_MAILINGLIST', 'cron_mailinglist');
}
if (!defined('TABLE_DEPARTEMENT_DE')) {
    define('TABLE_DEPARTEMENT_DE', 'departement_de');
}
if (!defined('TABLE_DEPARTEMENT_EN')) {
    define('TABLE_DEPARTEMENT_EN', 'departement_en');
}
if (!defined('TABLE_DEPARTEMENT_FR')) {
    define('TABLE_DEPARTEMENT_FR', 'departement_fr');
}
if (!defined('TABLE_ECHANGE_VOITURE')) {
    define('TABLE_ECHANGE_VOITURE', 'echange_voiture_');
}
if (!defined('TABLE_ECRIRE_NEWSLETTER')) {
    define('TABLE_ECRIRE_NEWSLETTER', 'ecrire_newsletter');
}
if (!defined('TABLE_FICHIER_AUDIO')) {
    define('TABLE_FICHIER_AUDIO', 'audio');
}
if (!defined('TABLE_FICHIER_VIDEO')) {
    define('TABLE_FICHIER_VIDEO', 'video');
}
if (!defined('TABLE_GALERIE_PHOTOS')) {
    define('TABLE_GALERIE_PHOTOS', 'galerie_photos');
}
if (!defined('TABLE_GARAGE')) {
    define('TABLE_GARAGE', 'garage_');
}
if (!defined('TABLE_GRILLE_TARIFAIRE')) {
    define('TABLE_GRILLE_TARIFAIRE', 'grille_tarifaire');
}
if (!defined('TABLE_HANDICAPE')) {
    define('TABLE_HANDICAPE', 'handicape_');
}
if (!defined('TABLE_HISTORIQUE_PAIEMENT')) {
    define('TABLE_HISTORIQUE_PAIEMENT', 'historique_paiement');
}
if (!defined('TABLE_IDENTITE')) {
    define('TABLE_IDENTITE', 'identite');
}
if (!defined('TABLE_INFORMATIONS_DIRECT')) {
    define('TABLE_INFORMATIONS_DIRECT', 'informations_direct');
}
if (!defined('TABLE_INSCRIPTION')) {
    define('TABLE_INSCRIPTION', 'inscription');
}
if (!defined('TABLE_JARDIN')) {
    define('TABLE_JARDIN', 'jardin_');
}
if (!defined('TABLE_LISTING_COUCHSURFING')) {
    define('TABLE_LISTING_COUCHSURFING', 'listing_couchsurfing');
}
if (!defined('TABLE_LISTING_ECHANGE_MAISON')) {
    define('TABLE_LISTING_ECHANGE_MAISON', 'listing_echange_maison');
}
if (!defined('TABLE_LISTE_EMAIL')) {
    define('TABLE_LISTE_EMAIL', 'liste_email');
}
if (!defined('TABLE_LISTE_MEMBRES_CONNECTER_DUO')) {
    define('TABLE_LISTE_MEMBRES_CONNECTER_DUO', 'duo_membres_connecter');
}
if (!defined('TABLE_LIVRE_DOR')) {
    define('TABLE_LIVRE_DOR', 'livre_dor');
}
if (!defined('TABLE_LOGEMENT_FUMEUR')) {
    define('TABLE_LOGEMENT_FUMEUR', 'logement_fumeur_');
}
if (!defined('TABLE_MESSAGERIE')) {
    define('TABLE_MESSAGERIE', 'messagerie');
}
if (!defined('TABLE_MESSAGES_ALERTE')) {
    define('TABLE_MESSAGES_ALERTE', 'messages_alerte');
}
if (!defined('TABLE_MESSENGER')) {
    define('TABLE_MESSENGER', 'messenger');
}
if (!defined('TABLE_MOIS')) {
    define('TABLE_MOIS', 'mois_');
}
if (!defined('TABLE_MOTS_CLES')) {
    define('TABLE_MOTS_CLES', 'mots_cles');
}
if (!defined('TABLE_NIVEAU')) {
    define('TABLE_NIVEAU', 'niveau_');
}
if (!defined('TABLE_NOUVEAUX_INSCRITS')) {
    define('TABLE_NOUVEAUX_INSCRITS', 'nouveaux_inscrits');
}
if (!defined('TABLE_ONLINE')) {
    define('TABLE_ONLINE', 'membres_connectes');
}
if (!defined('TABLE_OPTIONS')) {
    define('TABLE_OPTIONS', 'options');
}
if (!defined('TABLE_PAIEMENTS')) {
    define('TABLE_PAIEMENTS', 'utilisateur');
}
if (!defined('TABLE_PAIEMENT_ATTENTE_CONFIRMATION')) {
    define('TABLE_PAIEMENT_ATTENTE_CONFIRMATION', 'paiement_attente_confirmation');
}
if (!defined('TABLE_PAYS_DE')) {
    define('TABLE_PAYS_DE', 'pays_de');
}
if (!defined('TABLE_PAYS_EN')) {
    define('TABLE_PAYS_EN', 'pays_en');
}
if (!defined('TABLE_PAYS_FR')) {
    define('TABLE_PAYS_FR', 'pays_fr');
}
if (!defined('TABLE_PISCINE')) {
    define('TABLE_PISCINE', 'piscine_');
}
if (!defined('TABLE_RELATION')) {
    define('TABLE_RELATION', 'relation');
}
if (!defined('TABLE_RUBRIQUES_ECHANGE')) {
    define('TABLE_RUBRIQUES_ECHANGE', 'rubriques_');
}
if (!defined('TABLE_SALLE_BAIN')) {
    define('TABLE_SALLE_BAIN', 'salle_bain_');
}
if (!defined('TABLE_SITUATION')) {
    define('TABLE_SITUATION', 'situation_');
}
if (!defined('TABLE_TCHAT_DISCUSSION')) {
    define('TABLE_TCHAT_DISCUSSION', 'discussion_tchat');
}
if (!defined('TABLE_TCHAT_LISTE_CONNECTES')) {
    define('TABLE_TCHAT_LISTE_CONNECTES', 'liste_connectes_tchat');
}
if (!defined('TABLE_TERRASSE')) {
    define('TABLE_TERRASSE', 'terrasse_exterieure_');
}
if (!defined('TABLE_THEMATIQUE')) {
    define('TABLE_THEMATIQUE', 'thematique');
}
if (!defined('TABLE_TYPE_LOGEMENT')) {
    define('TABLE_TYPE_LOGEMENT', 'type_logement_');
}
if (!defined('TABLE_VELO')) {
    define('TABLE_VELO', 'pret_velo_');
}
if (!defined('TABLE_WEBCAM_DUO')) {
    define('TABLE_WEBCAM_DUO', 'webcam_duo');
}

 
  /*
  *             CHEMIN ACCES FICHIER IMAGES
  */
 if (!defined('REPERTOIRE_IMAGE_ORIGINAL')) {
    define('REPERTOIRE_IMAGE_ORIGINAL', RACINE.'/images/original/');
}
if (!defined('REPERTOIRE_IMAGE_REDIMENSIONNEE')) {
    define('REPERTOIRE_IMAGE_REDIMENSIONNEE', RACINE.'/images/redimensionnee/');
}
if (!defined('REPERTOIRE_IMAGE_MINIATURE')) {
    define('REPERTOIRE_IMAGE_MINIATURE', RACINE.'/images/miniature/');
}
if (!defined('REPERTOIRE_IMAGE')) {
    define('REPERTOIRE_IMAGE', RACINE.'/images/');
}
if (!defined('HTTP_IMAGE')) {
    define('HTTP_IMAGE', HTTP_HOST.'/images/');
}
if (!defined('HTTP_IMAGE_ORIGINAL')) {
    define('HTTP_IMAGE_ORIGINAL', HTTP_HOST.'/images/original/');
}
if (!defined('HTTP_IMAGE_REDIMENSIONNEE')) {
    define('HTTP_IMAGE_REDIMENSIONNEE', HTTP_HOST.'/images/redimensionnee/');
}
if (!defined('HTTP_IMAGE_MINIATURE')) {
    define('HTTP_IMAGE_MINIATURE', HTTP_HOST.'/images/miniature/');
}
if (!defined('HTTP_FLASH')) {
    define('HTTP_FLASH', HTTP_HOST.'/images/flash/');
}
if (!defined('HTTP_FLASH_ACCUEIL')) {
    define('HTTP_FLASH_ACCUEIL', HTTP_HOST.'/images/flash/anim_2.flv');
}
if (!defined('REPERTOIRE_FMS')) {
    define('REPERTOIRE_FMS', $array[12]);
}
if (!defined('HTTP_ADMIN')) {
    define('HTTP_ADMIN', HTTP_HOST.'/admin/');
}
if (!defined('REPERTOIRE_AUDIO')) {
    define('REPERTOIRE_AUDIO', RACINE.'/images/audio/');
}
if (!defined('HTTP_AUDIO')) {
    define('HTTP_AUDIO', HTTP_IMAGE.'audio/');
}
if (!defined('REPERTOIRE_VIDEO')) {
    define('REPERTOIRE_VIDEO', RACINE.'/images/video/');
}
if (!defined('HTTP_VIDEO')) {
    define('HTTP_VIDEO', HTTP_IMAGE.'video/');
}
if (!defined('REPERTOIRE_WEBAPPS_RED5')) {
    define('REPERTOIRE_WEBAPPS_RED5', '/usr/lib/red5/webapps/oflaDemo/streams/maison.biz/');
}
if (!defined('HTTP_WARNING')) {
    define('HTTP_WARNING', '<img src="'.HTTP_HOST.'/images/warning.gif" alt="'.ATTRIBUT_ALT.'"/>');
}
if (!defined('HTTP_PROGRESS')) {
    define('HTTP_PROGRESS', '<img src="'.HTTP_HOST.'/images/progressbar.gif" alt="'.ATTRIBUT_ALT.'"/>');
}
if (!defined('REPERTOIRE_INTERFACE')) {
    define('REPERTOIRE_INTERFACE', RACINE.'/interface/');
}
if (!defined('HTTP_INTERFACE')) {
    define('HTTP_INTERFACE', HTTP_HOST.'/interface/');
}

 if (!defined('HTTP_PLUGIN_LECTEUR_FLASH')) {
    define('HTTP_PLUGIN_LECTEUR_FLASH', HTTP_HOST.'/interface/install_flash_player.exe');
}
if (!defined('HTTP_MOTEUR_MAISON')) {
    define('HTTP_MOTEUR_MAISON', HTTP_SERVEUR.'listingSearch/');
}
if (!defined('HTTP_COMMENTAIRES')) {
    define('HTTP_COMMENTAIRES', HTTP_SERVEUR.'commentaires/');
}
if (!defined('HTTP_BLOG')) {
    define('HTTP_BLOG', HTTP_SERVEUR.'blog/');
}
if (!defined('HTTP_PAIEMENT')) {
    define('HTTP_PAIEMENT', HTTP_SERVEUR.'interface/'.FILENAME_PAGE_PAIEMENT);
}
if (!defined('HTTP_ESPACE_MEMBRE')) {
    define('HTTP_ESPACE_MEMBRE', HTTP_SERVEUR.'membre/');
}
if (!defined('HTTP_LISTING_SEARCH')) {
    define('HTTP_LISTING_SEARCH', HTTP_SERVEUR.'listingSearch/');
}
if (!defined('HTTP_TCHAT')) {
    define('HTTP_TCHAT', HTTP_SERVEUR.'tchat/');
}
if (!defined('HTTP_DRAPEAUX')) {
    define('HTTP_DRAPEAUX', HTTP_HOST.'/images/flags/');
}

 
 /*
  *            LISTING ANNONCE
  */
 if (!defined('NOMBRE_ANNONCE_PAR_PAGE')) {
    define('NOMBRE_ANNONCE_PAR_PAGE', $array[13]);
}
if (!defined('NOMBRE_COLONNE_LISTING')) {
    define('NOMBRE_COLONNE_LISTING', $array[14]);
}
if (!defined('AFFICHER_EXTRAIT_DEBUT')) {
    define('AFFICHER_EXTRAIT_DEBUT', $array[15]);
}
if (!defined('AFFICHER_EXTRAIT_FIN')) {
    define('AFFICHER_EXTRAIT_FIN', $array[16]);
}

 
 /*
  *            CONFIG CONNECTER
  */
 if (!defined('PERIODE_CONNEXION')) {
    define('PERIODE_CONNEXION', $array[17]); // Durée de la connexion
}
if (!defined('LIMITE_CONNEXION_AVANT_CLOTURE')) {
    define('LIMITE_CONNEXION_AVANT_CLOTURE', $array[18]); // Limite critique avant cloture de la session
}
if (!defined('RAFRAICHISSEMENT_PAGE')) {
    define('RAFRAICHISSEMENT_PAGE', $array[19]); // Échéance du rafraîchissement de la page
}

  /*
  *            CONFIG INSCRIPTION
  */
 if (!defined('LIMITE_AGE_MAJORITE')) {
    define('LIMITE_AGE_MAJORITE', $array[20]); // LIMITE AGE ACCEPTE
}
if (!defined('RAFRAICHISSEMENT_MESSENGER')) {
    define('RAFRAICHISSEMENT_MESSENGER', $array[21]); // Échéance du rafraîchissement de la page
}
if (!defined('LIMITE_AFFICHAGE_INFORMATIONS')) {
    define('LIMITE_AFFICHAGE_INFORMATIONS', $array[22]); // Temps affichage du message dans espace INFORMATIONS EN DIRECT
}
if (!defined('RAFRAICHISSEMENT_MESSAGES_MESSENGER')) {
    define('RAFRAICHISSEMENT_MESSAGES_MESSENGER', $array[23]); // Temps affichage message erreur traitement MESSENGER
}
if (!defined('NOMBRE_MESSAGES_PAR_PAGE')) {
    define('NOMBRE_MESSAGES_PAR_PAGE', $array[24]); // Nombre de messages par page
}
if (!defined('NOMBRE_CARACTERES_EXTRAIT_DESCRIPTION')) {
    define('NOMBRE_CARACTERES_EXTRAIT_DESCRIPTION', $array[25]); // Nombre de caractères extrait description
}
if (!defined('NOMBRE_MEMBRES_BLACKLIST')) {
    define('NOMBRE_MEMBRES_BLACKLIST', $array[26]); // Nombre de membres blacklister par page
}
if (!defined('NOMBRE_MESSAGES_DUO_WEBCAM')) {
    define('NOMBRE_MESSAGES_DUO_WEBCAM', $array[27]); // Nombre de messages affichés durant la conversation
}
if (!defined('RAFRAICHISSEMENT_MESSAGES_DUO_WEBCAMS')) {
    define('RAFRAICHISSEMENT_MESSAGES_DUO_WEBCAMS', $array[28]); // rafraîchissement toutes les X secondes
}
if (!defined('FENETRE_WIDTH_MESSAGES_DUO_WEBCAMS')) {
    define('FENETRE_WIDTH_MESSAGES_DUO_WEBCAMS', $array[29] . 'px');
}
if (!defined('FENETRE_HEIGHT_MESSAGES_DUO_WEBCAMS')) {
    define('FENETRE_HEIGHT_MESSAGES_DUO_WEBCAMS', $array[30] . 'px');
}
if (!defined('PERIODE_PAIEMENT_GRATUIT')) {
    define('PERIODE_PAIEMENT_GRATUIT', $array[31]);
}
if (!defined('MAIL_CORRESPONDANCE')) {
    define('MAIL_CORRESPONDANCE', $array[32]);
}
if (!defined('EMAIL_PAYPAL')) {
    define('EMAIL_PAYPAL', $array[33]);
}
if (!defined('TEMPS_MAJ_CONNEXION')) {
    define('TEMPS_MAJ_CONNEXION', 70);
}
if (!defined('INTERVALLE_MAJ_CONNEXION')) {
    define('INTERVALLE_MAJ_CONNEXION', 60);
}
if (!defined('DIMENSION_MAXIMALE_HAUTEUR_PUB')) {
    define('DIMENSION_MAXIMALE_HAUTEUR_PUB', 180);
}
if (!defined('DIMENSION_MAXIMALE_LARGEUR_PUB')) {
    define('DIMENSION_MAXIMALE_LARGEUR_PUB', 280);
}
if (!defined('MAIL_RECEPTION_CRON')) {
    define('MAIL_RECEPTION_CRON', MAIL_CORRESPONDANCE);
}
if (!defined('CONSTAT_ETAT_LIEUX')) {
    define('CONSTAT_ETAT_LIEUX', HTTP_SERVEUR . 'images/Constat_etat_des_lieux_type.doc');
}
if (!defined('CONTRAT_ECHANGE_MAISON')) {
    define('CONTRAT_ECHANGE_MAISON', HTTP_SERVEUR . 'images/Contrat type_echange_de_maison.doc');
}
if (!defined('CONTRAT_ECHANGE_VEHICULE')) {
    define('CONTRAT_ECHANGE_VEHICULE', HTTP_SERVEUR . 'images/Contrat_type_echange_vehicule.doc');
}
if (!defined('CONSTAT_ETAT_LIEUX_PDF')) {
    define('CONSTAT_ETAT_LIEUX_PDF', HTTP_SERVEUR . 'images/Constat_etat_des_lieux_type.pdf');
}
if (!defined('CONTRAT_ECHANGE_MAISON_PDF')) {
    define('CONTRAT_ECHANGE_MAISON_PDF', HTTP_SERVEUR . 'images/Contrat type_echange_de_maison.pdf');
}
if (!defined('CONTRAT_ECHANGE_VEHICULE_PDF')) {
    define('CONTRAT_ECHANGE_VEHICULE_PDF', HTTP_SERVEUR . 'images/Contrat_type_echange_vehicule.pdf');
}
if (!defined('SERVEUR_SOCKET_ADRESSE')) {
    define('SERVEUR_SOCKET_ADRESSE', '127.0.0.1');
}
if (!defined('SERVEUR_SOCKET_PORT')) {
    define('SERVEUR_SOCKET_PORT', '35353');
}

// ... (tes defines déjà présents)

// Fonction pour inclure un fichier de langue
function includeLanguage($racine, $langue, $fichier) {
    $chemin = $racine . $fichier;

    if (file_exists($chemin)) {
        include_once($chemin);
    } else {
        echo "<p><i>Erreur : fichier de langue introuvable ($chemin).</i></p>";
    }
}

// Charset global
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset', 'utf-8');