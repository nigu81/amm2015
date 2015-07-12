<<<<<<< HEAD
<h2 class="icon-title">Cliente</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="cliente<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="cliente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'lista_ordini' ? 'current_page_item' : '' ?>"><a href="cliente/lista_ordini<?= $vd->scriviToken('?')?>">Lista Ordini</a></li>
    <li class="<?= $vd->getSottoPagina() == 'ordine' ? 'current_page_item' : '' ?>"><a href="cliente/ordine<?= $vd->scriviToken('?')?>">Ordine</a></li>
=======
<h2 class="icon-title">Studente</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="studente<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="studente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'esami' ? 'current_page_item' : '' ?>"><a href="studente/esami<?= $vd->scriviToken('?')?>">Libretto</a></li>
    <li class="<?= $vd->getSottoPagina() == 'iscrizione' ? 'current_page_item' : '' ?>"><a href="studente/iscrizione<?= $vd->scriviToken('?')?>">Iscrizione</a></li>
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
</ul>
