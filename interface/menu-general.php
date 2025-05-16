<?php
/*
 * MENU GENERAL DU SITE
 */
?>
<p class="menu_principal">
	<a href="<?php echo HTTP_SERVEUR; ?>"><?php echo MENU_ACCUEIL; ?></a> 
	 | <a href="<?php echo HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE; ?>"><?php echo MENU_ESPACE_MEMBRE; ?></a>  
	 | <a href="<?php echo HTTP_SERVEUR.FILENAME_CONTACT; ?>"><?php echo FOOTER_CONTACT; ?></a>  
	 | <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>"><?php echo MENU_CGU; ?></a> 
	 | <a href="<?php echo HTTP_SERVEUR.FILENAME_PUBLICITE; ?>"><?php echo MENU_PUBLICITE; ?></a> 
	 | <a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CONSEILLER_SITE_AMI; ?>"><?php echo MENU_CONSEILLER_SITE; ?></a>
</p>