
    <option class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>" value="cliente<?= $vd->scriviToken('?')?>">Home</option>
    <option class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>" value="cliente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</option>
    <option class="<?= $vd->getSottoPagina() == 'lista_ordini' ? 'current_page_item' : '' ?>" value="cliente/lista_ordini<?= $vd->scriviToken('?')?>">Lista Ordini</option>
    <option class="<?= $vd->getSottoPagina() == 'ordine' ? 'current_page_item' : '' ?>" value="cliente/ordine<?= $vd->scriviToken('?')?>">Ordine</option>



