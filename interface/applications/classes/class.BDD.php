<?php
//***************************************************************
//            CLASS PRINCIPALE BASE DE DONNEES - VERSION MYSQLI
//***************************************************************

class BDD {
    // Attributs
    var $serveur ='db5017827985.hosting-data.io';
    var $login = 'dbu885281';
    var $motDePasse ='aWcDSb9twH6>6Q-55';
    var $baseDeDonnees = 'dbs14218084';
    var $connexion;

    // Constructeur
    function BDD() {
        $this->serveur;
        $this->login;
        $this->motDePasse;
        $this->baseDeDonnees;
        $this->connexion;
    }

    // Tester la connexion à la base de données
    function testerConnexion() {
        $this->connexion = new mysqli($this->serveur, $this->login, $this->motDePasse, $this->baseDeDonnees);
        if ($this->connexion->connect_error) {
            echo "Erreur connexion MySQLi : " . $this->connexion->connect_error;
        }
    }

    // Exécuter une requête SQL
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
