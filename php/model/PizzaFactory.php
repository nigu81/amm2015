<?php

include_once 'Pizza.php';
include_once 'Db.php';

/**
 * Classe per creare oggetti di tipo Pizzeria
 *
 * @author Davide Spano
 */
class PizzaFactory {
    
    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare Pizzerie
     * @return \PizzeriaFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new PizzaFactory();
        }
        
        return self::$singleton;
    }
    
    /**
     * Restituisce la lista di tutti i Pizzerie
     * @return array|\Pizzeria
     */
    public function &elencoPizze(){
        
        $pizze = array();
        $query = "select 
                    id pizza_id,
                    nome pizza_nome, 
                    descrizione pizza_descrizione,
                    prezzo pizza_prezzo
                  from 
                     pizze";
        $mysqli = Db::getInstance()->connectDb();
        if(!isset($mysqli)){
            error_log("[getPizzerie] impossibile inizializzare il database");
            $mysqli->close();
            return $pizze;
        }
        
        
        $result = $mysqli->query($query);
        if($mysqli->errno > 0){
            error_log("[getPizzerie] impossibile eseguire la query");
            $mysqli->close();
            return $pizze;
        }
        
        while($row = $result->fetch_array()){
            $pizze[] = self::getPizze($row);
        }
        
        
        
        $mysqli->close();
        return $pizze;
    }
    
    /**
     * Crea un pizzeria da una riga di DB
     * @param type $row
     */
   /* public function creaDaArray($row){
        $pizzeria = new Pizzeria();
        $pizzeria->setId($row['pizzeria_id']);
        $pizzeria->setNome($row['pizzeria_nome']);
        return $pizzeria;
    }
    */
    /**
     * Crea un oggetto di tipo Pizzeria a partire da una riga del DB
     * @param type $row
     * @return \Pizzeria
     */
    private function getPizze($row){
        $pizza = new Pizza();
        
        $pizza->setId($row['pizza_id']);
        $pizza->setNome($row['pizza_nome']);
        $pizza->setDescrizione($row['pizza_descrizione']);
        $pizza->setPrezzo($row['pizza_prezzo']);
        return $pizza;
    }
    
   
}

?>
