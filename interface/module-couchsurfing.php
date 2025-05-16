<div id="module_echange_search">
	<form action="<?php echo HTTP_SERVEUR.FILENAME_ANNONCES_ECHANGE_MAISON; ?>" method="get">
		<table>
			<tr>
				<td>
					<table>
						<tr>
							<td>
							<?php
							//AFFICHER LES OPTIONS DE PAYS
							$tab_echange = $metier->afficherEchange('couchsurfing','');
							foreach($tab_echange as $cle_echange){
								echo str_replace(' name="couchsurfing" ',' name="type" ',$cle_echange);
							}
							?>
							</td>
						</tr>
						<tr>
							<td>
							<?php
							//AFFICHER LES OPTIONS DE PAYS
							$tab_pays = $metier->afficherPays('choix_pays', LANGUAGE);
							foreach($tab_pays as $cle_pays){
								echo $cle_pays;
							}
							?>
							</td>
						</tr>
					</table>
				</td>
				<td><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_RECHERCHER; ?>" class="bt_envoyer"/></td>
			</tr>
		</table>
	</form>
</div>