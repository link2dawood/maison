<?php
/*
 * ESPACE PUBLICITAIRE DE TYPE A
 */
 //RECUPERER UNE ANNONCE ALEATOIREMENT
 $maPub = $membre->getAffichageAleatoire("A");

if(empty($maPub->id)){
	echo '<div style="text-align:center;">' .
	
			'<a href="'.HTTP_SERVEUR.FILENAME_PUBLICITE.'" style="font-size:10px;">'.ESPACE_PUBLICITAIRE_LIEN.'</a>' .
				'</div>';
}





else{
	//MODIFIER DIMENSIONS MAXIMALES
	$dimensions = modifierImage($maPub->lien, DIMENSION_MAXIMALE_LARGEUR_PUB, DIMENSION_MAXIMALE_HAUTEUR_PUB);
	
	echo '<div style="text-align:center;">' .
			'<a href="'.$maPub->texte.'" rel="nofollow"><img src="'.$maPub->lien.'" alt="'.ATTRIBUT_ALT.'" width="'.$dimensions[0].'" height="'.$dimensions[1].'" '.$dimensions[2].'/></a>' .
			'<br /><a href="'.HTTP_SERVEUR.FILENAME_PUBLICITE.'" style="font-size:10px;">'.ESPACE_PUBLICITAIRE_LIEN.'</a>' .
			'</div>';
}
?>