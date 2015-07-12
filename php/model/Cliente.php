<?php

include_once 'User.php';
<<<<<<< HEAD
<<<<<<< HEAD
//include_once 'CorsoDiLaurea.php'; Ordine

/**
 * Classe che rappresenta un Cliente
 * @author Davide Spano
=======
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
include_once 'CorsoDiLaurea.php';

/**
 * Classe che rappresenta un Cliente
 * @author Nicola Frongia
<<<<<<< HEAD
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
 */
class Cliente extends User {

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
     * Matricola dello studente
     * @var int
     */
    private $matricola;

    /**
     * CorsoDiLaurea a cui lo studente e' iscritto
     * @var CorsoDiLaurea cdl
     */
    private $cdl;

    /**
<<<<<<< HEAD
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
     * Costruttore della classe
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Cliente);
        
    }

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
    /**
     * Restituisce la matricola per lo studente
     * @return int
     */
    public function getMatricola() {
        return $this->matricola;
    }

    /**
     * Imposta un nuovo valore per la matricola dello studente
     * @param int $matricola la nuova matricola dello studente
     * @return boolean true se il nuovo valore della matricola e' ammissibile
     * ed e' stato impostato, false altrimenti
     */
    public function setMatricola($matricola) {
        $intVal = filter_var($matricola, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->matricola = $intVal;
            return true;
        }
        return false;
    }
    
    /**
     * Restituisce il CorsoDiLaurea a cui lo studente e' iscritto
     * @return CorsoDiLaurea
     */
    public function getCorsoDiLaurea() {
        return $this->cdl;
    }

    /**
     * Imposta il CorsoDiLaurea a cui lo studente e' iscritto
     * @param CorsoDiLaurea $cdl il nuovo CorsoDiLaurea
     */
    public function setCorsoDiLaurea(CorsoDiLaurea $cdl) {
        $this->cdl = $cdl;
    }
<<<<<<< HEAD
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1

}

?>
