<?php
set_time_limit(0);
//***********************************************
//          CLASS SERVEUR SOCKET
//***********************************************
//include("class.CompBDD.php");

class ServeurSocket{
	//Attributs
	var $socket = NULL;
	var $client = NULL;
	
	//Constructeur
	function ServeurSocket(){
		
	}
	
	function activerServeurSocket($adresse,$port){
	    echo"Lancement du serveur...\n";
	    $this->clients = array();
	
	    //Création de la socket
	    $this->socket = socket_create(AF_INET, SOCK_STREAM, 0);
	    //on lie la ressource sur laquelle le serveur va écouter
	    @socket_bind($this->socket, $adresse, $port) or die("Port déja utilise\n");
	    //On prépare l'écoute
	    socket_listen($this->socket);
	    //Boucle infinie, car le serveur ne doit s'arrêter que si on lui demande
	    while(true){
		   	//Le code se bloque jusqu'à ce qu'une nouvelle connexion client soit établie
		    $this->client = socket_accept($this->socket);
		    //Cette méthode lit les données reçues par un client, et les redistribue
		    $reception = socket_read($this->client , 255);
		    $pseudo = substr($reception , 0 , strpos($reception , ' '));
		    $message = substr($reception , strpos($reception , ' ')+1 , strlen($reception));
		    //Le message est "/connect", donc on stocke la socket dans le tableau
		    if($message == "/connect"){
			    $this->clients[$pseudo]=$this->client;
			    echo "$pseudo connected\n";
		    }
		    //C'est donc un message : ici on va envoyer le message vers chacun des clients
		    else{
			    echo "Pseudo: [".$pseudo."] Message recu: [".$message."] Message envoye a : ";
			    //On passe chaque case du tableau = chaque client, et on lui envoie le message
			    foreach( $this->clients as $nom_case => $socket_en_cours){
				    //Si ça ne marche pas, c'est qu'il est déconnecté
				    if(@socket_write($socket_en_cours, $reception, strlen($reception)) === false){
					    //La socket est enlevée du tableau
					    unset($this->clients[$nom_case]);
					    echo "[$nom_case s'est deconnecte]";
				    }
				    else{
				    	echo "$nom_case ";
				    }
			    }
			    //On ferme la socket qui vient de nous apporter un message
			    socket_close($this->client);
			    echo"\n";
			    flush();
		    }
	    }
    }
}
?>
