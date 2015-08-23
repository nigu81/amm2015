<h2 id="help" class="icon-title">Istruzioni</h2>
<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        ?>
        <p>
            In questa sezione puoi modificare i tuoi dati personali.
        </p>
        <ul>
            <li>
                Il tuo <strong>indirizzo</strong> del tuo ufficio.
            </li>
            <li>
                I tuoi contatti  (<strong>email</strong> e 
                <strong>orario di ricevimento</strong>).
            </li>
            <li>
                La tua <strong>password</strong>
            </li>
        </ul>
        <?php break; ?>

    <?php case 'ordini_pizzeria': ?>
        <p>
            In questa sezione è possibile visualizzare gli ordini della tua pizzeria attraverso il filtro del loro status.
           
        </p>
        
        <?php break; ?>

    <?php case 'lavora_ordine': ?>
    <?php case 'dettaglio_ordine_da_lavorare': ?>
        <p>
            In questa sezione e' possibile inserire il numero di un ordine per poterlo lavorare
        </p>
        
        <p>
            Un ordine <strong>in attesa </strong>puo' passare ad essere in lavorazione (o eliminato)

        </p>
        <p>
           Un ordine <strong>in preparazione </strong>puo' passare ad essere in consegna (o eliminato)
        </p>
        <p>
           Un ordine <strong>in consegna </strong>puo' passare ad essere consegnato (o eliminato)
        </p>
        <p>
           Un ordine <strong>consegnato</strong> puo' essere eliminato
        </p>
        <?php break; ?>
    <?php case 'el_esami': ?>
        <p>
            In questa sezione puoi visualizzare lo storico degli esami
            da te registrati. &Egrave; possibile filtrarli per data e per studente
        </p>
        <p>
            Puoi modificarne uno la registrazione di un esame esistente 
            premendo il pulsante <em>Modifica</em>, 
            identificabile dall'icona matita <br/>
            <img  src="../images/edit-action.png" alt="icona modifica">
        </p>
        <p>
            &Egrave; possibile eliminare la registrazione di un esame
            tramite il pulsante  <em>Elimina</em>, 
            identificabile dall'icona cestino <br/>
            <img  src="../images/delete-action.png" alt="icona elimina">
        </p>
        <?php break; ?>
    <?php default:
        ?>
        <p>
            Seleziona una delle  seguentifunzionalit&agrave; disponibili per 
            la gestione degli ordini della tua pizzeria:
        </p>
        <ol>
            <li>
                <strong>Anagrafica</strong> per modificare i tuoi dati 
                anagrafici e la tua password.
            </li>
            <li>
                <strong>Elenco Ordini</strong> per visualizzare l'elenco degli ordini della tua pizzeria.
            </li>
            <li>
                <strong>Lavora Ordine</strong> per lavorare un ordine.
            </li>
            
        </ol>
        <?php break; ?>
<?php } ?>