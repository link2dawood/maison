<?php

?>
<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_AFFICHER_RESULTATS_LISTING_MEMBRE; ?>" method="post">
	<ul>
		<li><?php echo TEXT_MODULE_RECHERCHE; ?></li>
		<li>
			<?php
			//AFFICHER LES OPTIONS DE PAYS
			$tab_pays = $membre->afficherPaysEspaceMembre('recherche_pays', LANGUAGE);
			foreach($tab_pays as $cle_pays){
				echo $cle_pays;
			}
			?>
		</li>
		<li><?php include(INCLUDE_DEPARTEMENT); ?></li>
		<li><?php echo OPTION_1_MODULE_RECHERCHE; ?></li>
		<li><input type="radio" name="option" value="0"/> <span style="color:green;font-weight:bolder;"><?php echo OPTION_2_MODULE_RECHERCHE; ?></span></li>
		<li><input type="radio" name="option" value="1"/> <span style="color:red;font-weight:bolder;"><?php echo OPTION_3_MODULE_RECHERCHE; ?></span></li>
		<li><input type="radio" name="option" value="2" checked/> <?php echo OPTION_4_MODULE_RECHERCHE; ?></li>
		<li><input type="submit" value="<?php echo SUBMIT_MODULE_RECHERCHE; ?>"/></li>
	</ul>
</form>