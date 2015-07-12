<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;
    case 'lista_ordini':
        include_once 'lista_ordini.php';
        break;

    case 'ordine':
        include_once 'ordine.php';
        break;
    default:
        
        ?>
        <h2 class="icon-title" id="h-home">Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul class="panel">
            <li><a href="cliente/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica">
                    Anagrafica
                </a>
            </li>

            <li><a href="cliente/lista_ordini<?= $vd->scriviToken('?')?>" id="pnl-libretto">Lista Ordini</a></li>
            <li><a href="cliente/ordine<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Effettua un ordine</a></li>

        </ul>
        <?php
        break;
}
?>


