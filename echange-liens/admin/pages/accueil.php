<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>ADMINISTRATION - Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="header">
			<h1>Administration</h1>
			<div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div>
		</div>
		<?php echo $menu; ?>
		<div id="content">
			<span class="title">Bienvenue</span>
			<hr />
			Bienvenue dans votre espace d'administration. Vous pourrez gérer les partenaires, et effectuer d'autres opérations sur le script de <a href="http://www.paidpr.com">PaidPR.com</a>. Pour cela, il vous suffit de cliquer sur le lien de votre choix dans le menu ci-dessus.
			<br /><br />
<?php
	if(file_exists('../installation/'))
		echo '<em>Note : Le dossier <strong>installation</strong> est toujours présent sur le serveur. Vous pouvez le supprimer, il n\'est plus utile.</em>';
?>
		</div>
		<?php echo $footer; ?>
	</body>
</html>