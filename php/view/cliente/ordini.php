<h2 class="icon-title" id="h-ordini">Ordini</h2>
<ul class="none">
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
</ul>

<?php if (count($ordini) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="esami-col-large">Ordine</th>
                <th class="esami-col-small">Status</th>
                <th class="esami-col-small">Data</th>
                <th class="esami-col-large">Pizzeria</th>
                <th class="esami-col-large">Importo</th>
                <th class="esami-col-large">Dettaglio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;

            foreach ($ordini as $ordine) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $ordine->getId() ?></td>
                    <td><?= $ordine->getStatus() ?></td>
                    <td><?= $ordine->getData()->format('d/m/Y') ?></td>
                    <td><?= $ordine->getPizzeria() ?></td>
                    <td><?= $ordine->getImporto() ?></td>
                    <td>
                        <a href="cliente/dettaglio_ordine?ordine=<?= $ordine->getId() ?><?= $vd->scriviToken('&') ?>" title="Dettaglio Ordine">
                        Apri Ordine
                        </a>
                    
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Nessun ordine presente </p>
<?php } ?>

