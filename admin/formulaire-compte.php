<?php
/*
 * Created on 27 févr. 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 $info_membre = $membre->getTable(TABLE_INSCRIPTION,"id",$_GET['id_compte']);
 $identite = $membre->getTable(TABLE_IDENTITE,"identifiant",$_GET['id_compte']);
 $album = $membre->getTable(TABLE_ALBUM_PHOTO,"identifiant",$_GET['id_compte']);
 $monPays = $metier->getChamps('pays', TABLE_PAYS_FR, 'id', $identite->pays);
 
 //INFO PAIEMENT...
 $info_paiement = $metier->getComptePaiement($info_membre->pseudo);
 $date_cloture = strtotime($info_paiement[2]);
 if($info_paiement[3] == 1){
 	$paiement = '<span style="font-weight:bolder;color:green;">compte gratuit</span> ' .
 			'<a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=paiement&id_compte='.$_GET['id_compte'].'&action_paiement=0&ref=detail&pseudo='.$info_membre->pseudo.'" style="font-size:10px;font-style:italic;padding-left:10px;">[payant]</a>';
 }
 else{
 	if($info_paiement[4] == 1){
	 	$paiement = '<span style="font-weight:bolder;color:green;">membre ONLINE (téléphonie)</span>';
	 }
	 else{
	 	if($date_cloture > time()){
		 	$paiement = 'Abonnement jusqu\'au : <span style="font-weight:bolder;color:green;">'.$info_paiement[2].'</span>';
		 }
		 else{
		 	$paiement = '<span style="font-weight:bolder;color:red;">aucun paiement actuellement !</span> ' .
		 			'<a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=paiement&id_compte='.$_GET['id_compte'].'&action_paiement=1&ref=detail&pseudo='.$info_membre->pseudo.'" style="font-size:10px;font-style:italic;padding-left:10px;">[gratuit]</a>';
		 }
	 }
 }
 
if($info_membre->compte_actif == 0){
	$actif = '<span style="font-weight:bolder;color:green;">OK</span>';
}
else{
	$actif = '<span style="font-weight:bolder;color:red;">désactivé</span>';
}

if(($album->img1 != "" AND $album->controle == 1) OR ($album->img2 != "" AND $album->controle == 1) OR ($album->img3 != "" AND $album->controle == 1) OR ($album->img4 != "" AND $album->controle == 1)){
	$statut = '<span style="font-weight:bolder;color:green;">photo en ligne !</span>';
}
else{
	if(($album->img1 != "" AND $album->controle == 0) OR ($album->img2 != "" AND $album->controle == 0) OR ($album->img3 != "" AND $album->controle == 0) OR ($album->img4 != "" AND $album->controle == 0)){
		$statut = '<span style="font-weight:bolder;color:red;">photo en attente !</span>';
	}
	else{
		$statut = '<span style="font-weight:bolder;color:red;">pas de photo !</span>';
	}
}
//FICHIERS MULTIMEDIA
 $audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $info_membre->pseudo);
 if($audio_existant == ""){
 	$action_audio = 'sans AUDIO';
 }
 else{
 	$action_audio = '<a href=\'javascript:popUp("'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_PROFIL_FLV.'?f=2&pid='.$info_membre->id.'",260,260,"menubar=no,scrollbars=no,statusbar=no")\'>ECOUTER</a>';
 }
 $video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $info_membre->pseudo);
  if($video_existant == ""){
 	$action_video = 'sans VIDEO';
 }
 else{
 	$action_video = '<a href=\'javascript:popUp("'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_PROFIL_FLV.'?f=1&pid='.$info_membre->id.'",260,260,"menubar=no,scrollbars=no,statusbar=no")\'>REGARDER</a>';
 }
 //------- TYPE ANNONCE -----------
if($identite->type_echange){
	//PARTIE ECHANGE
	$type_echange = $metier->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange);
}
else{
	//SANS ANNONCE
	$type_echange = 'sans annonce';
}
//------------------------------------------------
 if($info_membre->type_annonce == TABLE_LISTING_ECHANGE_MAISON){
	$presentation = 'info_ech';
	$area = 'area_ech';
	$velo = 'Echange de vélo';
	$voiture = 'Echange de voiture';
	$velo_rechercher = 'Echange de vélo';
	$voiture_rechercher = 'Echange de voiture';
	//$compte = $metier->getOnlineMembre($_GET['id_compte']);
	$annonce = $membre->getTable(TABLE_LISTING_ECHANGE_MAISON, "identifiant", $_GET['id_compte']);
	$type_echange = 'Type d\échange';
	$titre_album = 'titre_album_ech';
	$titre_album_video = 'titre_album_ech_video';
	$titre_album_audio = 'titre_album_ech_audio';
	$genre = 'echange';
}
elseif($info_membre->type_annonce == TABLE_LISTING_COUCHSURFING){
	$presentation = 'info_couch';
	$area = 'area_couch';
	$velo = 'Prêt de vélo';
	$voiture = 'Prêt de voiture';
	$velo_rechercher = 'Prêt de vélo';
	$voiture_rechercher = 'Prêt de voiture';
	$annonce = $membre->getTable(TABLE_LISTING_COUCHSURFING, "identifiant", $_GET['id_compte']);
	$type_echange = 'Type couchsurfing';
	$titre_album = 'titre_album_couch';
	$titre_album_video = 'titre_album_couch_video';
	$titre_album_audio = 'titre_album_couch_audio';
	$genre = 'couchsurfing';
}
else{
	
}
 //MODIFICATION SUR DERNIERS INSCRITS
if($_GET['action'] == "modifier-derniers-inscrits"){
 	$action = '?action=confirmer-modification&type=derniers-inscrits';
 }
 else{
 	$action = '?action=confirmer-modification';
 }
?>

<table id="compte_client_controle">
	<tr>
		<td>
			<p style="text-align:center;">
				<a href="<?php echo HTTP_ADMIN.FILENAME_ADMIN_COMPTES;?>?action=modifier&id_compte=<?php echo $_GET['id_compte'];?>" title="Modifier ce compte">Modifier ce compte</a> 
				| <a href="<?php echo HTTP_ADMIN.FILENAME_ADMIN_COMPTES;?>?action=supprimer&id_compte=<?php echo $_GET['id_compte'];?>" title="Supprimer ce compte" style="color:red;font-weight:bolder;">Supprimer ce compte</a> 
				| <a href="<?php echo HTTP_ADMIN.FILENAME_MESSAGERIE;?>?action=detail&id_compte=<?php echo $_GET['id_compte'];?>&type=courrier" title="Contrôler sa messagerie COURRIER">Contrôler sa messagerie COURRIER [<?php echo $membre->compterTousLesMessages(TABLE_MESSAGERIE,$_GET['id_compte']); ?>]</a> 
				| <a href="<?php echo HTTP_ADMIN.FILENAME_MESSAGERIE;?>?action=detail&id_compte=<?php echo $_GET['id_compte'];?>&type=tchat" title="Contrôler sa messagerie TCHAT">Contrôler sa messagerie TCHAT [<?php echo $membre->compterTousLesMessages(TABLE_MESSENGER,$_GET['id_compte']); ?>]</a>  
			</p>
		</td>
	</tr>
	<tr>
		<td style="text-align:center;">
			<div id="wrapper">
				<div id="progress-bar">
					<div id="progress-level"></div>
				</div>
			</div>
			<p style="text-align:center;font-size:10px;font-style:italic;">Espace de stockage réservé(équivalent à 100 messages)</p>
		</td>
	</tr>
</table>
<form action="<?php echo HTTP_ADMIN.FILENAME_ADMIN_COMPTES.$action;?>" method="post" enctype="multipart/form-data">
	<table id="compte_client">
		<tr>
			<td>Référence :</td>
			<td class="donnees"><span style="font-weight:bolder;font-size:18px;"><?php echo $info_membre->id;?></span></td>
		</tr>
		<tr>
			<td>Pseudo :</td>
			<td class="donnees"><span style="font-weight:bolder;font-size:14px;color:#F5772A;"><?php echo strtoupper($info_membre->pseudo);?></span></td>
		</tr>
		<tr>
			<td>Mot de passe :</td>
			<td class="donnees"><?php echo $info_membre->passe;?></td>
		</tr>
		<tr>
			<td>Date inscription :</td>
			<td class="donnees"><?php echo date("d/m/Y", $info_membre->date_inscription);?></td>
		</tr>
		<tr>
			<td>Paiement :</td>
			<td class="donnees_paiement"><?php echo $paiement;?> <input type="hidden" name="id_compte" value="<?php echo $_GET['id_compte'];?>"/></td>
		</tr>
		<tr>
			<td>Email :</td>
			<td class="donnees"><input type="text" name="email" value="<?php echo $info_membre->email;?>"/></td>
		</tr>
		<tr>
			<td>Ip : </td>
			<td class="donnees"><?php echo $info_membre->ip;?></td>
		</tr>
		<tr>
			<td>Etat :</td>
			<td class="donnees"><?php echo iconeConnexion($metier->getChamps("identifiant", TABLE_ONLINE, "pseudo", $info_membre->pseudo));?></td>
		</tr>
		<?php
		if($info_membre->id_annonce){
			?>
			<tr>
				<td>Statut de la photo :</td>
				<td class="donnees">
					<select name="statut">
						<?php
						//ANNONCE PRESENTE
						if($album->controle == 1){
							echo '<option value="ok" selected>Photo publiée</option>' .
									'<option value="">Photo non publiée</option>';
						}
						else{
							echo '<option value="ok">Photo publiée</option>' .
									'<option value="" selected>Photo non publiée</option>';
						}
						?>
					</select>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td>Compte actif :</td>
			<td class="donnees">
				<select name="actif">
					<?php
					if($info_membre->compte_actif == 0){
						echo '<option value="ok" selected>Compte actif</option>' .
								'<option value="ko">Désactivé ce compte</option>';
					}
					else{
						echo '<option value="ok">Compte actif</option>' .
								'<option value="ko" selected>Désactivé ce compte</option>';
					}
					?>
				</select>
			</td>
		</tr>
	</table>
	<?php
	if($info_membre->id_annonce){
		//ANNONCE PRESENTE
		include(INCLUDE_ADMIN_ANNONCE_MODIFIER);
	}
	?>
	<p style="text-align:center;margin-top:7px;margin-bottom:7px;"><input type="submit" value="Modifier ce compte"/></p>
</form>