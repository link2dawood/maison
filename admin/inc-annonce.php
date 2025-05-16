<div id="compte_client_bis">
	<table class="tab_general">
			<tr>
				<td class="col1">
					<table>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Nom</p></td>
							<td id="fiche_data"><?php echo $identite->nom; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Prénom</p></td>
							<td id="fiche_data"><?php echo $identite->prenom; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Adresse</p></td>
							<td id="fiche_data"><?php echo $identite->adresse; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Code postal</p></td>
							<td id="fiche_data"><?php echo $identite->code_postal; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Période du:</p></td>
							<td id="fiche_data"><?php echo $annonce->date1; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Au</p></td>
							<td id="fiche_data"><?php echo $annonce->date2; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Ville</p></td>
							<td id="fiche_data"><?php echo $identite->ville; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Pays</p></td>
							<td id="fiche_data"><?php echo $monPays; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Situation</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_SITUATION.LANGUAGE, 'id', $annonce->situation); ?></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $type_echange; ?></p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Type de logement</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_logement); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Niveau</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_NIVEAU.LANGUAGE, 'id', $annonce->niveau); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Capacité d'accueil</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_CAPACITE_ACCUEIL.LANGUAGE, 'id', $annonce->capacite); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Chambre adulte</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_CHAMBRE_ADULTE.LANGUAGE, 'id', $annonce->ch_adulte); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Chambre enfant</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_CHAMBRE_ENFANT.LANGUAGE, 'id', $annonce->ch_enfant); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Canapé lit</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_CANAPE_LIT.LANGUAGE, 'id', $annonce->canape); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Salle de bains</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_SALLE_BAIN.LANGUAGE, 'id', $annonce->sdb); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Cuisine</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_CUISINE.LANGUAGE, 'id', $annonce->cuisine); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Terrasse</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_TERRASSE.LANGUAGE, 'id', $annonce->terrasse); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Barbecue</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_BARBECUE.LANGUAGE, 'id', $annonce->barbecue); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Jardin</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_JARDIN.LANGUAGE, 'id', $annonce->jardin); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Piscine</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_PISCINE.LANGUAGE, 'id', $annonce->piscine); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo $velo; ?></p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_VELO.LANGUAGE, 'id', $annonce->velo); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Garage</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_GARAGE.LANGUAGE, 'id', $annonce->garage); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Animaux</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_ANIMAUX.LANGUAGE, 'id', $annonce->animaux); ?></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture; ?></p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_ECHANGE_VOITURE.LANGUAGE, 'id', $annonce->voiture); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Handicape</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_HANDICAPE.LANGUAGE, 'id', $annonce->handicape); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Fumeur</p></td>
							<td id="fiche_data"><?php echo $metier->getChamps('element', TABLE_LOGEMENT_FUMEUR.LANGUAGE, 'id', $annonce->fumeur); ?></td>
						</tr>
						<tr>
							<td colspan="2" id="<?php echo $area; ?>"><p>Equipements du logement</p></td>
							<td colspan="2" id="<?php echo $area; ?>"><p>Commerces - transports - loisirs, etc...</p></td>
						</tr>
						<tr>
							<td colspan="2" id="area"><p><?php echo $annonce->commentaire1; ?></p></td>
							<td colspan="2" id="area"><p><?php echo $annonce->commentaire2; ?></p></td>
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
							<td style="width:175px;"><?php echo $annonce->date3; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Au</p></td>
							<td><?php echo $annonce->date4; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Destination n°1</p></td>
							<td style="width:175px;"><?php echo $annonce->destination1; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Destination n°2</p></td>
							<td><?php echo $annonce->destination2; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Destination n°3</p></td>
							<td style="width:175px;"><?php echo $annonce->destination3; ?></td>
							<td id="<?php echo $presentation; ?>"><p>Destination n°4</p></td>
							<td><?php echo $annonce->destination4; ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°1</p></td>
							<td style="width:175px;"><?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech1); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°2</p></td>
							<td><?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech2); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°3</p></td>
							<td style="width:175px;"><?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech3); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Type logement n°4</p></td>
							<td><?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech4); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p>Capacité d'accueil</p></td>
							<td style="width:175px;"><?php echo $metier->getChamps('element', TABLE_CAPACITE_ACCUEIL.LANGUAGE, 'id', $annonce->capac_rech); ?></td>
							<td id="<?php echo $presentation; ?>"><p>Logement fumeur</p></td>
							<td><?php echo $metier->getChamps('element', TABLE_LOGEMENT_FUMEUR.LANGUAGE, 'id', $annonce->fumeur_rech); ?></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo $velo_rechercher; ?></p></td>
							<td style="width:175px;"><?php echo $metier->getChamps('element', TABLE_VELO.LANGUAGE, 'id', $annonce->velo_rech); ?></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture_rechercher; ?></p></td>
							<td><?php echo $metier->getChamps('element', TABLE_ECHANGE_VOITURE.LANGUAGE, 'id', $annonce->voiture_rech); ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
</div>