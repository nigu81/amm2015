<?php

//include_once 'Cliente.php';
include_once 'Pizzeria.php';
include_once 'Gestore.php';

class Ordine {
	
	private $id;
	private $cliente;
	private $pizzeria;
	private $status;
	private $data;
	private $items;
	private $importo;
	
	public function __construct(){
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	
	public function getCliente(){
		return $this->cliente;
	}
	
	public function setCliente($cliente){
		$this->cliente = $cliente;
	}
	
	
	
	public function getPizzeria(){
		return $this->pizzeria ;
	}
	
	public function setPizzeria($pizzeria){
		$this->pizzeria = $pizzeria;
	}
	
	
	public function getStatus(){
		return $this->status;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function setData(DateTime $data){
		$this->data = $data;
		return true;
	}
	
	public function setImporto($importo){
		$this->importo = $importo;
	}
	public function getImporto(){
		return $this->importo;
	}
	
	
	
}


	
?>