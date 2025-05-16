<?php
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();
?>
<div id="bulle">Mon info-bulle</div>
<ul>
	<?php
		$metier->getListesConnectes(minuscule($_GET['sl']));
	?>
</ul>