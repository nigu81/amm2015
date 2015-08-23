<h2 class="icon-title" id="h-dettaglio">Dettaglio Ordine </h2>


<?php if (count($dettagli_ordine) > 0) { ?>
    <form method="post" action="cliente/crea_ordine_items?cmd=elimina_item&pizzeria_id=<?=$request['pizzeria_id']?>">
    <table>
        <thead>
            <tr>
                <th class="esami-col-large">NomePizza</th>
                <th class="esami-col-large">IngredientiPizza</th>
                <th class="esami-col-small">Qta</th>
                <th class="esami-col-small">Pr. Comp.</th>
                <th class="esami-col-small">Azione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $totale = 0;

            foreach ($dettagli_ordine as $dettaglio_ordine) {
                ?>
                
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <input type="hidden" name="ordine_id" value=<?=$dettaglio_ordine->getOrdineId()?>>
                    <input type="hidden" name="pizza_id" value=<?=$dettaglio_ordine->getPizzaId()?>>
                     <td><?= $dettaglio_ordine->getNomePizza() ?></td>
                      <td><?= $dettaglio_ordine->getIngredientiPizza() ?></td>
                    <td><?= $dettaglio_ordine->getQta() ?>
                    <td><?=$sub = $this->calcolaPrezzo($dettaglio_ordine->getPizzaId(), $dettaglio_ordine->getQta(),$dettaglio_ordine->getOrdineId(),$totale) ?></td>                   
                    </td>
                    <td><button type="submit">Cancella</button></td>
                </tr>
                <?php
                    $totale = $totale+$sub;
                    
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php echo "Totale ordine: ".number_format((float)$totale, 2, '.', '')." euro";?>
    
<?php } else { ?>
    <p> Ordine Vuoto </p>
<?php } ?>
<div class="btn-group">
            <button type="submit" name="cmd" value="salva_ordine">Salva</button>
            <button type="submit" name="cmd" value="annulla_ordine">Annulla</button>
        </div>
</form>
