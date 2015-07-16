<?php

include_once 'Cliente.php';
include_once 'Pizzeria.php';
include_once 'Gestore.php';

class Ordine {
	
	private $id;
	private $cliente;
	private $pizzeria;
	private $status;
	private $data;
	
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
	
	public function setCliente(Cliente $cliente){
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
	
	public function setData($data){
		$this->data = $data;
	}
}


	
?>