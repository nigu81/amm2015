<h2 class="icon-title" id="h-pizza-box-mini">Scelta ordine</h2>

<div class="input-form">
    
    <form method="post" action="gestore/dettaglio_ordine_da_lavorare<?= $vd->scriviToken('?') ?>">
        <label for="status">Numero Ordine</label>
        
            <input type="text" name="ordine_id">
        
        <br/>
        
        <button id="cerca" type="submit" name="cmd" value="dettaglio_ordine_da_lavorare">Lavora ordine</button>
    </form>
</div>



