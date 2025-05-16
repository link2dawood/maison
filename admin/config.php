<?php
//RECUPERER LA CONFIGURATION
$config = $membre->getConfiguration();

?>
<form action="<?php echo HTTP_ADMIN.FILENAME_ADMIN_CONFIGURATION;?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
<table id="compte_client">
	<tr>
		<td colspan="2" style="font-weight:bolder;font-size:14; color:red;"><img src="<?php echo HTTP_IMAGE; ?>warning.gif" alt="warning" /> 
			ATTENTION... assurez-vous d'être abilité à modifier la configuration du site car ces effets sont immédiat et irréversible !!<br />
			RESPECTER SCRUPULEUSEMENT LA SYNTHAXE DES CHAMPS CI-DESSOUS !!
		</td>
	</tr>
	<tr>
		<td>Racine physique des fichiers :</td>
		<td class="donnees_config"><input type="hidden" name="controle" value="ok" /> <input type="text" name="requiredRacineFichier" value="<?php echo $config[0];?>" /> (<em>pas de fin /</em>)</td>
	</tr>
	<tr>
		<td>Racine du site (protocole HTTP) :</td>
		<td class="donnees_config"><input type="text" name="requiredRacineSite" value="<?php echo $config[1];?>" /> (<em>pas de fin /</em>)</td>
	</tr>
	<tr>
		<td>Accès de la base de données :</td>
		<td class="donnees_config"><input type="text" name="requiredAccesBDD" value="<?php echo $config[2];?>" /></td>
	</tr>
	<tr>
		<td>Login de la base de données :</td>
		<td class="donnees_config"><input type="text" name="requiredLoginBDD" value="<?php echo $config[3];?>" /></td>
	</tr>
	<tr>
		<td>Mot de passe de la base de données :</td>
		<td class="donnees_config"><input type="text" name="requiredPasseBDD" value="<?php echo $config[4];?>" /></td>
	</tr>
	<tr>
		<td>Nom de la base de données :</td>
		<td class="donnees_config"><input type="text" name="requiredNomBDD" value="<?php echo $config[5];?>" /></td>
	</tr>
	<tr>
		<td>Nom de la base de données (PAIEMENT):</td>
		<td class="donnees_config"><input type="text" name="requiredNomBDDPaiement" value="<?php echo $config[6];?>" /></td>
	</tr>
	<tr>
		<td>Racine du site version FRANCE (protocole HTTP) :</td>
		<td class="donnees_config"><input type="text" name="requiredRacineSiteFR" value="<?php echo $config[7];?>" /> (<em>avec /</em>)</td>
	</tr>
	<tr>
		<td>Racine du site ANGLAIS (protocole HTTP) :</td>
		<td class="donnees_config"><input type="text" name="requiredRacineSiteEN" value="<?php echo $config[8];?>" /> (<em>avec /</em>)</td>
	</tr>
	<tr>
		<td>Racine du site ALLEMAND (protocole HTTP) :</td>
		<td class="donnees_config"><input type="text" name="requiredRacineSiteDE" value="<?php echo $config[9];?>" /> (<em>avec /</em>)</td>
	</tr>
	<tr>
		<td>Charset :</td>
		<td class="donnees_config"><input type="text" name="requiredCharset" value="<?php echo $config[10];?>" /></td>
	</tr>
	<tr>
		<td>Type content :</td>
		<td class="donnees_config"><input type="text" name="requiredTypeContent" value="<?php echo $config[11];?>" /></td>
	</tr>
	<tr>
		<td>Accès FLASH MEDIA SERVEUR (protocole RTMP) :</td>
		<td class="donnees_config"><input type="text" name="requiredAccesFlash" value="<?php echo $config[12];?>" /> (<em>avec /</em>)</td>
	</tr>
	<tr>
		<td>Nombre d'annonces par page :</td>
		<td class="donnees_config"><input type="text" name="requiredNombreAnnonce" value="<?php echo $config[13];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Nombre de colonnes/listing :</td>
		<td class="donnees_config"><input type="text" name="requiredNombreColonne" value="<?php echo $config[14];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Extrait du contenu (début) :</td>
		<td class="donnees_config"><input type="text" name="requiredExtraitContenuDebut" value="<?php echo $config[15];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Extrait du contenu (fin) :</td>
		<td class="donnees_config"><input type="text" name="requiredExtraitContenuFin" value="<?php echo $config[16];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Durée d'une connexion:</td>
		<td class="donnees_config"><input type="text" name="requiredDureeConnexion" value="<?php echo $config[17];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Limite avant suppression de la connexion :</td>
		<td class="donnees_config"><input type="text" name="requiredLimiteConnexion" value="<?php echo $config[18];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Période raffraichissement d'une page :</td>
		<td class="donnees_config"><input type="text" name="requiredPeriodeRaffrPage" value="<?php echo $config[19];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Limite de la majorité :</td>
		<td class="donnees_config"><input type="text" name="requiredLimiteMajorite" value="<?php echo $config[20];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Période raffraichissement du MESSENGER :</td>
		<td class="donnees_config"><input type="text" name="requiredPeriodeRaffrMessenger" value="<?php echo $config[21];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Temps affichage du message dans espace INFORMATIONS EN DIRECT :</td>
		<td class="donnees_config"><input type="text" name="requiredTempsAffichageInfo" value="<?php echo $config[22];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Temps affichage message erreur traitement MESSENGER :</td>
		<td class="donnees_config"><input type="text" name="requiredTempsAffichageMessenger" value="<?php echo $config[23];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Nombre de messages par page :</td>
		<td class="donnees_config"><input type="text" name="requiredMessagesParPage" value="<?php echo $config[24];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Nombre de caractères acceptés dans une description (extrait) :</td>
		<td class="donnees_config"><input type="text" name="requiredNombreCaracteresExtrait" value="<?php echo $config[25];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Nombre de membres blacklister par page :</td>
		<td class="donnees_config"><input type="text" name="requiredNombreBacklisterParPage" value="<?php echo $config[26];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Nombre de messages affichés durant la conversation MP :</td>
		<td class="donnees_config"><input type="text" name="requiredNombreMessagesConversationDuo" value="<?php echo $config[27];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Rafraichissement toutes les X secondes MP :</td>
		<td class="donnees_config"><input type="text" name="requiredRaffrTempsDuo" value="<?php echo $config[28];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Largeur de la fenêtre message MP :</td>
		<td class="donnees_config"><input type="text" name="requiredLargeurDuo" value="<?php echo $config[29];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Hauteur de la fenêtre message MP :</td>
		<td class="donnees_config"><input type="text" name="requiredHauteurDuo" value="<?php echo $config[30];?>" /> (<em>uniquement chiffre</em>)</td>
	</tr>
	<tr>
		<td>Durée gratuite pour tout nouveau client :</td>
		<td class="donnees_config"><input type="text" name="requiredGratuitNouveauClient" value="<?php echo $config[31];?>" /> (<em>en secondes</em>)</td>
	</tr>
	<tr>
		<td>Mail de correspondance :</td>
		<td class="donnees_config"><input type="text" name="requiredMailCorrespondance" value="<?php echo $config[32];?>" /></td>
	</tr>
	<tr>
		<td>Mail paiement PAYPAL :</td>
		<td class="donnees_config"><input type="text" name="requiredMailPaypal" value="<?php echo $config[33];?>" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:center;"><input type="submit" /></td>
	</tr>
</table>
</form>