<?php

include_once 'model/Album.php';

class TrackListController {

    public function __construct() {
        
    }

    public function handleInput(&$request) {
        if (isset($request["cmd"])) {
            // abbiamo ricevuto un comando
            switch ($request["cmd"]) {
                case 'showTrack':
                    // mostriamo la traccia
                    if (isset($request["id"])) {
                        $id = intval($request["id"]);
                    } else {
                        // selezionamo 1 come id di default
                        $id = 1;
                    }
                    $this->showTrackList($id);
                    break;

                default:
                    // mostriamo l'album con id 1 come default
                    $this->showTrackList(1);
                    break;
            }
        } else {
            // mostriamo l'album con id 1 come default
            $this->showTrackList(1);
        }
    }

    private function showTrackList($id) {
        // chiediamo al modello di caricare i dati e li passiamo alla vista. 
        // Il passaggio e' fatto semplicemente popolando delle variabili
        // che poi vengono lette dalla vista.
        $album = new Album($id);
        include_once('trackList-view.php');
    }

}

?>
