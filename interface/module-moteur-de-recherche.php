<div id="section_top">
	<table style="width:100%;">
		<tr>
			<td class="td_1">
				<!-- Moteur de recherche -->
				<form action="<?php echo HTTP_MOTEUR_MAISON.FILENAME_MOTEUR_MAISON; ?>" method="get">
					<table class="tab_1">
						<tr>
							<td class="tab_1_1"><span id="lib"><?php echo MODULE_RECHERCHE_LIBELLE; ?></span></td>
							<td class="tab_1_2"><input type="text" name="rechercher"/></td>
							<td class="tab_1_3"><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_OK; ?>" class="bt_envoyer"/></td>
							<td class="tab_1_4"><!-- AddThis Bookmark Button BEGIN --><script type="text/javascript">
										 addthis_url    = location.href;   
										 addthis_title  = document.title;  
										 addthis_pub    = 'kosmos';     
										</script>
							</td>
							<td class="tab_1_5"><script type="text/javascript" src="http://s7.addthis.com/js/addthis_widget.php?v=12" ></script><!-- AddThis Bookmark Button END --></td>
							<td class="tab_1_6"><a href="<?php echo HTTP_SERVEUR; ?>echange-maison.xml"><img src="<?php echo HTTP_IMAGE; ?>xml.gif" alt="<?php echo ATTRIBUT_ALT; ?>" style="margin-left:5px;"/></a></td>
						</tr>
					</table>
				</form>
			</td>
			<td class="td_2">
			<!-- Recommander ce site échange de maison et couch surfing -->
				<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CONSEILLER_SITE_AMI; ?>" method="post">
					<table class="tab_2">
						<tr>
							<td class="tab_2_1"><span id="lib"><?php echo LIBELLE_INPUT; ?></span></td>
							<td class="tab_2_2"><input type="text" name="email_form" value="........@........"/></td>
							<td class="tab_2_3"><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_OK; ?>" class="bt_envoyer"/></td>
						</tr>
					</table>
				</form>	
			</td>
		</tr>
	</table>
</div>