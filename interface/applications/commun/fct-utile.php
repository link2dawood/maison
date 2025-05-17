<?php
//*********************************************************
//         LISTES DE TOUTES LES FONCTIONS UTILES
//*********************************************************
//----------------------------

function protegerTexte($element){
	$element1 = mysql_real_escape_string(htmlspecialchars($element));
	$element1 = trim($element1);
	$element2 = strtolower($element1);
	$element3 = ucfirst($element2);
	return $element3;
}

function protegerTextarea($element){
	$element1 = mysql_real_escape_string(htmlspecialchars($element));
	$element1 = trim($element1);
	$element2 = nl2br($element2);
	$element3 = strtolower($element2);
	$element4 = ucfirst($element3);
	return $element4;
}

function minuscule($element){
	$element1 = htmlentities ($element, ENT_QUOTES);
	$element1 = trim($element1);
	$element2 = stripslashes($element1);
	$element3 = strtolower($element2);
	return $element3;
}

function majuscule($element){
	$element1 = htmlentities ($element, ENT_QUOTES);
	$element1 = trim($element1);
	$element2 = stripslashes($element1);
	$element3 = strtoupper($element2);
	return $element3;
}

function textFormater($element){
	$element1 = htmlentities ($element, ENT_QUOTES);
	$element1 = trim($element1);
	$element2 = stripslashes($element1);
	$element3 = strtolower($element2);
	$element4 = ucfirst($element3);
	return $element4;
}

function textareaFormater($element){
	$element1 = htmlentities ($element, ENT_QUOTES);
	$element2 = stripslashes($element1);
	$element2 = nl2br($element2);
	$element3 = strtolower($element2);
	$element4 = ucfirst($element3);
	return $element4;
}

function textareaLibre($element){
	$element1 = htmlentities ($element, ENT_QUOTES);
	$element2 = stripslashes($element1);
	$element2 = nl2br($element2);
	return $element2;
}

function textLibre($element){
	$element1 = htmlentities ($element, ENT_QUOTES);
	$element2 = stripslashes($element1);
	$element2 = trim($element2);
	return $element2;
}

function text($element){
	//$element1 = htmlentities ($element, ENT_QUOTES);
	$element = trim($element);
	$element2 = stripslashes($element);
	return $element2;
}

//Rcuprer l'adresse Ip du membre
function recupIP(){
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
		$ip  = $_SERVER['HTTP_CLIENT_IP'];
	}
	else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
return $ip; 
}

//Controle sur le pseudo pas de caractres spciaux
function caractSpeciaux($verifPseudo){
	$caractAutoriser = "#[^a-zA-Z0-9]#";
	if(preg_match($caractAutoriser, $verifPseudo)){
		$mes = 1;//C'est bon !
	}
	else{
		$mes = 0;
	}
	return $mes;
}

//Controle pour vrifier la validit (synthaxe) d'un email
function conformEmail($verifEmail){
	$formAutorise = "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i";
	if(preg_match($formAutorise,$verifEmail)){
		$mes = 1;//C'est bon !
	}
	else{
		$mes = 0;
	}
	return $mes;
}

function encodage($chaineDepart){
	$chaineSlashes = stripslashes($chaineDepart);
	$chaineDepart1 = strtolower($chaineSlashes);
	$chaineDepart1 = trim($chaineDepart1);
	$chaineDepart2 = ucfirst($chaineDepart1);
	$chaineDepart3 = urlencode($chaineDepart2);
	$chaineTester = strpos($chaineDepart3, " ");
	if($chaineTester === FALSE){
		return $chaineDepart3;
	}
	else{
		$chaineDepart4 = str_replace(" ", "+", $chaineDepart3);
		return $chaineDepart4;
	}
}

//Dtruire la SESSION en cours
function detruireSession(){
	$_SESSION = array();
	session_destroy();
}

function commencerSession(){
	session_start();
}

//Formulaire de contact
function formulaireDeContact($nb){
	$formulaire = "<div style=\"margin:0 auto;width:100%\">\n"
				."<table style=\"width:100%;\">\n"
				."<tr>\n"
				."<td>"
				."<ul><form action=\"./contact.php\" method=\"post\" onSubmit=\"return checkrequired(this)\" name=\"formulaire\">\n"
				."<li><span style=\"text-decoration:underline;font-weight:bolder;\">ATTENTION </span>:Tous les champs sont obligatoires pour valider votre message !!</li>\n"
				."<li><br /><span style=\"text-decoration:underline;\">Raison du message</span>: <input type=\"text\" name=\"requiredRaisonMessage\" size=\"60\" style=\"margin-left:16px;\" /> <em>(40 car. maxi)</em></li>\n"
				."<li style=\"text-align:center;\"><label><br />Commentaire: <br /><textarea name=\"requiredCommentaire\" onKeyDown=\"CheckLen(this)\" onKeyUp=\"CheckLen(this)\" rows=\"10\" cols=\"80\"></textarea><br />Il vous reste <input type=\"text\" name=\"abd\" size=\"3\" value=\"800\" style=\"width: 30px; background-color: transparent; border: none; color: red;\">caractres</label></li>\n"
				."<li><label><br /><span style=\"text-decoration:underline;font-weight:bolder;color:#005ADF;\">Votre email valide</span>: <input type=\"text\" name=\"requiredEmail\" size=\"34\" /></label></li>\n"
				."<li><br /><input type=\"hidden\" name=\"num\"  value=\"".$nb."\" /></li>\n"
				."<li><br />Veuillez recopier le code ci-contre: <img src=\"".HTTP_HOST."/interface/applications/image.php?nb=".$nb."\" alt=\"contact\" /> <input type=\"text\" name=\"image\" /></li> \n"
				."<li style=\"text-align:center;\"><br /><input type=\"submit\" name=\"validation\" class=\"bt_envoyer\" value=\"".SUBMIT."\"/> <input type=\"reset\" style=\"margin-left:15px;\"/></li>\n"
				."</ul></form>\n"
				."</td>\n"
				."</tr>\n"
				."</table>\n"
				."</div>\n";
	
	return $formulaire;
}

//Supprimer les prpositions d'une recherche par moteur...
function supprimerPreposition($result){
	$tableauPreposition = array(" d\'", " de ", " et ", " l\'", " le ", " la ", " les ", " des ", " du ", " mon ", " ton ", " son ", " ", " ma ", " mes ", " ces ", " ses ", " ta ", " sa ");
	
	$receptionDesMots  = str_replace($tableauPreposition, " ", $result);
	
	return $receptionDesMots;
}

//Fonction Anti-spam (image)
function encodageSpam($var){
	$spam = "K".$var."s";
	return $spam;
}

function modifierImage($img, $largeur, $hauteur) {
    $dst_w = $largeur;
    $dst_h = $hauteur;
	
	 // Lit les dimensions de l'image
   $size = GetImageSize($img);  
   $src_w = $size[0]; 
   $src_h = $size[1];
   
   // Teste les dimensions tenant dans la zone
   $test_h = round(($dst_w / $src_w) * $src_h);
   $test_w = round(($dst_h / $src_h) * $src_w);
   
   // Si Height final non prcis (0)
   if(!$dst_h) $dst_h = $test_h;
   
   // Sinon si Width final non prcis (0)
   elseif(!$dst_w) $dst_w = $test_w;
   
   // Sinon teste quel redimensionnement tient dans la zone
   elseif($test_h>$dst_h) $dst_w = $test_w;
   else $dst_h = $test_h;
   
  	if($dst_h > 1 AND $dst_h < $hauteur){
		$paddingTop = ceil(($hauteur - $dst_h) / 2);
	}
	else{
		$paddingTop = 0;
	}
	$pad = " style=\"margin-top:".$paddingTop."px;\"";
   
	$tab = array($dst_w, $dst_h, $pad);
    return $tab;
}

function afficherLogin($connecter, $url){
	if(empty($connecter)){
		$log = '<form action="'.$url.'interface/" method="post">' ."\n".
				'<table class="non_connecter">' ."\n".
				'<tr>' ."\n".
				'<td>' ."\n".
				'<table>' ."\n".
				'<tr>' ."\n".
				'<td class="partA">'.CONNEXION_DEJA_INSCRITS.'</td>' ."\n".
				'<td><input type="text" name="login" size="15" style="width:130px;" value="'.CONNEXION_PSEUDO.'"/></td>' ."\n".
				'</tr>' ."\n".
				'<tr>' ."\n".
				'<td class="partA"><a href="'.$url.'interface/" title="'.CONNEXION_LIEN_ANCHOR.'" class="lien_passe_perdu">'.CONNEXION_LIEN_ANCHOR.'</a></td>' ."\n".
				'<td><input type="password" name="passe" size="15" style="width:130px;"/></td>' ."\n".
				'</tr>' ."\n".
				'</table>' ."\n".
				'</td>' ."\n".
				'<td><input type="image" src="'.CONNEXION_IMAGE_SUBMIT.'" style="margin-left:10px;"/></td>' ."\n".
				'</tr>' ."\n".
				'<tr>' ."\n".
				'<td style="text-align:right;padding-right:10px;"><a href="'.$url.'" title="'.CONNEXION_LIEN_DEVENIR_MEMBRE.'" class="lien_passe_perdu">'.CONNEXION_LIEN_DEVENIR_MEMBRE.'</a></td>' ."\n".
				'<td colspan="2" style="text-align:right;"><div id="list_drapeau">'.afficherDrapeau().'</div></td>' .
				'</tr>' ."\n".
				'</table>' ."\n".
				'</form>';
	}
	else{
		$membre = new EspaceMembre();
		$metier = new Metier();
		
		$nb_mails = $membre->compterMessagesNonLus($_SESSION['id_client'], $_SESSION['pseudo_client']);
		$mon_compte = $metier->getOnlineMembre($_SESSION['id_client']);
		
		$log = '<table id="connexion_ok">' .
			   '<tr>' .
			   '<td class="heure">'.LIBELLE_DATE_TOP.' '.date("d/m/Y - H:i", $mon_compte->connexion).'</td>' .
			   '<td class="bonjour">'.CONNEXION_MESSAGE_ACCUEIL.' '.$_SESSION['pseudo_client'].'</td>' .
			   '</tr>' .
			   '<tr>' .
			   '<td class="mail">'.NB_MESSAGES_RECEPTION.' <strong>'.$nb_mails.'</strong></td>' .
			   '<td class="option">' .
			   '<div class="icone">' .
			   '<ul>' .
			   '<li><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=ecrire-message-texte"><img src="'.HTTP_IMAGE.'icone_tchat_login.jpg" alt="'.ATTRIBUT_ALT.'"/></a></li>' .
			   '<li><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=ecrire-message-video"><img src="'.HTTP_IMAGE.'icone_video_login.jpg" alt="'.ATTRIBUT_ALT.'"/></a></li>' .
			   '<li><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=ecrire-message-audio"><img src="'.HTTP_IMAGE.'icone_audio_login.jpg" alt="'.ATTRIBUT_ALT.'"/></a></li>' .
			   '<li><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_COURRIER.'?action=ecrire-message-texte"><img src="'.HTTP_IMAGE.'icone_mail_login.jpg" alt="'.ATTRIBUT_ALT.'"/></a></li>' .
			   '</ul>' .
			   '<div>' .
			   '</td>' .
			   '</tr>' .
			   '</table>';
	}
	return $log;
}

function mail_attachement($to , $sujet , $message , $fichier , $typemime , $nom , $reply , $from){
    $limite = "_parties_".md5(uniqid (rand()));
    
    $mail_mime = "Date: ".date("l j F Y, G:i")."\n";
    $mail_mime .= "MIME-Version: 1.0\n";
    $mail_mime .= "Content-Type: multipart/mixed;\n";
    $mail_mime .= " boundary=\"----=".$limite."\"\n\n";
   
    //Le message en texte simple pour les navigateurs qui n'acceptent pas le HTML
    $texte = "This is a multi-part message in MIME format.\n";
    $texte .= "Ceci est un message est au format MIME.\n";
    $texte .= "------=".$limite."\n";
    $texte .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
    $texte .= "Content-Transfer-Encoding: 7bit\n\n";
    $texte .= $message;
    $texte .= "\n\n";
    
	//le fichier
    $attachement = "------=".$limite."\n";
    $attachement .= "Content-Type: ".$typemime."; name=\"".$nom."\"\n";
    $attachement .= "Content-Transfer-Encoding: base64\n";
    $attachement .= "Content-Disposition: attachment; filename=\"".$nom."\"\n\n";
    
    $fd = fopen( $fichier, "r" );
    $contenu = fread( $fd, filesize( $fichier ) );
    fclose( $fd );
    $attachement .= chunk_split(base64_encode($contenu));
    
    $attachement .= "\n\n\n------=".$limite."\n";
    return mail($to, $sujet, $texte.$attachement, "Reply-to: ".$reply."\nFrom:
    ".$from."\n".$mail_mime);
}

function defautPage($var) {
    return (isset($var) && is_numeric($var) && $var > 0) ? (int)$var : 1;
}


function boutonPagination($url, $method, $name, $bt_name, $action, $page_actuelle){
	if ($action == "retour"){
		if(is_null($page_actuelle) OR $page_actuelle <= 1){
			$num = 0;
			$disabled = "disabled";
		}
		else{
			$num = $page_actuelle-1;
			$disabled = "";
		}
		
		$bouton = '<form action="'.$url.'" method="'.$method.'">' .
				'<input type="hidden" name="'.$name.'" value="'.$num.'"/>' .
				'<input type="submit" value="'.$bt_name.'" '.$disabled.'/>' .
				'</form>'; 
	}
	elseif ($action == "suite"){
		if(is_null($page_actuelle) OR $page_actuelle == 0){
			$num = 1;
		}
		else{
			$num = $page_actuelle+1;
		}
		
		$bouton = '<form action="'.$url.'" method="'.$method.'">' .
				'<input type="hidden" name="'.$name.'" value="'.$num.'"/>' .
				'<input type="submit" value="'.$bt_name.'"/>' .
				'</form>';
	}
	else {
		$bouton = '';
	}
	return $bouton;
}

function pageMaxi($var){
	if($var <= 10){
		$pageMax = 20;
	}
	elseif($var <= 20){
		$pageMax = 30;
	}
	elseif($var <= 30){
		$pageMax = 40;
	}
	elseif($var <= 40){
		$pageMax = 50;
	}
	elseif($var <= 50){
		$pageMax = 60;
	}
	elseif($var <= 60){
		$pageMax = 70;
	}
	elseif($var <= 70){
		$pageMax = 80;
	}
	elseif($var <= 80){
		$pageMax = 90;
	}
	elseif($var <= 90){
		$pageMax = 100;
	}
	elseif($var <= 100){
		$pageMax = 110;
	}
	return $pageMax;
}

function pageMini($var){
	if($var <= 10){
		$pageMin = 1;
	}
	elseif($var <= 20){
		$pageMin = 10;
	}
	elseif($var <= 30){
		$pageMin = 20;
	}
	elseif($var <= 40){
		$pageMin = 30;
	}
	elseif($var <= 50){
		$pageMin = 40;
	}
	elseif($var <= 60){
		$pageMin = 50;
	}
	elseif($var <= 70){
		$pageMin = 60;
	}
	elseif($var <= 80){
		$pageMin = 70;
	}
	elseif($var <= 90){
		$pageMin = 80;
	}
	elseif($var <= 100){
		$pageMin = 90;
	}
	return $pageMin;
}

function includeLanguage($racine, $langue, $fichier){
	if($langue == "en"){
		//RENVOI VERS VERSION ANGLAISE
		include ($racine."/interface/applications/language/en/".$fichier);
		include ($racine."/interface/applications/language/en/connexion.php");
		include ($racine."/interface/applications/language/en/footer.php");
	}
	elseif($langue == "de"){
		//RENVOI VERS VERSION ALLEMANDE
		include ($racine."/interface/applications/language/de/".$fichier);
		include ($racine."/interface/applications/language/de/connexion.php");
		include ($racine."/interface/applications/language/de/footer.php");
	}
	elseif($langue == "es"){
		//RENVOI VERS VERSION ESPAGNOL
		include ($racine."/interface/applications/language/es/".$fichier);
		include ($racine."/interface/applications/language/es/connexion.php");
		include ($racine."/interface/applications/language/es/footer.php");
	}
	else{
		//RENVOI VERS VERSION FRANCAISE
		include ($racine."/interface/applications/language/fr/".$fichier);
		include ($racine."/interface/applications/language/fr/connexion.php");
		include ($racine."/interface/applications/language/fr/footer.php");
	}
}

function afficherMetaLangue($langue){
	if($langue == "en"){
		//VERSION ANGLAISE
		$meta = '<meta http-equiv="content-language" content="en"/>'."\n";
	}
	elseif($langue == "de"){
		//VERSION ALLEMANDE
		$meta = '<meta http-equiv="content-language" content="de"/>'."\n";
	}
	elseif($langue == "es"){
		//VERSION ESPAGNOL
		$meta = '<meta http-equiv="content-language" content="es"/>'."\n";
	}
	else{
		//VERSION FRANCAISE
		$meta = '<meta http-equiv="content-language" content="fr"/>'."\n";
	}
	return $meta;
}

function afficherDrapeau(){
	$drapeau = '<div id="drapeau">' .
			   '<a href="'.HTTP_FRANCAIS.'"><img src="" alt="'.ATTRIBUT_ALT.'"/></a>' .
			   '<a href="'.HTTP_ANGLAIS.'"><img src="" alt="'.ATTRIBUT_ALT.'" style="margin-left:2px;"/></a>' .
			   '<img src="" alt="'.ATTRIBUT_ALT.'" style="margin-left:2px;"/>' .
			   '</div>';
	return $drapeau;
}

function redirection($temps, $url){
	echo '<meta http-equiv="refresh" content="'.$temps.'; url='.$url.'" />';
}

function envoiMailAlerte($entete, $pseudo, $mot_de_passe, $destinataire){
	$expediteur   = MAIL_CORRESPONDANCE;
	
	$contenu = '<h1 style="text-align:center;">Ouverture compte vacanceshome.com</h1>' .
						'<p>Bonjour,<br />' .
						'Vous recevez ce message car vous venez de vous enregistrer sur notre site : vacanceshome.com &trade;<br />' .
						'Notre quipe va contrler votre photo en conformit avec nos conditions gnrales d\'utilisations.<br />' .
						'Trouvez ci-dessous vos identifiants de connexion:' .
						'<br />Date inscription : <em>'.date("d-m-Y", time()).'</em>' .
						'<br />Pseudo : <em>'.$pseudo.'</em>' .
						'<br />Mot de passe : <em>'.$mot_de_passe.'</em>' .
						'<br />Nous vous remercions vivement de votre confiance et nous vous disons  trs bientt !<br /><br /><br />' .
						'Pour voyager autrement<br />' .
						'www.vacanceshome.com</p>' .
						'<h3 style="text-align:center;">NE PAS REPONDRE - MAIL AUTOMATIQUE</h3>';
	
	$reponse      = $expediteur;

	$codehtml=  '<html>' .
			'<head>' .
			'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
			'</head>' .
			'<body>' .
			''.$contenu.'' .
			'</body>' .
			'</html>';
				
				mail($destinataire, $entete, $codehtml,"From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");	
}

function creationImage($largeur, $hauteur, $type, $savefile, $genre, $nommage){
	//REDIMENSIONNEE UNE IMAGE EN FONCTION DE SES LIMITES
	$dimension = modifierImage(REPERTOIRE_IMAGE_ORIGINAL.$nommage.$savefile, $largeur, $hauteur);
	
	$largeurDestination = $dimension[0];
	$hauteurDestination = $dimension[1];
	
	$ex1 = ".jpg";
	$ex2 = ".jpeg";
	$ex3 = ".gif";
	$ex4 = ".png";
	
	$im = ImageCreateTrueColor ($largeurDestination, $hauteurDestination) or die ("Erreur lors de la cration de l'image");  
	//Vrifier si l'extension est conforme au type PHP
	if($type == $ex1 OR $type == $ex2){//Pour JPG
		$source = ImageCreateFromJpeg(REPERTOIRE_IMAGE_ORIGINAL.$nommage.$savefile);
	}
	if($type == $ex4){//Pour PNG
		$source = ImageCreateFromPng(REPERTOIRE_IMAGE_ORIGINAL.$nommage.$savefile);
	}
	if($type == $ex3){//Pour Gif
		$source = ImageCreateFromGif(REPERTOIRE_IMAGE_ORIGINAL.$nommage.$savefile);
	}
	$largeurSource = imagesx($source);
	$hauteurSource = imagesy($source); 
																			
	ImageCopyResampled($im, $source, 0, 0, 0, 0, $largeurDestination, $hauteurDestination, $largeurSource, $hauteurSource);
										    
	
	
	if($genre == "miniature"){
		$miniature = $savefile;
		$rep = REPERTOIRE_IMAGE_MINIATURE.$nommage;
	}
	elseif($genre == "redimensionnee"){
		$miniature = $savefile;
		$rep = REPERTOIRE_IMAGE_REDIMENSIONNEE.$nommage;
	}
	else{
		$miniature = 0;
		$rep = 0;
	}
				
	//Vrifier si l'extension est conforme au type PHP
	if($type == $ex1 OR $type == $ex2){//Pour JPG
		ImageJpeg ($im, $rep.$miniature);
	}
	if($type == $ex4){//Pour PNG
		ImagePng ($im, $rep.$miniature);
	}
	if($type == $ex3){//Pour Gif
		ImageGif ($im, $rep.$miniature);
	}
	
	return $miniature;
}

function iconeConnexion($connexion){
	if(is_numeric($connexion)){
		//MEMBRE CONNECTE
		$icone = '<img src="'.HTTP_IMAGE.'connecter.png" alt="'.ATTRIBUT_ALT.'" id="puce"/> <span style="color:green;">Online</span>';
	}
	else{
		//PAS CONNECTER
		$icone = '<img src="'.HTTP_IMAGE.'non_connecter.png" alt="'.ATTRIBUT_ALT.'" id="puce"/> Offline';
	}
	return $icone;
}

function grandIconeConnexion($connexion){
	if(is_numeric($connexion)){
		//MEMBRE CONNECTE
		$icone = '<img src="'.HTTP_IMAGE.'icone-online.png" alt="'.ATTRIBUT_ALT.'" id="puce"/>';
	}
	else{
		//PAS CONNECTER
		$icone = '<img src="'.HTTP_IMAGE.'icone-offline.png" alt="'.ATTRIBUT_ALT.'" id="puce"/>';
	}
	return $icone;
}

function activerHyperlienConnexion($connexion, $url, $title, $lien_img, $anchor, $actif){
	if(is_numeric($connexion) OR $actif == "actif"){
		//MEMBRE CONNECTE
		$icone = '<a href="'.$url.'" title="'.$title.'"><img src="'.$lien_img.'" alt="'.ATTRIBUT_ALT.'"/> '.$anchor.'</a>';
	}
	elseif($actif == "webcam" AND $connexion == ""){
		$icone = '';
	}
	else{
		//PAS CONNECTER
		$icone = '<img src="'.$lien_img.'" alt="'.ATTRIBUT_ALT.'"/> '.$anchor.'';
	}
	return $icone;
}

function nommageRepertoire($id_pseudo){
	if(strlen($id_pseudo) == 0){
		$repertoire = "000/";
	}
	elseif(strlen($id_pseudo) == 1){
		$repertoire = "00".$id_pseudo."/";
	}
	elseif(strlen($id_pseudo) == 2){
		$repertoire = "0".$id_pseudo."/";
	}
	elseif(strlen($id_pseudo) == 3){
		$repertoire = $id_pseudo."/";
	}
	else{
		$rep = substr($id_pseudo,-3);
		$repertoire = $rep."/";
	}
	return $repertoire;	
}

function afficherMiniature($id_client, $pseudo, $extension, $ok){
	$rep = nommageRepertoire($id_client);
	
	if(empty($extension)){
		//PAS DE MINIATURE
		$icone = '<div id="img_container"><img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
	}
	else{
		if(empty($ok)){
			$icone = '<div id="img_container"><img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
		}
		else{
			$image = HTTP_IMAGE_MINIATURE.$rep.libelleImage($pseudo,1).'.'.$extension;
			$icone = '<div id="img_container"><img src="'.$image.'" alt="'.ATTRIBUT_ALT.'"/></div>';
		}
	}
	return $icone;
}

function afficherMiniatureGalerie($id_client, $pseudo, $extension, $ok,$numero_img){
	$rep = nommageRepertoire($id_client);
	
	if(empty($extension)){
		//PAS DE MINIATURE
		$icone = '<div id="img_container"><img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
	}
	else{
		if(empty($ok)){
			$icone = '<div id="img_container"><img src="'.HTTP_IMAGE.'sans.jpg" alt="'.ATTRIBUT_ALT.'"/></div>';
		}
		else{
			$image = HTTP_IMAGE_MINIATURE.$rep.libelleGalerie($pseudo,$numero_img).'.'.$extension;
			$icone = '<div id="img_container"><img src="'.$image.'" alt="'.ATTRIBUT_ALT.'"/></div>';
		}
	}
	return $icone;
}

function afficherLienMiniature($identifiant, $pseudo, $numero_img,$extension, $ok,$style){
	$http = HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($identifiant).libelleImage($pseudo,$numero_img).'.'.$extension;
	
	if(empty($extension)){
		//PAS DE MINIATURE
		$lien = TEXTE_80;
	}
	else{
		if(empty($ok)){
			$lien = TEXTE_81;
		}
		else{
			$lien = '<a href="'.$http.'" rel="lightbox" style="'.$style.'">'.TEXTE_80.'</a>';
		}
	}
	return $lien;
}

function afficherMiniatureAlbumPhoto($id_client, $pseudo, $extension, $ok,$photo){
	$rep = nommageRepertoire($id_client);
	
	if(empty($extension)){
		//PAS DE MINIATURE
		$icone = '<div id="img_container"><img src="'.HTTP_IMAGE.$photo.'" alt="'.ATTRIBUT_ALT.'"/></div>';
	}
	else{
		if(empty($ok)){
			$icone = '<div id="img_container"><img src="'.HTTP_IMAGE.$photo.'" alt="'.ATTRIBUT_ALT.'"/></div>';
		}
		else{
			$image = HTTP_IMAGE_MINIATURE.$rep.$pseudo.'.'.$extension;
			//$tab = modifierImage($image, 100, 100);
			//$icone = '<div id="img_container"><img src="'.$image.'" alt="'.ATTRIBUT_ALT.'" width="'.$tab[0].'" height="'.$tab[1].'" '.$tab[2].'/></div>';
			$icone = '<div id="img_container"><img src="'.$image.'" alt="'.ATTRIBUT_ALT.'"/></div>';
		}
	}
	return $icone;
}

function formulaireMessengerTexte($url, $method, $pseudo, $etat, $msg, $action, $titre, $phrase, $submit, $id_pseudo){
	//MESSAGE TEXTE
	echo '<form action="'.$url.'" method="'.$method.'" onSubmit="return checkrequired(this)" name="formulaire">' .
			'<div id="form_messenger">' ."\n".
			'<table>' ."\n".
			'<tr>' ."\n".
			'<td class="img_form">'.$etat.'</td>' ."\n".
			'<td class="text_top_form"><strong>'.$pseudo.'</strong></td>' ."\n".
			'<td class="icone_form"><img src="'.HTTP_IMAGE.'message_texte.png" alt="'.ATTRIBUT_ALT.'"/> <input type="hidden" name="id_pseudo" value="'.$id_pseudo.'" /> <input type="hidden" name="genre" value="'.$msg.'" /> <input type="hidden" name="action" value="'.$action.'" /></td>' ."\n".
			'</tr>' ."\n".
			'<tr>' ."\n".
			'<td style="text-align:center;" colspan="3"><textarea name="requiredCommentaire" rows="20" cols="65">'.$phrase.'</textarea></td>' ."\n".
			'</tr>' ."\n".
			'<tr>' ."\n".
			'<td style="text-align:center;padding-top:5px;" colspan="3"><input type="image" src="'.HTTP_IMAGE.$submit.'" /></td>' ."\n".
			'</tr>' ."\n".
			'</table>' ."\n".
			'</div>' ."\n".
			'</form>' ."\n";
}

function formulaireMessengerAudio($url, $method, $pseudo,$etat, $msg, $action, $submit, $textarea, $id_pseudo, $chaine){
	//MESSAGE TEXTE
	?>
	<form action="<?php echo $url; ?>" method="<?php echo $method; ?>" onSubmit="return checkrequired(this)" name="formulaire">
		<div id="form_messenger">
			<table>
				<tr>
					<td class="img_form"><?php echo $etat; ?></td>
					<td class="text_top_form"><strong><?php echo $pseudo; ?></strong></td>
					<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></td>
				</tr>
			</table>
			<table>
				<tr>
					<td colspan="2" style="text-align:center;">
						<input type="hidden" name="genre" value="<?php echo $msg; ?>" /> 
						<input type="hidden" name="action" value="<?php echo $action; ?>" />
						<input type="hidden" name="id_pseudo" value="<?php echo $id_pseudo; ?>" /> 
						<textarea name="requiredCommentaire" rows="5" cols="82"><?php echo $textarea; ?></textarea>
					</td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<?php echo scriptJsMessageAudio($chaine); ?>
						<br />
						<?php echo scriptFlashMessageAudio($chaine); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;padding-top:5px;"><input type="image" src="<?php echo HTTP_IMAGE.$submit; ?>" /></td>
				</tr>
			</table>
		</div>
	</form>
	<?php
}

function formulaireMessengerVideo($url, $method, $pseudo, $etat, $msg, $action, $submit, $textarea, $id_pseudo, $chaine){
	//MESSAGE TEXTE
	?>
	<form action="<?php echo $url; ?>" method="<?php echo $method; ?>" onSubmit="return checkrequired(this)" name="formulaire">
		<div id="form_messenger">
			<table>
				<tr>
					<td class="img_form"><?php echo $etat; ?></td>
					<td class="text_top_form"><strong><?php echo $pseudo; ?></strong></td>
					<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></td>
				</tr>
				</table>
				<table>
					<tr>
						<td colspan="2" style="text-align:center;">
							<input type="hidden" name="genre" value="<?php echo $msg; ?>" /> 
							<input type="hidden" name="action" value="<?php echo $action; ?>" /> 
							<input type="hidden" name="id_pseudo" value="<?php echo $id_pseudo; ?>" /> 
							<textarea name="requiredCommentaire" rows="3" cols="82"><?php echo $textarea; ?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;">
						<?php echo scriptJsMessageVideo($chaine); ?>
						<br />
						<?php echo scriptFlashMessageVideo($chaine); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;padding-top:15px;"><input type="image" src="<?php echo HTTP_IMAGE.$submit; ?>" /></td>
					</tr>
				</table>
			</div>
		</form>	
	<?php
}

function afficherH1Listing($id_opt, $id_pays, $nom_pays, $nom_dept){
	if($id_opt == 0){
		//UNIQUEMENT CONNECTES
		if($id_pays == 5){
			echo H1_CONNECTER.' .:. '.$nom_dept;
		}
		else{
			echo H1_CONNECTER.' .:. '.$nom_pays;
		}
	}
	elseif($id_opt == 1){
		//UNIQUEMENT NON CONNECTES
		if($id_pays == 5){
			echo H1_NON_CONNECTER.' .:. '.$nom_dept;
		}
		else{
			echo H1_NON_CONNECTER.' .:. '.$nom_pays;
		}
	}
	else{
		//UNIQUEMENT CONNECTES
		if($id_pays == 5){
			echo H1_TOUS_MEMBRES.' .:. '.$nom_dept;
		}
		else{
			echo H1_TOUS_MEMBRES.' .:. '.$nom_pays;
		}
	}
}

function afficherExtrait($element){
	if(is_null($element)){
		$chaine = ' ';
	}
	else{
		$descript = substr($element, AFFICHER_EXTRAIT_DEBUT, AFFICHER_EXTRAIT_FIN);
		
		$pos = strrpos($descript, " ");
		if ($pos === false) {
		    // pas trouv...
		    $chaine = $descript;
		}
		else{
			$chaine = $descript.'...';
		}
	}
	return $chaine; 
}

function afficherIconeMessenger($genre){
	if($genre == "message-texte"){
		//TYPE MESSAGE TEXTE
		$icone = '<img src="'.HTTP_IMAGE.'tchat_txt.gif" alt="'.ATTRIBUT_ALT.'"/>';
	}
	elseif($genre == "message-audio"){
		//TYPE MESSAGE AUDIO
		$icone = '<img src="'.HTTP_IMAGE.'tchat_audio.gif" alt="'.ATTRIBUT_ALT.'"/>';
	}
	elseif($genre == "message-video"){
		//TYPE MESSAGE VIDEO
		$icone = '<img src="'.HTTP_IMAGE.'tchat_video.gif" alt="'.ATTRIBUT_ALT.'"/>';
	}
	else{
		//ERREUR...
		$icone = '';
	}
	return $icone;
}

function afficherLiensOptionsMessagerie($type, $genre, $id_membre, $pseudo_membre){
	if($type == "messenger"){
		if($genre == "message-texte"){
			//TYPE MESSAGE TEXTE
			$icone = '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?action=demande-duo&id='.$id_membre.'&m='.$pseudo_membre.'&method=repondre"><img src="'.HTTP_IMAGE.'webcam.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_DEMANDE_DUO.'</a>';
		}
		elseif($genre == "demande-duo"){
			//TYPE DEMANDE EN DUO WEBCAM
			$icone = '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?action=message-texte&id='.$id_membre.'&m='.$pseudo_membre.'&method=repondre"><img src="'.HTTP_IMAGE.'texte.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_TEXTE.'</a>';
		}
		else{
			//ERREUR...
			$icone = '';
		}
	}
	else{
		//COURRIER
		$icone = '';
	}
	return $icone;
}

function afficherEtatMessagerie($lu, $supprimer){
	if($lu == "non" AND empty($supprimer)){
		$etat = ETAT_MESSAGE_NON_LU;
	}
	elseif($lu == "oui" AND empty($supprimer)){
		$etat = ETAT_MESSAGE_LU;
	}
	elseif($lu == "oui" AND !empty($supprimer)){
		$etat = ETAT_MESSAGE_SUPPRIMER;
	}
	elseif($lu == "non" AND !empty($supprimer)){
		$etat = ETAT_MESSAGE_SUPPRIMER;
	}
	else{
		$etat = "ERREUR";
	}
	return $etat;
}

function afficherReponseMessagerie($reponse){
	if(empty($reponse)){
		$etat = NOUVEAU_MESSAGE;
	}
	elseif($reponse == "vu"){
		$etat = "";
	}
	elseif($reponse == "repondre"){
		$etat = REPONSE_MESSAGE;
	}
	else{
		$etat = "";
	}
	return $etat;
}

function afficherExtraitDescription($description){
	$descript = substr(str_replace("<br />", " ",$description), 0, NOMBRE_CARACTERES_EXTRAIT_DESCRIPTION).'...';
	return $descript; 
}

function afficherLiensMessagerie($genre, $id_membre, $pseudo_membre, $id_msg){
	if($genre == "message-texte"){
		//TYPE MESSAGE TEXTE
		$icone = '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$id_msg.'&type=message-audio&id_m='.$id_membre.'&m='.$pseudo_membre.'&action=repondre"><img src="'.HTTP_IMAGE.'audio.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_AUDIO.'</a>' .
					'&nbsp;.:.&nbsp;<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$id_msg.'&type=message-video&id_m='.$id_membre.'&m='.$pseudo_membre.'&action=repondre"><img src="'.HTTP_IMAGE.'camera.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_VIDEO.'</a>';
	}
	elseif($genre == "message-audio"){
		//TYPE MESSAGE AUDIO
		$icone = '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$id_msg.'&type=message-texte&id_m='.$id_membre.'&m='.$pseudo_membre.'&action=repondre"><img src="'.HTTP_IMAGE.'texte.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_TEXTE.'</a>' .
					'&nbsp;.:.&nbsp;<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$id_msg.'&type=message-video&id_m='.$id_membre.'&m='.$pseudo_membre.'&action=repondre"><img src="'.HTTP_IMAGE.'camera.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_VIDEO.'</a>';
	}
	elseif($genre == "message-video"){
		//TYPE MESSAGE VIDEO
		$icone = '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$id_msg.'&type=message-audio&id_m='.$id_membre.'&m='.$pseudo_membre.'&action=repondre"><img src="'.HTTP_IMAGE.'audio.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_AUDIO.'</a>' .
					'&nbsp;.:.&nbsp;<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$id_msg.'&type=message-texte&id_m='.$id_membre.'&m='.$pseudo_membre.'&action=repondre"><img src="'.HTTP_IMAGE.'texte.png" alt="'.ATTRIBUT_ALT.'"/> '.MESSENGER_GESTION_ANCHOR_MESSAGE_TEXTE.'</a>';
	}
	else{
		//ERREUR...
		$icone = '';
	}
	return $icone;
}

function afficherH2Messagerie($action, $type, $genre){
	if($action == "supprimer"){
	 	$titre_h2 = SUPPRIMER_MESSAGE;
	 }
	 elseif($action == "repondre"){
	 	if($type == "message-texte"){
	 		$titre_h2 = MESSENGER_REPONDRE_MESSAGE_TEXTE;
	 	}
	 	elseif($type == "message-audio"){
	 		$titre_h2 = MESSENGER_REPONDRE_MESSAGE_AUDIO;
	 	}
	 	elseif($type == "message-video"){
	 		$titre_h2 = MESSENGER_REPONDRE_MESSAGE_VIDEO;
	 	}
	 	else{
	 		$titre_h2 = "";
	 	}
	 }
	 elseif($genre == "message-texte"){
	 	$titre_h2 = MESSENGER_LIRE_MESSAGE_TEXTE;
	 }
	 elseif($genre == "message-audio"){
	 	$titre_h2 = MESSENGER_LIRE_MESSAGE_AUDIO;
	 }
	 elseif($genre == "message-video"){
	 	$titre_h2 = MESSENGER_LIRE_MESSAGE_VIDEO;
	 }
	 else{
	 	$titre_h2 = "";
	 }
	
	return $titre_h2;
}

function etatConnecter($connexion){
	if(empty($connexion)){
		//MEMBRE NON CONNECTE
		$icone = 0;
	}
	else{
		//CONNECTER
		$icone = 1;
	}
	return $icone;
}

function desactiverBoutonTchat($connexion, $url){
	if($connexion == 0){
		//MEMBRE NON CONNECTE
		$icone = '<img src="'.HTTP_IMAGE.BOUTON_REPONSE_TCHAT_OFF.'" alt="'.ATTRIBUT_ALT.'"/>';
	}
	else{
		//CONNECTER
		$icone = '<a href="'.$url.'"><img src="'.HTTP_IMAGE.BOUTON_REPONSE_TCHAT.'" alt="'.ATTRIBUT_ALT.'"/></a>';
	}
	return $icone;
}

function afficherInfoBlacklist($info){
	if($info > 0){
		echo ICONE_TEXTE_MEMBRE_BLACKLISTER;
	}
	else{
		echo '&nbsp;';
	}
}

function formaterChiffre($chiffre){
	
	if(strlen($chiffre) != 2){
		//LE CHIFFRE NEST PAS SUR 2 VALEURS
		$nombre = '0'.$chiffre;
	}
	else{
		//OK
		$nombre = $chiffre;
	}
	return $nombre;
}

function majPagination($nombreMembresParPage, $TotalMembres){
	// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
   return (int) ceil($total / $nbParPage);
}

function controleAcces(){
	/*$membre = new EspaceMembre();
	$type = $membre->getChamps("type_echange",TABLE_IDENTITE,"identifiant",$_SESSION['id_client']);
	$condition = $membre->getConditionGratuite($type);
	if($condition == 0){
		$acces = 0;
	}
	else{
		//COMPTE BENEFICIANT GRATUITE....
		$acces = 1;
	}*/
	$acces = 1;
	return $acces;
}

function activerPaiement($mon_pseudo){
	$controle_acces = controleAcces();
	//********RECUPERER LES ACCES A LA BASE DES PAIEMENTS************
	mysqli_connect(BDD_SERVEUR, BDD_IDENTIFIANT, BDD_MOT_PASSE);
	// mysqli_select_db est géré automatiquement par mysqli_connect(BDD_BASE_DE_DONNEES_PAIEMENTS);
	$reponse = mysqli_query("SELECT * FROM `".TABLE_PAIEMENTS."` WHERE `pseudo`='".$mon_pseudo."'") or die(mysql_error());
	while ($mysql = mysqli_fetch_object($reponse)){
		$id_utilisateur = $mysql->id;
		$pseudo_utilisateur = $mysql->pseudo;
		$date_fin_utilisateur = $mysql->date_fin;
		$gratuit_utilisateur = $mysql->gratuit;
		$online_utilisateur = $mysql->online;
	}
	
	mysql_close();
	
	$date_cloture = strtotime($date_fin_utilisateur);
	//***************************************************************
	
	if($gratuit_utilisateur == 1 
	OR $online_utilisateur == 1 
	OR $date_cloture > time() 
	OR $controle_acces == 1){
		//COMPTE GRATUIT...ON NE FAIT RIEN....
		$compte = 1;
	}
	else{
		//TOUS LES AUTRES TYPES DE COMPTES....
		$compte = 0;
	}
	return $compte;
}

function autoriserAction($mon_pseudo, $lien, $anchor){
	$controle_acces = controleAcces();
	//********RECUPERER LES ACCES A LA BASE DES PAIEMENTS************
	mysqli_connect(BDD_SERVEUR, BDD_IDENTIFIANT, BDD_MOT_PASSE);
	// mysqli_select_db est géré automatiquement par mysqli_connect(BDD_BASE_DE_DONNEES_PAIEMENTS);
	$reponse = mysqli_query("SELECT * FROM `".TABLE_PAIEMENTS."` WHERE `pseudo`='".$mon_pseudo."'") or die(mysql_error());
	while ($mysql = mysqli_fetch_object($reponse)){
		$id_utilisateur = $mysql->id;
		$pseudo_utilisateur = $mysql->pseudo;
		$date_fin_utilisateur = $mysql->date_fin;
		$gratuit_utilisateur = $mysql->gratuit;
		$online_utilisateur = $mysql->online;
	}
	mysql_close();
	
	$date_cloture = strtotime($date_fin_utilisateur);
	//***************************************************************
	
	if($gratuit_utilisateur == 1 
	OR $online_utilisateur == 1 
	OR $date_cloture > time() 
	OR $controle_acces == 1){
		//COMPTE GRATUIT...ON NE FAIT RIEN....
		$action = '<a href="'.$lien.'">'.$anchor.'</a>';
	}
	else{
		//TOUS LES AUTRES TYPES DE COMPTES....
		$action = '<a href="'.HTTP_PAIEMENT.'" class="lien_supprimer" target="_top">'.$anchor.'</a>';
	}
	return $action;
}

function afficherLoginAdmin(){
		echo	'<form action="./connexion.php" method="post">' .
				'<table id="login_ad">' .
				'<tr>' .
				'<td colspan="2" class="titre">ESPACE RESTREINT</td>' .
				'</tr>' .
				'<tr>' .
				'<td style="padding-top:25px;">Login :</td>' .
				'<td style="padding-top:25px;"><input type="text" name="login"/></td>' .
				'</tr>' .
				'<tr>' .
				'<td>Mot de passe :</td>' .
				'<td><input type="password" name="passe"/></td>' .
				'</tr>' .
				'<tr>' .
				'<td colspan="2" style="text-align:center;"><input type="submit" value="se connecter"/></td>' .
				'</tr>' .
				'</table>' .
				'</form>';
}

function afficherFormulaireModificationAdmin(){
		echo	'<form action="./identifiants2.php" method="post">' .
				'<table id="login_ad">' .
				'<tr>' .
				'<td colspan="2" class="titre">Formulaire</td>' .
				'</tr>' .
				'<tr>' .
				'<td style="padding-top:25px;">Login :</td>' .
				'<td style="padding-top:25px;"><input type="text" name="login"/></td>' .
				'</tr>' .
				'<tr>' .
				'<td>Mot de passe :</td>' .
				'<td><input type="password" name="passe1"/></td>' .
				'</tr>' .
				'<tr>' .
				'<td>Confirmation :</td>' .
				'<td><input type="password" name="passe2"/></td>' .
				'</tr>' .
				'<tr>' .
				'<td colspan="2" style="text-align:center;"><input type="submit" value="envoyer"/></td>' .
				'</tr>' .
				'</table>' .
				'</form>';
}

function afficherAlerte($msg){
	echo '<p style="font-size:20px;text-align:center;margin-top:80px;font-weight:bolder;">'.$msg.'</p>';	
}	

function afficherErreur($msg){
	echo '<table id="stop">' .
			'<tr>' .
			'<td><img src="'.HTTP_IMAGE.'interrogation-3.jpg" alt="'.ATTRIBUT_ALT.'"/></td>' .
			'<td>'.$msg.'</td>' .
			'</tr>' .
			'</table>';	
}

function messageErreur($msg){
	echo '<table id="stop">' .
			'<tr>' .
			'<td>'.HTTP_PROGRESS.'</td>' .
			'<td>'.$msg.'</td>' .
			'</tr>' .
			'</table>';	
}

function validerSynthaxe($chaine, $condition){
	$rest = substr($chaine, -1);
	if($condition == "avec-slash"){
		if($rest == "/"){
			$resultat = "ok";
		}
		else{
			$resultat = "";
		}	
	}
	else{
		if($rest == "/"){
			$resultat = "";
		}
		else{
			$resultat = "ok";
		}
	}
	return $resultat; 
}

function formulairePub($lien, $texte, $action, $type, $email, $anchor){
	
	$formulaire = '<form action="'.HTTP_HOST.'/'.FILENAME_PUBLICITE.'?action='.$action.'&type='.$type.'" method="post" name="formulaire_1" onSubmit="return checkrequired(this)">' .
					'<div id="annonce_pub">' .
					'<table style="width:100%;">' .
					'<tr>' .
					'<td colspan="2" class="titre">'.TITRE_PUB.'</td>' .
					'</tr>' .
					'<tr>' .
					'<td>'.LIBELLE_0.'</td>' .
					'<td><input type="text" name="requiredEmail" value="'.$email.'"/></td>' .
					'</tr>' .
					'<tr>' .
					'<td>'.ANCHOR.'</td>' .
					'<td><input type="text" name="requiredAnchor" value="'.$anchor.'"/></td>' .
					'</tr>' .
					'<tr>' .
					'<td>'.LIBELLE_1.'</td>' .
					'<td><input type="text" name="requiredLien" value="'.$lien.'"/></td>' .
					'</tr>' .
					'<tr>' .
					'<td>'.LIBELLE_2.'</td>' .
					'<td><textarea name="requiredCommentaire" onKeyDown="CheckLen_1(this)" onKeyUp="CheckLen_1(this)" rows="2" cols="90">'.$texte.'</textarea><br />Il vous reste <input type="text" name="abd_1" size="3" value="200" style="width: 30px; background-color: transparent; border: none; color: red;">caractres</td>' .
					'</tr>' .
					'<tr>' .
					'<td colspan="2" style="text-align:center;"><input type="submit" value="'.SUBMIT.'"/></td>' .
					'</tr>' .
					'</table>' .
					'</div>' .
					'</form>';
	
	return $formulaire;
}

function formulairePreview($lien, $texte, $action, $type, $email, $anchor){
	
	$preview = '<div id="annonce_pub_preview">' .
				'<ul>' .
				'<li class="anchor"><a href="'.$lien.'" target="_blank">'.$anchor.'</a></li>' .
				'<li class="texte">'.$texte.'</li>' .
				'<li class="lien_ca"><a href="'.HTTP_HOST.'/'.FILENAME_PUBLICITE.'">votre pub ici</a></li>' .
				'</ul>' .
				'</div>';
	
	return $preview;
}

function boutonPaiementPAYPAL($url_paypal, $email, $nom_article, $prix, $url_ok, $url_erreur, $devise){
	echo '<form action="'.$url_paypal.'" method="post">'."\n"
		.'<input type="hidden" name="cmd" value="_xclick">'."\n"
		.'<input type="hidden" name="business" value="'.$email.'">'."\n"
		.'<input type="hidden" name="item_name" value="'.$nom_article.'">'."\n"
		.'<input type="hidden" name="amount" value="'.$prix.'">'."\n"
		.'<input type="hidden" name="no_shipping" value="1">'."\n"
		.'<input type="hidden" name="return" value="'.$url_ok.'">'."\n"
		.'<input type="hidden" name="cancel_return" value="'.$url_erreur.'">'."\n"
		.'<input type="hidden" name="no_note" value="1">'."\n"
		.'<input type="hidden" name="currency_code" value="'.$devise.'">'."\n"
		.'<input type="hidden" name="lc" value="FR">'."\n"
		.'<input type="hidden" name="bn" value="PP-BuyNowBF">'."\n"
		.'<input type="image" src="https://www.paypal.com/fr_FR/FR/i/btn/x-click-but5.gif" border="0" name="submit" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et scurise">'."\n"
		.'<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">'."\n"
		.'</form>'."\n";
}

function afficherAudio($fichier, $extenion){
	
	if(strtolower($extenion) == "mp3"){
		//FORMAT MP3
		$audio = '<object ' .
				'type="application/x-shockwave-flash"' .
				' data="dewplayer.swf?son='.HTTP_AUDIO.$fichier.'" width="200" height="20">' .
				' <param name="movie" value="dewplayer.swf?son='.HTTP_AUDIO.$fichier.'" />' .
				' </object>';
	}
	elseif(strtolower($extenion) == "wav"){
		//FORMAT WAV
		$audio = "<a href=\"".HTTP_AUDIO.$fichier."\" target=\"popup\" onclick=\"window.open('','popup','width=200,height=100,left=10,top=10,scrollbars=100')\">Ecoutez</a>";
	}
	elseif(strtolower($extenion) == "wma"){
		//FORMAT WMA
		$audio = '<object ' .
				'id="video1" ' .
				'width=160 ' .
				'height=162 ' .
				'classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95" ' .
				'codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715" ' .
				'standby="Loading..." ' .
				'type="application/x-oleobject">' .
				'<param name="'.HTTP_AUDIO.$fichier.'" ' .
				'value="'.HTTP_AUDIO.$fichier.'">' .
				'<param name="AutoStart" value="false">' .
				'<embed type="application/x-mplayer2" ' .
				'pluginspage = "http://www.microsoft.com/Windows/MediaPlayer/" ' .
				'src="'.HTTP_AUDIO.$fichier.'" ' .
				'name="video1" ' .
				'width=160 height=162 AutoStart=false>' .
				'</embed>' .
				'</object>';
	}
	else{
		//ERREUR...IMAGE PAR DEFAUT
		$audio = '';
	}
	return $audio;
}

function afficherVideo($fichier, $extenion,$repertoire){
	
	if(strtolower($extenion) == "avi" OR strtolower($extenion) == "mpg" OR strtolower($extenion) == "wmv"){
		$video = "<table border='0' cellpadding='0' align='center'>" .
				"<tr><td>" .
				"<OBJECT id='mediaPlayer' width='300' height='265'" .
				"classid='CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95'" .
				"codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701'" .
				"standby='Loading Microsoft Windows Media Player components...' type='application/x-oleobject'>" .
				"<param name='fileName' value='".HTTP_VIDEO.$repertoire.$fichier."'>" .
				"<param name='animationatStart' value='true'>" .
				"<param name='transparentatStart' value='true'>" .
				"<param name='autoStart' value='true'>" .
				"<param name='showControls' value='true'>" .
				"<param name='loop' value='true'>" .
				"<EMBED type='application/x-mplayer2'" .
				"pluginspage='http://microsoft.com/windows/mediaplayer/en/download/'" .
				"id='mediaPlayer' name='mediaPlayer' displaysize='4' autosize='-1'" .
				"bgcolor='darkblue' showcontrols='true' showtracker='-1'" .
				"showdisplay='0' showstatusbar='-1' videoborder3d='-1' width='300' height='265'" .
				"src='".HTTP_VIDEO.$repertoire.$fichier."' autostart='true' designtimesp='5311' loop='true'>" .
				"</EMBED>" .
				"</OBJECT>" .
				"</td></tr>" .
				"<tr><td align='center'>" .
				"<a href='".HTTP_VIDEO.$repertoire.$fichier."' style='font-size: 85%;' target='_blank'>Launch in external player</a>" .
				"</td></tr>" .
				"</table>";
	}
	elseif(strtolower($extenion) == "mov"){
		//FORMAT MOV
		$video = '<EMBED ' ."\n".
				'TYPE="video/quicktime" ' ."\n".
				'SRC="'.HTTP_VIDEO.$repertoire.$fichier.'?embed" ' ."\n".
				'WIDTH="300" HEIGHT="250" ' ."\n".
				'AUTOPLAY="true" ' ."\n".
				'CONTROLLER="false">' ."\n".
				'</EMBED>';
	}
	elseif(strtolower($extenion) == "flv"){
		//FORMAT FLV
		$video = '<object ' ."\n".
				'type="application/x-shockwave-flash" ' ."\n".
				'width="300" height="250" ' ."\n".
				'wmode="transparent" ' ."\n".
				'data="flvplayer.swf?file='.HTTP_VIDEO.$repertoire.$fichier.'">' ."\n".
				'<param name="movie" ' ."\n".
				'value="flvplayer.swf?file='.HTTP_VIDEO.$repertoire.$fichier.'" />' ."\n".
				'<param name="wmode" value="transparent" />' ."\n".
				'</object>';
	}
	else{
		//ERREUR...IMAGE PAR DEFAUT
		$video = '';
	}
	return $video;
}

function afficherIconeDrapeau($langue){
	if($langue == "en"){
		$drapeau = '<img src="'.DRAPEAU_ANGLAIS.'" alt="'.ATTRIBUT_ALT.'"/>';
	}
	elseif($langue == "es"){
		$drapeau = '<img src="'.DRAPEAU_ESPAGNOL.'" alt="'.ATTRIBUT_ALT.'"/>';
	}
	elseif($langue == "de"){
		$drapeau = '<img src="'.DRAPEAU_ALLEMAND.'" alt="'.ATTRIBUT_ALT.'"/>';
	}
	else{
		$drapeau = '<img src="'.DRAPEAU_FRANCAIS.'" alt="'.ATTRIBUT_ALT.'"/>';
	}
	return $drapeau;
}

function getDrapeau($langue){
	$drapeau = '<img src="'.HTTP_IMAGE.'large_flag_'.$langue.'.png" alt="'.ATTRIBUT_ALT.'"/>';
	return $drapeau;
}

function envoyerUnMail($destinataire, $entete, $contenu, $expediteur, $reponse){
	$codehtml=  '<html>' .
			'<head>' .
			'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
			'</head>' .
			'<body>' .
			''.$contenu.'' .
			'</body>' .
			'</html>';
				
			mail($destinataire, $entete, $codehtml,"From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");	
}

function preview($variable){
	if(empty($variable)){
		$result = "Dvelopper votre newsletter ici...<br />Nous vous conseillons vivement de ne pas alourdir votre newsletter avec des images.<br />En effet, 99% des boites de messagerie : yahoo, gmail, orange, hotmail, etc... bloquent systmatiquement les images et considrent alors votre newsletter comme du spam !!";
	}
	else{
		$result = $variable;
	}
	return $result;
}

function envoiNewsletter($email, $newsletter){
									
	$destinataire = $email;
	$expediteur   = MAIL_CORRESPONDANCE;
	$reponse      = $expediteur;
	
	$codehtml = "<html><body>".$newsletter."</body></html>";
				
	mail($destinataire,"NEWSLETTER",$codehtml,"From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
}

function creationRepertoireStockage($separateur){
	$rep_mini = "".REPERTOIRE_IMAGE_MINIATURE.$separateur."";
	$rep_redi = "".REPERTOIRE_IMAGE_REDIMENSIONNEE.$separateur."";
	$rep_orig = "".REPERTOIRE_IMAGE_ORIGINAL.$separateur."";

	if (file_exists($rep_mini) AND file_exists($rep_redi) AND file_exists($rep_orig)) {
	    //ON NE FAIT RIEN... DEJA EXISTANT !
	} else {
	    //CREATION DES FICHIERS SUR LE SERVEUR
	    mkdir($rep_mini, 0777, true);
		
	    mkdir($rep_redi, 0777, true);
		
	    mkdir($rep_orig, 0777, true);
	}
}

function creerUnRepertoire($rep){
	if (file_exists($rep)) {
	    //ON NE FAIT RIEN... DEJA EXISTANT !
	} else {
	    //CREATION DES FICHIERS SUR LE SERVEUR
	    mkdir($rep, 0777, true);
	}
}

function libelleImage($pseudo_client,$num){
	$libelle = $pseudo_client.'_'.$num;
	return $libelle;
}

function libelleGalerie($pseudo_client,$num){
	$libelle = $pseudo_client.'_galerie_'.$num;
	return $libelle;
}

function retrecirMessageTropLong($chaine){
	//Filtrer les mots trop long....
	$array = array();
	$pos = strpos($chaine, ' ');
	if ($pos === false) {
	    $long = strlen($chaine);
	    if($long < 40){
	    	$ma_chaine = $chaine;
	    	//Filtrage des adresses emails
	    	$controle = conformEmail($ma_chaine);
	    	if($controle == 1){
	    		//Adresse email...
	    		$retour = str_replace($ma_chaine, FILTRE_EMAIL, $ma_chaine);
	    	}
	    	else{
	    		//Non email...
	    		$retour = $chaine;
	    	}
	    }
	    else{
	    	$ma_chaine = substr($chaine, 0, 15);
	    	//Filtrage des adresses emails
	    	$controle = conformEmail($ma_chaine);
	    	if($controle == 1){
	    		//Adresse email...
	    		$retour = str_replace($ma_chaine, FILTRE_EMAIL, $ma_chaine);
	    	}
	    	else{
	    		//Non email...
	    		$retour = $ma_chaine;
	    	}
	    }
	}
	else {
	    $pieces = explode(" ", $chaine);
	    foreach($pieces as $cle){
			$longueur = strlen($cle);
		    if($longueur < 40){
		    	//Filtrage des adresses emails
		    	$controle = conformEmail($cle);
		    	if($controle == 1){
		    		//Adresse email...
		    		$element = str_replace($cle, FILTRE_EMAIL, $cle);
		    	}
		    	else{
		    		//Non email...
		    		$element = $cle;
		    	}
		    	array_push($array, $element);
		    }
		    else{
		    	$rest = substr($cle, 0, 15);
		    	//Filtrage des adresses emails
		    	$controle = conformEmail($rest);
		    	if($controle == 1){
		    		//Adresse email...
		    		$element = str_replace($rest, FILTRE_EMAIL, $rest);
		    	}
		    	else{
		    		//Non email...
		    		$element = $rest;
		    	}
		    	array_push($array, $element);
		    }
		}
		$retour = implode(" ", $array);
	}
	
	return $retour;
}

function connexionON(){
	?>
	<script language="javascript">
		new Ajax.PeriodicalUpdater(
		    'maj',
		    '<?php echo HTTP_SERVEUR.'interface/maj.php'; ?>',
		    {
		        frequency: ,
		        decay:1
		    }
		);
    </script>
	<?php
}

function afficherCompteurMessages($connexion, $recus, $envoyes){
	if(empty($connexion)){
		echo TCHAT_MESSAGES_NON_LUS.'<strong>0</strong>'.TCHAT_MESSAGES_NON_LUS_ENVOYES.'<strong>0</strong>';
	}
	else{
		echo TCHAT_MESSAGES_NON_LUS.'<strong>'.$recus.'</strong>'.TCHAT_MESSAGES_NON_LUS_ENVOYES.'<strong>'.$envoyes.'</strong>';			
	}
}

function afficherActionAjax($connexion, $elementID, $page, $interval){
	if(empty($connexion)){
		//ON NE FAIT RIEN
	}
	else{
		?>
		<script language="javascript">
			new Ajax.PeriodicalUpdater(
			    '<?php echo $elementID; ?>',
			    '<?php echo $page; ?>',
			    {
			        frequency: <?php echo $interval; ?>,
			        decay:1
			    }
			);
	    </script>
	<?php
	}
}

function scriptJsMessageAudio($fichier_flash){
	?>
<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "575",
		"height", "250",
		"align", "middle",
		"id", "message_audio",
		"quality", "high",
		"bgcolor", "#869ca7",
		"name", "message_audio",
		"allowScriptAccess","sameDomain",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer",
		"flashVars", "<?php echo $fichier_flash; ?>"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "message_audio",
			"width", "575",
			"height", "250",
			"align", "middle",
			"id", "message_audio",
			"quality", "high",
			"bgcolor", "#869ca7",
			"name", "message_audio",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer",
			"flashVars", "<?php echo $fichier_flash; ?>"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>	
	<?php
}

function scriptFlashMessageAudio($fichier_flash){
	?>
<noscript>
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="message_audio" width="575" height="250"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="message_audio.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#869ca7" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashVars" value="<?php echo $fichier_flash; ?>" />
			<embed src="message_audio.swf" quality="high" bgcolor="#869ca7"
				width="575" height="250" name="message_audio" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				flashVars="<?php echo $fichier_flash; ?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
	<?php
}

function scriptJsMessageVideo($chaine){
	?>
<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "675",
		"height", "250",
		"align", "middle",
		"id", "message_video",
		"quality", "high",
		"bgcolor", "#869ca7",
		"name", "message_video",
		"allowScriptAccess","sameDomain",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer",
		"flashVars", "<?php echo $chaine; ?>"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "message_video",
			"width", "675",
			"height", "250",
			"align", "middle",
			"id", "message_video",
			"quality", "high",
			"bgcolor", "#869ca7",
			"name", "message_video",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer",
			"flashVars", "<?php echo $chaine; ?>"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>
	<?php
}

function scriptFlashMessageVideo($chaine){
	?>
<noscript>
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="message_video" width="675" height="250"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="message_video.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#869ca7" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashVars" value="<?php echo $chaine; ?>" />
			<embed src="message_video.swf" quality="high" bgcolor="#869ca7"
				width="675" height="250" name="message_video" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				flashVars="<?php echo $chaine; ?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
	<?php
}

function creationRepertoireStockageRED5($separateur){
	$rep_red5 = "".REPERTOIRE_WEBAPPS_RED5.$separateur."";
	
	if (file_exists($rep_red5)) {
	    //ON NE FAIT RIEN... DEJA EXISTANT !
	} else {
	    //CREATION DES FICHIERS SUR LE SERVEUR
	    mkdir($rep_red5, 0777, true);
	}
}

function scriptJsLireAudio($fichier){
?>
<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "675",
		"height", "250",
		"align", "middle",
		"id", "lire_audio",
		"quality", "high",
		"bgcolor", "#869ca7",
		"name", "lire_audio",
		"allowScriptAccess","sameDomain",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer",
		"flashVars", "<?php echo $fichier; ?>"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "lire_audio",
			"width", "675",
			"height", "250",
			"align", "middle",
			"id", "lire_audio",
			"quality", "high",
			"bgcolor", "#869ca7",
			"name", "lire_audio",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer",
			"flashVars", "<?php echo $fichier; ?>"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>
<?php	
}

function scriptFlashLireAudio($fichier){
?>
<noscript>
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="lire_audio" width="675" height="250"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="lire_audio.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#869ca7" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashVars" value="<?php echo $fichier; ?>" />
			<embed src="lire_audio.swf" quality="high" bgcolor="#869ca7"
				width="675" height="250" name="lire_audio" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				flashVars="<?php echo $fichier; ?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
<?php	
}

function scriptJsLireVideo($fichier){
	?>
	<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "675",
		"height", "250",
		"align", "middle",
		"id", "lire_video",
		"quality", "high",
		"bgcolor", "#869ca7",
		"name", "lire_video",
		"allowScriptAccess","sameDomain",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer",
		"flashVars", "<?php echo $fichier; ?>"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "lire_video",
			"width", "675",
			"height", "250",
			"align", "middle",
			"id", "lire_video",
			"quality", "high",
			"bgcolor", "#869ca7",
			"name", "lire_video",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer",
			"flashVars", "<?php echo $fichier; ?>"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>
	<?php
}

function scriptFlashLireVideo($fichier){
	?>
<noscript>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="lire_video" width="675" height="250"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="lire_video.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#869ca7" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashVars" value="<?php echo $fichier; ?>" />
			<embed src="lire_video.swf" quality="high" bgcolor="#869ca7"
				width="675" height="250" name="lire_video" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				flashVars="<?php echo $fichier; ?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
	<?php
}

function scriptJsProfilVideo($chaine){
	?>
<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "250",
		"height", "250",
		"align", "middle",
		"id", "lire_video_profil",
		"quality", "high",
		"bgcolor", "#cccccc",
		"name", "lire_video_profil",
		"allowScriptAccess","sameDomain",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer",
		"flashVars", "<?php echo $chaine; ?>"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "lire_video_profil",
			"width", "250",
			"height", "250",
			"align", "middle",
			"id", "lire_video_profil",
			"quality", "high",
			"bgcolor", "#cccccc",
			"name", "lire_video_profil",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer",
			"flashVars", "<?php echo $chaine; ?>"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>
	<?php
}

function scriptFlashProfilVideo($chaine){
	?>
<noscript>
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="lire_video_profil" width="250" height="250"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="lire_video_profil.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#cccccc" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashVars" value="<?php echo $chaine; ?>" />
			<embed src="lire_video_profil.swf" quality="high" bgcolor="#cccccc"
				width="250" height="250" name="lire_video_profil" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				flashVars="<?php echo $chaine; ?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
	<?php
}

function scriptJsProfilAudio($chaine){
	?>
<script language="JavaScript" type="text/javascript">
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "250",
		"height", "250",
		"align", "middle",
		"id", "main",
		"quality", "high",
		"bgcolor", "#869ca7",
		"name", "main",
		"allowScriptAccess","sameDomain",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer",
		"flashVars", "<?php echo $chaine; ?>"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "main",
			"width", "250",
			"height", "250",
			"align", "middle",
			"id", "main",
			"quality", "high",
			"bgcolor", "#869ca7",
			"name", "main",
			"allowScriptAccess","sameDomain",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer",
			"flashVars", "<?php echo $chaine; ?>"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
// -->
</script>
	<?php
}

function scriptFlashProfilAudio($chaine){
	?>
<noscript>
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="main" width="250" height="250"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="main.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#869ca7" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashVars" value="<?php echo $chaine; ?>" />
			<embed src="main.swf" quality="high" bgcolor="#869ca7"
				width="250" height="250" name="main" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				flashVars="<?php echo $chaine; ?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
</noscript>
	<?php
}

function controleExistanceFLV($fichier){
	if (file_exists($fichier)) {
	    $retour = 1;
	} else {
	    //Le fichier n'existe pas !!
	    $retour = 0;
	}
	return $retour;
}

function selectGestionAdmin($num, $select){
	if($num == $select){
		$resultat = "selected";
	}
	else{
		$resultat = "";
	}
	return $resultat; 
}

function modifierUrlsExotiques($urlExotique, $page,$type,$pays,$x,$y){
	//Transformer les urls exotiques
	$adresse = '/petites-annonces-echange-maison--'.$type.'-'.$pays.'.php';	
	$adresse1 = 'petites-annonces-echange-maison-'.$page.'-'.$type.'-'.$pays.'.php';
	$adresseExotique = '/petites-annonces-echange-maison.php?page='.$page.'&type='.$type.'&choix_pays='.$pays;
	$adresseExotique1 = '/petites-annonces-echange-maison.php?type='.$type.'&choix_pays='.$pays.'&x='.$x.'&y='.$y;
	
	if ($urlExotique == $adresseExotique OR $urlExotique == $adresseExotique1){
		header("Status: 301 Moved Permanently");
		header("Location: ./".$adresse1);
		exit();
	}
	elseif ($urlExotique == $adresse){
		header("Status: 301 Moved Permanently");
		header("Location: ./".$adresse1);
		exit();
	}
	else{
		
	}
}

function ajoutCouch($VariableEchange, $ChoixEchange){
	if($VariableEchange == 7 OR $VariableEchange == 8){
		if(LANGUAGE == "en"){
			$mot =  "Free holidays accomodation ".$ChoixEchange;
		}
		elseif(LANGUAGE == "es"){
			$mot =  "Alojamiento vacaciones gratis ".$ChoixEchange;
		}
		else{
			$mot =  "Hbergement vacances gratuites ".$ChoixEchange;
		}
	}
	else{
		$mot =  $ChoixEchange;
	}
	return $mot;
}

function afficherEspaceStockage($compteur){
	if($compteur <= 100){
		$pourcentage = $compteur;
	}
	else{
		$pourcentage = 100;
	}
	?>
	<style type="text/css">
	#wrapper {
		text-align: left;
	}
	/*PROGRESS BAR CSS*/
	#progress-bar {
		background: url(../images/percentage-bg.png) no-repeat left center;
		width: 316px;
		height: 39px;
		margin: 0 auto;
	}
	#progress-level {
		background: url(../images/progress.png) no-repeat left center;
		width: <?php echo $pourcentage; ?>%;
		height: 39px;
	}
	</style>
	<?php 
}

function afficherLimiteStockage($compteur){
	if($compteur <= 100){
		$pourcentage = $compteur;
	}
	else{
		$pourcentage = 100;
	}
	?>
	<style type="text/css">
	#wrapper {
		text-align: left;
	}
	/*PROGRESS BAR CSS*/
	#progress-bar {
		background: url(../images/bg_stockage.png) no-repeat left center;
		width: 200px;
		height: 39px;
		margin: 0 auto;
	}
	#progress-level {
		background: url(../images/stockage.png) no-repeat left center;
		width: <?php echo $pourcentage; ?>%;
		height: 39px;
	}
	</style>
	<?php 
}

function effacerEmail($chaine){
	//Filtrer les emails....
	$array = array();
	$pos = strpos($chaine, ' ');
	if ($pos === false) {
	    $controle = conformEmail($chaine);
	    if($controle == 1){
	    	//Adresse email...
	    	$retour = str_replace($chaine, FILTRE_EMAIL, $chaine);
	    }
	    else{
	    	//Non email...
	    	$retour = $chaine;
	    }
	}
	else {
	    $pieces = explode(" ", $chaine);
	    foreach($pieces as $cle){
			$controle = conformEmail($cle);
		    if($controle == 1){
		    	//Adresse email...
		    	$element = str_replace($cle, FILTRE_EMAIL, $cle);
		    	array_push($array,$element);
		    }
		    else{
		    	//Non email...
		    	array_push($array,$cle);
		    }
		}
		$retour = implode(" ", $array);
	}
	return $retour;
}

function filtrageMessage($msg){
	$msg_1 = textareaFormater($msg);
	$mon_msg = retrecirMessageTropLong($msg_1);
	return $mon_msg;
}

function fenetrePopUp($url,$height,$width,$anchor){
	$js = "<a href='javascript:popUp(\"".$url."\",".$height.",".$width.",\"menubar=no,scrollbars=no,statusbar=no\")'>".$anchor."</a>";
	return $js;
}

function nonCommunique($donnee){
	if($donnee == ""){
	   	$element = NON_COMMUNIQUE;
	}
	else{
	  	$element = $donnee;
	}
	return $element;
}

function supprimerImage($identifiant,$libelle,$extension){
	$original = REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($identifiant).$libelle.'.'.$extension;
	$redimensionnee = REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($identifiant).$libelle.'.'.$extension;
	$miniature = REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($identifiant).$libelle.'.'.$extension;
	
	if(file_exists($original)){
		unlink($original);
		unlink($redimensionnee);
		unlink($miniature);
	}
}

function scriptAlloPass1Mois($libelle){
	?>
<table>
	<tr>
		<td colspan="2" style="font-weight:bolder;font-size:14px;text-align:center;"><?php echo $libelle; ?></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="149" height="80">
			 <tr>
			  <td width="149" height="80">
			   <form name="cben" action="https://payment.allopass.com/subscription/subscribe.apu" method="POST" target="DisplaySub">
			    <input type="hidden" name="idd" value="485681">
			    <input type="hidden" name="ids" value="177489">
			    <input type="hidden" name="lang" value="fr">
			       <input type="image" src="http://www.allopass.com/imgweb/script/fr/cb_subscribe_os.gif" alt="Ticket d'accs" onClick="window.open('','DisplaySub','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=600,height=570');" border = 0>
			      </form>
			  </td>
			 </tr>
			</table>
		</td>
		<td>
			<form action="http://payment.allopass.com/subscription/access.apu" method="POST">
			 <input type="hidden" name="idd" value="485681">
			 <input type="hidden" name="ids" value="177489">
			 <input type="hidden" name="lang" value="fr">
			 <table border="0" cellpadding="0" cellspacing="0" width="300">
			  <tr>
			   <td width="300" height="68" colspan="3">
			         <img src="http://payment.allopass.com/imgweb/script/fr/cb_os_top.gif" alt="">
			       </td>
			  </tr>
			  <tr>
			   <td width="157" valign="middle" bgcolor="White">
			    <font face="Arial,Helvetica" color="Black" size="11" Style="font-size: 12px;">
			     <b>Entrez votre ticket d'accs</b>
			    </font>
			   </td>
			   <td width="80" bgcolor="White">
			    <input type="text" size="10" maxlength="10" value="Ticket" name="code" onFocus="if (this.form.code.value=='Ticket') this.form.code.value=''" style="BACKGROUND-COLOR: #E7E7E7; BORDER-BOTTOM: #000080 1px solid; BORDER-LEFT: #000080 1px solid; BORDER-RIGHT: #000080 1px solid; BORDER-TOP: #000080 1px solid; COLOR: #000080; CURSOR: text; FONT-FAMILY: Arial; FONT-SIZE: 10pt; FONT-WEIGHT:bold; LETTER-SPACING: normal; WIDTH:85; TEXT-ALIGN=center;">
			   </td>
			   <td width="58" align="center" bgcolor="White">
			    <input type="button" name="APsub" value="" onClick="this.form.submit(); this.form.APsub.disabled=true;" style="border:0px;margin:0px;padding:0px;width:48px; height:18px; background:url('http://www.allopass.com/img/bt_ok.png');">
			   </td>
			  </tr>
			  <tr><td colspan="3" width="300" height="13"><img src="http://payment.allopass.com/img/cb_bot.gif" alt=""></td></tr>
			 </table>
			</form>
		</td>
	</tr>
</table>	
	<?php
}

function scriptAlloPass3Mois($libelle){
	?>
<table>
	<tr>
		<td colspan="2" style="font-weight:bolder;font-size:14px;text-align:center;"><?php echo $libelle; ?></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="149" height="80">
			 <tr>
			  <td width="149" height="80">
			   <form name="cben" action="https://payment.allopass.com/subscription/subscribe.apu" method="POST" target="DisplaySub">
			    <input type="hidden" name="idd" value="485690">
			    <input type="hidden" name="ids" value="177489">
			    <input type="hidden" name="lang" value="fr">
			       <input type="image" src="http://www.allopass.com/imgweb/script/fr/cb_subscribe_os.gif" alt="Ticket d'accs" onClick="window.open('','DisplaySub','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=600,height=570');" border = 0>
			      </form>
			  </td>
			 </tr>
			</table>
		</td>
		<td>
			<form action="http://payment.allopass.com/subscription/access.apu" method="POST">
			 <input type="hidden" name="idd" value="485690">
			 <input type="hidden" name="ids" value="177489">
			 <input type="hidden" name="lang" value="fr">
			 <table border="0" cellpadding="0" cellspacing="0" width="300">
			  <tr>
			   <td width="300" height="68" colspan="3">
			         <img src="http://payment.allopass.com/imgweb/script/fr/cb_os_top.gif" alt="">
			       </td>
			  </tr>
			  <tr>
			   <td width="157" valign="middle" bgcolor="White">
			    <font face="Arial,Helvetica" color="Black" size="11" Style="font-size: 12px;">
			     <b>Entrez votre ticket d'accs</b>
			    </font>
			   </td>
			   <td width="80" bgcolor="White">
			    <input type="text" size="10" maxlength="10" value="Ticket" name="code" onFocus="if (this.form.code.value=='Ticket') this.form.code.value=''" style="BACKGROUND-COLOR: #E7E7E7; BORDER-BOTTOM: #000080 1px solid; BORDER-LEFT: #000080 1px solid; BORDER-RIGHT: #000080 1px solid; BORDER-TOP: #000080 1px solid; COLOR: #000080; CURSOR: text; FONT-FAMILY: Arial; FONT-SIZE: 10pt; FONT-WEIGHT:bold; LETTER-SPACING: normal; WIDTH:85; TEXT-ALIGN=center;">
			   </td>
			   <td width="58" align="center" bgcolor="White">
			    <input type="button" name="APsub" value="" onClick="this.form.submit(); this.form.APsub.disabled=true;" style="border:0px;margin:0px;padding:0px;width:48px; height:18px; background:url('http://www.allopass.com/img/bt_ok.png');">
			   </td>
			  </tr>
			  <tr><td colspan="3" width="300" height="13"><img src="http://payment.allopass.com/img/cb_bot.gif" alt=""></td></tr>
			 </table>
			</form>
		</td>
	</tr>
</table>
	<?php
}

function scriptAlloPass6Mois($libelle){
	?>
<table>
	<tr>
		<td colspan="2" style="font-weight:bolder;font-size:14px;text-align:center;"><?php echo $libelle; ?></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="149" height="80">
			 <tr>
			  <td width="149" height="80">
			   <form name="cben" action="https://payment.allopass.com/subscription/subscribe.apu" method="POST" target="DisplaySub">
			    <input type="hidden" name="idd" value="485691">
			    <input type="hidden" name="ids" value="177489">
			    <input type="hidden" name="lang" value="fr">
			       <input type="image" src="http://www.allopass.com/imgweb/script/fr/cb_subscribe_os.gif" alt="Ticket d'accs" onClick="window.open('','DisplaySub','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=600,height=570');" border = 0>
			      </form>
			  </td>
			 </tr>
			</table>
		</td>
		<td>
			<form action="http://payment.allopass.com/subscription/access.apu" method="POST">
			 <input type="hidden" name="idd" value="485691">
			 <input type="hidden" name="ids" value="177489">
			 <input type="hidden" name="lang" value="fr">
			 <table border="0" cellpadding="0" cellspacing="0" width="300">
			  <tr>
			   <td width="300" height="68" colspan="3">
			         <img src="http://payment.allopass.com/imgweb/script/fr/cb_os_top.gif" alt="">
			       </td>
			  </tr>
			  <tr>
			   <td width="157" valign="middle" bgcolor="White">
			    <font face="Arial,Helvetica" color="Black" size="11" Style="font-size: 12px;">
			     <b>Entrez votre ticket d'accs</b>
			    </font>
			   </td>
			   <td width="80" bgcolor="White">
			    <input type="text" size="10" maxlength="10" value="Ticket" name="code" onFocus="if (this.form.code.value=='Ticket') this.form.code.value=''" style="BACKGROUND-COLOR: #E7E7E7; BORDER-BOTTOM: #000080 1px solid; BORDER-LEFT: #000080 1px solid; BORDER-RIGHT: #000080 1px solid; BORDER-TOP: #000080 1px solid; COLOR: #000080; CURSOR: text; FONT-FAMILY: Arial; FONT-SIZE: 10pt; FONT-WEIGHT:bold; LETTER-SPACING: normal; WIDTH:85; TEXT-ALIGN=center;">
			   </td>
			   <td width="58" align="center" bgcolor="White">
			    <input type="button" name="APsub" value="" onClick="this.form.submit(); this.form.APsub.disabled=true;" style="border:0px;margin:0px;padding:0px;width:48px; height:18px; background:url('http://www.allopass.com/img/bt_ok.png');">
			   </td>
			  </tr>
			  <tr><td colspan="3" width="300" height="13"><img src="http://payment.allopass.com/img/cb_bot.gif" alt=""></td></tr>
			 </table>
			</form>
		</td>
	</tr>
</table>
	<?php
}

function scriptAlloPass12Mois($libelle){
	?>
<table>
	<tr>
		<td colspan="2" style="font-weight:bolder;font-size:14px;text-align:center;"><?php echo $libelle; ?></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="149" height="80">
			 <tr>
			  <td width="149" height="80">
			   <form name="cben" action="https://payment.allopass.com/subscription/subscribe.apu" method="POST" target="DisplaySub">
			    <input type="hidden" name="idd" value="485691">
			    <input type="hidden" name="ids" value="177489">
			    <input type="hidden" name="lang" value="fr">
			       <input type="image" src="http://www.allopass.com/imgweb/script/fr/cb_subscribe_os.gif" alt="Ticket d'accs" onClick="window.open('','DisplaySub','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=600,height=570');" border = 0>
			      </form>
			  </td>
			 </tr>
			</table>
		</td>
		<td>
			<form action="http://payment.allopass.com/subscription/access.apu" method="POST">
			 <input type="hidden" name="idd" value="485691">
			 <input type="hidden" name="ids" value="177489">
			 <input type="hidden" name="lang" value="fr">
			 <table border="0" cellpadding="0" cellspacing="0" width="300">
			  <tr>
			   <td width="300" height="68" colspan="3">
			         <img src="http://payment.allopass.com/imgweb/script/fr/cb_os_top.gif" alt="">
			       </td>
			  </tr>
			  <tr>
			   <td width="157" valign="middle" bgcolor="White">
			    <font face="Arial,Helvetica" color="Black" size="11" Style="font-size: 12px;">
			     <b>Entrez votre ticket d'accs</b>
			    </font>
			   </td>
			   <td width="80" bgcolor="White">
			    <input type="text" size="10" maxlength="10" value="Ticket" name="code" onFocus="if (this.form.code.value=='Ticket') this.form.code.value=''" style="BACKGROUND-COLOR: #E7E7E7; BORDER-BOTTOM: #000080 1px solid; BORDER-LEFT: #000080 1px solid; BORDER-RIGHT: #000080 1px solid; BORDER-TOP: #000080 1px solid; COLOR: #000080; CURSOR: text; FONT-FAMILY: Arial; FONT-SIZE: 10pt; FONT-WEIGHT:bold; LETTER-SPACING: normal; WIDTH:85; TEXT-ALIGN=center;">
			   </td>
			   <td width="58" align="center" bgcolor="White">
			    <input type="button" name="APsub" value="" onClick="this.form.submit(); this.form.APsub.disabled=true;" style="border:0px;margin:0px;padding:0px;width:48px; height:18px; background:url('http://www.allopass.com/img/bt_ok.png');">
			   </td>
			  </tr>
			  <tr><td colspan="3" width="300" height="13"><img src="http://payment.allopass.com/img/cb_bot.gif" alt=""></td></tr>
			 </table>
			</form>
		</td>
	</tr>
</table>
	<?php
}

function bookmark(){
	?>
<!-- AddThis Button BEGIN -->
<a href="http://www.addthis.com/bookmark.php?v=250" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/sm-bookmark-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=kosmos"></script>
<!-- AddThis Button END -->
	<?php	
}

function modifierUrlsExotiquesAdvancedSearch($urlExotique, $page, $select_departement, $select_echange, $select_pays){
	//Transformer les urls exotiques
	$adresse = "/recherche-avancee1--".$select_departement."-".$select_echange."-".$select_pays.".php";	
	$adresse1 = "recherche-avancee1-".$page."-".$select_departement."-".$select_echange."-".$select_pays.".php";
	$adresseExotique = "/recherche-avancee1.php?select_departement=".$select_departement."&select_echange=".$select_echange."&select_pays=".$select_pays."";
	$adresseExotique1 = "/recherche-avancee1.php?page=".$page."&select_echange=".$select_echange."&select_pays=".$select_pays."&select_departement=".$select_departement."";
	
	if ($urlExotique == $adresseExotique OR $urlExotique == $adresseExotique1){
		header("Status: 301 Moved Permanently");
		header("Location: ./".$adresse1);
		exit();
	}
	elseif ($urlExotique == $adresse){
		header("Status: 301 Moved Permanently");
		header("Location: ./".$adresse1);
		exit();
	}
	else{
		
	}
}	

function parserXML($site){
	$fp = @fopen($site,"r");
	while(!feof($fp)){
		$raw .= @fgets($fp, 4096);
	} 
	fclose($fp);
	
	if( eregi("<item>(.*)</item>", $raw, $rawitems ) ){
 		$items = explode("<item>", $rawitems[0]);
 		for( $i = 0; $i < count($items)-1; $i++ ) {
  			eregi("<title>(.*)</title>",$items[$i+1], $title );
  			eregi("<link>(.*)</link>",$items[$i+1], $url );
  			eregi("<description>(.*)</description>",$items[$i+1], $description);
  			echo "<li style=\"padding-top:7px;\">"
  				."<a href='".$url[1]."' title='".utf8_decode($title[1])."'target=\"_blank_\">".utf8_decode($title[1])."</a><br />"
  				."".TEXTE_2." <em>".utf8_decode($description[1])."</em>"
  				."</li>";
 		}
	}
}

function getMenu($login){
	if($login){
		include(INCLUDE_MENU_ESPACE_MEMBRE);
	}
	else{
		include(INCLUDE_MENU);
	}
}

?>
