<?php
include('../../interface/applications/commun/configuration.php');
include('../../interface/applications/language/'.LANGUAGE.'/connexion.php');

echo '<div id="departement" style="display:inline;"><select name="departement"><option value="x">'.PAYS_DEPARTEMENTS_TOP.'</option>';

	if(!empty($_POST["id"])){
		
		if($_POST["id"] == 5 AND LANGUAGE == "fr"){
			$table = TABLE_DEPARTEMENT_FR;
			$controle = 1;
		}
		elseif($_POST["id"] == 5 AND LANGUAGE == "en"){
			$table = TABLE_DEPARTEMENT_EN;
			$controle = 1;
		}
		elseif($_POST["id"] == 5 AND LANGUAGE == "de"){
			$table = TABLE_DEPARTEMENT_DE;
			$controle = 1;
		}
		else{
			$table = "";
			$controle = 0;
		}
		
		if($controle == 1){
			mysql_connect(BDD_SERVEUR,BDD_IDENTIFIANT,BDD_MOT_PASSE);
			mysql_select_db(BDD_BASE_DE_DONNEES);
			$res = mysql_query("SELECT `numdept`, `nomdept` FROM $table ORDER BY `nomdept`");
			while($row = mysql_fetch_object($res)){
				echo '<option value="'.$row->numdept.'">'.utf8_encode($row->nomdept).'</option>';
			}
		}
		else{
			echo '<option value="0" disabled>----------</option>';
		}
	}
	else{
		echo '<option value="0" disabled>----------</option>';
	}
echo '</select></div>';
?>
