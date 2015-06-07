<?php
    require_once 'model/Album.php';
    require_once 'model/Track.php';
    // la variabile album viene popolata dal controller
?>
<!DOCTYPE html>
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
        <form name="cd" action="trackList">
            <label for="id">Titolo</label>
            <input type="hidden" name="cmd" value="showTrack"/>
            <select name="id" id="id">
                <option value="1" <?= $album->getId() == 1 ? 'selected' : '' ?>>A Night at the Opera</option>
                <option value="2" <?= $album->getId() == 2 ? 'selected' : '' ?>>A Day at Races</option>
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
            $i = 0;
            foreach ($album->getTracks() as $track) {
                ?>
                <tr class="<?= $i % 2 == 0 ? 'normal' : 'odd' ?>">
                    <td><?= $track->getPosition() ?></td>
                    <td><?= $track->getTitle() ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </body>
</html>