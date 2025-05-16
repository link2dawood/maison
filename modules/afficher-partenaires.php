<?php
//IL VOUS SUFFIT D'INSERER CE CODE SUR UNE DES PAGES OU VOUS VOULEZ AFFICHER LES PARTENAIRES
//Rensignez bien l'include qui se situe si dessous, si le script d'échange de liens est situé dans le dossier echange-liens-gratuits, veuillez inclure ceci ; include('echange-liens-gratuits/inc/partenaires.class.php');
	include('inc/partenaires.class.php');
	
	$partenaires = new Partenaires();
	
	$partenaires->nombreAafficher(3); // fonction facultative, si elle n'est pas appelée, le script affichera le nombre de sites que l'admin a spécifié en configuration
	$partenaires->separateurs('<li>', '</li>'); // fonction obligatoire
	$partenaires->ordre(DECROISSANT); // possibilitées : CROISSANT ou DECROISSANT | fonction facultative, si elle n'est pas appelée, le script affichera les sites dans l'ordre spécifié dans la configuration
	
	echo '<ul>' . $partenaires->getPartenaires() . '</ul>';
//Merci d'utiliser le Script d'échange de liens automatique de www.paidpr.com
?>