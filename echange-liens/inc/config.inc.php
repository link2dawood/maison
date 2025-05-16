<?php
	define('DUR',0);
	define('REDIRECTION',1);
	define('NON',0);
	define('OUI',1);
	define('ACCUEIL',0);
	define('PARTOUT',1);
	define('CROISSANT',0);
	define('DECROISSANT',1);

	$config = array(
		'login' => 'paloma',
		'pass' => 'paloma',
		'noms_du_site' => array ('echange maison'),
		'url_du_site_principal' => 'http://www.echange-maison.biz',
		'lien_retour' => PARTOUT,
		'type_de_liens' => REDIRECTION,
		'envoi_de_mails' => OUI,
		'ajout_pages_internes' => OUI,
		'liens_xxx' => OUI,
		'nbre_lien_par_page' => 1,
		'classement' => CROISSANT,
		'mail_admin' => 'prode75@gmail.com'
	);

	$config['nom_du_site'] = $config['noms_du_site'][mt_rand(0,count($config['noms_du_site']) - 1)];
?>