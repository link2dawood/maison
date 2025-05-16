<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>ADMINISTRATION - Connexion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<div id="header">
			<h1>Administration - Connexion</h1>
			<div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div>
		</div>
		<div id="content">
			<?php echo $erreur; ?>
			<form action="" method="post">
				<p>
					Identification requise ! Merci d'entrer les identifiants demandés :<br />
					Login : <input type="text" name="login" /><br />
					Mot de passe : <input type="password" name="pass" /><br />
					<input type="submit" value="Connexion" />
				</p>
			</form>
		</div>
		<?php echo $footer; ?>
	</body>
</html>