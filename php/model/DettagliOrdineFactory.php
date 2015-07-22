<?php

include_once 'DettagliOrdine.php';
//include_once 'Cliente.php';
include_once 'Pizzeria.php';
include_once 'UserFactory.php';

class DettagliOrdineFactory {
	
	private static $singleton;

    private function __constructor() {
        
    }
	
	public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new DettagliOrdineFactory();
        }

        return self::$singleton;
    }
	
	public function &dettagliOrdinePerOrdine($id_ordine){
        
        $dettagli_ordine = array();
        $query = "SELECT
                    ordini_clienti.ordine_id ordine_id, 
                    ordini_clienti.cliente_id cliente_id, 
                    ordini_clienti.pizzeria_id, 
                    ordini_clienti.pizza_id,
                    pizze.nome nome_pizza,
                    pizze.descrizione descrizione_pizza,
                    ordini_clienti.qta qta
                    
                    FROM ordini_clienti 
                    
                    JOIN pizze ON
                    ordini_clienti.pizza_id = pizze.id
                    
                    WHERE ordine_id = ?";
       
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[ordiniPerCliente] impossibile inizializzare il database");
            $mysqli->close();
            return $dettagli_ordine;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        
        if (!$stmt) {
            error_log("[ordiniPerCliente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $dettagli_ordine;
        }
        
        //$value = $user->getId();
        if (!$stmt->bind_param('i', $id_ordine)) {
            error_log("[ordiniPerCliente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $dettagli_ordine;
        }

        $dettagli_ordine = self::caricaDettagliOrdineDaStmt($stmt);
        
        $mysqli->close();
        return $dettagli_ordine;
		
	}
    
    public function &caricaDettagliOrdineDaStmt(mysqli_stmt $stmt) {
        $dettagli_ordine = array();
        if (!$stmt->execute()) {
            error_log("[caricaOrdiniDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        
        $bind = $stmt->bind_result(
                $row['ordine_id'], 
                $row['cliente_id'], 
                $row['pizzeria_id'], 
                $row['pizza_id'],
                $row['pizza_nome'],
                $row['pizza_descrizione'],
                $row['qta']);
                
        if (!$bind) {
            error_log("[caricaOrdiniDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $dettagli_ordine[] = self::creaDaArray($row);
        }

        $stmt->close();

        return $dettagli_ordine;
    }
    
    public function creaDaArray($row) {
        $dettagli_ordine = new DettagliOrdine();
        $dettagli_ordine->setOrdineId($row['ordine_id']);
        $dettagli_ordine->setClienteId($row['cliente_id']);
        $dettagli_ordine->setPizzeriaId($row['pizzeria_id']);
        $dettagli_ordine->setPizzaId($row['pizza_id']);
        $dettagli_ordine->setNomePizza($row['pizza_nome']);
        $dettagli_ordine->setIngredientiPizza($row['pizza_descrizione']);
        $dettagli_ordine->setQta($row['qta']);
        return $dettagli_ordine;
    }
    
    
    public function nuovo(DettagliOrdine $dettaglio_ordine, &$request){
        $query = "insert into ordini_clienti (ordine_id, pizzeria_id, cliente_id, pizza_id, qta)
                  values (?, ?, ?,?,?)";
        return $this->modificaDB($dettaglio_ordine, $query, $request);
    }	
    
    private function modificaDB(DettagliOrdine $dettaglio_ordine, $query, &$request){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();
       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[modificaDB] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('iiiii', 
            $request['ordine_id'],
            $request['pizzeria_id'],
                $request['cliente_id'],
                $request['pizza_id'],
                $request['qta']
                )) {
            error_log("[modificaDB] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[modificaDB] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();

    }
    
    public function eliminaItem(&$request){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }
        $id_ordine = $request['ordine_id'];
        $id_pizza = $request['pizza_id'];
        $query = "delete from ordini_clienti
                  where ordine_id = $id_ordine and pizza_id = $id_pizza";
                  
        $mysqli->query($query);
        $mysqli->close();
        
    }
    
    
    
	
}




?>