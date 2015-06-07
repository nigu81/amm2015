<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
$tracks = array();
$id = 1;
if (isset($_REQUEST["id"])) {
    $id = intval($_REQUEST["id"]);
}
switch ($id) {
    case 1:
        // A Night at the opera
        // simuliamo il caricamento da un db
        $tracks[] = array('numero' => 1, 'titolo' => "Death on two Legs");
        $tracks[] = array('numero' => 2, 'titolo' => "Lazing on a Sunday Afternoon");
        $tracks[] = array('numero' => 3, 'titolo' => "I'm in Love with my Car");
        $tracks[] = array('numero' => 4, 'titolo' => "You're my best friend");
        $tracks[] = array('numero' => 5, 'titolo' => "'39");
        $tracks[] = array('numero' => 6, 'titolo' => "Sweet Lady");
        $tracks[] = array('numero' => 7, 'titolo' => "Seaside Rendezvous");
        $tracks[] = array('numero' => 8, 'titolo' => "The Prophet's Song");
        $tracks[] = array('numero' => 9, 'titolo' => "Love of My Life");
        $tracks[] = array('numero' => 10, 'titolo' => "Good Company");
        $tracks[] = array('numero' => 11, 'titolo' => "Bohemian Rhapsody");
        $tracks[] = array('numero' => 12, 'titolo' => "God Save the Queen");
        break;

    case 2 :
        // A day at races
        // simuliamo il caricamento da un db
        $tracks[] = array('numero' => 1, 'titolo' => "Tie Your Mother Down");
        $tracks[] = array('numero' => 2, 'titolo' => "You Take My Breath Away");
        $tracks[] = array('numero' => 3, 'titolo' => "Long Away");
        $tracks[] = array('numero' => 4, 'titolo' => "The Millionaire Waltz");
        $tracks[] = array('numero' => 5, 'titolo' => "You and I");
        $tracks[] = array('numero' => 6, 'titolo' => "Somebody to Love");
        $tracks[] = array('numero' => 7, 'titolo' => "White Man");
        $tracks[] = array('numero' => 8, 'titolo' => "Good Old-Fashioned Lover Boy");
        $tracks[] = array('numero' => 9, 'titolo' => "Drowse");
        $tracks[] = array('numero' => 10, 'titolo' => "Teo Torriatte (Let Us Cling Together)");
        break;
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Visualizzatore Tracce</title>
        <style>
            body {
                font-family: sans-serif;
            }
            td, th, table {
                border: 1px solid black;
                border-collapse: collapse;
            }
            .normal {
                background-color: white;
            }
            .odd{
                background-color: #eeffee;
            }
        </style>
    </head>
    <body>
        <form name="cd" action="trackListNormale.php">
            <label for="id">Titolo</label>
            <input type="hidden" name="cmd" value="showTrack"/>
            <select name="id" id="id">
                <option value="1" <?= $id == 1 ? 'selected' : '' ?>>A Night at the Opera</option>
                <option value="2" <?= $id == 2 ? 'selected' : '' ?>>A Day at Races</option>
            </select>
            <input type="submit" value="Vedi tracce"/>
        </form>
        <table>
            <thead> 
                <tr>
                    <th>Numero</th>
                    <th>Titolo</th>
                </tr>
            </thead>
            <?php
            for ($i = 0; $i < count($tracks); $i++) {
                ?>
                <tr class="<?= $i % 2 == 0 ? 'normal' : 'odd' ?>">
                    <td><?= $tracks[$i]['numero'] ?></td>
                    <td><?= $tracks[$i]['titolo'] ?></td>
                </tr>
                <?php
            }
            ?>

        </table>
    </body>
</html>
