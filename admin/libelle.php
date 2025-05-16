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
		<td colspan="2" style="text-align:right;"><a href="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=libelle&lang='.$_GET['lang'].'" title="Modifier les libellés"><img src="'.HTTP_IMAGE; ?>modifier.png" alt="modifier"/></a></td>
	</tr>
	<?php
	echo $membre->getOptions("consulter",TABLE_RUBRIQUES_ECHANGE,$_GET['lang']);
	?>
</table>