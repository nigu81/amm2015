<?php

include 'Cliente.php';
include 'Ordine.php';

class DettaglioOrdine {
	
	private $pizze;
	private $id;
		


	public function __construct(){
		
		$this->pizze = array();
	
	}
	
	public function getId(){
		return $this->id;
	}
	
	 public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
        return true;
	}
	
	public function &getPizze(){
		return $this->pizze;
	}

}	
?>