<?php
if($_GET['action'] == "commentaire-en-attente"){
	$validation = '&valid=valider';
}
else{
	$validation = '';
}
//RECHERCHE DU LISTING
	$nombreAnnoncesParPage = NOMBRE_ANNONCE_PAR_PAGE;
				
	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
	//$total = $membre->compterUnElement(TABLE_LIVRE_DOR,"accepter_message",$_GET['on']);
						 
	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
	$premierAnnoncesAafficher = ($page - 1) * $nombreAnnoncesParPage;
				
	//**********************************************************************************
	//                      RECUPERATION DU LISTING ANNONCES
	//**********************************************************************************
	if($total_messages > 0){
		echo $metier->getCommentairesLivreDorADMIN($premierAnnoncesAafficher, $nombreAnnoncesParPage,$_GET['on'],HTTP_ADMIN.'commentaires.php?page='.$page.'&lang='.$_GET['lang'].'&on='.$_GET['on'].'&ctrl=ok'.$validation);
	}
	else{
		echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">Pas de résultat disponible !</p>';
	}
				
?>