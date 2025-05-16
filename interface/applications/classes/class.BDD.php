<?php
//***************************************************************
//            CLASS PRINCIPALE BASE DE DONNEES - VERSION MYSQLI
//***************************************************************

class BDD {
    // Attributs
    var $serveur ='localhost';
    var $login = 'root';
    var $motDePasse ='';
    var $baseDeDonnees = 'maison';
    var $connexion;

    // Constructeur
    function BDD() {
        $this->serveur;
        $this->login;
        $this->motDePasse;
        $this->baseDeDonnees;
        $this->connexion;
    }

    // Tester la connexion � la base de donn�es
    function testerConnexion() {
        $this->connexion = new mysqli($this->serveur, $this->login, $this->motDePasse, $this->baseDeDonnees);
        if ($this->connexion->connect_error) {
            echo "Erreur connexion MySQLi : " . $this->connexion->connect_error;
        }
    }

    // Ex�cuter une requ�te SQL
    function executerRequete($requete) {
        if (!$this->connexion) {
            $this->testerConnexion();
        }
        $resultat = $this->connexion->query($requete);
        if (!$resultat) {
            echo "Erreur MySQLi : " . $this->connexion->error;
        }
        return $resultat;
    }

    // Fermer la connexion
    function fermerConnexion() {
        if ($this->connexion) {
            $this->connexion->close();
        }
    }
}
?>
