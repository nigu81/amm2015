<?php

include_once 'BaseController.php';
//include_once basename(__DIR__) . '/../model/ElencoEsami.php';
include_once basename(__DIR__) . '/../model/PizzeriaFactory.php';
//include_once basename(__DIR__) . '/../model/UserFactory.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai 
 * Docenti da parte di utenti con ruolo Docente o Amministratore 
 *
 * @author Davide Spano
 */
class GestoreController extends BaseController {

    const elenco = 'elenco';

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
                        //$dipartimenti = DipartimentoFactory::instance()->getDipartimenti();
                        $vd->setSottoPagina('anagrafica');
                        break;
                    
                    case 'ordini_pizzeria':
                        $vd->setSottoPagina('ordini_pizzeria');
                        break;
                    case 'cerca_ordini':
                        $pizzeria = $user->getPizzeria()->getId();
                        $ordini = OrdineFactory::instance()->cercaOrdiniPerPizzeria($request['status'], $pizzeria);                  
                        $vd->setSottoPagina('ordini_pizzeria');
                        break;                 
                    case 'lavora_ordine':
                         $vd->setSottoPagina('lavora_ordine');
                        
                        break;
                    case 'dettaglio_ordine_da_lavorare':
                        $pizzeria = $user->getPizzeria()->getId();
                        
                        $ordini = OrdineFactory::instance()->cercaOrdinePerId($request['ordine_id'], $pizzeria);
                        if (isset($ordini)){
                            $dettagli_ordine = DettagliOrdineFactory::instance()->dettagliOrdinePerOrdine($request['ordine_id']);
                            
                            $vd->setSottoPagina('dettaglio_ordine_da_lavorare');
                        } else {
                            $msg[]="Ordine non presente per questa pizzeria";
                            $this->creaFeedbackUtente($msg, $vd, "Ordine non presente per questa pizzeria");
                        
                            
                            $vd->setSottoPagina('lavora_ordine');
                        }
                        break;
                    
                    // gestione della richiesta ajax di filtro esami
                    case 'filtra_ordini':
                    
                        $vd->toggleJson();
                        $vd->setSottoPagina('el_ordini_json');
                        $errori = array();

                        if (isset($request['ordine']) && ($request['ordine'] != '')) {
                            $ordine_id = filter_var($request['ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if($ordine_id == null){
                                $errori['ordine'] = "Specificare un identificatore valido";
                            }
                        } else {
                            $ordine_id = null;
                            
                        }

                        

                        if (isset($request['cognome'])) {
                            $cognome = $request['cognome'];
                        }else{
                            $cognome = null;
                        }

                       

                        
                        $ordini = OrdineFactory::instance()->ricercaOrdini(
                                $user, 
                               // $request['pizzeria'], 
                                $status
                                );

                        break;
                    
                    

                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }


            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {

                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;

                    // modifica delle informazioni sull'indirizzo dell'ufficio
                    

                    // modifica della password
                    case 'password':
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeUtente($vd);
                        break;
                    case 'modifica_ordine':
                        //$request['ordine_id'];
                        //$request['ordine_status'];
                       OrdineFactory::instance()->lavoraOrdine($request);
                        $this->creaFeedbackUtente($msg, $vd, "Status ordine aggiornato");
                
                        $this->showHomeUtente($vd);
                        break;
                    case 'elimina_ordine':
                        $request['ordine_id'];
                        OrdineFactory::instance()->eliminaOrdine($request);
                        $this->creaFeedbackUtente($msg, $vd, "Ordine Eliminato");
                
                        $this->showHomeUtente($vd);
                        break;   
                   
                    // default
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                // nessun comando, dobbiamo semplicemente visualizzare 
                // la vista
                // nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }


        // richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

    

}

?>
