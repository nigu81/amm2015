<ul>
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="gestore/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'anagrafica') !== false ? 'current_page_item' : '' ?>"><a href="gestore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= strpos($vd->getSottoPagina(), 'ordini_pizzeria') !== false ? 'current_page_item' : '' ?>"><a href="gestore/ordini_pizzeria<?= $vd->scriviToken('?')?>">ElencoOrdini</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'lavora_ordine') !== false ? 'current_page_item' : '' ?>"><a href="gestore/lavora_ordine<?= $vd->scriviToken('?')?>">LavoraOrdine</a></li>
    
</ul>