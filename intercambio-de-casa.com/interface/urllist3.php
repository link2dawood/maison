<?php
header("Content-Type: text/html");

include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_FLUX_XML);
$flux = new FluxXml();

//**************************************
//  CREATION DYNAMIQUE URLLIST
//**************************************
//FRANCE
$flux->getUrlListDepartements(TABLE_DEPARTEMENT_FR,5);
//ALGERIE
$flux->getUrlListDepartements(TABLE_DEPARTEMENT_FR,21);
//ALLEMAGNE
$flux->getUrlListDepartements(TABLE_DEPARTEMENT_FR,6);
//GUADELOUPE
$flux->getUrlListDepartements(TABLE_DEPARTEMENT_FR,96);
//GUYANE FR
$flux->getUrlListDepartements(TABLE_DEPARTEMENT_FR,102);
//MAROC
$flux->getUrlListDepartements(TABLE_DEPARTEMENT_FR,153);
?>