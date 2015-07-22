<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/PizzaFactory.php'; 
include_once basename(__DIR__) . '/../model/DettagliOrdineFactory.php';
include_once basename(__DIR__) . '/../model/OrdineFactory.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai 
 * Clienti da parte di clienti con ruolo Cliente o Amministratore 
 *
 * @author Davide Spano
 */
class ClienteController extends BaseController {

      public $id_ultimo_ordine;
   // const lista_ordini = 'lista_ordini';
      private $prezzo_complessivo = "OK";

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
                        
                    case 'dettaglio_ordine':

                        $ordini = OrdineFactory::instance()->ordiniPerCliente($user);
                      
                        $dettagli_ordine = DettagliOrdineFactory::instance()->dettagliOrdinePerOrdine($request['ordine']);
                        $vd->setSottoPagina('dettaglio_ordine');
                        break;
                        
                    case 'crea_ordine':
                        //$ordini = OrdineFactory::instance()->ordiniPerCliente($user);
                        $pizzerie = PizzeriaFactory::instance()->elencoPizzerie();
                        //$pizze = PizzaFactory::instance()->elencoPizze();
                        
                        
                        $vd->setSottoPagina('crea_ordine');
                        break;
                    case 'crea_ordine_items':
                        //$ordini = OrdineFactory::instance()->ordiniPerCliente($user);
                        //$pizzerie = PizzeriaFactory::instance()->elencoPizzerie();
                        $pizze = PizzaFactory::instance()->elencoPizze();
                        $id_ultimo_ordine=$request['ordine_id'];
                        
                        $dettagli_ordine = DettagliOrdineFactory::instance()->dettagliOrdinePerOrdine($id_ultimo_ordine);

                        $vd->setSottoPagina('crea_ordine_items');
                        break;
                    
                        
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
                    case 'nuovo_ordine':
                        $msg = array();
                        $nuovo = new Ordine();
                       // $nuovo->setId(-1);
                        $this->updateOrdine($nuovo, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Ordine creato");
                        $id_ultimo_ordine = OrdineFactory::instance()->nuovo($nuovo, $request );
                        if (count($msg) == 0) {
                            $pizze = PizzaFactory::instance()->elencoPizze();
                            $dettagli_ordine = DettagliOrdineFactory::instance()->dettagliOrdinePerOrdine($id_ultimo_ordine);
                            $vd->setSottoPagina('crea_ordine_items');
                               
                        }
                        
                        //$ordini = OrdineFactory::instance()->OrdiniPerCliente($user);
                        $this->showHomeUtente($vd);
                        break;
                    
                    case 'aggiungi_item':
                        if ($request['qta']<1 || (!isset($request['qta']))){
                            echo "qta inserita non valida";
                            break;
                        }
                        
                        $msg = array();
                        $nuovo_dettaglio = new DettagliOrdine();
                        DettagliOrdineFactory::instance()->nuovo($nuovo_dettaglio, $request );
                        $pizze = PizzaFactory::instance()->elencoPizze();
                       
                        $dettagli_ordine = DettagliOrdineFactory::instance()->dettagliOrdinePerOrdine($request['ordine_id']);
                        $id_ultimo_ordine=$request['ordine_id'];
                        $vd->setSottoPagina('crea_ordine_items');
                        $this->showHomeUtente($vd);
                        
                        break;
                    case 'elimina_item':
                        $nuovo_dettaglio = new DettagliOrdine();
                        DettagliOrdineFactory::instance()->eliminaItem($request);
                        $pizze = PizzaFactory::instance()->elencoPizze();
                        $dettagli_ordine = DettagliOrdineFactory::instance()->dettagliOrdinePerOrdine($id_ultimo_ordine);
                            
                        
                        $vd->setSottoPagina('crea_ordine_items');
                        $this->showHomeUtente($vd);
                        
                        break;
                    case 'salva_ordine':
                        /*
                          registrare i dettagli 
                          sulla tabella ordini_clienti
                        */
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

private function getDettaglioOrdine(&$request, &$msg) {
    
        if (isset($request['ordine'])) {
            $ordine_id = filter_var($request['ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            $dettaglio_ordine = DettaglioOrdineFactory::instance()->cercaItemsPerOrdine($ordine_id);
            if ($ordine_id == null) {
                $msg[] = "L'ordine selezionato non &egrave; corretto</li>";
            }
            return $dettaglio_ordine;
        } else {
            return null;
        }
    }
    
    private function updateOrdine($mod_ordine, &$request, &$msg) {
        
        
        if (isset($request['data'])) {
            $data = DateTime::createFromFormat("d/m/Y", $request['data']);
            if (isset($data) && $data != false) {
                $mod_ordine->setData($data);
                //echo $mod_ordine->getData();
            } else {
                $msg[] = "<li>La data specificata non &egrave; corretta</li>";
            }
        }
        if (isset($request['pizzeria'])) {
         //   if (!
                $mod_ordine->setPizzeria($request['pizzeria']);
                //echo $mod_ordine->getPizzeria();
         //       ) {
         //       $msg[] = "<li>La capienza specificata non &egrave; corretta</li>";
        //    }
        }
        if (isset($request['cliente'])) {
         //   if (!
                $mod_ordine->setCliente($request['cliente']);
                //echo $mod_ordine->getCliente();
         //       ) {
         //       $msg[] = "<li>La capienza specificata non &egrave; corretta</li>";
        //    }
        }
}

public function calcolaPrezzo($pizza_id, $qta, $id_ordine,$totale){
    
    $mysqli = Db::getInstance()->connectDb();
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $query="select prezzo from pizze where id = $pizza_id";
    
    if ($result = $mysqli->query($query)) {

    /* fetch object array */
    /*while ($row = $result->fetch_row()) {
        echo $row[0]*$qta;
        //printf ("%s (%s)\n", $row[0]);
    }*/
    
    $row = $result->fetch_row();
    

    
    $result->close();
    $sub = $row[0]*$qta;
    $totale = $totale + $sub;
    $query="update ordini set importo=$totale where id = $id_ordine";
    $mysqli->query($query);
   
    
   
    return $sub;
}
   

    
     
    
}


}







?>
