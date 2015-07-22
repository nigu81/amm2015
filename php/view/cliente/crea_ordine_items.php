
<div class="input-form">
    <h3>Crea Ordine <?= $id_ultimo_ordine?></h3>
    
           <table>
            <tr>
                <td>Pizza</td>
                <td>Ingredienti</td>
                <td>Prezzo</td>
                <td>Qta</td>
                <td>Azione</td>
             <?php foreach ($pizze as $pizza) { ?>
                 <form method="post" action="cliente/crea_ordine_items?cmd=aggiungi_item">
                 <input type="hidden" name="ordine_id" value=<?=$id_ultimo_ordine?>>
           <input type="hidden" name="pizzeria_id" value=<?=$request['pizzeria_id']?>>
           <input type="hidden" name="cliente_id" value=<?=$user->getId()?>>
           
                 <tr><input type="hidden" name="pizza_id" value=<?=$pizza->getId()?>>
                 <td><?= $pizza->getNome() ?></td>
                 <td><?= $pizza->getDescrizione() ?></td>
                 <td><?= $pizza->getPrezzo() ?></td>
                 <td><input type="text" name="qta" ></td>
                 <td><button type="submit">Aggiungi</button></td>
                 </form> 
                 </tr>
            <?php } ?>
            
        </table>   
      
        
    
</div>