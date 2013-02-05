<?php
	class IndexView{
		private $entity, $onSale;

		public function __construct($entity, $onSale = false){
			$this->entity = $entity;
			$this->onSale = $onSale;
		}

		public function render(){
			$values = $this->entity->toArray();
			if($this->onSale){
				$values['price'] = $values['salePrice'];
			}
			$values['name'] = $this->decode($values['name']);
			$values['description'] = $this->decode($values['description']);
			include("templates/item/main.tpl.php");
		}

		private function decode($var){
			return html_entity_decode($var);
		}
	}
?>