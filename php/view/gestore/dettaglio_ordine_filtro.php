<h2 class="icon-title" id="h-esami">Ordini trovati</h2>

<?php 
           
    if (!isset($ordini)){
        echo "<p> Nessun ordine presente </p>";    
    }
    else {
    if (count($ordini) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="esami-col-large">Ordine</th>
                <th class="esami-col-small">Data</th>
                <th class="esami-col-large">Cliente</th>
                <th class="esami-col-large">Importo</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;

            foreach ($ordini as $ordine) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $ordine->getId() ?></td>
                    <td><?= $ordine->getData()->format('d/m/Y') ?></td>
                    <td><?= $ordine->getCliente() ?></td>
         
                    
                    <td><?= $ordine->getImporto() ?></td>
                    
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Nessun ordine presente </p>
<?php } } ?>

