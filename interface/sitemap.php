<?php
header("Content-Type: text/xml");
include('../interface/applications/commun/configuration.php');
//**************************************
//  CREATION DYNAMIQUE SITEMAP
//**************************************
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
	."<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_INSCRIPTION."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_CGU."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_VOYAGE."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PARTENAIRE."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_SITE."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_CHATEAU."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_MANOIR."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_VILLA."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_MAISON."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_APPARTEMENT."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_CHAMBRE."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_RECEVOIR_A_DOMICILE."</loc>\n"
	."</url>\n"
	."<url>\n"
	."<loc>".HTTP_SERVEUR.FILENAME_PLAN_RECHERCHE_HEBERGEMENT."</loc>\n"
	."</url>\n";
	//-------------------------------------------------------------------------------------------
	//                          Récupération du listing des pays
	//-------------------------------------------------------------------------------------------
	for ($i=1; $i<248; $i++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-1-".$i.".php</loc>\n"
			."</url>\n";
	}
	for ($a=1; $a<248; $a++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-2-".$a.".php</loc>\n"
			."</url>\n";
	}
	for ($b=1; $b<248; $b++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-3-".$b.".php</loc>\n"
			."</url>\n";
	}
	for ($c=1; $c<248; $c++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-4-".$c.".php</loc>\n"
			."</url>\n";
	}
	for ($d=1; $d<248; $d++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-5-".$d.".php</loc>\n"
			."</url>\n";
	}
	for ($e=1; $e<248; $e++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-6-".$e.".php</loc>\n"
			."</url>\n";
	}
	for ($f=1; $f<248; $f++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-7-".$f.".php</loc>\n"
			."</url>\n";
	}
	for ($g=1; $g<248; $g++){
		echo "<url>\n"
			."<loc>".HTTP_SERVEUR."petites-annonces-echange-maison-1-8-".$g.".php</loc>\n"
			."</url>\n";
	}

echo "</urlset>";
?>
