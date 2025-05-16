<div class="album">
	<ul>
		<li id="<?php echo $titre_album; ?>"><p>Album PHOTOS</p></li>
		<li class="photo">
			<table>
				<tr>
					<td style="text-align:center;">
						<?php
						$rep = nommageRepertoire($info_membre->id);
						
						if($album->img1){
							 $img1 = HTTP_IMAGE_MINIATURE.$rep.libelleImage($info_membre->pseudo,1).'.'.$album->img1;
							 echo '<div id="img_container"><img src="'.$img1.'" alt="'.ATTRIBUT_ALT.'"/></div>';
						}
						else{
							echo '<div id="img_container"><img src="'.HTTP_IMAGE.'sans_1.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
						}
						?>
						<p>
							<?php
							if($album->img1){
								echo '<a href="'.HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($info_membre->id).libelleImage($info_membre->pseudo,1).'.'.$album->img1.'" rel="lightbox" style="font-size:10px;">+ zoom</a><br />';
								echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=5&action=sm&ad='.$info_membre->id.'',400,200,'<span style="font-size:10px;">[supprimer]</span>'); 
							}
							else{
								echo '[off]';
							}
							?>
						</p>
					</td>
					<td style="text-align:center;">
						<?php
						if($album->img2){
							 $img2 = HTTP_IMAGE_MINIATURE.$rep.libelleImage($info_membre->pseudo,2).'.'.$album->img2;
							 echo '<div id="img_container"><img src="'.$img2.'" alt="'.ATTRIBUT_ALT.'"/></div>';
						}
						else{
							echo '<div id="img_container"><img src="'.HTTP_IMAGE.'sans_2.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
						}
						?>
						<p>
							<?php
							if($album->img2){
								echo '<a href="'.HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($info_membre->id).libelleImage($info_membre->pseudo,2).'.'.$album->img2.'" rel="lightbox" style="font-size:10px;">+ zoom</a><br />';
								echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=6&action=sm&ad='.$info_membre->id.'',400,200,'<span style="font-size:10px;">[supprimer]</span>'); 
							}
							else{
								echo '[off]';
							}
							?>
						</p>
					</td>
					</tr>
					<tr>
						<td style="text-align:center;">
							<?php
							if($album->img3){
								 $img3 = HTTP_IMAGE_MINIATURE.$rep.libelleImage($info_membre->pseudo,3).'.'.$album->img3;
								 echo '<div id="img_container"><img src="'.$img3.'" alt="'.ATTRIBUT_ALT.'"/></div>';
							}
							else{
								echo '<div id="img_container"><img src="'.HTTP_IMAGE.'sans_3.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
							}
							?>
							<p>
							<?php
							if($album->img3){
								echo '<a href="'.HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($info_membre->id).libelleImage($info_membre->pseudo,3).'.'.$album->img3.'" rel="lightbox" style="font-size:10px;">+ zoom</a><br />';
								echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=7&action=sm&ad='.$info_membre->id.'',400,200,'<span style="font-size:10px;">[supprimer]</span>'); 
							}
							else{
								echo '[off]';
							}
							?>
						</p>
						</td>
						<td style="text-align:center;">
							<?php
							if($album->img4){
								 $img4 = HTTP_IMAGE_MINIATURE.$rep.libelleImage($info_membre->pseudo,4).'.'.$album->img4;
								 echo '<div id="img_container"><img src="'.$img4.'" alt="'.ATTRIBUT_ALT.'"/></div>';
							}
							else{
								echo '<div id="img_container"><img src="'.HTTP_IMAGE.'sans_4.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
							}
							?>
							<p>
							<?php
							if($album->img4){
								echo '<a href="'.HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($info_membre->id).libelleImage($info_membre->pseudo,4).'.'.$album->img4.'" rel="lightbox" style="font-size:10px;">+ zoom</a><br />';
								echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=8&action=sm&ad='.$info_membre->id.'',400,200,'<span style="font-size:10px;">[supprimer]</span>'); 
							}
							else{
								echo '[off]';
							}
							?>
						</p>
						</td>
					</tr>
				</table>
			</li>
			<li id="<?php echo $titre_album_video; ?>"><p>Annonce VIDEO</p></li>
			<li class="video">
				<table>
					<tr>
						<td style="text-align:center;">
							<?php
							if($video_existant){
								//Regarder la vidéo
								echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=9&action=rg&tpe='.$genre.'&ad='.$info_membre->id.'',700,270,'<span style="font-size:10px;">Regarder</span>').'</p>';
								//Supprimer la vidéo
								echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=9&action=sm&tpe='.$genre.'&ad='.$info_membre->id.'',400,200,'<span style="font-size:10px;">[supprimer]</span>').'</p>';
							}
							else{
								echo '[off]';
							}
							?>
						</td>
						<td><img src="<?php echo HTTP_IMAGE; ?>media-player.png" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
					</tr>
				</table>
			</li>
			<li id="<?php echo $titre_album_video; ?>"><p>Annonce AUDIO</p></li>
			<li class="audio">
				<table>
					<tr>
						<td style="text-align:center;">
							<?php
							if($audio_existant){
								//Regarder la vidéo
								echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=10&action=ec&tpe='.$genre.'&ad='.$info_membre->id.'',700,270,'<span style="font-size:10px;">Ecouter</span>').'</p>';
								//Supprimer la vidéo
								echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=10&action=sm&tpe='.$genre.'&ad='.$info_membre->id.'',400,200,'<span style="font-size:10px;">[supprimer]</span>').'</p>';
							}
							else{
								echo '[off]';
							}
							?>
						</td>
						<td><img src="<?php echo HTTP_IMAGE; ?>loudspeaker.png" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
					</tr>
				</table>
			</li>
		</ul>
	</div>	