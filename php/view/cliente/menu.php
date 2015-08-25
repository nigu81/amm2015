<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="cliente<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="cliente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'lista_ordini' ? 'current_page_item' : '' ?>"><a href="cliente/ordini<?= $vd->scriviToken('?')?>">Lista Ordini</a></li>
    <li class="<?= $vd->getSottoPagina() == 'ordine' ? 'current_page_item' : '' ?>"><a href="cliente/crea_ordine<?= $vd->scriviToken('?')?>">Ordine</a></li>
</ul>


