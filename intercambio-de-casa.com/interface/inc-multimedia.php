<div class="album">
	<ul>
		<li id="<?php echo $titre_album; ?>"><p><?php echo TEXTE_49; ?></p></li>
		<li class="photo">
			<table>
				<tr>
					<td style="text-align:center;">
						<?php echo afficherMiniatureAlbumPhoto($inscription->id, libelleImage($inscription->pseudo,1), $img1, $inscription->en_ligne,"sans_1.jpg");	?>
						<p><?php echo afficherLienMiniature($inscription->id, $inscription->pseudo, 1,$img1, $inscription->en_ligne,"font-size:12px;"); ?></p>
					</td>
					<td style="text-align:center;">
						<?php echo afficherMiniatureAlbumPhoto($inscription->id, libelleImage($inscription->pseudo,2), $img2, $inscription->en_ligne,"sans_2.jpg");	?>
						<p><?php echo afficherLienMiniature($inscription->id, $inscription->pseudo, 2,$img2, $inscription->en_ligne,"font-size:12px;"); ?></p>
					</td>
					</tr>
					<tr>
						<td style="text-align:center;">
							<?php echo afficherMiniatureAlbumPhoto($inscription->id, libelleImage($inscription->pseudo,3), $img3, $inscription->en_ligne,"sans_3.jpg");	?>
							<p><?php echo afficherLienMiniature($inscription->id, $inscription->pseudo, 3,$img3, $inscription->en_ligne,"font-size:12px;"); ?></p>
						</td>
						<td style="text-align:center;">
							<?php echo afficherMiniatureAlbumPhoto($inscription->id, libelleImage($inscription->pseudo,4), $img4, $inscription->en_ligne,"sans_4.jpg");	?>
							<p><?php echo afficherLienMiniature($inscription->id, $inscription->pseudo, 4,$img4, $inscription->en_ligne,"font-size:12px;"); ?></p>
						</td>
					</tr>
				</table>
			</li>
			<li id="<?php echo $titre_album_video; ?>"><p><?php echo TEXTE_82; ?></p></li>
			<li class="video">
				<table>
					<tr>
						<td style="text-align:center;">
							<?php
							if($video_existant){
								//Regarder la vidéo
								if($inscription->en_ligne){
									echo '<p style="padding-top:25px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=9&action=rg&tpe='.$_GET['tpe'].'',700,270,TEXTE_72).'</p>';
								}
								else{
									echo '<p style="padding-top:25px;">'.TEXTE_81.'</p>';
								}
							}
							else{
								//Regarder la vidéo
								echo '<p style="padding-top:25px;">'.TEXTE_72.'</p>';
							}
							?>
						</td>
						<td><img src="<?php echo HTTP_IMAGE; ?>media-player.png" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
					</tr>
				</table>
			</li>
			<li id="<?php echo $titre_album_video; ?>"><p><?php echo TEXTE_83; ?></p></li>
			<li class="audio">
				<table>
					<tr>
						<td style="text-align:center;">
							<?php
							if($audio_existant){
								//Regarder la vidéo
								if($inscription->en_ligne){
									echo '<p style="padding-top:25px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=10&action=ec&tpe='.$_GET['tpe'].'',700,270,TEXTE_73).'</p>';
								}
								else{
									echo '<p style="padding-top:25px;">'.TEXTE_81.'</p>';
								}
							}
							else{
								//Regarder la vidéo
								echo '<p style="padding-top:25px;">'.TEXTE_73.'</p>';
							}
							?>
						</td>
						<td><img src="<?php echo HTTP_IMAGE; ?>loudspeaker.png" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
					</tr>
				</table>
			</li>
		</ul>
	</div>	