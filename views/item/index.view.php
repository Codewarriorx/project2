<?php
	class IndexView{
		private $entity;

		public function __construct($entity){
			$this->entity = $entity;
		}

		public function render(){
			$values = $this->entity->toArray();
			$values['name'] = $this->decode($values['name']);
			$values['description'] = $this->decode($values['description']);
			include("templates/item/main.tpl.php");
		}

		private function decode($var){
			return html_entity_decode($var);
		}
	}
?>