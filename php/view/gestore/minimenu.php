
    <option class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>" value="gestore/home<?= $vd->scriviToken('?')?>">Home</option>
    <option class="<?= strpos($vd->getSottoPagina(),'anagrafica') !== false ? 'current_page_item' : '' ?>" value="gestore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</option>
    <option class="<?= strpos($vd->getSottoPagina(), 'ordini_pizzeria') !== false ? 'current_page_item' : '' ?>" value="gestore/ordini_pizzeria<?= $vd->scriviToken('?')?>">ElencoOrdini</option>
    <option class="<?= strpos($vd->getSottoPagina(),'lavora_ordine') !== false ? 'current_page_item' : '' ?>" value="gestore/lavora_ordine<?= $vd->scriviToken('?')?>">LavoraOrdine</option>
    
