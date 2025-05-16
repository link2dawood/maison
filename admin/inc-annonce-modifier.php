<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
	<tr>
		<td id="ds_calclass"></td>
	</tr>
</table>
<?php include(INCLUDE_SCRIPT_CALENDRIER_JS); ?>
<div id="compte_client_bis">
	<table class="tab_general">
			<tr>
				<td class="col1">
					<table>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Nom</p></td>
							<td id="fiche_data"><input type="text" name="requiredNom" value="<?php echo $identite->nom; ?>"/></td>
							<td id="<?php echo $presentation; ?>"><p>Prénom</p></td>
							<td id="fiche_data"><input type="text" name="requiredPrenom" value="<?php echo $identite->prenom; ?>"/></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Adresse</p></td>
							<td id="fiche_data"><input type="text" name="requiredAdresse" value="<?php echo $identite->adresse; ?>" /></td>
							<td id="<?php echo $presentation; ?>"><p>Code postal</p></td>
							<td id="fiche_data"><input type="text" name="requiredCodepostal" value="<?php echo $identite->code_postal; ?>"/></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Période du:</p></td>
							<td id="fiche_data"><input onclick="ds_sh(this);" value="<?php echo $annonce->date1; ?>" name="requiredDate1" readonly="readonly" style="cursor:text;" /></td>
							<td id="<?php echo $presentation; ?>"><p>Au</p></td>
							<td id="fiche_data"><input onclick="ds_sh(this);" value="<?php echo $annonce->date2; ?>" name="requiredDate2" readonly="readonly" style="cursor:text;" /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Ville</p></td>
							<td id="fiche_data"><input type="text" name="requiredVille" value="<?php echo $identite->ville; ?>" /></td>
							<td id="<?php echo $presentation; ?>"><p>Pays</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_pays = $metier->getPays('select_pays', LANGUAGE, $identite->pays);
								foreach($tab_pays as $cle_pays){
									echo $cle_pays;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Situation</p></td>
							<td id="fiche_data">
								<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_situation = $metier->getListing('select_situation', LANGUAGE, $annonce->situation, TABLE_SITUATION);
								foreach($tab_situation as $situation){
									echo $situation;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $type_echange; ?></p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_echange = $metier->afficherEchange($genre,$identite->type_echange);
								foreach($tab_echange as $cle_echange){
									echo $cle_echange;
								}
							?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Type de logement</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type = $metier->getListing('select_type', LANGUAGE, $annonce->type_logement, TABLE_TYPE_LOGEMENT);
								foreach($tab_type as $type){
									echo $type;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Niveau</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_niveau = $metier->getListing('select_niveau', LANGUAGE, $annonce->niveau, TABLE_NIVEAU);
								foreach($tab_niveau as $niveau){
									echo $niveau;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Capacité d'accueil</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_capacite = $metier->getListing('select_capacite', LANGUAGE, $annonce->capacite, TABLE_CAPACITE_ACCUEIL);
								foreach($tab_capacite as $capacite){
									echo $capacite;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Chambre adulte</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_ch_adulte = $metier->getListing('select_ch_adulte', LANGUAGE, $annonce->ch_adulte, TABLE_CHAMBRE_ADULTE);
								foreach($tab_ch_adulte as $ch_adulte){
									echo $ch_adulte;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Chambre enfant</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_ch_enfant = $metier->getListing('select_ch_enfant', LANGUAGE, $annonce->ch_enfant, TABLE_CHAMBRE_ENFANT);
								foreach($tab_ch_enfant as $ch_enfant){
									echo $ch_enfant;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Canapé lit</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_canape = $metier->getListing('select_canape', LANGUAGE, $annonce->canape, TABLE_CANAPE_LIT);
								foreach($tab_canape as $canape){
									echo $canape;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Salle de bains</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_sdb = $metier->getListing('select_sdb', LANGUAGE, $annonce->sdb, TABLE_SALLE_BAIN);
								foreach($tab_sdb as $sdb){
									echo $sdb;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Cuisine</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_cuisine = $metier->getListing('select_cuisine', LANGUAGE, $annonce->cuisine, TABLE_CUISINE);
								foreach($tab_cuisine as $cuisine){
									echo $cuisine;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Terrasse</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_terrasse = $metier->getListing('select_terrasse', LANGUAGE, $annonce->terrasse, TABLE_TERRASSE);
								foreach($tab_terrasse as $terrasse){
									echo $terrasse;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Barbecue</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_barbecue = $metier->getListing('select_barbecue', LANGUAGE, $annonce->barbecue, TABLE_BARBECUE);
								foreach($tab_barbecue as $barbecue){
									echo $barbecue;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Jardin</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_jardin = $metier->getListing('select_jardin', LANGUAGE, $annonce->jardin, TABLE_JARDIN);
								foreach($tab_jardin as $jardin){
									echo $jardin;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Piscine</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_piscine = $metier->getListing('select_piscine', LANGUAGE, $annonce->piscine, TABLE_PISCINE);
								foreach($tab_piscine as $piscine){
									echo $piscine;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo $velo; ?></p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_velo = $metier->getListing('select_velo', LANGUAGE, $annonce->velo, TABLE_VELO);
								foreach($tab_velo as $velo){
									echo $velo;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Garage</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_garage = $metier->getListing('select_garage', LANGUAGE, $annonce->garage, TABLE_GARAGE);
								foreach($tab_garage as $garage){
									echo $garage;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Animaux</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_animaux = $metier->getListing('select_animaux', LANGUAGE, $annonce->animaux, TABLE_ANIMAUX);
								foreach($tab_animaux as $animaux){
									echo $animaux;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture; ?></p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_voiture = $metier->getListing('select_voiture', LANGUAGE, $annonce->voiture, TABLE_ECHANGE_VOITURE);
								foreach($tab_voiture as $voiture){
									echo $voiture;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Handicape</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_handicape = $metier->getListing('select_handicape', LANGUAGE, $annonce->handicape, TABLE_HANDICAPE);
								foreach($tab_handicape as $handicape){
									echo $handicape;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Fumeur</p></td>
							<td id="fiche_data">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_fumeur = $metier->getListing('select_fumeur', LANGUAGE, $annonce->fumeur, TABLE_LOGEMENT_FUMEUR);
								foreach($tab_fumeur as $fumeur){
									echo $fumeur;
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2" id="<?php echo $area; ?>"><p>Equipements du logement</p></td>
							<td colspan="2" id="<?php echo $area; ?>"><p>Commerces - transports - loisirs, etc...</p></td>
						</tr>
						<tr>
							<td colspan="2" id="area"><textarea name="requiredCommentaire1" rows="10" cols="45"><?php echo str_replace("<br />","",$annonce->commentaire1); ?></textarea></td>
							<td colspan="2" id="area"><textarea name="requiredCommentaire2" rows="10" cols="45"><?php echo str_replace("<br />","",$annonce->commentaire2); ?></textarea></td>
						</tr>
					</table>
				</td>
				<td class="col2">
					<div id="popup">
						<?php include(INCLUDE_ADMIN_MEDIA); ?>
					</div>
				</td>
			</tr>
		</table>
		<table id="tab_general_2">
			<tr>
				<td class="col1">
					<table>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Période du:</p></td>
							<td style="width:175px;"><input onclick="ds_sh(this);" value="<?php echo $annonce->date3; ?>" name="requiredDate3" readonly="readonly" style="cursor:text;" /></td>
							<td id="<?php echo $presentation; ?>"><p>Au</p></td>
							<td><input onclick="ds_sh(this);" value="<?php echo $annonce->date4; ?>" name="requiredDate4" readonly="readonly" style="cursor:text;" /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Destination n°1</p></td>
							<td style="width:175px;"><input type="text" name="requiredDestination1" value="<?php echo $annonce->destination1; ?>" /></td>
							<td id="<?php echo $presentation; ?>"><p>Destination n°2</p></td>
							<td><input type="text" name="requiredDestination2" value="<?php echo $annonce->destination2; ?>" /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Destination n°3</p></td>
							<td style="width:175px;"><input type="text" name="requiredDestination3" value="<?php echo $annonce->destination3; ?>" /></td>
							<td id="<?php echo $presentation; ?>"><p>Destination n°4</p></td>
							<td><input type="text" name="requiredDestination4" value="<?php echo $annonce->destination4; ?>" /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°1</p></td>
							<td style="width:175px;">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type_1 = $metier->getListing('select_type_rech_1', LANGUAGE, $annonce->type_rech1, TABLE_TYPE_LOGEMENT);
								foreach($tab_type_1 as $type_1){
									echo $type_1;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°2</p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type_2 = $metier->getListing('select_type_rech_2', LANGUAGE, $annonce->type_rech2, TABLE_TYPE_LOGEMENT);
								foreach($tab_type_2 as $type_2){
									echo $type_2;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°3</p></td>
							<td style="width:175px;">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type_3 = $metier->getListing('select_type_rech_3', LANGUAGE, $annonce->type_rech3, TABLE_TYPE_LOGEMENT);
								foreach($tab_type_3 as $type_3){
									echo $type_3;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°4</p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type_4 = $metier->getListing('select_type_rech_4', LANGUAGE, $annonce->type_rech4, TABLE_TYPE_LOGEMENT);
								foreach($tab_type_4 as $type_4){
									echo $type_4;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Capacité d'accueil</p></td>
							<td style="width:175px;">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_capac_rech = $metier->getListing('select_capac_rech', LANGUAGE, $annonce->capac_rech, TABLE_CAPACITE_ACCUEIL);
								foreach($tab_capac_rech as $capac_rech){
									echo $capac_rech;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p>Logement fumeur</p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_fumeur_rech = $metier->getListing('select_fumeur_rech', LANGUAGE, $annonce->fumeur_rech, TABLE_LOGEMENT_FUMEUR);
								foreach($tab_fumeur_rech as $fumeur_rech){
									echo $fumeur_rech;
								}
								?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo $velo_rechercher; ?></p></td>
							<td style="width:175px;">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_velo_rech = $metier->getListing('select_velo_rech', LANGUAGE, $annonce->velo_rech, TABLE_VELO);
								foreach($tab_velo_rech as $velo_rech){
									echo $velo_rech;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture_rechercher; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_voiture_rech = $metier->getListing('select_voiture_rech', LANGUAGE, $annonce->voiture_rech, TABLE_ECHANGE_VOITURE);
								foreach($tab_voiture_rech as $voiture_rech){
									echo $voiture_rech;
								}
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
</div>