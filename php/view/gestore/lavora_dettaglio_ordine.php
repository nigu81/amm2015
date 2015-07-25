
<?php
                        
                        $status = $ordini->getStatus(); 
                        $string_button;
                        $string_ordine;
                        switch ($status){
                            case 0:
                                $string_button = "Prepara Ordine";
                                $string_ordine = "In attesa di Preparazione";
                                break;
                            case 1:
                                $string_button = "Consegna Ordine";
                                $string_ordine = "Pronto da Consegnare";
                                break;
                            case 2:
                                $string_button = "Ordine Consegnato";
                                $string_ordine = "Uscito per Consegna";
                                break;
                             
                                
                        }
                       
                        
                    ?>

<h2 class="icon-title" id="h-esami">Dettaglio Ordine <?=$ordini->getId()?><?php echo " ".$string_ordine?></h2>
<?php if (count($dettagli_ordine) > 0) { ?>
    <form method="post" cmd="modifica" action="gestore/modifica_ordine">
    <table>
        <thead>
            <tr>
           <!--     <th class="esami-col-large">Ordine</th>
                <th class="esami-col-small">Cliente</th>
                <th class="esami-col-large">Pizzeria</th>
                <th class="esami-col-large">Pizza</th> -->
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
                    <input type="hidden" name="ordine_id" value=<?=$dettaglio_ordine->getOrdineId()?>>
                    <input type="hidden" name="pizza_id" value=<?=$dettaglio_ordine->getPizzaId()?>>
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
    
    <button type="submit"><?=$string_button?></button>
    <button type="submit">Elimina Ordine</button>
    
    
<?php } else { ?>
    <p> Ordine Vuoto </p>
<?php } ?>


