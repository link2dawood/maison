<?php
/*
 * FORMULAIRE INSCRIPTION GRATUITE ACCUEIL
 */
?>
<div class="tab">
	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_INSCRIPTION_GRATUITE; ?>" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><?php echo FORMULAIRE_JE_SUIS; ?></td>
				<td>
					<?php
						//AFFICHER LES OPTIONS DE RECHERCHE
						$tab_options_1 = $metier->afficherOptions('je_suis', LANGUAGE, $_SESSION['form_inscpt_je_suis']);
						foreach($tab_options_1 as $cle_1){
							echo $cle_1;
						}
					?>
				</td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_JE_RECHERCHE; ?></td>
				<td>
					<?php
						//AFFICHER LES OPTIONS DE RECHERCHE
						$tab_options_2 = $metier->afficherOptions('je_cherche', LANGUAGE, $_SESSION['form_inscpt_je_recherche']);
						foreach($tab_options_2 as $cle_2){
							echo $cle_2;
						}
					?>
				</td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_MON_PSEUDO; ?></td>
				<td><input type="text" name="pseudo" class="input_text_pseudo" value="<?php echo $_SESSION['form_inscpt_pseudo']; ?>"/></td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_MOT_DE_PASSE; ?></td>
				<td><input type="password" name="mot_de_passe" class="input_text_passe"/></td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_CONFIRMATION; ?></td>
				<td><input type="password" name="mot_de_passe_confirmation" class="input_text_passe2"/></td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_REGION; ?></td>
				<td>
					<?php
						//AFFICHER LES OPTIONS DE PAYS
						$tab_pays = $metier->afficherPays('recherche_pays', LANGUAGE);
						foreach($tab_pays as $cle_pays){
							echo $cle_pays;
						}
					?>
				</td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_DEPARTEMENT; ?></td>
				<td><?php include(INCLUDE_DEPARTEMENT_ACCUEIL); ?></td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_DATE_NAISSANCE; ?></td>
				<td><input type="text" name="jour" class="input_text_jour" value="<?php 
																			//AFFICHER LE JOUR		
																			if(empty($_SESSION['form_inscpt_jour'])){
																				echo FORMULAIRE_DATE_JOUR;
																			}		
																			else{
																				echo $_SESSION['form_inscpt_jour'];
																			}		
																			 ?>"/> 
					<input type="text" name="mois" class="input_text_mois" value="<?php 
																			//AFFICHER LE MOIS		
																			if(empty($_SESSION['form_inscpt_mois'])){
																				echo FORMULAIRE_DATE_MOIS;
																			}		
																			else{
																				echo $_SESSION['form_inscpt_mois'];
																			}
																			 ?>"/> 
					<input type="text" name="annee" class="input_text_annee" value="<?php 
																			//AFFICHER ANNEE		
																			if(empty($_SESSION['form_inscpt_annee'])){
																				echo FORMULAIRE_DATE_ANNEE;
																			}		
																			else{
																				echo $_SESSION['form_inscpt_annee'];
																			}
																			 ?>"/></td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_EMAIL; ?></td>
				<td><input type="text" name="email" class="input_text_email" value="<?php echo $_SESSION['form_inscpt_email']; ?>"/></td>
			</tr>
			<tr>
				<td><?php echo FORMULAIRE_PHOTO; ?></td>
				<td><input type="file" name="photo" size="8" /></td>
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
				<td colspan="2" style="text-align:center;"><input type="image" src="./images/<?php echo FORMULAIRE_IMAGE_SUBMIT; ?>"/></td>
			</tr>
		</table>
	</form>
</div>