<?php
// ? Afficher les erreurs pour d�boguer
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ? Lancer la session proprement
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ? Inclusion des fichiers n�cessaires
include('../interface/applications/commun/fct-utile.php');
include('../config.php');
include('../interface/applications/commun/configuration.php');
include(INCLUDE_CLASS_LOGIN);

$login = new Login();

// ? V�rifie si l'admin est d�j� connect�
if (empty($_SESSION['admin'])) {

    // ? V�rifie si le formulaire a �t� soumis
    if (empty($_POST['login']) || empty($_POST['passe'])) {
        // Redirige vers l'accueil admin
        redirection('0', HTTP_ADMIN);
        exit;
    }

    // ? R�cup�re et nettoie les donn�es
    $login_post = minuscule($_POST['login']);
    $passe_post = md5(textLibre($_POST['passe']));

    // ? Contr�le des identifiants
    $result_connexion = $login->controleLoginAdmin($login_post, $passe_post);

    if (
        isset($result_connexion[0], $result_connexion[1]) &&
        $login_post === $result_connexion[0] &&
        $passe_post === $result_connexion[1]
    ) {
        // Connexion r�ussie
        $_SESSION['admin'] = $result_connexion[0];
        $_SESSION['date_last_visite'] = $result_connexion[2];

        // Mise � jour de la derni�re connexion
        $login->majderniereConnexionAdmin($login_post, time());

        redirection('0', HTTP_ADMIN);
        exit;
    } else {
        // Identifiants incorrects
        echo '<p style="font-size:20px;text-align:center;margin-top:80px;font-weight:bolder;color:red;">Erreur de connexion : identifiants incorrects.</p>';
        exit;
    }

} else {
    // D�j� connect� ? redirection
    redirection('0', HTTP_ADMIN);
    exit;
}
?>