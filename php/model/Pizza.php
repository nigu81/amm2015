<?php
/**
 * Classe che rappresenta una Pizzeria
 * @author Davide Spano
 */
class Pizza {

    /**
     * Il nome della pizzeria
     * @var string 
     */
    private $nome;
    /**
     * L'identificatore della pizzeria
     * @var int
     */
    private $id;

    private $descrizione;
    
    private $prezzo;
    
    /**
     * Costrutture di una pizzeria
     */
    public function __construct() {
        
    }

    /**
     * Imposta il nome di una pizzeria
     * @param string $nome il nuovo nome per la pizzeria
     */
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    /**
     * Restituisce il nome di una pizzeria
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Restituisce l'identificatore della pizzeria
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Imposta un nuovo identificatore per la pizzeria
     * @param int $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Verifica se due oggetti Pizzeria sono logicamente uguali
     * @param Pizzeria $other l'oggetto con cui confrontare $this
     * @return boolean true se i due oggetti sono logicamente uguali, false 
     * altrimenti
     */
    public function setDescrizione($descrizione){
        $this->descrizione = $descrizione;
    }
    
    /**
     * Restituisce il nome di una pizzeria
     * @return string
     */
    public function getDescrizione() {
        return $this->descrizione;
    }
    
    public function setPrezzo($prezzo){
        $this->prezzo = $prezzo;
    }
    
    public function getPrezzo() {
        return $this->prezzo;
    }
    
    
    

}

?>
