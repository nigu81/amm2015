<?php

include_once 'DettaglioOrdine.php';
include_once 'UserFactory.php';
include_once 'Ordine.php';
include_once 'OrdineFactory';
include_once 'Cliente.php';
include_once 'User.php';


class DettaglioOrdineFactory {
	
	private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare appelli
     * @return \AppelloFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new DettaglioOrdineFactory();
        }
        
        return self::$singleton;
    }
	
	public function cercaOrdinePerId($ordine_id){
        $pizze = array();
        $query ="SELECT 
                ordini_clienti.ordine_id id,
            	pizze.nome pizza,
                pizze.descrizione ingredienti,
                ordini_clienti.qta qta

                FROM ordini_clienti
                	
                JOIN ordini ON
                ordini_clienti.ordine_id = ordini.id
                
                JOIN pizze ON
                ordini_clienti.pizza_id = pizze.id
                
                WHERE ordini.id = ?";
    }
    
    $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaDettaglioOrdinePerId] impossibile inizializzare il database");
            $mysqli->close();
            return $pizze;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaDettaglioOrdinePerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $pizze;
        }

        
        if (!$stmt->bind_param('i', $ordine_id)) {
            error_log("[cercaDettaglioOrdinePerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $pizze;
        }
        
        $ordini =  self::caricaDettaglioOrdineDaStmt($stmt);
        foreach($pizze as $pizza){
            self::caricaIscritti($pizza);
        }
        if(count($pizze > 0)){
            $mysqli->close();
            return $pizze[0];
        }else{
            $mysqli->close();
            return null;
        }
        
        private function &caricaDettaglioOrdineDaStmt(mysqli_stmt $stmt){
        $pizze = array();
         if (!$stmt->execute()) {
            error_log("[caricaDettaglioOrdineDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['id'],
                $row['pizza'],
                $row['ingredienti'],
                $row['qta']);
        if (!$bind) {
            error_log("[caricaDettaglioOrdineDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $pizze[] = self::creaDaArray($row);
        }
        
        $stmt->close();
        
        return $pizze;
    }
    
    public function creaDaArray($row){
        $dettaglio_ordine = new DettaglioOrdine();
        $dettaglio_ordine->setId($row['id']);
        return $dettaglio_ordine;
    }
	
	public function getDettaglioOrdinePerIdOrdine($id_ordine){
        $query ="SELECT 
                ordini_clienti.ordine_id id,
            	pizze.nome pizza,
                pizze.descrizione ingredienti,
                ordini_clienti.qta qta

                FROM ordini_clienti
                	
                JOIN ordini ON
                ordini_clienti.ordine_id = ordini.id
                
                JOIN pizze ON
                ordini_clienti.pizza_id = pizze.id
                
                WHERE ordini.id = ?";
                        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaDettaglioOrdinePerIdOrdine] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaDettaglioOrdinePerIdOrdine] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $appello->getId())) {
            error_log("[cercaDettaglioOrdinePerIdOrdine] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        if (!$stmt->execute()) {
            error_log("[cercaDettaglioOrdinePerIdOrdine] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['id'],
                $row['pizza'],
                $row['ingredienti'],
                $row['qta']);
        if (!$bind) {
            error_log("[caricaIscritti] impossibile" .
                    " effettuare il binding in output");
            $mysqli->close();
            return null;
        }

        while ($stmt->fetch()) {
            $pizze[] = self::creaDaArray($row);
        }
        
        $mysqli->close();
        $stmt->close();
        
        }
    }
        
        
        
    }
	
	
	
}


	
	
?>