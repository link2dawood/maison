<?php
/*
 * Created on 27 févr. 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

?>
<form method="post" action="<?php echo FILENAME_PARAMETRES; ?>?action=confirmation-libelle&lang=<?php echo $_GET['lang']; ?>">
<table id="compte_client">
	<?php
	echo $membre->getOptions("modifier",TABLE_RUBRIQUES_ECHANGE,$_GET['lang']);	
	?>
	<tr>
		<td colspan="2" style="text-align:center;"><input type="submit" value="Envoyer"></td>
	</tr>
</table>
</form>