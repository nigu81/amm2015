<div class="input-form">
    <h3>Crea Ordine</h3>
    <form method="post" action="cliente/crea_ordine<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="o_nuovo"/>
        <label for="data">Data</label>
        <input type="text" name="data" id="data"/>
        <br/>
        <label for="pizzeria">Pizzeria</label>
        <select name="pizzeria" id="pizzeria">
            <?php foreach ($pizzerie as $pizzeria) { ?>
                <option value="<?= $pizzeria->getNome() ?>" ></option>
            <?php } ?>
        </select>
        <br/>
        <?php foreach ($pizze as $pizza) { ?>
                <input type="text" name="<?= $pizza->getNome() ?>" id="posti"/>
                <label for="qta">Quantita</label>
                <input type="text" name="qta" id="qta"/>
                <br/>
            <?php } ?>
       
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_nuovo">Salva</button>
            <button type="submit" name="cmd" value="a_annulla">Annulla</button>
        </div>
    </form>
</div>