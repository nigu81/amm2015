<h2 id="help" class="icon-title">Istruzioni</h2>
<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica': ?>
        <p>
            In questa sezione puoi modificare i tuoi dati personali.
        </p>
        <ul>
            <li>
                Il tuo <strong>indirizzo</strong> di residenza.
            </li>
            <li>
                Il tuo indirizzo <strong>email</strong>.
            </li>
            <li>
                La tua <strong>password</strong>
            </li>
        </ul>
        <?php break; ?>

    <?php case 'ordini': ?>
        <p>
            In questa sezione puoi visualizzare gli ordini da te effetutati. 
            Per ogni ordine vengono riportati:
        </p>
        <ul>
            <li>
                Il numero dell'ordine.
            </li>
            <li>
               Lo status dell'ordine:<br/>
               0 = in attesa <br/>
               1 = in preparazione <br/>
               2 = in consegna <br/>
               3 = consegnato <br/>
               </li>
            
            <li>
                La data dell'ordine.
            </li>
            <li>
                La pizzeria dove e' stato fatto l'ordine
            </li>
            <li>
                L'importo dell'ordine.
            </li>
            <li>
                Il dettaglio dell'ordine. Cliccando sul dettaglio, in basso, verranno visualizzate le pizze ordinate
            </li>
            
        </ul>
        <?php break; ?>

    <?php case 'crea_ordine': ?>
        <p>
            In questa sezione puoi effettuare un nuovo ordine.
            Per iniziare e' necessario inserire:
        </p>
        <ul>
            <li>
                La data in cui si vuole ordinare le pizze.
            </li>
            <li>
                La pizzeria scelta.
            </li>
            
        </ul>
        <p>Una volta effettuata la scelta si verra' rediretti per aggiungere le pizze all'ordine.

        </p>
        <?php break; ?>
        <?php case 'crea_ordine_items': ?>
        <p>
            In questa sezione puoi creare il tuo nuovo ordine.
            Per ogni pizza nell'elenco dovrai:
        </p>
        <ul>
            <li>
                Selezionare la quantita' desiderata.
            </li>
            <li>
                Premere <strong>Aggiungi</strong> per aggiornare l'ordine.
            </li>
            
        </ul>
        <p>In basso verrà visualizzato il dettaglio dell'ordine con il totale complessivo in euro. E' possibile eliminare una riga dell'ordine selezionando <strong>Cancella</strong></p>
        <p>Premendo su <strong>Salva </strong>si tornera' al menu principale</p>
        <p>Premendo <strong>Annulla</strong> l'ordine verra' eliminato

        </p>
        <?php break; ?>
        <?php  default:
        ?>
        <p>
            Seleziona una delle  seguenti funzionalit&agrave; disponibili per 
            la gestione dei tuoi esami:
        </p>
        <ol>
            <li>
                <strong>Anagrafica</strong> per modificare i tuoi dati 
                anagrafici e la tua password.
            </li>
            <li>
                <strong>Ordini</strong> per visualizzare gli ordini effettuati.
            </li>
            <li>
                <strong>Nuovo ordine</strong> per effettuare un nuovo ordine.
            </li>
        </ol>
        <?php break; ?>
<?php } ?>