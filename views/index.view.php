<?php
	class IndexView{
		private $entityList;

		public function __construct($entities){
			$this->entityList = $entities;
		}

		public function render(){
			$catalogList = "";
			foreach ($this->entityList as $entity) {
				ob_start();
				$values = $entity->toArray();
				include("templates/index/mainItem.tpl.php");
				$content = ob_get_clean();
				$catalogList .= $content;
			}

			include("templates/index/itemContainer.tpl.php");

		}

		public function itemDescriptionLimited($description, $length){
			return substr($description,0,$length)."...";
		}
	}
?>