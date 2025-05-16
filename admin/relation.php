<?php
/*
 * Created on 27 févr. 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<table id="compte_client">
	<tr>
		<td colspan="2" style="text-align:left;"><img src="<?php echo HTTP_IMAGE; ?>warning.gif" alt="warning"/> <a href="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES; ?>?action=reset&type=relation" title="Remise à zéro table de relation">Remise à zéro</a></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:right;"><a href="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES.'?action=insertion&type=relation" title="Ajouter une table de relation"><img src="'.HTTP_IMAGE; ?>ajouter.png" alt="ajouter"/></a> ::: <a href="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=relation" title="Modifier les relations"><img src="'.HTTP_IMAGE; ?>modifier.png" alt="modifier"/></a></td>
	</tr>
	<?php
	echo $membre->getRelation("consulter");
	?>
</table>