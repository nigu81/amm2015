<?php

$json = array();
$json['errori'] = $errori;
$json['ordini'] = array();
foreach($ordini as $ordine){
     /* @var $esame Esame */
    $element = array();
    $element['status'] = $ordine->getStatus();
    $json['ordini'][] = $element;
    
}
echo json_encode($json);
?>
