<?php

include_once 'User.php';
include_once 'Docente.php';
include_once 'Cliente.php';
include_once 'CorsoDiLaureaFactory.php';
include_once 'DipartimentoFactory.php';

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
     * @return \User|\Docente|\Cliente
     */
    public function caricaUtente($username, $password) {


        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        

        // cerco prima nella tabella clienti
        $query = "select clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
            clienti.matricola clienti_matricola,
            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia,
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,
            clienti.password clienti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from clienti 
            join CdL on clienti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
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

        // ora cerco un docente
        $query = "select 
               docenti.id docenti_id,
               docenti.nome docenti_nome,
               docenti.cognome docenti_cognome,
               docenti.email docenti_email,
               docenti.citta docenti_citta,
               docenti.cap docenti_cap,
               docenti.via docenti_via,
               docenti.provincia docenti_provincia,
               docenti.numero_civico docenti_numero_civico,
               docenti.ricevimento docenti_ricevimento,
               docenti.username docenti_username,
               docenti.password docenti_password,
               dipartimenti.id dipartimenti_id,
               dipartimenti.nome dipartimenti_nome
               
               from docenti 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id
               where docenti.username = ? and docenti.password = ?";

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

        $docente = self::caricaDocenteDaStmt($stmt);
        if (isset($docente)) {
            // ho trovato un docente
            $mysqli->close();
            return $docente;
        }
    }

    /**
     * Restituisce un array con i Docenti presenti nel sistema
     * @return array
     */
    public function &getListaDocenti() {
        $docenti = array();
        $query = "select 
               docenti.id docenti_id,
               docenti.nome docenti_nome,
               docenti.cognome docenti_cognome,
               docenti.email docenti_email,
               docenti.citta docenti_citta,
               docenti.cap docenti_cap,
               docenti.via docenti_via,
               docenti.provincia docenti_provincia,
               docenti.numero_civico docenti_numero_civico,
               docenti.ricevimento docenti_ricevimento,
               docenti.username docenti_username,
               docenti.password docenti_password,
               dipartimenti.id dipartimenti_id,
               dipartimenti.nome dipartimenti_nome
               
               from docenti 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaDocenti] impossibile inizializzare il database");
            $mysqli->close();
            return $docenti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaDocenti] impossibile eseguire la query");
            $mysqli->close();
            return $docenti;
        }

        while ($row = $result->fetch_array()) {
            $docenti[] = self::creaDocenteDaArray($row);
        }

        $mysqli->close();
        return $docenti;
    }

    /**
     * Restituisce la lista dei clienti presenti nel sistema
     * @return array
     */
    public function &getListaClienti() {
        $clienti = array();
        $query = "select * from clienti " .
                "join CdL on cdl_id = CdL.id" .
                "join dipartimenti on CdL.dipartimento_id = dipartimenti.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaclienti] impossibile inizializzare il database");
            $mysqli->close();
            return $clienti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaclienti] impossibile eseguire la query");
            $mysqli->close();
            return $clienti;
        }

        while ($row = $result->fetch_array()) {
            $clienti[] = self::creaClienteDaArray($row);
        }

        return $clienti;
    }

    /**
     * Carica un clienti dalla matricola
     * @param int $matricola la matricola da cercare
     * @return Cliente un oggetto Cliente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaClientePerMatricola($matricola) {


        $intval = filter_var($matricola, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaClientePerMatricola] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "select clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
            clienti.matricola clienti_matricola,
            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia,
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,
            clienti.password clienti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from clienti 
            join CdL on clienti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where clienti.matricola = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaClientePerMatricola] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $intval)) {
            error_log("[cercaClientePerMatricola] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $toRet =  self::caricaClienteDaStmt($stmt);
        $mysqli->close();
        return $toRet;
    }

    /**
     * Cerca un cliente per id
     * @param int $id
     * @return Cliente un oggetto Cliente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaUtentePerId($id, $role) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaClientePerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        switch ($role) {
            case User::Cliente:
                $query = "select 
            clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
            clienti.matricola clienti_matricola,
            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia, 
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,
            clienti.password clienti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from clienti 
            join CdL on clienti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
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

            case User::Docente:
                $query = "select 
               docenti.id docenti_id,
               docenti.nome docenti_nome,
               docenti.cognome docenti_cognome,
               docenti.email docenti_email,
               docenti.citta docenti_citta,
               docenti.cap docenti_cap,
               docenti.via docenti_via,
               docenti.provincia docenti_provincia,
               docenti.numero_civico docenti_numero_civico,
               docenti.ricevimento docenti_ricevimento,
               docenti.username docenti_username,
               docenti.password docenti_password,
               dipartimenti.id dipartimenti_id,
               dipartimenti.nome dipartimenti_nome
               
               from docenti 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id
               where docenti.id = ?";

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

                $toRet =  self::caricaDocenteDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;

            default: return null;
        }
    }

    /**
     * Crea uno cliente da una riga del db
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
        $cliente->setMatricola($row['clienti_matricola']);
        $cliente->setEmail($row['clienti_email']);
        $cliente->setProvincia($row['clienti_provincia']);
        $cliente->setNumeroCivico($row['clienti_numero_civico']);
        $cliente->setRuolo(User::Cliente);
        $cliente->setUsername($row['clienti_username']);
        $cliente->setPassword($row['clienti_password']);

        if (isset($row['CdL_id']))
            $cliente->setCorsoDiLaurea(CorsoDiLaureaFactory::instance()->creaDaArray($row));
        return $cliente;
    }

    /**
     * Crea un docente da una riga del db
     * @param type $row
     * @return \Docente
     */
    public function creaDocenteDaArray($row) {
        $docente = new Docente();
        $docente->setId($row['docenti_id']);
        $docente->setNome($row['docenti_nome']);
        $docente->setCognome($row['docenti_cognome']);
        $docente->setEmail($row['docenti_email']);
        $docente->setCap($row['docenti_cap']);
        $docente->setCitta($row['docenti_citta']);
        $docente->setVia($row['docenti_via']);
        $docente->setProvincia($row['docenti_provincia']);
        $docente->setNumeroCivico($row['docenti_numero_civico']);
        $docente->setRicevimento($row['docenti_ricevimento']);
        $docente->setRuolo(User::Docente);
        $docente->setUsername($row['docenti_username']);
        $docente->setPassword($row['docenti_password']);

        $docente->setDipartimento(DipartimentoFactory::instance()->creaDaArray($row));
        return $docente;
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
            case User::Docente:
                $count = $this->salvaDocente($user, $stmt);
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }

    /**
     * Rende persistenti le modifiche all'anagrafica di uno cliente sul db
     * @param cliente $s lo cliente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaCliente(Cliente $s, mysqli_stmt $stmt) {
        $query = " update clienti set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    numero_civico = ?,
                    citta = ?,
                    provincia = ?,
                    matricola = ?,
                    cap = ?,
                    via = ?
                    where clienti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCliente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssississi', $s->getPassword(), $s->getNome(), $s->getCognome(), $s->getEmail(), $s->getNumeroCivico(), $s->getCitta(), $s->getProvincia(), $s->getMatricola(), $s->getCap(), $s->getVia(), $s->getId())) {
            error_log("[salvaCliente] impossibile" .
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
    
    /**
     * Rende persistenti le modifiche all'anagrafica di un docente sul db
     * @param Docente $d il docente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaDocente(Docente $d, mysqli_stmt $stmt) {
        $query = " update docenti set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    ricevimento = ?,
                    numero_civico = ?,
                    dipartimento_id = ?
                    where docenti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCliente] impossibile" .
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
                $d->getRicevimento(),
                $d->getNumeroCivico(), 
                $d->getDipartimento()->getId(),
                $d->getId())) {
            error_log("[salvaCliente] impossibile" .
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

    /**
     * Carica un docente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaDocenteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaDocenteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['docenti_id'], 
                $row['docenti_nome'], 
                $row['docenti_cognome'], 
                $row['docenti_email'], 
                $row['docenti_citta'],
                $row['docenti_cap'],
                $row['docenti_via'],
                $row['docenti_provincia'], 
                $row['docenti_numero_civico'],
                $row['docenti_ricevimento'],
                $row['docenti_username'], 
                $row['docenti_password'], 
                $row['dipartimenti_id'], 
                $row['dipartimenti_nome']);
        if (!$bind) {
            error_log("[caricaDocenteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaDocenteDaArray($row);
    }

    /**
     * Carica uno Cliente eseguendo un prepared statement
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
                $row['clienti_id'], $row['clienti_nome'], $row['clienti_cognome'], $row['clienti_matricola'], $row['clienti_email'], $row['clienti_citta'], $row['clienti_via'], $row['clienti_cap'], $row['clienti_provincia'], $row['clienti_numero_civico'], $row['clienti_username'], $row['clienti_password'], $row['CdL_id'], $row['CdL_nome'], $row['CdL_codice'], $row['dipartimenti_id'], $row['dipartimenti_nome']);
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

}

?>
