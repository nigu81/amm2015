
<div class="input-form">
    <h3>Crea Ordine per <?= $user->getNome() ?><?= $user->getCognome() ?></h3>
    <form method="post" id="form_ordine" >
        <!--<form method="post" id="form_ordine" action="cliente/crea_ordine_items //$vd->scriviToken('?')?>">
        <!--<input type="hidden" name="cmd" value="nuovo_ordine"/>-->
        <input type="hidden" name="cliente" value=<?=$user->getId()?>/>
        <label for="data">Data</label>
        <input type="text" name="data" id="data"/>
        <br/>
        
        <label for="pizzeria">Pizzeria</label>
        <select name="pizzeria_id" id="pizzeria">
            <option disabled selected> -- scegli una pizzeria -- </option>
            <?php foreach ($pizzerie as $pizzeria) { ?>
                <option value="<?= $pizzeria->getId() ?>" ><?= $pizzeria->getNome() ?></option>
                
            <?php } ?>
        </select>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="nuovo_ordine">Effettua nuovo ordine</button>
        </div>
        </form>
</div>
