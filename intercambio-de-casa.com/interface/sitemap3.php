<?php
header("Content-Type: text/xml");

include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_FLUX_XML);
$flux = new FluxXml();

//***********************************************
//  CREATION DYNAMIQUE SITEMAP 2 CATEGORIES 
//***********************************************
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
	."<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\n";

//FRANCE
$flux->getUrlListDepartementsXML(TABLE_DEPARTEMENT_FR,5);
//ALGERIE
$flux->getUrlListDepartementsXML(TABLE_DEPARTEMENT_FR,21);
//ALLEMAGNE
$flux->getUrlListDepartementsXML(TABLE_DEPARTEMENT_FR,6);
//GUADELOUPE
$flux->getUrlListDepartementsXML(TABLE_DEPARTEMENT_FR,96);
//GUYANE FR
$flux->getUrlListDepartementsXML(TABLE_DEPARTEMENT_FR,102);
//MAROC
$flux->getUrlListDepartementsXML(TABLE_DEPARTEMENT_FR,153);

echo "</urlset>";
?>