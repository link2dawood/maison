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

$flux->getUrlListArticleBlogXML(TABLE_BLOG.LANGUAGE);

echo "</urlset>";
?>