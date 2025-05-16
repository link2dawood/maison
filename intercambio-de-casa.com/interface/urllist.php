<?php
header("Content-Type: text/html");
include('../../interface/applications/commun/configuration.php');
//**************************************
//  CREATION DYNAMIQUE URLLIST
//**************************************

?>
<?php echo HTTP_SERVEUR; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_CGU; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PARTENAIRE; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_SITE; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_VOYAGE; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_CHATEAU; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_MANOIR; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_VILLA; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_MAISON; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_APPARTEMENT; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_CHAMBRE; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_RECEVOIR_A_DOMICILE; ?><br />
<?php echo HTTP_SERVEUR.FILENAME_PLAN_RECHERCHE_HEBERGEMENT; ?><br />
<?php
	//-------------------------------------------------------------------------------------------
	//                          Récupération du listing des pays
	//-------------------------------------------------------------------------------------------
	for ($i=1; $i<248; $i++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-1-<?php echo $i; ?>.php<br />
	<?php
	}
	for ($a=1; $a<248; $a++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-2-<?php echo $a; ?>.php<br />
	<?php
	}
	for ($b=1; $b<248; $b++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-3-<?php echo $b; ?>.php<br />
	<?php
	}
	for ($c=1; $c<248; $c++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-4-<?php echo $c; ?>.php<br />
	<?php
	}
	for ($d=1; $d<248; $d++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-5-<?php echo $d; ?>.php<br />
	<?php
	}
	for ($e=1; $e<248; $e++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-6-<?php echo $e; ?>.php<br />
	<?php
	}
	for ($f=1; $f<248; $f++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-7-<?php echo $f; ?>.php<br />
	<?php
	}
	for ($g=1; $g<248; $g++){
	?>
		<?php echo HTTP_SERVEUR; ?>petites-annonces-echange-maison-1-8-<?php echo $g; ?>.php<br />
	<?php
	}
	?>