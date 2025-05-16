<?php

echo '<p style="text-align:right;margin-top:10px;margin-bottom:10px;"><a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=condition" title="Modifier les conditions de gratuité">Modifier les conditions de gratuité</a></p>';
echo '<p style="text-align:left;margin-top:10px;margin-bottom:10px;">' .
		'<a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=condition&section=off" title="pas de conditions">Pas de conditions</a>' .
		' ::: <a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=ajouter&type=condition" title="ajouter une condition">+ Ajouter une condition</a>' .
		'</p>';

?>
<div id="tab_listing_compte">
	<?php
	if($_GET['action'] == "consulter"){
		?>
		<table style="width:100%;">
			<tr>
				<th><strong>REFERENCE</strong></th>
				<th><strong>TYPE</strong></th>
			</tr>
			<?php
			$array = $membre->getAllTableCondition($_GET['action']);
			foreach($array as $cle){
				echo $cle;
			}
			?>
		</table>
		<?php
	}
	elseif($_GET['action'] == "ajouter"){
		?>
		<form action="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES.'?action=ajouter&type=condition&section=confirmation';?>" method="post">
			<table style="width:100%;">
				<tr>
					<th><strong>TYPE</strong></th>
				</tr>
				<?php
					echo '<tr>' .
						'<td>';
					//AFFICHER LES OPTIONS DE RECHERCHE
					$tab_options_1 = $metier->afficherEchange('except', "fr", "");
					foreach($tab_options_1 as $cle_1){
						echo $cle_1;
					}
					echo	'</td>';
					
					echo   '</tr>';
				?>
				<tr>
					<td colspan="2" style="text-align:center;padding-top:10px;padding-bottom:10px;"><input type="submit" value="Ajouter cette condition" /></td>
				</tr>
			</table>
		</form>
		<?php
	}
	else{
		?>
		<form action="<?php echo HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=condition&section=confirmation';?>" method="post">
			<table style="width:100%;">
				<tr>
					<th><strong>REFERENCE</strong></th>
					<th><strong>TYPE</strong></th>
				</tr>
				<?php
				$array = $membre->getAllTableCondition($_GET['action']);
				foreach($array as $cle){
					echo $cle;
				}
				?>
				<tr>
					<td colspan="3" style="text-align:center;padding-top:10px;padding-bottom:10px;"><input type="submit" value="Modifier les conditions" /></td>
				</tr>
			</table>
		</form>
		<?php
	}
	?>
</div>