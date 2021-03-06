<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

    case 'ordini':
        include_once 'ordini.php';
        break;

    case 'iscrizione':
        include_once 'iscrizione.php';
        break;
        
    case 'dettaglio_ordine':
        include_once 'ordini.php';
        include_once 'dettaglio_ordine.php';
        break;
    case 'crea_ordine':
        include_once 'crea_ordine.php';
        break;
    case 'crea_ordine_items':
        include_once 'crea_ordine_items.php';
        include_once 'new_dettaglio_ordine.php';
        break;
    case 'elimina_item':
    
        include_once 'crea_ordine_items.php';
        include_once 'new_dettaglio_ordine.php';
        break;
     ?>
    <?php default: ?>
        <h2 class="icon-title" id="h-home">Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul class="panel">
            <li><a href="cliente/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica-clienti">
                    Anagrafica
                </a>
            </li>
            <li><a href="cliente/ordini<?= $vd->scriviToken('?')?>" id="pnl-ordini">Lista Ordini</a></li>
            <li><a href="cliente/crea_ordine<?= $vd->scriviToken('?')?>" id="pnl-crea_ordine">Nuovo Ordine</a></li>
        </ul>
        <?php
        break;
}
?>


