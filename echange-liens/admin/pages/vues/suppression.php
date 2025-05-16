<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>Administration - Supprimer un site</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<div id="header">
			<h1>Administration</h1>
			<div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div>
		</div>
		<?php echo $menu; ?>
		<div id="content">
			<?php echo $erreur; ?>
			<form action="" method="post">
				<span class="title">Supprimer un site</span><hr />
				<p>
					Entrez l'adresse à supprimer (copiez l'url complète, pas uniquement le nom de domaine) : <input type="text" name="url" /><br />
					<?php echo $form_mail; ?>
					<input type="submit" value="Supprimer" />
				</p>
			</form>
			<span class="title">Liste des sites</span><hr />
			<?php echo $pagination . $liste_sites; ?>
		</div>
		<?php echo $footer; ?>
	</body>
</html>