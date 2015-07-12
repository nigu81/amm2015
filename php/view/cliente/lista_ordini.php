<h2 class="icon-title" id="h-lista_ordini">Lista Ordini</h2>
<ul class="none">
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
</ul>

<?php if (count($lista_ordini) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="esami-col-large">Ordine</th>
                <th class="esami-col-small">IdOrdine</th>
                <th class="esami-col-small">Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;

            foreach ($lista_ordini as $ordine) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $ordine->getOrdine()->getId() ?></td>
                    <td><?= $ordine->getOrdine()->getData() ?></td>
                    <td><?= $ordine->getOrdine()->getGestore()->getNome() ?></td>
                    <td>
                        <ul class="none no-space">
                            <?php
                            foreach ($ordine->getPizze() as $pizza) {
                                echo '<li>' . $ordine->getPizze().'</li>';
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Nessun esame inserito </p>
<?php } ?>
