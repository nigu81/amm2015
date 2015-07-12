<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

<<<<<<< HEAD
<<<<<<< HEAD
    case 'lista_ordini':
        include_once 'lista_ordini.php';
        break;

    case 'ordine':
        include_once 'ordine.php';
=======
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
    case 'esami':
        include_once 'esami.php';
        break;

    case 'iscrizione':
        include_once 'iscrizione.php';
<<<<<<< HEAD
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
=======
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
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
<<<<<<< HEAD
<<<<<<< HEAD
            <li><a href="cliente/lista_ordini<?= $vd->scriviToken('?')?>" id="pnl-libretto">Lista Ordini</a></li>
            <li><a href="cliente/ordine<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Effettua un ordine</a></li>
=======
            <li><a href="cliente/esami<?= $vd->scriviToken('?')?>" id="pnl-libretto">Libretto</a></li>
            <li><a href="cliente/iscrizione<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Iscrizione</a></li>
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
=======
            <li><a href="cliente/esami<?= $vd->scriviToken('?')?>" id="pnl-libretto">Libretto</a></li>
            <li><a href="cliente/iscrizione<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Iscrizione</a></li>
>>>>>>> 7123b1f8b33e43679993cd0ecaac23f68f0771b1
        </ul>
        <?php
        break;
}
?>


