<?php
/*
 * Created on 10 mai 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div id="footer_link">
	<?php
	if(LANGUAGE == "en"){
		for($i=1;$i<=8;$i++){
			echo '<a href="'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-'.$i.'-17.php" title="'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'">'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'</a>';
		}
	}
	elseif(LANGUAGE == "es"){
		for($i=1;$i<=8;$i++){
			echo '<a href="'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-'.$i.'-14.php" title="'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'">'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'</a>';
		}
	}
	elseif(LANGUAGE == "de"){
		for($i=1;$i<=8;$i++){
			echo '<a href="'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-'.$i.'-6.php" title="'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'">'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'</a>';
		}
	}
	else{
		for($i=1;$i<=8;$i++){
			echo '<a href="'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-'.$i.'-5.php" title="'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'">'.ucfirst($metier->getChamps("element",TABLE_RUBRIQUES_ECHANGE.LANGUAGE,"id",$i)).'</a>';
		}
	}
	?>
</div>