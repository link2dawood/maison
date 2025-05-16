<?php
/*
 * MENU ESPACE MEMBRE NUMERO 2
 */
 
 $compteur_visites = $membre->compterVisites($_SESSION['id_client']);
 
 $mon_compte = $metier->getInscriptionMembre($_SESSION['id_client']);
 
 echo '<p style="text-align:left;">' .
 		''.autoriserAction($mon_compte[4], $mon_compte[5], $mon_compte[6], $mon_compte[8], $mon_compte[1], $mon_compte[3], HTTP_SERVEUR.'interface/'.FILENAME_PROFIL, '('.$compteur_visites.')'.MENU_VISITER_PROFIL).'' .
 		'</p>';
 
?>

