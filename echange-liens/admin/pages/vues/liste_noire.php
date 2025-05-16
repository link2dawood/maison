<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>ADMINISTRATION - Liste noire</title>
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
			<span class="title">Ajouter un site à la liste noire</span><hr />
			<form action="" method="post">
				<p>
					<input type="hidden" name="action" value="ajouter" />
					Entrez l'adresse à ajouter à la liste noire : <input type="text" name="url" /><br />
<?php
	if($config['envoi_de_mails'] == OUI)
		echo '<input type="checkbox" name="envoi_mail" checked="checked" id="check1" /> <label for="check1">Envoyer un mail au webmaster du site si l\'e-mail a été spécifié</label><br />';
?>
					<input type="submit" value="Ajouter à la liste noire" />
				</p>
			</form><br />
			<span class="title">Supprimer un site de la liste noire</span><hr />
			<form action="" method="post">
				<p>
					<input type="hidden" name="action" value="supprimer" />
					Entrez l'adresse à supprimer de la liste noire : <input type="text" name="url" /><br />
<?php
	if($config['envoi_de_mails'] == OUI)
		echo '<input type="checkbox" name="envoi_mail" checked="checked" id="check2" /> <label for="check2">Envoyer un mail au webmaster du site si l\'e-mail a été spécifié</label><br />';
?>
					<input type="submit" value="Supprimer de la liste noire" />
				</p>
			</form><br />
			<span class="title">Ajouter un site à la liste noire</span><hr />
			<p><?php echo $pagination_sites . $liste_sites; ?></p><br />
			<span class="title">Supprimer un site de la liste noire</span><hr />
			<p><?php echo $pagination_liste_noire . $liste_sites_liste_noire; ?></p>
		</div>
		<?php echo $footer; ?>
	</body>
</html>