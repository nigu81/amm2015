<?php

include_once 'BaseController.php';
//include_once basename(__DIR__) . '/../model/EsameFactory.php'; ORDINE
//include_once basename(__DIR__) . '/../model/DettaglioOrdineFactory.php';
include_once basename(__DIR__) . '/../model/OrdineFactory.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai 
 * Clienti da parte di clienti con ruolo Cliente o Amministratore 
 *
 * @author Davide Spano
 */
class ClienteController extends BaseController {


    //const appelli = 'appelli';
    const lista_ordini = 'lista_ordini';

    /**
     * Costruttore
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo per gestire l'input dell'utente. 
     * @param type $request la richiesta da gestire
     */
    public function handleInput(&$request) {

        // creo il descrittore della vista
        $vd = new ViewDescriptor();


        // imposto la pagina
        $vd->setPagina($request['page']);

        // imposto il token per impersonare un utente (nel lo stia facendo)
        $this->setImpToken($vd, $request);

        // gestion dei comandi
        // tutte le variabili che vengono create senza essere utilizzate 
        // direttamente in questo switch, sono quelle che vengono poi lette
        // dalla vista, ed utilizzano le classi del modello

        if (!$this->loggedIn()) {
            // utente non autenticato, rimando alla home

            $this->showLoginPage($vd);
        } else {
            // utente autenticato
            $user = UserFactory::instance()->cercaUtentePerId(
                            $_SESSION[BaseController::user], $_SESSION[BaseController::role]);


            // verifico quale sia la sottopagina della categoria
            // Docente da servire ed imposto il descrittore 
            // della vista per caricare i "pezzi" delle pagine corretti
            // tutte le variabili che vengono create senza essere utilizzate 
            // direttamente in questo switch, sono quelle che vengono poi lette
            // dalla vista, ed utilizzano le classi del modello
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    // modifica dei dati anagrafici
                    case 'anagrafica':
                        $vd->setSottoPagina('anagrafica');
                        break;
   
                    // visualizzazione degli esami sostenuti
                    case 'ordini':
                        $ordini = OrdineFactory::instance()->ordiniPerCliente($user);
                        $vd->setSottoPagina('ordini');
                        break;
                        
    /*                case 'dettaglio_ordine':
                        $msg = array();
                        $ordini = OrdineFactory::instance()->ordiniPerCliente($user);
                        $mod_ordine = $this->getDettaglioOrdine($request, $msg);
                        if (!isset($mod_ordine)) {
                            $vd->setSottoPagina('ordini');
                        } else {
                            $vd->setSottoPagina('dettaglio_ordine');
                        }
                        break;
    */                    
                    default:

                        $vd->setSottoPagina('home');
                        break;
                }
            }



            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {
                // abbiamo ricevuto un comando
                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;

                    // aggiornamento indirizzo
                    case 'indirizzo':

                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaIndirizzo($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Indirizzo aggiornato");
                        $this->showHomeUtente($vd);
                        break;

                    // cambio email
                    case 'email':
                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaEmail($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Email aggiornata");
                        $this->showHomeUtente($vd);
                        break;

                    // cambio password
                    case 'password':
                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeStudente($vd);
                        break;

                    // fai un nuovo ordine
                    case 'ordina':
                        // recuperiamo l'indice 
                        /*$msg = array();

                        $a = $this->getAppelloPerIndice($appelli, $request, $msg);
                        if (isset($a)) {
                            $isOk = $a->iscrivi($user);
                            $count = AppelloFactory::instance()->aggiungiIscrizione($user, $a);
                            if (!$isOk || $count != 1) {
                                $msg[] = "<li> Impossibile cancellarti dall'appello specificato </li>";
                            }
                        } else {
                            $msg[] = "<li> Impossibile iscriverti all'appello specificato. Verifica la capienza del corso </li>";
                        }

                        $this->creaFeedbackUtente($msg, $vd, "Ti sei iscritto all'appello specificato");

                        $this->showHomeStudente($vd);*/
                        break;


                    default : $this->showLoginPage($vd);
                }
            } else {
                // nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                                $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }

        // includo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

/*private function getDettaglioOrdine(&$request, &$msg) {
        if (isset($request['dettaglio_ordine'])) {
            $ordine_id = filter_var($request['dettaglio_ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            $dettaglio_ordine = DettaglioOrdineFactory::instance()->cercaDettaglioOrdinePerIdOrdine($ordine_id);
            if ($ordine == null) {
                $msg[] = "L'ordine selezionato non &egrave; corretto</li>";
            }
            return $dettaglio_ordine;
        } else {
            return null;
        }
    }
*/


}




?>
