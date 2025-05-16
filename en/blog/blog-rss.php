<?php
header("Content-Type: text/xml");
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_FLUX_XML);

include(INCLUDE_CLASS_BLOG);
$blog = new Blog();

//*************************************************************
//  CREATION DYNAMIQUE 	du plan syndication en flux RSS
//*************************************************************
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>"
	."<rss version=\"2.0\">"
	."<channel>"
	."<image>"
	."<title>".TEXTE_20."</title>"
	."<url>".HTTP_SERVEUR."ascreen.jpg</url>"
	."<link>".HTTP_SERVEUR."</link>"
	."</image>";
	
	//Récupération du listing Flux XML
	$blog->getListingCategoriesXml();
	
echo "</channel>"
	."</rss>";
?>
