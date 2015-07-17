<h2 class="icon-title" id="h-esami">Dettagli Ordine <?= $request['ordine'] ?></h2>


<?php if (count($dettagli_ordine) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="esami-col-large">Ordine</th>
                <th class="esami-col-small">Cliente</th>
                <th class="esami-col-large">Pizzeria</th>
                <th class="esami-col-large">Pizza</th>
                <th class="esami-col-large">NomePizza</th>
                <th class="esami-col-large">IngredientiPizza</th>
                <th class="esami-col-small">Qta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;

            foreach ($dettagli_ordine as $dettaglio_ordine) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $dettaglio_ordine->getOrdineId() ?></td>
                    <td><?= $dettaglio_ordine->getClienteId() ?></td>
                    <td><?= $dettaglio_ordine->getPizzeriaId() ?></td>
                    <td><?= $dettaglio_ordine->getPizzaId() ?></td>
                     <td><?= $dettaglio_ordine->getNomePizza() ?></td>
                      <td><?= $dettaglio_ordine->getIngredientiPizza() ?></td>
                    <td><?= $dettaglio_ordine->getQta() ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Ordine Vuoto </p>
<?php } ?>

