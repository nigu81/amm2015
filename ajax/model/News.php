<?php

class News {

    private $heading;
    private $image;
    private $text;
    private $id;

    public function __construct() {
        
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setHeading($heading){
        $this->heading = $heading;
    }
    
    public function getHeading(){
        return $this->heading;
    }
    
    public function setImage($image){
        $this->image = $image;
    }
    
    public function getImage(){
        return $this->image;
    }
    
    public function setText($text){
        $this->text = $text;
    }
    
    public function getText(){
        return $this->text;
    }
    
    

}

?>
