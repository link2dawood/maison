<?php
header("Content-Type: text/html");

include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_FLUX_XML);
$flux = new FluxXml();

//**************************************
//  CREATION DYNAMIQUE URLLIST
//**************************************

$flux->listerUrlListCarnetDeVoyage();
?>