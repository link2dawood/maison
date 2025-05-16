<?php
	if(count($_GET) > 1)
	{
		echo $resultat;
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>ADMINISTRATION - Vérifier si les sites ont toujours le lien de retour</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script type="text/javascript" src="js/verifications.js"></script>
		<noscript><meta http-equiv="refresh" content="5;url=./" /></noscript>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<div id="header">
			<h1>Administration</h1>
			<div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div>
		</div>
		<?php echo $menu; ?>
		<div id="content">
			<noscript>
				<span class="title">JavaScript requis</span><hr />Vous devez accepter JavaScript pour pouvoir utiliser ce module ! Redirection dans 5 secondes (si rien ne se passe, <a href="./">cliquez ici</a>)<br /><br />
			</noscript>
			<span class="title">Analyse</span><hr />
			<p id="avertissement"><a href="#" onclick="javascript:lancement();return false;">Démarrer l'analyse</a></p>
			<p><?php echo $liste_sites; ?></p>
			<p id="current"></p>
			<span class="title">Sites à supprimer</span><hr /><form action="" method="post" onsubmit="javascript:return confirm('Etes-vous sûr de vouloir supprimer tous ces sites ?');"><p id="reponses">Aucun site pour le moment.</p></form>
		</div>
		<?php echo $footer; ?>
	</body>
</html>