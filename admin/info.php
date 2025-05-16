<?php
/*
 * Created on 27 févr. 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div id="info_ad">
	Bonjour <span style="color:#EF7227;font-weight:bolder;"><?php echo $_SESSION['admin']; ?></span>, vous êtes connecté !
	<br />Votre dernière connexion : <span style="color:#EF7227;font-weight:bolder;"><?php echo date("d/m/Y H:i:s", $_SESSION['date_last_visite']); ?></span>
</div>