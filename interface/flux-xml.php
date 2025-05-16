<?php
header("Content-Type: text/xml");

include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_FLUX_XML);
$flux = new FluxXml();

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_FLUX_XML);

echo '<?xml version="1.0" encoding="iso-8859-1"?>' .
		'<rss version="2.0">' .
		'<channel>' .
		'<title>'.TEXTE_1.'</title>' .
		'<link>'.HTTP_SERVEUR.'</link>' .
		'<description>'.TEXTE_2.'</description>' .
		'<image>' .
		'<title>'.TEXTE_3.'</title>' .
		'<url>'.HTTP_SERVEUR.'ascreen.jpg</url>' .
		'<link>'.HTTP_SERVEUR.'</link>' .
		'</image>' .
		'<item>' .
		'<title>'.TEXTE_4.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-1-5.php</link>' .
		'<description>'.TEXTE_5.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_6.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-2-5.php</link>' .
		'<description>'.TEXTE_7.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_8.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-3-5.php</link>' .
		'<description>'.TEXTE_9.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_10.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-4-5.php</link>' .
		'<description>'.TEXTE_11.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_12.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-5-5.php</link>' .
		'<description>'.TEXTE_13.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_14.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-6-5.php</link>' .
		'<description>'.TEXTE_15.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_16.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-7-5.php</link>' .
		'<description>'.TEXTE_17.'</description>' .
		'</item>' .
		'<item>' .
		'<title>'.TEXTE_18.'</title>' .
		'<link>'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-8-5.php</link>' .
		'<description>'.TEXTE_19.'</description>' .
		'</item>' .
		'</channel>' .
		'</rss>';
?>