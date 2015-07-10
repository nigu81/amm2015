<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="cliente<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="cliente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'esami' ? 'current_page_item' : '' ?>"><a href="cliente/esami<?= $vd->scriviToken('?')?>">Libretto</a></li>
    <li class="<?= $vd->getSottoPagina() == 'iscrizione' ? 'current_page_item' : '' ?>"><a href="cliente/iscrizione<?= $vd->scriviToken('?')?>">Iscrizione</a></li>
</ul>
