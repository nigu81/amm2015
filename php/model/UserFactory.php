<?php

include_once 'User.php';
include_once 'Docente.php';
<<<<<<< HEAD
include_once 'Studente.php';
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
     * @return \User|\Docente|\Studente|\Cliente
=======
     * @return \User|\Docente|\Cliente
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
     */
    public function caricaUtente($username, $password) {


        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        
<<<<<<< HEAD
        // prima cerco nella tabella clienti
        $query = "select clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
=======

        // cerco prima nella tabella clienti
        $query = "select clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
            clienti.matricola clienti_matricola,
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia,
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,
<<<<<<< HEAD
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

        // ore cerco nella tabella studenti
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
=======
            clienti.password clienti_password,
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
<<<<<<< HEAD
            from studenti 
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where studenti.username = ? and studenti.password = ?";
=======
            from clienti 
            join CdL on clienti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where clienti.username = ? and clienti.password = ?";
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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

<<<<<<< HEAD
        $studente = self::caricaStudenteDaStmt($stmt);
        if (isset($studente)) {
            // ho trovato uno studente
            $mysqli->close();
            return $studente;
=======
        $cliente = self::caricaClienteDaStmt($stmt);
        if (isset($cliente)) {
            // ho trovato un cliente
            $mysqli->close();
            return $cliente;
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
    
    
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1

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
<<<<<<< HEAD
     * Restituisce la lista degli studenti presenti nel sistema
     * @return array
     */
    public function &getListaStudenti() {
        $studenti = array();
        $query = "select * from studenti " .
                "join CdL on cdl_id = CdL.id" .
                "join dipartimenti on CdL.dipartimento_id = dipartimenti.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaStudenti] impossibile inizializzare il database");
            $mysqli->close();
            return $studenti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaStudenti] impossibile eseguire la query");
            $mysqli->close();
            return $studenti;
        }

        while ($row = $result->fetch_array()) {
            $studenti[] = self::creaStudenteDaArray($row);
        }

        return $studenti;
    }
    
    /**
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
     * Restituisce la lista dei clienti presenti nel sistema
     * @return array
     */
    public function &getListaClienti() {
        $clienti = array();
<<<<<<< HEAD
        $query = "select * from clienti ";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaClienti] impossibile inizializzare il database");
=======
        $query = "select * from clienti " .
                "join CdL on cdl_id = CdL.id" .
                "join dipartimenti on CdL.dipartimento_id = dipartimenti.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaclienti] impossibile inizializzare il database");
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            $mysqli->close();
            return $clienti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
<<<<<<< HEAD
            error_log("[getListaClienti] impossibile eseguire la query");
=======
            error_log("[getListaclienti] impossibile eseguire la query");
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            $mysqli->close();
            return $clienti;
        }

        while ($row = $result->fetch_array()) {
            $clienti[] = self::creaClienteDaArray($row);
        }

        return $clienti;
    }

    /**
<<<<<<< HEAD
     * Carica uno studente dalla matricola
     * @param int $matricola la matricola da cercare
     * @return Studente un oggetto Studente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaStudentePerMatricola($matricola) {
=======
     * Carica un clienti dalla matricola
     * @param int $matricola la matricola da cercare
     * @return Cliente un oggetto Cliente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaClientePerMatricola($matricola) {
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1


        $intval = filter_var($matricola, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
<<<<<<< HEAD
            error_log("[cercaStudentePerMatricola] impossibile inizializzare il database");
=======
            error_log("[cercaClientePerMatricola] impossibile inizializzare il database");
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            $mysqli->close();
            return null;
        }

<<<<<<< HEAD
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
=======
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
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
<<<<<<< HEAD
            from studenti 
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where studenti.matricola = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaStudentePerMatricola] impossibile" .
=======
            from clienti 
            join CdL on clienti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where clienti.matricola = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaClientePerMatricola] impossibile" .
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $intval)) {
<<<<<<< HEAD
            error_log("[cercaStudentePerMatricola] impossibile" .
=======
            error_log("[cercaClientePerMatricola] impossibile" .
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

<<<<<<< HEAD
        $toRet =  self::caricaStudenteDaStmt($stmt);
=======
        $toRet =  self::caricaClienteDaStmt($stmt);
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
        $mysqli->close();
        return $toRet;
    }

    /**
<<<<<<< HEAD
     * Cerca uno studente per id
     * @param int $id
     * @return Studente un oggetto Studente nel caso sia stato trovato,
=======
     * Cerca un cliente per id
     * @param int $id
     * @return Cliente un oggetto Cliente nel caso sia stato trovato,
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
     * NULL altrimenti
     */
    public function cercaUtentePerId($id, $role) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
<<<<<<< HEAD
            error_log("[cercaUtentePerId] impossibile inizializzare il database");
=======
            error_log("[cercaClientePerId] impossibile inizializzare il database");
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            $mysqli->close();
            return null;
        }

        switch ($role) {
<<<<<<< HEAD
            case User::Studente:
                $query = "select 
            studenti.id studenti_id,
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
            where studenti.id = ?";
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

                return self::caricaStudenteDaStmt($stmt);
                break;
                
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            case User::Cliente:
                $query = "select 
            clienti.id clienti_id,
            clienti.nome clienti_nome,
            clienti.cognome clienti_cognome,
<<<<<<< HEAD
=======
            clienti.matricola clienti_matricola,
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
            clienti.email clienti_email,
            clienti.citta clienti_citta,
            clienti.via clienti_via,
            clienti.cap clienti_cap,
            clienti.provincia clienti_provincia, 
            clienti.numero_civico clienti_numero_civico,
            clienti.username clienti_username,
<<<<<<< HEAD
            clienti.password clienti_password
            
            from clienti 
          
=======
            clienti.password clienti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from clienti 
            join CdL on clienti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
                break;    
            
=======
                break;
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1

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
<<<<<<< HEAD
     * Crea uno studente da una riga del db
     * @param type $row
     * @return \Studente
     */
    public function creaStudenteDaArray($row) {
        $studente = new Studente();
        $studente->setId($row['studenti_id']);
        $studente->setNome($row['studenti_nome']);
        $studente->setCognome($row['studenti_cognome']);
        $studente->setCitta($row['studenti_citta']);
        $studente->setCap($row['studenti_cap']);
        $studente->setVia($row['studenti_via']);
        $studente->setMatricola($row['studenti_matricola']);
        $studente->setEmail($row['studenti_email']);
        $studente->setProvincia($row['studenti_provincia']);
        $studente->setNumeroCivico($row['studenti_numero_civico']);
        $studente->setRuolo(User::Studente);
        $studente->setUsername($row['studenti_username']);
        $studente->setPassword($row['studenti_password']);

        if (isset($row['CdL_id']))
            $studente->setCorsoDiLaurea(CorsoDiLaureaFactory::instance()->creaDaArray($row));
        return $studente;
    }

/**
     * Crea un cliente da una riga del db
=======
     * Crea uno cliente da una riga del db
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
=======
        $cliente->setMatricola($row['clienti_matricola']);
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
        $cliente->setEmail($row['clienti_email']);
        $cliente->setProvincia($row['clienti_provincia']);
        $cliente->setNumeroCivico($row['clienti_numero_civico']);
        $cliente->setRuolo(User::Cliente);
        $cliente->setUsername($row['clienti_username']);
        $cliente->setPassword($row['clienti_password']);

<<<<<<< HEAD
        return $cliente;
    }


=======
        if (isset($row['CdL_id']))
            $cliente->setCorsoDiLaurea(CorsoDiLaureaFactory::instance()->creaDaArray($row));
        return $cliente;
    }

>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
            case User::Studente:
                $count = $this->salvaStudente($user, $stmt);
=======
            case User::Cliente:
                $count = $this->salvaCliente($user, $stmt);
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
                break;
            case User::Docente:
                $count = $this->salvaDocente($user, $stmt);
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }

    /**
<<<<<<< HEAD
     * Rende persistenti le modifiche all'anagrafica di uno studente sul db
     * @param Studente $s lo studente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaStudente(Studente $s, mysqli_stmt $stmt) {
        $query = " update studenti set 
=======
     * Rende persistenti le modifiche all'anagrafica di uno cliente sul db
     * @param cliente $s lo cliente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaCliente(Cliente $s, mysqli_stmt $stmt) {
        $query = " update clienti set 
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
                    where studenti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaStudente] impossibile" .
=======
                    where clienti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCliente] impossibile" .
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssississi', $s->getPassword(), $s->getNome(), $s->getCognome(), $s->getEmail(), $s->getNumeroCivico(), $s->getCitta(), $s->getProvincia(), $s->getMatricola(), $s->getCap(), $s->getVia(), $s->getId())) {
<<<<<<< HEAD
            error_log("[salvaStudente] impossibile" .
=======
            error_log("[salvaCliente] impossibile" .
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
            error_log("[salvaStudente] impossibile" .
=======
            error_log("[salvaCliente] impossibile" .
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
            error_log("[salvaStudente] impossibile" .
=======
            error_log("[salvaCliente] impossibile" .
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
     * Carica uno studente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaStudenteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaStudenteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['studenti_id'], $row['studenti_nome'], $row['studenti_cognome'], $row['studenti_matricola'], $row['studenti_email'], $row['studenti_citta'], $row['studenti_via'], $row['studenti_cap'], $row['studenti_provincia'], $row['studenti_numero_civico'], $row['studenti_username'], $row['studenti_password'], $row['CdL_id'], $row['CdL_nome'], $row['CdL_codice'], $row['dipartimenti_id'], $row['dipartimenti_nome']);
        if (!$bind) {
            error_log("[caricaStudenteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaStudenteDaArray($row);
    }

/**
     * Carica un cliente eseguendo un prepared statement
=======
     * Carica uno Cliente eseguendo un prepared statement
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
                $row['clienti_id'], $row['clienti_nome'], $row['clienti_cognome'], $row['clienti_email'], $row['clienti_citta'], 
                $row['clienti_via'], $row['clienti_cap'], $row['clienti_provincia'], $row['clienti_numero_civico'], 
                $row['clienti_username'], $row['clienti_password']);
=======
                $row['clienti_id'], $row['clienti_nome'], $row['clienti_cognome'], $row['clienti_matricola'], $row['clienti_email'], $row['clienti_citta'], $row['clienti_via'], $row['clienti_cap'], $row['clienti_provincia'], $row['clienti_numero_civico'], $row['clienti_username'], $row['clienti_password'], $row['CdL_id'], $row['CdL_nome'], $row['CdL_codice'], $row['dipartimenti_id'], $row['dipartimenti_nome']);
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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

<<<<<<< HEAD

=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
}

?>
