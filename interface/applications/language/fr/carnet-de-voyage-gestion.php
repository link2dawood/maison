<?php
session_start();
define('HEADER_TITLE', 'La gestion de mon carnet de voyage');
define('HEADER_DESCRIPTION', 'La gestion de mon carnet de voyage');
define('HEADER_KEYWORDS', 'change, webcam, voyage webcam, change maison, change de maison, hbergement vacances gratuites, appartement, echange appartement, change de logement, logements, vacance, vacances');

define('H1_DE_LA_PAGE', 'La gestion de mon carnet de voyage');
define('H2_DE_LA_PAGE', 'Mon carnet de voyage');


define('TEXTE_1', '<img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/>' .
		'<img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/>' .
		'<img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/>' .
		'<img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/>' .
		'<img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/>');
define('TEXTE_2', 'Gestion de votre galerie photos :');
define('TEXTE_3', 'Slectionner :');
define('TEXTE_4', 'Ajouter');
define('TEXTE_5', 'Supprimer');
define('TEXTE_6', 'Envoyer');
define('TEXTE_7', 'Ajouter une photo dans la galerie');
define('TEXTE_8', 'Supprimer une photo dans la galerie');
define('TEXTE_9', 'Ma photo :');
define('TEXTE_10', 'Nous sommes dsols mais cette photo n\'est pas conforme !');
define('TEXTE_11', 'La photo a t ajout!<br />Elle va maintenant tre contrle par notre quipe !');
define('TEXTE_12', 'Envoyer mon carnet de voyage');
define('TEXTE_13', HTTP_WARNING.' Notre quipe contrle tout ajout ou modification d\'un carnet de voyage en concordance avec nos conditions gnrales d\'utilisation !' .
		'<br /><strong>ATTENTION, tous les champs sont obligatoires !</strong>');
define('TEXTE_14', 'Carnet de voyage ajout...<br />Il va maintenant tre contrl par notre quipe !');
define('TEXTE_15', 'Carnet de voyage modifi...<br />Il va maintenant tre contrl par notre quipe !');
define('TEXTE_16', 'Carnet de voyage supprim !');
define('TEXTE_17', 'Carnet de voyage [en attente de validation]');
define('TEXTE_18', 'Carnet de voyage [en ligne]');
define('TEXTE_19', 'Carnet de voyage [sans]');
define('TEXTE_20', '[Annuler]');
define('TEXTE_21', 'Image supprime !');
define('TEXTE_22', 'Vido [en attente]');
define('TEXTE_23', 'Vido [en ligne]');
define('TEXTE_24', 'Vido [sans]');
define('TEXTE_25', 'Gestion de votre vido :');
define('TEXTE_26', 'Vido supprime !');
define('TEXTE_27', 'Ajouter ma vido');
define('TEXTE_28', HTTP_WARNING.' formats accepts : (<em>AVI,MOV,MPG et WMV</em>)');
define('TEXTE_29', 'Vido ajoute !');
define('TEXTE_30', 'Titre ('.HTTP_WARNING.' limit 80 caractres maxi) : ');
define('TEXTE_31', 'Nous sommes dsols mais les champs :<br /> INTITULE et COMMENTAIRE sont obligatoires !');
define('TEXTE_32', 'Ma galerie photos');
define('TEXTE_33', '[Supprimer le carnet de voyage]');
define('TEXTE_34', 'Utilisez ce champs ci-contre pour dvelopper votre carnet de voyage avec du texte mise en valeur, des photos, etc... faites-nous rver !' .
		'<br />/!\ Effacer ce message avant de commencer !');
?>