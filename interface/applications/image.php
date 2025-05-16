<?php
session_start(); 

include('./commun/configuration.php');
include(INCLUDE_FCTS_UTILE);

$nb = $_GET['nb'];

$texte = encodageSpam($nb);

// Nouvelle image 100*30
$im = imagecreate(70, 17);

// Fond noir
$bg = imagecolorallocate($im, 255, 255, 255);
// texte blanc
$textcolor = imagecolorallocate($im, 0, 90, 223);

// Ajout de la phrase en haut  gauche
imagestring($im, 5, 5, 1, $texte, $textcolor);

// Affichage de l'image
header("Content-type: image/png");
imagepng($im);
?>