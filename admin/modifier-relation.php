<?php
/*
 * Created on 27 f�vr. 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

?>
<form method="post" action="<?php echo FILENAME_PARAMETRES; ?>?action=confirmation-relation">
<table id="compte_client">
	<tr>
		<td colspan="2" style="text-align:left;"><img src="<?php echo HTTP_IMAGE; ?>warning.gif" alt="warning"/> <a href="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES; ?>?action=reset&type=relation" title="Remise � z�ro table de relation">Remise � z�ro</a></td>
	</tr>
	<?php
	echo $membre->getRelation("modifier");	
	?>
	<tr>
		<td colspan="2" style="text-align:center;"><input type="submit" value="Envoyer"></td>
	</tr>
</table>
</form>