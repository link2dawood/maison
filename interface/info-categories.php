<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();
include(INCLUDE_CLASS_RECHERCHE_AVANCEE);
$rech = new RechercheAvancee();

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_RECHERCHE_AVANCEE);

//*****************************************************
//             INFOS SUR UN PAYS
//*****************************************************

echo '<div>' .
		'<table style="width:100%;">' .
		'<tr>' .
		'<td colspan="2" style="text-align:center;font-size:20px;font-weight:bolder;background-color:#00327C;color:white;">'.TEXTE_19.' '.$metier->getChamps("pays","pays_".LANGUAGE,"id",minuscule($_GET['id_pays'])).'</td>' .
		'</tr>' .
		'<tr>' .
		'<td>'.TEXTE_20.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),5).')</td>' .
		'<td>'.TEXTE_21.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),6).')</td>' .
		'</tr>' .
		'<tr>' .
		'<td>'.TEXTE_22.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),4).')</td>' .
		'<td>'.TEXTE_23.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),3).')</td>' .
		'</tr>' .
		'<tr>' .
		'<td>'.TEXTE_24.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),1).')</td>' .
		'<td>'.TEXTE_25.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),2).')</td>' .
		'</tr>' .
		'<tr>' .
		'<td>'.TEXTE_26.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),8).')</td>' .
		'<td>'.TEXTE_27.' ('.$rech->compterTypeEnLigne(minuscule($_GET['id_pays']),7).')</td>' .
		'</tr>' .
		'</table>' .
		'</div>';
?>
