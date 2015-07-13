<h2 class="icon-title">Docente</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>">
    <a href="gestore/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="gestore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'conferma_ordini' ? 'current_page_item' : '' ?>"><a href="gestore/conferma_ordini<?= $vd->scriviToken('?')?>">Appelli</a></li>
    <li class="<?= $vd->getSottoPagina() == 'el_ordini' ? 'current_page_item' : '' ?>"><a href="gestore/el_ordini<?= $vd->scriviToken('?')?>">Elenco Esami</a></li>
</ul>
