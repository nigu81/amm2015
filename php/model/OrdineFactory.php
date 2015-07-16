<?php

include_once 'Ordine.php';
include_once 'Cliente.php';
include_once 'Pizzeria.php';
include_once 'UserFactory.php';

class OrdineFactory {
	
	private static $singleton;

    private function __constructor() {
        
    }
	
	public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new OrdineFactory();
        }

        return self::$singleton;
    }
	
	public function &ordiniPerCliente(Cliente $user){
        
        $ordini = array();
        $query = "SELECT
                    ordini_clienti.ordine_id ordine, 
                    ordini.data data, 
                    ordini.status status, 
                    pizzerie.nome pizzeria 
                    
                    FROM ordini_clienti 
                    
                    JOIN clienti ON ordini_clienti.cliente_id = clienti.id 
                    JOIN pizzerie ON ordini_clienti.pizzeria_id = pizzerie.id 
                    JOIN ordini ON ordini_clienti.ordine_id = ordini.id 
                    
                    WHERE clienti.id = ? 
                    GROUP BY ordini_clienti.ordine_id";
       
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[ordiniPerCliente] impossibile inizializzare il database");
            $mysqli->close();
            return $ordini;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        
        if (!$stmt) {
            error_log("[ordiniPerCliente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $ordini;
        }
        
        $value = $user->getId();
        if (!$stmt->bind_param('i', $value)) {
            error_log("[ordiniPerCliente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $ordini;
        }

        $ordini = self::caricaOrdiniDaStmt($stmt);
        
        $mysqli->close();
        return $ordini;
		
	}
    
    public function &caricaOrdiniDaStmt(mysqli_stmt $stmt) {
        $ordini = array();
        if (!$stmt->execute()) {
            error_log("[caricaOrdiniDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        
        $bind = $stmt->bind_result(
                $row['ordine'], 
                $row['data'], 
                $row['status'], 
                $row['pizzeria']);
        if (!$bind) {
            error_log("[caricaOrdiniDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $ordini[] = self::creaDaArray($row);
        }

        $stmt->close();

        return $ordini;
    }
    
    public function creaDaArray($row) {
        $ordine = new Ordine();
        $ordine->setId($row['ordine']);
        $ordine->setData($row['data']);
        $ordine->setStatus($row['status']);
        $ordine->setPizzeria($row['pizzeria']);
        return $ordine;
    }
	
	
public function cercaOrdinePerId($ordine_id){
        $ordini = array();
        $query = "SELECT
                    ordini_clienti.ordine_id ordine, 
                    ordini.data data, 
                    ordini.status status, 
                    pizzerie.nome pizzeria 
                    
                    FROM ordini_clienti 
                    
                    JOIN clienti ON ordini_clienti.cliente_id = clienti.id 
                    JOIN pizzerie ON ordini_clienti.pizzeria_id = pizzerie.id 
                    JOIN ordini ON ordini_clienti.ordine_id = ordini.id 
                    
                    WHERE ordine.id = ?
                    GROUP BY ordini_clienti.ordine_id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaOrdinePerId] impossibile inizializzare il database");
            $mysqli->close();
            return $ordini;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaOrdinePerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $ordini;
        }

        
        if (!$stmt->bind_param('i', $ordine_id)) {
            error_log("[cercaOrdinePerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $ordini;
        }

        $ordini =  self::caricaOrdiniDaStmt($stmt);
        foreach($ordini as $pizze){
            DettaglioOrdineFactory::caricaDettaglioOrdine($pizze);
        }
        if(count($ordini > 0)){
            $mysqli->close();
            return $ordini[0];
        }else{
            $mysqli->close();
            return null;
        }
    }	
    
    
    
	
}




?>