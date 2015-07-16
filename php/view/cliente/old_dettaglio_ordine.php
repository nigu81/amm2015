<div class="input-form">
    
    <h3>Dettaglio Ordine  
        <?= $mod_ordine[0] ?>
    </h3>
    <ol>
        <?php
        foreach ($mod_ordine->getPizze() as $pizza) {
            ?>
            <li><?= $pizza?></li>
            <?php
        }
        ?>
    </ol>
    <form method="get" action="cliente/ordini<?= $vd->scriviToken('?')?>">
        <button type="submit" name="cmd" value="a_annulla">Chiudi</button>
    </form>

</div>