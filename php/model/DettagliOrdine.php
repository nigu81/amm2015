<?php

//include_once 'Cliente.php';
include_once 'Pizzeria.php';
include_once 'Gestore.php';

class DettagliOrdine {
	
	private $ordine_id;
	private $pizzeria_id;
	private $cliente_id;
	private $pizza_id;
	private $nome_pizza;
	private $ingredienti_pizza;
	private $qta;
	
	public function __construct(){
		
	}
	
	public function getOrdineId(){
		return $this->ordine_id;
	}
	
	public function setOrdineId($ordine_id){
		$this->ordine_id = $ordine_id;
	}
	
	public function getPizzeriaId(){
		return $this->pizzeria_id ;
	}
	
	public function setPizzeriaId($pizzeria_id){
		$this->pizzeria_id = $pizzeria_id;
	}
	
	public function getClienteId(){
		return $this->cliente_id;
	}
	
	public function setClienteId($cliente_id){
		$this->cliente_id = $cliente_id;
	}
	
	public function getPizzaId(){
		return $this->pizza;
	}
	
	public function setPizzaId($pizza){
		$this->pizza = $pizza;
	}
	
	public function getNomePizza(){
		return $this->nome_pizza;
	}
	
	public function setNomePizza($nome_pizza){
		$this->nome_pizza = $nome_pizza;
	}
	
	public function getIngredientiPizza(){
		return $this->ingredienti_pizza;
	}
	
	public function setIngredientiPizza($ingredienti_pizza){
		$this->ingredienti_pizza = $ingredienti_pizza;
	}
	
	public function getQta(){
		return $this->qta;
	}
	
	public function setQta($qta){
		$this->qta = $qta;
	}
	
}


	
?>