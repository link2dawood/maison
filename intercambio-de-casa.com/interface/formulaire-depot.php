<?php
/*
 * FORMULAIRE INSCRIPTION GRATUITE ACCUEIL
 */
 if($_GET['tpe'] == "echange"){
	$texte = TEXTE_60;
	$partie1 = TEXTE_61;
	$presentation = 'info_ech';
	$area = 'area_ech';
	$velo = TEXTE_67;
	$voiture = TEXTE_68;
	$velo_rechercher = TEXTE_67;
	$voiture_rechercher = TEXTE_68;
	$identite = $membre->getTable(TABLE_IDENTITE, "identifiant", $_SESSION['id_client']);
	$compte = $metier->getOnlineMembre($_SESSION['id_client']);
	$annonce = $membre->getTable(TABLE_LISTING_ECHANGE_MAISON, "identifiant", $_SESSION['id_client']);
	$type_echange = TEXTE_92;
}
elseif($_GET['tpe'] == "couchsurfing"){
	$texte = TEXTE_11;
	$partie1 = TEXTE_12;
	$presentation = 'info_couch';
	$area = 'area_couch';
	$velo = TEXTE_22;
	$voiture = TEXTE_34;
	$velo_rechercher = TEXTE_22;
	$voiture_rechercher = TEXTE_34;
	$annonce = $membre->getTable(TABLE_LISTING_COUCHSURFING, "identifiant", $_SESSION['id_client']);
	$type_echange = TEXTE_93;
}
else{
	
}

$identite = $membre->getTable(TABLE_IDENTITE, "identifiant", $_SESSION['id_client']);

?>
<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
	<tr>
		<td id="ds_calclass"></td>
	</tr>
</table>
<?php include(INCLUDE_SCRIPT_CALENDRIER_JS); ?>							
<div id="formulaire_depot">
	<p id="text_formulaire_depot"><?php echo $texte; ?></p>
	<p id="partie1_formulaire_depot"><?php echo $partie1; ?></p>
	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_DEPOT_ANNONCE_1; ?>?tpe=<?php echo $_GET['tpe']; ?>&action=<?php echo $_GET['action']; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
		<table class="tab_general">
			<tr>
				<td class="col1">
					<table>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_55; ?></p></td>
							<td>
								<input type="text" name="requiredNom" value="<?php echo $identite->nom; ?>" style="width:110px;"/>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_56; ?></p></td>
							<td><input type="text" name="requiredPrenom" value="<?php echo $identite->prenom; ?>" style="width:110px;"/></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_57; ?></p></td>
							<td><input type="text" name="requiredAdresse" value="<?php echo $identite->adresse; ?>" style="width:110px;" /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_58; ?></p></td>
							<td><input type="text" name="requiredCodepostal" value="<?php echo $identite->code_postal; ?>" style="width:110px;"/></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_26; ?></p></td>
							<td><input type="text" name="requiredVille" value="<?php echo $identite->ville; ?>" style="width:110px;" /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_14; ?></p></td>
							<td>
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_13; ?></p></td>
							<td><input onclick="ds_sh(this);" value="<?php echo $annonce->date1; ?>" name="requiredDate1" readonly="readonly" style="cursor:text;width:110px;"/></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_25; ?></p></td>
							<td><input onclick="ds_sh(this);" value="<?php echo $annonce->date2; ?>" name="requiredDate2" readonly="readonly" style="cursor:text;width:110px;"/></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_15; ?></p></td>
							<td id="select_ie_1">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_situation = $metier->getListing('select_situation', LANGUAGE, $annonce->situation, TABLE_SITUATION);
								foreach($tab_situation as $situation){
									echo $situation;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $type_echange; ?></p></td>
							<td id="select_ie_2">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_echange = $metier->afficherEchange($_GET['tpe'],$identite->type_echange);
								foreach($tab_echange as $cle_echange){
									echo $cle_echange;
								}
							?>
							</td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_16; ?></p></td>
							<td id="select_ie_3">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type = $metier->getListing('select_type', LANGUAGE, $annonce->type_logement, TABLE_TYPE_LOGEMENT);
								foreach($tab_type as $type){
									echo $type;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_27; ?></p></td>
							<td id="select_ie_4">
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_17; ?></p></td>
							<td id="select_ie_5">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_capacite = $metier->getListing('select_capacite', LANGUAGE, $annonce->capacite, TABLE_CAPACITE_ACCUEIL);
								foreach($tab_capacite as $capacite){
									echo $capacite;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_28; ?></p></td>
							<td id="select_ie_6">
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_18; ?></p></td>
							<td id="select_ie_7">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_ch_enfant = $metier->getListing('select_ch_enfant', LANGUAGE, $annonce->ch_enfant, TABLE_CHAMBRE_ENFANT);
								foreach($tab_ch_enfant as $ch_enfant){
									echo $ch_enfant;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_29; ?></p></td>
							<td id="select_ie_8">
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_19; ?></p></td>
							<td id="select_ie_9">
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_sdb = $metier->getListing('select_sdb', LANGUAGE, $annonce->sdb, TABLE_SALLE_BAIN);
								foreach($tab_sdb as $sdb){
									echo $sdb;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_30; ?></p></td>
							<td id="select_ie_10">
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_20; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_terrasse = $metier->getListing('select_terrasse', LANGUAGE, $annonce->terrasse, TABLE_TERRASSE);
								foreach($tab_terrasse as $terrasse){
									echo $terrasse;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_31; ?></p></td>
							<td>
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_21; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_jardin = $metier->getListing('select_jardin', LANGUAGE, $annonce->jardin, TABLE_JARDIN);
								foreach($tab_jardin as $jardin){
									echo $jardin;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_32; ?></p></td>
							<td>
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
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_velo = $metier->getListing('select_velo', LANGUAGE, $annonce->velo, TABLE_VELO);
								foreach($tab_velo as $velo){
									echo $velo;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_33; ?></p></td>
							<td>
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_23; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_animaux = $metier->getListing('select_animaux', LANGUAGE, $annonce->animaux, TABLE_ANIMAUX);
								foreach($tab_animaux as $animaux){
									echo $animaux;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture; ?></p></td>
							<td>
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_24; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_handicape = $metier->getListing('select_handicape', LANGUAGE, $annonce->handicape, TABLE_HANDICAPE);
								foreach($tab_handicape as $handicape){
									echo $handicape;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_35; ?></p></td>
							<td>
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
							<td colspan="2" id="<?php echo $area; ?>"><p><?php echo TEXTE_36; ?></p></td>
							<td colspan="2" id="<?php echo $area; ?>"><p><?php echo TEXTE_38; ?></p></td>
						</tr>
						<tr>
							<td colspan="2" id="area">
								<textarea name="requiredCommentaire1">
									<?php
									if(empty($annonce->commentaire1)){
										echo TEXTE_37;
									}
									else{
										echo $annonce->commentaire1;
									}
									?>
								</textarea>
							</td>
							<td colspan="2" id="area">
								<textarea name="requiredCommentaire2">
									<?php
									if(empty($annonce->commentaire2)){
										echo TEXTE_39;
									}
									else{
										echo $annonce->commentaire2;
									}
									?>
								</textarea>
							</td>
						</tr>
					</table>
				</td>
				<td class="col2">
					<div style="display:block;">
						<iframe src ="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_IFRAME_MULTIMEDIA; ?>?action=<?php echo $_GET['action']; ?>&tpe=<?php echo $_GET['tpe']; ?>" width="206px" height="435px" id="iframe_multimedia" frameborder="0">
  						<p>Your browser does not support iframes.</p>
						</iframe>
					</div>
				</td>
			</tr>
		</table>
		<p id="partie1_formulaire_depot"><?php echo TEXTE_40; ?></p>
		<table id="tab_general_2">
			<tr>
				<td class="col1">
					<table>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_13; ?></p></td>
							<td><input onclick="ds_sh(this);" value="<?php echo $annonce->date3; ?>" name="requiredDate3" readonly="readonly" style="cursor:text;width:110px;"/></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_25; ?></p></td>
							<td><input onclick="ds_sh(this);" value="<?php echo $annonce->date4; ?>" name="requiredDate4" readonly="readonly" style="cursor:text;width:110px;"/></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_41; ?></p></td>
							<td><input type="text" name="requiredDestination1" value="<?php echo $annonce->destination1; ?>" style="width:110px;" /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_42; ?></p></td>
							<td><input type="text" name="destination2" value="<?php echo $annonce->destination2; ?>" style="width:110px;" /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_43; ?></p></td>
							<td><input type="text" name="destination3" value="<?php echo $annonce->destination3; ?>" style="width:110px;" /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_44; ?></p></td>
							<td><input type="text" name="destination4" value="<?php echo $annonce->destination4; ?>" style="width:110px;" /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_45; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type_1 = $metier->getListing('select_type_rech_1', LANGUAGE, $annonce->type_rech1, TABLE_TYPE_LOGEMENT);
								foreach($tab_type_1 as $type_1){
									echo $type_1;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_46; ?></p></td>
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_47; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_type_3 = $metier->getListing('select_type_rech_3', LANGUAGE, $annonce->type_rech3, TABLE_TYPE_LOGEMENT);
								foreach($tab_type_3 as $type_3){
									echo $type_3;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_48; ?></p></td>
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
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_17; ?></p></td>
							<td>
							<?php
								//AFFICHER LES OPTIONS DE PAYS
								$tab_capac_rech = $metier->getListing('select_capac_rech', LANGUAGE, $annonce->capac_rech, TABLE_CAPACITE_ACCUEIL);
								foreach($tab_capac_rech as $capac_rech){
									echo $capac_rech;
								}
								?>
							</td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_35; ?></p></td>
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
							<td>
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
				<td class="col2">
					<p style="text-align:center;">
						<?php
						if(empty($annonce->date1) AND $_GET['action'] == "md"){
							echo '<input type="submit" value="'.TEXTE_53.'" disabled/>';
						}
						else{
							echo '<input type="submit" value="'.TEXTE_53.'" />';
						}
						?>
					</p>
					<p class="explication"><?php echo TEXTE_54; ?></p>
				</td>
			</tr>
		</table>
	</form>
</div>