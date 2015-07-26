<?php
include_once 'Ordine.php';
//include_once 'Cliente.php';
include_once 'Pizzeria.php';
include_once 'UserFactory.php';
//include_once 'DettagliOrdineFactory.php';
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
                    pizzerie.nome pizzeria,
                    ordini.importo importo 
                    
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
                $row['pizzeria'],
                $row['importo']);
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
        $ordine->setData(new DateTime($row['data']));
        if (isset($row['status'])){
            $ordine->setStatus($row['status']);
        }
              
        if (isset($row['pizzeria'])){
            $ordine->setPizzeria($row['pizzeria']);    
        }
        if (isset($row['cliente'])){
            $ordine->setCliente($row['cliente']);    
        }
         
        
        $ordine->setImporto($row['importo']);
        return $ordine;
    }
	
	
public function cercaOrdinePerId($ordine_id,$pizzeria){
        $ordini = array();
        $query = "SELECT
                    ordini_clienti.ordine_id ordine, 
                    ordini.data data, 
                    ordini.status status, 
                    pizzerie.nome pizzeria,
                    ordini.importo importo 
                    
                    FROM ordini_clienti 
                    
                    JOIN clienti ON ordini_clienti.cliente_id = clienti.id 
                    JOIN pizzerie ON ordini_clienti.pizzeria_id = pizzerie.id 
                    JOIN ordini ON ordini_clienti.ordine_id = ordini.id 
                    
                    WHERE ordini.id = ? AND ordini.pizzeria_id = ?
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
        
        if (!$stmt->bind_param('ii', $ordine_id,$pizzeria)) {
            error_log("[cercaOrdinePerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $ordini;
        }
        $ordini =  self::caricaOrdiniDaStmt($stmt);
        /*foreach($ordini as $pizze){
            DettagliOrdineFactory::caricaDettagliOrdine($pizze);
        }*/
        if(count($ordini) > 0){
            $mysqli->close();
            return $ordini[0];
        }else{
            $mysqli->close();
            error_log("Ordine non trovato");
            return null;
        }
    }
    
    
    public function nuovo(Ordine $ordine, &$request){
        $query = "insert into ordini (data, pizzeria_id, cliente_id)
                  values (?, ?, ?)";
        return $this->modificaDB($ordine, $query, $request);
    }	
    
    private function modificaDB(Ordine $ordine, $query, &$request){
        $mysqli = Db::getInstance()->connectDb();
        $mysqli->autocommit(false);
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
        $value = $ordine->getData()->format('Y-m-d');
        if (!$stmt->bind_param('sii',                
                $value, 
                $request['pizzeria_id'],
                $request['cliente']
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
        
        $id_ultimo_ordine = $mysqli->insert_id;
        
        //$mysqli->close();
        return $id_ultimo_ordine;
    }
    
    
    public function &cercaOrdiniPerPizzeria($status, $pizzeria){
        
        $ordini = array();
        $query = "SELECT 
                    ordini_clienti.ordine_id ordine, 
                    ordini.data data, 
                    clienti.cognome cliente_cognome, 
                    ordini.importo importo 
                    FROM ordini_clienti 
                    JOIN ordini ON ordini_clienti.ordine_id = ordini.id 
                    JOIN clienti ON ordini_clienti.cliente_id = clienti.id 
                    JOIN pizzerie ON ordini_clienti.pizzeria_id = pizzerie.id 
                    WHERE ordini.status = ? AND ordini.pizzeria_id = ? 
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
        
        
        
        if (!$stmt->bind_param('ii', $status, $pizzeria)) {
            error_log("[ordiniPerCliente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $ordini;
        }
        $ordini = self::caricaOrdiniPizzeriaDaStmt($stmt);
        
        $mysqli->close();
        return $ordini;
		
	}
    
    
    
    public function &caricaOrdiniPizzeriaDaStmt(mysqli_stmt $stmt) {
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
                $row['cliente'], 
                $row['importo']);
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
    
    public function lavoraOrdine(&$request){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }
        $id_ordine = $request['ordine_id'];
        $status_ordine = $request['ordine_status'];
        $query = "update ordini
                  set
                  status = $status_ordine
                  where id=$id_ordine";
                  
        $mysqli->query($query);
        $mysqli->close();
        
    }
    
    public function eliminaOrdine(&$request){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }
        $id_ordine = $request['ordine_id'];
        $query = "delete from ordini
                  where id = $id_ordine";
                  
        $mysqli->query($query);
        $query = "delete from ordini_clienti
                  where ordine_id = $id_ordine";
                  
        $mysqli->query($query);
        $mysqli->close();
        
    }
    
    
	
}
?>