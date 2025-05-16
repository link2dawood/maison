<?php
//GRILLE TARIFAIRE HOMME
$abo_1_homme = $membre->getAbonnement(1, TABLE_ABO_HOMME, "fr");
$abo_3_homme = $membre->getAbonnement(3, TABLE_ABO_HOMME, "fr");
$abo_6_homme = $membre->getAbonnement(6, TABLE_ABO_HOMME, "fr");
$abo_12_homme = $membre->getAbonnement(12, TABLE_ABO_HOMME, "fr");

echo '<p style="text-align:right;margin-top:10px;margin-bottom:10px;"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=tarif" title="Modifier les tarifs">modifier les tarifs</a></p>';

?>
<div id="tab_listing_compte">
	<?php
	if($_GET['action'] == "consulter"){
		?>
		<table style="width:100%;">
			<tr>
				<th colspan="3">GRILLE TARIFAIRE</th>
			</tr>
			<tr>
				<td><strong>REFERENCE</strong></td>
				<td><strong>DUREE</strong></td>
				<td><strong>FORMULE</strong></td>
			</tr>
			<tr>
				<td colspan="3"><hr /></td>
			</tr>
			<tr>
				<td><?php echo $abo_1_homme[0];?></td>
				<td><?php echo $abo_1_homme[1];?> mois</td>
				<td style="color: rgb(239, 114, 39); font-weight: bolder;"><?php echo $abo_1_homme[2];?> €</td>
			</tr>	
			<tr>
				<td colspan="3"><hr /></td>
			</tr>
			<tr>
				<td><?php echo $abo_3_homme[0];?></td>
				<td><?php echo $abo_3_homme[1];?> mois</td>
				<td style="color: rgb(239, 114, 39); font-weight: bolder;"><?php echo $abo_3_homme[2];?> €</td>
			</tr>
			<tr>
				<td colspan="3"><hr /></td>
			</tr>
			<tr>
				<td><?php echo $abo_6_homme[0];?></td>
				<td><?php echo $abo_6_homme[1];?> mois</td>
				<td style="color: rgb(239, 114, 39); font-weight: bolder;"><?php echo $abo_6_homme[2];?> €</td>
			</tr>
			<tr>
				<td colspan="3"><hr /></td>
			</tr>
			<tr>
				<td><?php echo $abo_12_homme[0];?></td>
				<td><?php echo $abo_12_homme[1];?> mois</td>
				<td style="color: rgb(239, 114, 39); font-weight: bolder;"><?php echo $abo_12_homme[2];?> €</td>
			</tr>
		</table>
		<?php
	}
	else{
		?>
		<form action="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=tarif&section=confirmation';?>" method="post">
			<table style="width:100%;">
				<tr>
					<th colspan="3">GRILLE TARIFAIRE</th>
				</tr>
				<tr>
					<td><strong>REFERENCE</strong></td>
					<td><strong>DUREE</strong></td>
					<td><strong>FORMULE</strong></td>
				</tr>
				<tr>
					<td colspan="3"><hr /></td>
				</tr>
				<tr>
					<td><?php echo $abo_1_homme[0];?></td>
					<td><?php echo $abo_1_homme[1];?> mois</td>
					<td><input type="text" name="abo_1_homme" value="<?php echo $abo_1_homme[2];?>" /> €</td>
				</tr>	
				<tr>
					<td colspan="3"><hr /></td>
				</tr>
				<tr>
					<td><?php echo $abo_3_homme[0];?></td>
					<td><?php echo $abo_3_homme[1];?> mois</td>
					<td><input type="text" name="abo_3_homme" value="<?php echo $abo_3_homme[2];?>" /> €</td>
				</tr>
				<tr>
					<td colspan="3"><hr /></td>
				</tr>
				<tr>
					<td><?php echo $abo_6_homme[0];?></td>
					<td><?php echo $abo_6_homme[1];?> mois</td>
					<td><input type="text" name="abo_6_homme" value="<?php echo $abo_6_homme[2];?>" /> €</td>
				</tr>
				<tr>
					<td colspan="3"><hr /></td>
				</tr>
				<tr>
					<td><?php echo $abo_12_homme[0];?></td>
					<td><?php echo $abo_12_homme[1];?> mois</td>
					<td><input type="text" name="abo_12_homme" value="<?php echo $abo_12_homme[2];?>" /> €</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align:center;"><input type="submit" value="Modifier grille tarifaire" /></td>
			</table>
		</form>
		<?php
	}
	?>
</div>