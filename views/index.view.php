<?php
	class IndexView{
		private $entityList;

		public function __construct($entities){
			$this->entityList = $entities;
		}

		public function render(){
			foreach ($this->entityList as $entity) {
				var_dump($entity->toArray());
				ob_start();
				$values = $entity->toArray();
				include("templates/index/mainItem.tpl.php");
				$content = ob_get_clean();
				echo $content;
			}
		}

		public function itemDescriptionLimited($description, $length){
			return substr($description,0,$length)."...";
		}
	}
?>