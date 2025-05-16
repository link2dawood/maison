<?php
//************************************************************
//         RECUPERATION DE LA VILLE ET DU PAYS DU MEMBRE
//************************************************************
$Pays = $_GET['pays'];
$Ville = $_GET['ville'];
$Adresse = $Ville.",".$Pays;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
    <title><?php echo $Adresse; ?></title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA_Z69m65DDVMeWKNzH9DIjxTN3Cf61ttBHrhVET-ARJZI2PmUbxRJw50Yr7OVuhkIlAVjzY4TV9TI1w"
      type="text/javascript"></script>
	  
<body style="margin: 0px; padding: 0px;">

<div id="map" style="width: 400px; height: 300px"></div>

<script type="text/javascript">
   
//<![CDATA[
    /* Variable qui va correspondre à l'affichage de la carte dans la "div" */
	var address = "<?php echo $Adresse; ?>";
	
    var map = new GMap2(document.getElementById("map"));
    /* Centre la carte aux coordonnées indiquées et réalise un zoom de niveau 5 */
    var point = new GLatLng(49.41483, 2.817895);
    map.setCenter(point, 5);
    
    /* Cette ligne permet de bloquer le déplacement sur la carte à l'aide de la souris */
    map.disableDragging();
    
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());
    
    /* Création de l'objet GClientGeocoder */
    var geocoder = new GClientGeocoder();

    /* Fonction qui à partir d'une adresse va déterminer le point géographique */
    if (geocoder) 
		{
            geocoder.getLatLng(address, function(point) 
			{
                if (!point) 
				{ /* Si les coordonnées n'ont pas été trouvés */
                    alert("Invalide address :\n\n" + address);
                } 
				else 
				{ /* Les coordonnées ont été trouvés */
                    /* Centrer la carte sur le point */
                    map.setCenter(point, 5);
                    /* Création d'un marqueur */
                    var marker = new GMarker(point);
                    /* Afficher le marqueur */
                    map.addOverlay(marker);
                    /* Associer une info-bulle au marqueur */
                    marker.openInfoWindowHtml(address);
                }
            });
        }
    
//]]>

</script>

</body>
</html>