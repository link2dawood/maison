<?php
	function identification()
	{
		if($_POST['login'] == $GLOBALS['config']['login'] AND $_POST['pass'] == $GLOBALS['config']['pass'])
		{
			header('Location: ./');
			$_SESSION['identification'] = true;
			exit();
		}
		
		return 'Mauvais identifiant ou mauvais mot de passe !';
	}
?>