<?php

include_once 'User.php';
include_once 'Pizzeria.php';

/**
 * Classe che rappresenta un Gestore
 *
 * @author Davide Spano
 */
class Gestore extends User {

    /**
     * Il Dipartimento di afferenza
     * @var Dipartimento $dipartimento 
     */
    private $pizzeria;
    /**
     * Descrizione dell'orario di ricevimento
     * @var string
     */
    private $ricevimento;

    /**
     * Costruttore
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Gestore);
    }

    /**
     * Restituisce il Dipartimento di afferenza
     * @return Dipartimento
     */
    public function getPizzeria() {
        return $this->pizzeria;
    }

    /**
     * Imposta un nuovo Dipartimento di afferenza
     * @param Dipartimento $dipartimento il nuovo Dipartimento di afferenza
     */
    public function setPizzeria(Pizzeria $pizzeria) {
        $this->pizzeria = $pizzeria;
    }

}

?>
