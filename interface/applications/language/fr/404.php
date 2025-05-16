<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('HEADER_TITLE', 'Une erreur est survenue !');
define('HEADER_DESCRIPTION', '');
define('HEADER_KEYWORDS', 'voyage, change de maison, humanitaire, location de vacances, gites, hotel, camping,echange d\'appartement, change appartement, change de maisons, echange demaisons, appartement, echange de maison, appartements, condo, appartement, apartement, camping-car, etranger, camping car, Home exchange, homexchange, HOMEEXCHANGE, EXCHANGE, exchanges, camping cars, change, quebec, Home Exchange, france, canada, change-maison, Quebec, France, Canada, Echanges, maison, qubec, vacances  l\'etranger');

define('H1_DE_LA_PAGE', 'Une erreur est survenue !');
define('H2_DE_LA_PAGE', 'Une erreur est survenue !');

define('TEXTE_1', 'Nous sommes dsols mais une erreur est survenue durant l\'appel de cette page!<br />Si le problme persiste...merci de nous contacter !');
