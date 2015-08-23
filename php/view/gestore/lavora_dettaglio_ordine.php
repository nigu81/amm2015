<?php                       
        $status = $ordini->getStatus(); 
        $string_button;
        $string_ordine;
        switch ($status){
            case 0:
                $string_button = "Prepara Ordine";
                $string_ordine = "In attesa di Preparazione";
                $ordine_status = '1';
                break;
            case 1:
                $string_button = "Consegna Ordine";
                $string_ordine = "Pronto da Consegnare";
                $ordine_status = '2';
                break;
            case 2:
                $string_button = "Ordine Consegnato";
                $string_ordine = "Uscito per Consegna";
                $ordine_status = '3';
                break;
            case 3:
                $string_button = "";
                $string_ordine = "Ordine Consegnato";
                $ordine_status = '3';
                break;                       
         }
                       
                        
?>

<h2 class="icon-title" id="h-pizza-box-mini">Dettaglio Ordine <?=$ordini->getId()?><?php echo " ".$string_ordine?></h2>
<?php if (count($dettagli_ordine) > 0) { ?>
    <form method="post" action="gestore/lavora_ordine">
    <input type="hidden" name="ordine_id" value=<?=$ordini->getId()?>>
    <input type="hidden" name="ordine_status" value=<?=$ordine_status?>>
    <table>
        <thead>
            <tr>
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
    <?php if ($string_button!=""){?>
        <button type='submit' name='cmd' value='modifica_ordine'><?=$string_button?></button>
    <?php   }?>
    <button type="submit" name="cmd" value="elimina_ordine">Elimina Ordine</button>
    </form>
    
<?php } else { ?>
    <p> Ordine Vuoto </p>
<?php } ?>


