<h2 class="icon-title" id="h-cerca">Elenco ordini</h2>

<div class="input-form">
    <h3>Filtro</h3>
    <form method="post" action="gestore/cerca_ordini<?= $vd->scriviToken('?') ?>">
        <label for="status">Status</label>
        <select name="status" id="status" type="text"/>
            <option value="scegli" <?php if (!isset($request['status'])) echo "selected"; ?> disabled>Scegli lo status dell'ordine</option>
            <option value="0" <?php if (isset($request['status']) && ($request['status']==0)) echo "selected";?>  >In attesa</option>
            <option value="1" <?php if (isset($request['status']) && ($request['status']==1)) echo "selected";?>>In Lavorazione</option>
            <option value="2" <?php if (isset($request['status']) && ($request['status']==2)) echo "selected";?>>In Consegna</option>
            <option value="3" <?php if (isset($request['status']) && ($request['status']==3)) echo "selected";?>>Consegnato</option>
            
        </select>
        <br/>
        
        <button id="cerca" type="submit" >Cerca</button>
    </form>
</div>



