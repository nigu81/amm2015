<h2 class="icon-title" id="h-cerca">Elenco ordini</h2>
<div class="error">
    <div>
        <ul><li>Testo</li></ul>
    </div>
</div>
<div class="input-form">
    <h3>Filtro</h3>
    <form method="post" action="gestore/el_ordini<?= $vd->scriviToken('?') ?>">
        
        <label for="status">Status</label>
        <select name="status" id="status" type="text"/>
            <option value="qualsiasi">Qualsiasi</option>
            <option value="0">In attesa</option>
            <option value="1">In Lavorazione</option>
            <option value="2">In Consegna</option>
            <option value="3">Consegnato</option>
            
        </select>
        <br/>
        <button id="filtra" type="submit" name="cmd" value="e_cerca">Cerca</button>
    </form>
</div>



<h3>Elenco Ordini</h3>

<p id="nessuno">Nessun ordine trovato</p>

<table id="tabella_ordini">
    <thead>
        <tr>
            <th>Ordine</th>
            <th>Status</th>
            <th>Data</th>
            <th>Cliente</th>
            <th>Cognome</th>
        </tr>
    </thead>
    <tbody>

        <tr >
            <td> ordine</td>
            <td> status </td>
            <td> data </td>
            <td> cliente </td>
            <td> cognome </td>

        </tr>

    </tbody>
</table>