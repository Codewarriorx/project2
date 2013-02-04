<?php
	class IndexView{
		private $catalogEntities;

		public function __construct($catalogEntities){
			$this->catalogEntities = $catalogEntities;
		}

		public function render(){

		}

		private function decode($var){
			return html_entity_decode($var);
		}
	}
?>