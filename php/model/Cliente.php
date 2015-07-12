<?php

include_once 'User.php';

//include_once 'CorsoDiLaurea.php'; Ordine

/**
 * Classe che rappresenta un Cliente
 * @author Davide Spano
 */
class Cliente extends User {

     /* Costruttore della classe
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Cliente);
        
    }



}

?>
