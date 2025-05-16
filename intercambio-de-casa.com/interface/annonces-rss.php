<?php
header("Content-Type: text/xml");
include('../../interface/applications/commun/configuration.php');

//TRAITEMENT DU SUPPORT DE LANGUE
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_FLUX_XML);
$flux = new FluxXml();
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();

includeLanguage(RACINE, LANGUAGE, FILENAME_FLUX_XML);

//**********************************************************
//   TEMPLATE DE FLUX XML REPRENNANT TOUTES LES ANNONCES
//**********************************************************
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n"
	."<rss version=\"2.0\">\n"
	."<channel>\n"
	."<title>".TEXTE_25."</title>\n"
	."<description>".TEXTE_26."</description>\n"
	."<image>\n"
	."<title>".TEXTE_27."</title>\n"
	."<url>".HTTP_SERVEUR."ascreen.jpg</url>\n"
	."<link>".HTTP_SERVEUR."</link>\n"
	."</image>\n";

$flux->getFluxXmlDesAnnonces(minuscule($_GET['echange']), minuscule($_GET['pays']));

echo "</channel>\n"
	."</rss>\n";
?>
