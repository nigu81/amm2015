<p>Gestione Gestore - <?= $user->getNome().' '.$user->getCognome().' pizzeria: ' ?>

<?php
$pizzerie = PizzeriaFactory::instance()->elencoPizzerie();
$id_pizzeria = $user->getPizzeria()->getNome();
echo $id_pizzeria;
             
?>  
</p>
<p class="logout">
    <a href="gestore?cmd=logout">Logout</a>
</p>
                      