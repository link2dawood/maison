<?php
/*
 * FORMULAIRE INSCRIPTION GRATUITE ACCUEIL
 */
?>
<div id="formulaire_login">
	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CONNEXION; ?>" method="post">
		<table>
			<tr>
				<td colspan="2" class="titre"><?php echo FORMULAIRE_LOGIN_TEXTE; ?></td>
			</tr>
			<tr>
				<td class="info"><?php echo FORMULAIRE_LOGIN_PSEUDO; ?></td>
				<td><input type="text" name="login"/></td>
			</tr>
			<tr>
				<td class="info"><?php echo FORMULAIRE_LOGIN_PASSE; ?></td>
				<td><input type="password" name="passe" /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;"><input type="image" src="<?php echo HTTP_IMAGE.FORMULAIRE_LOGIN_SUBMIT; ?>"/></td>
			</tr>
		</table>
	</form>
</div>