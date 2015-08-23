<?php

include_once 'User.php';
include_once 'Cliente.php';
include_once 'Gestore.php';
include_once 'PizzeriaFactory.php';

/**
 * Classe per la creazione degli utenti del sistema
 *
 * @author Davide Spano
 */
class UserFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare utenti
     * @return \UserFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();
        }

        return self::$singleton;
    }

    /**
     * Carica un utente tramite username e password
     * @param string $username
     * @param string $password

     * @return \User|\Docente|\Studente|\Cliente|\Gestore

     */
    public function caricaUtente($username, $password) {


        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        

        // prima cerco nella tabella clienti
        $query = "select clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia,
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,
            clienti.password clienti_password
            
            from clienti 
            
            where clienti.username = ? and clienti.password = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $cliente = self::caricaClienteDaStmt($stmt);
        if (isset($cliente)) {
            // ho trovato un cliente
            $mysqli->close();
            return $cliente;
        }

        
        
      // ora cerco un gestore
        $query = "select 
               gestori.id gestori_id,
               gestori.nome gestori_nome,
               gestori.cognome gestori_cognome,
               gestori.email gestori_email,
               gestori.citta gestori_citta,
               gestori.cap gestori_cap,
               gestori.via gestori_via,
               gestori.provincia gestori_provincia,
               gestori.numero_civico gestori_numero_civico,
               gestori.username gestori_username,
               gestori.password gestori_password,
               pizzerie.id pizzerie_id,
               pizzerie.nome pizzerie_nome
               
               from gestori 
               join pizzerie on gestori.pizzeria_id = pizzerie.id
               where gestori.username = ? and gestori.password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $gestore = self::caricaGestoreDaStmt($stmt);
        if (isset($gestore)) {
            // ho trovato un gestore
            $mysqli->close();
            return $gestore;
        }       
 
    }

    

    
    
    
    /**
     * Restituisce un array con i Gestori presenti nel sistema
     * @return array
     */
    public function &getListaGestori() {
        $gestori = array();
        $query = "select 
               gestori.id gestori_id,
               gestori.nome gestori_nome,
               gestori.cognome gestori_cognome,
               gestori.email gestori_email,
               gestori.citta gestori_citta,
               gestori.cap gestori_cap,
               gestori.via gestori_via,
               gestori.provincia gestori_provincia,
               gestori.numero_civico gestori_numero_civico,
               gestori.username gestori_username,
               gestori.password gestori_password,
               pizzerie.id pizzerie_id,
               pizzerie.nome pizzerie_nome
               
               from gestori 
               join pizzerie on gestori.pizzeria_id = pizzerie.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaGestori] impossibile inizializzare il database");
            $mysqli->close();
            return $gestori;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaGestori] impossibile eseguire la query");
            $mysqli->close();
            return $gestori;
        }

        while ($row = $result->fetch_array()) {
            $gestori[] = self::creaGestoreDaArray($row);
        }

        $mysqli->close();
        return $gestori;
    }


    
    
    /**
     * Restituisce la lista dei clienti presenti nel sistema
     * @return array
     */
    public function &getListaClienti() {
        $clienti = array();
        $query = "select 
            clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,

            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia, 
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,

            clienti.password clienti_password
            
            from clienti 

            ";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaClienti] impossibile inizializzare il database");

            $mysqli->close();
            return $clienti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {

            error_log("[getListaClienti] impossibile eseguire la query");

            $mysqli->close();
            return $clienti;
        }

        while ($row = $result->fetch_array()) {
            $clienti[] = self::creaClienteDaArray($row);
        }

        return $clienti;
    }

    /**
     * Carica uno studente dalla matricola
     * @param int $matricola la matricola da cercare
     * @return Studente un oggetto Studente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaStudentePerMatricola($matricola) {


        $intval = filter_var($matricola, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {

            error_log("[cercaStudentePerMatricola] impossibile inizializzare il database");

            $mysqli->close();
            return null;
        }


        $query = "select studenti.id studenti_id,
            studenti.nome studenti_nome,
            studenti.cognome studenti_cognome,
            studenti.matricola studenti_matricola,
            studenti.email studenti_email,
            studenti.citta studenti_citta,
            studenti.via studenti_via,
            studenti.cap studenti_cap,
            studenti.provincia studenti_provincia,
            studenti.numero_civico studenti_numero_civico,
            studenti.username studenti_username,
            studenti.password studenti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from studenti 
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where studenti.matricola = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaStudentePerMatricola] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $intval)) {

            error_log("[cercaStudentePerMatricola] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $toRet =  self::caricaStudenteDaStmt($stmt);

        $mysqli->close();
        return $toRet;
    }

    /**

     * Cerca uno studente per id
     * @param int $id
     * @return Studente un oggetto Studente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaUtentePerId($id, $role) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {

            error_log("[cercaUtentePerId] impossibile inizializzare il database");

            $mysqli->close();
            return null;
        }

        switch ($role) {

            
                
            case User::Cliente:
                $query = "select 
            clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,

            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia, 
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,

            clienti.password clienti_password
            
            from clienti 

            where clienti.id = ?";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                return self::caricaClienteDaStmt($stmt);

                break;    
            

            

            case User::Gestore:
                $query = "select 
               gestori.id gestori_id,
               gestori.nome gestori_nome,
               gestori.cognome gestori_cognome,
               gestori.email gestori_email,
               gestori.citta gestori_citta,
               gestori.cap gestori_cap,
               gestori.via gestori_via,
               gestori.provincia gestori_provincia,
               gestori.numero_civico gestori_numero_civico,
               gestori.username gestori_username,
               gestori.password gestori_password,
               pizzerie.id pizzerie_id,
               pizzerie.nome pizzerie_nome
               
               from gestori 
               join pizzerie on gestori.pizzeria_id = pizzerie.id
               where gestori.id = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[loadUser] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                $toRet =  self::caricaGestoreDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;



            default: return null;
        }
    }

    

/**
     * Crea un cliente da una riga del db
     * @param type $row
     * @return \Cliente
     */
    public function creaClienteDaArray($row) {
        $cliente = new Cliente();
        $cliente->setId($row['clienti_id']);
        $cliente->setNome($row['clienti_nome']);
        $cliente->setCognome($row['clienti_cognome']);
        $cliente->setCitta($row['clienti_citta']);
        $cliente->setCap($row['clienti_cap']);
        $cliente->setVia($row['clienti_via']);

        $cliente->setEmail($row['clienti_email']);
        $cliente->setProvincia($row['clienti_provincia']);
        $cliente->setNumeroCivico($row['clienti_numero_civico']);
        $cliente->setRuolo(User::Cliente);
        $cliente->setUsername($row['clienti_username']);
        $cliente->setPassword($row['clienti_password']);


        return $cliente;
    }


   
/**
     * Crea un gestore da una riga del db
     * @param type $row
     * @return \Docente
     */
    public function creaGestoreDaArray($row) {
        $gestore = new Gestore();
        $gestore->setId($row['gestori_id']);
        $gestore->setNome($row['gestori_nome']);
        $gestore->setCognome($row['gestori_cognome']);
        $gestore->setEmail($row['gestori_email']);
        $gestore->setCap($row['gestori_cap']);
        $gestore->setCitta($row['gestori_citta']);
        $gestore->setVia($row['gestori_via']);
        $gestore->setProvincia($row['gestori_provincia']);
        $gestore->setNumeroCivico($row['gestori_numero_civico']);
        $gestore->setRuolo(User::Gestore);
        $gestore->setUsername($row['gestori_username']);
        $gestore->setPassword($row['gestori_password']);
       
        $gestore->setPizzeria(PizzeriaFactory::instance()->creaDaArray($row));
        return $gestore;
    }

    /**
     * Salva i dati relativi ad un utente sul db
     * @param User $user
     * @return il numero di righe modificate
     */
    public function salva(User $user) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }

        $stmt = $mysqli->stmt_init();
        $count = 0;
        switch ($user->getRuolo()) {

            
            case User::Cliente:
                $count = $this->salvaCliente($user, $stmt);

                break;
            case User::Gestore:
                $count = $this->salvaGestore($user, $stmt);
                break;
            
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }

    
    private function salvaGestore(Gestore $d, mysqli_stmt $stmt) {
        $query = " update gestori set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    numero_civico = ?,
                    pizzeria_id = ?
                    where gestori.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaGestore] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('sssssssssiii', 
                $d->getPassword(), 
                $d->getNome(), 
                $d->getCognome(), 
                $d->getEmail(), 
                $d->getCitta(),
                $d->getProvincia(),
                $d->getCap(), 
                $d->getVia(), 
                $d->getNumeroCivico(), 
                $d->getPizzeria()->getId(),
                $d->getId())) {

            error_log("[salvaGestore] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    private function salvaCliente(Cliente $c, mysqli_stmt $stmt) {
        $query = " update clienti set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    numero_civico = ?,
                    where clienti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCliente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssssssii', 
                $c->getPassword(), 
                $c->getNome(), 
                $c->getCognome(), 
                $c->getEmail(), 
                $c->getCitta(),
                $c->getProvincia(),
                $c->getCap(), 
                $c->getVia(), 
                $c->getNumeroCivico(), 
                $c->getId())) {

            error_log("[salvaCliente] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaClienti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    
    
    
    

    
    
    /**
     * Carica un gestore eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaGestoreDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaGestoreDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['gestori_id'], 
                $row['gestori_nome'], 
                $row['gestori_cognome'], 
                $row['gestori_email'], 
                $row['gestori_citta'],
                $row['gestori_cap'],
                $row['gestori_via'],
                $row['gestori_provincia'], 
                $row['gestori_numero_civico'],
                $row['gestori_username'], 
                $row['gestori_password'], 
                $row['pizzerie_id'], 
                $row['pizzerie_nome']);
                
        if (!$bind) {
            error_log("[caricaGestoreDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaGestoreDaArray($row);
    }
    
    
    
    
    

    
/**
     * Carica un cliente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaClienteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaClienteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(

                $row['clienti_id'], $row['clienti_nome'], $row['clienti_cognome'], $row['clienti_email'], $row['clienti_citta'], 
                $row['clienti_via'], $row['clienti_cap'], $row['clienti_provincia'], $row['clienti_numero_civico'], 
                $row['clienti_username'], $row['clienti_password']);
        if (!$bind) {
            error_log("[caricaClienteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaClienteDaArray($row);
    }
    
    
    public function &getClienteDaId($cliente_id) {
        $clienti = array();
        $query = "select * from clienti where id = $cliente_id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaClienti] impossibile inizializzare il database");

            $mysqli->close();
            return $clienti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {

            error_log("[getListaClienti] impossibile eseguire la query");

            $mysqli->close();
            return $clienti;
        }

        while ($row = $result->fetch_array()) {
            $clienti[] = self::creaClienteDaArray($row);
        }
        $cliente = $clienti[0];
        return $cliente;
    }

    
    
    

}

?>
