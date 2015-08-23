<h2 class="icon-title">Gestore</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>">
    <a href="gestore/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="gestore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'ordini_pizzeria' ? 'current_page_item' : '' ?>"><a href="gestore/ordini_pizzeria<?= $vd->scriviToken('?')?>">Elenco Ordini</a></li>
    <li class="<?= $vd->getSottoPagina() == 'lavora_ordine' ? 'current_page_item' : '' ?>"><a href="gestore/lavora_ordine<?= $vd->scriviToken('?')?>">Lavora Ordine</a></li>
</ul>
