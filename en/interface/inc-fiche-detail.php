<?php

?>						
<div id="formulaire_depot">
	<p id="partie1_formulaire_depot"><?php echo $partie1; ?></p>
	<table class="tab_general">
			<tr>
				<td class="col1">
					<table>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_13; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $annonce->date1; ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_25; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $annonce->date2; ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_26; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $identite->ville; ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_14; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $monPays; ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_15; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_SITUATION.LANGUAGE, 'id', $annonce->situation); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $type_echange; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_16; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_logement); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_27; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_NIVEAU.LANGUAGE, 'id', $annonce->niveau); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_17; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_CAPACITE_ACCUEIL.LANGUAGE, 'id', $annonce->capacite); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_28; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_CHAMBRE_ADULTE.LANGUAGE, 'id', $annonce->ch_adulte); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_18; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_CHAMBRE_ENFANT.LANGUAGE, 'id', $annonce->ch_enfant); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_29; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_CANAPE_LIT.LANGUAGE, 'id', $annonce->canape); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_19; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_SALLE_BAIN.LANGUAGE, 'id', $annonce->sdb); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_30; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_CUISINE.LANGUAGE, 'id', $annonce->cuisine); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_20; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_TERRASSE.LANGUAGE, 'id', $annonce->terrasse); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_31; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_BARBECUE.LANGUAGE, 'id', $annonce->barbecue); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_21; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_JARDIN.LANGUAGE, 'id', $annonce->jardin); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_32; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_PISCINE.LANGUAGE, 'id', $annonce->piscine); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo $velo; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_VELO.LANGUAGE, 'id', $annonce->velo); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_33; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_GARAGE.LANGUAGE, 'id', $annonce->garage); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_23; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_ANIMAUX.LANGUAGE, 'id', $annonce->animaux); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_ECHANGE_VOITURE.LANGUAGE, 'id', $annonce->voiture); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_24; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_HANDICAPE.LANGUAGE, 'id', $annonce->handicape); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_35; ?></p></td>
							<td id="fiche_data"><input type="text" value="<?php echo $metier->getChamps('element', TABLE_LOGEMENT_FUMEUR.LANGUAGE, 'id', $annonce->fumeur); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td colspan="2" id="<?php echo $area; ?>"><p><?php echo TEXTE_36; ?></p></td>
							<td colspan="2" id="<?php echo $area; ?>"><p><?php echo TEXTE_38; ?></p></td>
						</tr>
						<tr>
							<td colspan="2" id="area"><p><?php echo $annonce->commentaire1; ?></p></td>
							<td colspan="2" id="area"><p><?php echo $annonce->commentaire2; ?></p></td>
						</tr>
					</table>
				</td>
				<td class="col2">
					<div id="popup">
						<?php include(INCLUDE_MULTIMEDIA); ?>
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
							<td><input type="text" value="<?php echo $annonce->date3; ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_25; ?></p></td>
							<td><input type="text" value="<?php echo $annonce->date4; ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_41; ?></p></td>
							<td><input type="text" value="<?php echo $annonce->destination1; ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_42; ?></p></td>
							<td><input type="text" value="<?php echo $annonce->destination2; ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_43; ?></p></td>
							<td><input type="text" value="<?php echo $annonce->destination3; ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_44; ?></p></td>
							<td><input type="text" value="<?php echo $annonce->destination4; ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_45; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech1); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_46; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech2); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_47; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech3); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_48; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_TYPE_LOGEMENT.LANGUAGE, 'id', $annonce->type_rech4); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_17; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_CAPACITE_ACCUEIL.LANGUAGE, 'id', $annonce->capac_rech); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo TEXTE_35; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_LOGEMENT_FUMEUR.LANGUAGE, 'id', $annonce->fumeur_rech); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
						<tr>
							<td id="<?php echo $presentation; ?>"><p><?php echo $velo_rechercher; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_VELO.LANGUAGE, 'id', $annonce->velo_rech); ?>" style="width:110px;background-color:white;" readonly /></td>
							<td id="<?php echo $presentation; ?>"><p><?php echo $voiture_rechercher; ?></p></td>
							<td><input type="text" value="<?php echo $metier->getChamps('element', TABLE_ECHANGE_VOITURE.LANGUAGE, 'id', $annonce->voiture_rech); ?>" style="width:110px;background-color:white;" readonly /></td>
						</tr>
					</table>
				</td>
				<td class="col2">
					<div id="panel_control">
						<ul>
							<li class="top"><?php echo TEXTE_84; ?></li>
							<li class="contact_1">
								<!-- Contacter par COURRIER -->
								<table>
									<tr>
										<td class="top_1"><?php echo TEXTE_85; ?></td>
									<?php
									if($_SESSION['pseudo_client']){
										?>
										<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-video&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_VIDEO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
								 		<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-audio&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_AUDIO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
								 		<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_TEXTE; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<?php
									}
									else{
										?>
										<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_VIDEO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_AUDIO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_TEXTE; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<?php
									}
									?>
									</tr>
								</table>
							</li>
							<li class="contact_2">
								<!-- Contacter en direct tchat -->
								<table>
									<tr>
										<td class="top_1"><?php echo TEXTE_86; ?></td>
									<?php
							 		if(empty($_SESSION['pseudo_client'])){
							 		?>
							 			<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<?php
							 		}
							 		else{
							 			if($identifiant){
								 		?>
								 		<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_TEXTE; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_VIDEO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_AUDIO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
										<?php
								 		}
								 		else{
								 		?>
										<td class="ico_1"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
										<td class="ico_2"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
										<td class="ico_3"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
										<?php
								 		}
							 		}
							 		?>
							 		</tr>
								</table>
							</li>
							<li class="contact_3">
								<!-- Ajouter aux favoris -->
								<table style="margin-top:3px;width:100%;">
									<tr>
										<td class="top_1"><?php echo TEXTE_87; ?></td>
										<td>
											<?php
											if($_SESSION['pseudo_client']){
												$paiement = activerPaiement($_SESSION['pseudo_client']);
												if($paiement == 0){
										 			//AUTORISATION REFUSEE
										 			echo '<a href="'.HTTP_PAIEMENT.'">'.TEXTE_90.'</a>';
										 		}
										 		else{
										 			if($_SESSION['id_client'] == $inscription->id){
										 				echo TEXTE_90;
										 			}
										 			else{
										 				$deja_favori = $membre->getMisEnFavori($_SESSION['id_client'],$inscription->id);
											 			if($deja_favori > 0){
											 				echo TEXTE_91;
											 			}
											 			else{
											 				if($_GET['act'] == 1){
											 					$membre->ajouterFavori($_SESSION['id_client'],$inscription->id);
											 					echo TEXTE_91;
											 				}
											 				else{
											 					echo '<a href="'.HTTP_SERVEUR.'profil-'.$inscription->id.'-1.php">'.TEXTE_90.'</a>';
											 				}
											 			}
										 			}
										 		}
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_90; ?></a>
												<?php 
											}
											?>
										</td>
									</tr>
								</table>
							</li>
							<li class="contact_4">
								<!-- Lien vers blog de voyage -->
								<table style="margin-top:3px;border-top:1px solid #828183;width:100%;">
									<tr>
										<td class="top_1"><?php echo TEXTE_88; ?></td>
										<td>
											<?php
											if($_SESSION['pseudo_client']){
												$paiement = activerPaiement($_SESSION['pseudo_client']);
												if($_SESSION['id_client'] == $inscription->id){
										 			if($carnet->controle == "ok"){
										 				echo '<a href="'.HTTP_SERVEUR.'carnet-de-voyage-'.$inscription->id.'.php">'.TEXTE_89.'</a>';
										 			}
										 			else{
										 				echo TEXTE_89;
										 			}
										 		}
										 		elseif($paiement == 0){
										 			//AUTORISATION REFUSEE
										 			echo '<a href="'.HTTP_PAIEMENT.'">'.TEXTE_89.'</a>';
										 		}
										 		else{
										 			if($carnet->controle == "ok"){
										 				echo '<a href="'.HTTP_SERVEUR.'carnet-de-voyage-'.$inscription->id.'.php">'.TEXTE_89.'</a>';
										 			}
										 			else{
										 				echo TEXTE_89;
										 			}
										 		}
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_89; ?></a>
												<?php 
											}
											?>
										</td>
									</tr>
								</table>
							</li>
							<!-- SALON TCHAT -->
							<li style="font-size:10px;text-align:center;">
							<?php
								//Définir si membre présent salon de discussion...
								if($tchat->id){
									$libelle_tchat = LIBELLE_SALON_DISCUSSION_ONLINE.' '.$pays_salon;
								}
								else{
									$libelle_tchat = '<span style="color:grey;">'.LIBELLE_SALON_DISCUSSION_OFFLINE.'</span>';
								}
										
								if($_SESSION['pseudo_client']){
									$paiement = activerPaiement($_SESSION['pseudo_client']);
									if($paiement == 0){
										//AUTORISATION REFUSEE
										echo '<a href="'.HTTP_PAIEMENT.'">'.$libelle_tchat.'</a>';
									}
									else{
										if($_SESSION['id_client'] == $mysql->id){
								 			echo $libelle_tchat;
								 		}
								 		else{
								 			if($tchat->id){
												echo '<a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$tchat->id_pays.'">'.$libelle_tchat.'</a>';
											}
											else{
												echo $libelle_tchat;
											}
								 		}
								 	}
								}
								else{
									?>
									<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo $libelle_tchat; ?></a>
									<?php 
								}
							?>
							</li>
						</ul>
					</div>
				</td>
			</tr>
		</table>
</div>