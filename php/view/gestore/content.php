<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include 'anagrafica.php';
        break;

    
    case 'ordini_pizzeria':
        include 'ordini_pizzeria.php';
        include 'dettaglio_ordine_filtro.php';
        break;
    
    case 'el_ordini':
        include 'el_ordini.php';
        break;
    
    case 'el_ordini_json':
        include 'el_ordini_json.php';
        break;
   case 'lavora_ordine':
   include 'ordini_lavorazione.php';
        break;
   
   case 'dettaglio_ordine_da_lavorare':
   include 'lavora_dettaglio_ordine.php';
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
            <li><a href="gestore/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica">
                    Anagrafica
                </a>
            </li>
            <li><a href="gestore/ordini_pizzeria<?= $vd->scriviToken('?')?>" id="pnl-cerca">Elenco Ordini</a></li>
            <li><a href="gestore/lavora_ordine<?= $vd->scriviToken('?')?>" id="pnl-libretto">Lavora Ordine</a></li>
            
        </ul>
        <?php
        break;
}
?>


