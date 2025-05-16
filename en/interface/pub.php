<?php
/*
 * Created on 3 mars 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 $uneAnnonce = $metier->getUneAnnoncePub();
 
 echo formulairePreview($uneAnnonce[2], $uneAnnonce[3], "", "", "", $uneAnnonce[4]);
 
 //METTRE A JOUR LE COMPTEUR
 $compteur = $uneAnnonce[7] + 1;
 $metier->updateCompteurAffichage($compteur, $uneAnnonce[0]);
?>
