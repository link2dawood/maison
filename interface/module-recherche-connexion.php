<?php

?>
<form action="<?php echo HTTP_SERVEUR.'interface/'; ?>" method="post">
	<ul>
		<li><?php echo 0; ?></li>
		<li>
			<?php
			
			$tab_pays = $membre->afficherPaysEspaceMembre('recherche_pays', LANGUAGE);
			foreach($tab_pays as $cle_pays){
				echo $cle_pays;
			}
			?>
		</li>
		<li><?php include('./departement.php'); ?></li>
		<li><?php echo OPTION_1_MODULE_RECHERCHE; ?></li>
		<li><input type="radio" name="option" value="0"/> <span style="color:green;font-weight:bolder;"><?php echo OPTION_2_MODULE_RECHERCHE; ?></span></li>
		<li><input type="radio" name="option" value="1"/> <span style="color:red;font-weight:bolder;"><?php echo OPTION_3_MODULE_RECHERCHE; ?></span></li>
		<li><input type="radio" name="option" value="2" checked/> <?php echo OPTION_4_MODULE_RECHERCHE; ?></li>
		<li><input type="submit" value="<?php echo SUBMIT_MODULE_RECHERCHE; ?>"/></li>
	</ul>
</form>