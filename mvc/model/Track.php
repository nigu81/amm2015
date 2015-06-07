<?php

class Track{
    private $pos;
    private $title;
    
    
    public function __construct($pos, $title) {
        $this->pos = $pos;
        $this->title = $title;
    }
    
    public function setPosition($pos){
        $this->pos = $pos;
    }
    
    public function getPosition(){
        return $this->pos;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    
}
?>
