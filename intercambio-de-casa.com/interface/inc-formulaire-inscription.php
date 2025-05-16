<?php
/*
 * FORMULAIRE INSCRIPTION GRATUITE ACCUEIL
 */
  //***LUTTE ANTI-SPAM***
mt_srand((float) microtime()*1000000);
$nb = mt_rand(0, 100000);
?>
<div class="tab">
	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_INSCRIPTION; ?>" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td class="info"><?php echo FORMULAIRE_MON_PSEUDO; ?></td>
				<td><input type="text" name="pseudo" value="<?php echo $_SESSION['form_inscpt_pseudo']; ?>"/></td>
			</tr>
			<tr>
				<td class="info"><?php echo FORMULAIRE_MOT_DE_PASSE; ?></td>
				<td><input type="password" name="mot_de_passe" /></td>
			</tr>
			<tr>
				<td class="info"><?php echo FORMULAIRE_CONFIRMATION; ?></td>
				<td><input type="password" name="mot_de_passe_confirmation" /></td>
			</tr>
			<tr>
				<td class="info"><?php echo FORMULAIRE_EMAIL; ?> <input type="hidden" name="num"  value="<?php echo $nb; ?>" /></td>
				<td><input type="text" name="email" value="<?php echo $_SESSION['form_inscpt_email']; ?>"/></td>
			</tr>
			<tr>
				<td class="info">
					<table>
						<tr>
							<td class="libelle_code"><?php echo FORMULAIRE_CODE_ANTISPAM; ?></td>
							<td><img src="<?php echo HTTP_HOST; ?>/interface/applications/image.php?nb=<?php echo $nb; ?>" alt="<?php echo ATTRIBUT_ALT; ?>" /></td>
						</tr>
					</table>
				</td>
				<td><input type="text" name="image" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<table>
						<tr>
							<td><input type="checkbox" name="acceptation" value="ok" checked/></td>
							<td><?php echo FORMULAIRE_CGU; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;"><input type="image" src="<?php echo HTTP_IMAGE.FORMULAIRE_IMAGE_SUBMIT; ?>" name="validation" value="1"/></td>
			</tr>
		</table>
	</form>
</div>