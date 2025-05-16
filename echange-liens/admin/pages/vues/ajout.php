<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>ADMINISTRATION - Ajouter un site</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="header">
			<h1>Administration</h1>
			<div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div>
		</div>
		<?php echo $menu; ?>
		<form action="" method="post" id="content">
			<?php echo $erreur; ?>
			<span class="title">Ajouter un site</span><hr />
				Entrez l'url du site à référencer : <input type="text" name="url" maxlength="255" value="<?php if(isset($url)) echo htmlspecialchars($url); else echo 'http://'; ?>" /><br />
				Entrez le titre du site (50 caractères max) : <input type="text" name="titre" maxlength="50" value="<?php echo htmlspecialchars($titre); ?>" /><br />
				Entrez une courte description du site (100 caractères max) : <input type="text" name="description" maxlength="100" value="<?php echo htmlspecialchars($description); ?>" /><br />
				<?php echo $form; ?>
				<input type="submit" value="Ajouter" /><br />
				<?php echo $notes; ?>
				<br />Rappel : le code à placer sur le site est le suivant : <input type="text" readonly="readonly" value="<?php echo htmlspecialchars($code_retour); ?>" size="<?php echo strlen($code_retour); ?>" style="text-align:center;" />
		</form>
		<?php echo $footer; ?>
	</body>
</html>