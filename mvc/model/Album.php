<?php

require_once 'Track.php';

class Album {

    private $tracks;
    private $id;

    public function __construct($id) {
        $this->loadTracks($id);
    }

    public function &getTracks() {
        return $this->tracks;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        loadTracks($id);
    }

    private function loadTracks($id) {
        $this->tracks = array();
        $this->id = $id;
        // simuliamo il caricamento da un database
        switch ($id) {
            case 1:
                $this->tracks[] = new Track(1, "Death on two Legs");
                $this->tracks[] = new Track(2, "Lazing on a Sunday Afternoon");
                $this->tracks[] = new Track(3, "I'm in Love with my Car");
                $this->tracks[] = new Track(4, "You're my best friend");
                $this->tracks[] = new Track(5, "'39");
                $this->tracks[] = new Track(6, "Sweet Lady");
                $this->tracks[] = new Track(7, "Seaside Rendezvous");
                $this->tracks[] = new Track(8, "The Prophet's Song");
                $this->tracks[] = new Track(9, "Love of My Life");
                $this->tracks[] = new Track(10, "Good Company");
                $this->tracks[] = new Track(11, "Bohemian Rhapsody");
                $this->tracks[] = new Track(12, "God Save the Queen");
                break;
            case 2:
                $this->tracks[] = new Track(1, "Tie Your Mother Down");
                $this->tracks[] = new Track(2, "You Take My Breath Away");
                $this->tracks[] = new Track(3, "Long Away");
                $this->tracks[] = new Track(4, "The Millionaire Waltz");
                $this->tracks[] = new Track(5, "You and I");
                $this->tracks[] = new Track(6, "Somebody to Love");
                $this->tracks[] = new Track(7, "White Man");
                $this->tracks[] = new Track(8, "Good Old-Fashioned Lover Boy");
                $this->tracks[] = new Track(9, "Drowse");
                $this->tracks[] = new Track(10, "Teo Torriatte (Let Us Cling Together)");
                break;
        }
    }

}

?>
