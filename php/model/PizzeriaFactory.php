<?php

include_once 'Pizzeria.php';
include_once 'Db.php';

/**
 * Classe per creare oggetti di tipo Pizzeria
 *
 * @author Davide Spano
 */
class PizzeriaFactory {
    
    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare Pizzerie
     * @return \PizzeriaFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new PizzeriaFactory();
        }
        
        return self::$singleton;
    }
    
    /**
     * Restituisce la lista di tutti i Pizzerie
     * @return array|\Pizzeria
     */
    public function &getPizzerie(){
        
        $dip = array();
        $query = "select * from pizzerie";
        $mysqli = Db::getInstance()->connectDb();
        if(!isset($mysqli)){
            error_log("[getPizzerie] impossibile inizializzare il database");
            $mysqli->close();
            return $dip;
        }
        $result = $mysqli->query($query);
        if($mysqli->errno > 0){
            error_log("[getPizzerie] impossibile eseguire la query");
            $mysqli->close();
            return $dip;
        }
        
        while($row = $result->fetch_array()){
            $dip[] = self::getPizzeria($row);
        }
        
        $mysqli->close();
        return $dip;
    }
    
    /**
     * Crea un pizzeria da una riga di DB
     * @param type $row
     */
    public function creaDaArray($row){
        $dip = new Pizzeria();
        $dip->setId($row['pizzerie_id']);
        $dip->setNome($row['pizzerie_nome']);
        return $dip;
    }
    
    /**
     * Crea un oggetto di tipo Pizzeria a partire da una riga del DB
     * @param type $row
     * @return \Pizzeria
     */
    private function getPizzeria($row){
        $pizzeria = new Pizzeria();
        $pizzeria->setId($row['id']);
        $pizzeria->setNome($row['nome']);
        return $pizzeria;
    }
    
   
}

?>
