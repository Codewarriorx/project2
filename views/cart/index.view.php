<?php
	class IndexView{
		private $catalogEntities, $cartEntities;

		public function __construct($cartEntities, $catalogEntities){
			$this->cartEntities = $cartEntities;
			$this->catalogEntities = $catalogEntities;
		}

		public function render(){
			include("templates/cart/top.tpl.php");
			$content = "";
			$grandTotal = 0;
			for ($i=0; $i < count($this->cartEntities); $i++) { 
				$cartValues = $this->cartEntities[$i]->toArray();
				$catalogValues = $this->catalogEntities[$i]->toArray();
				$itemSum = $catalogValues['price'] * $cartValues['count'];
				$grandTotal += $itemSum;
				ob_start();
				include("templates/cart/tableRow.tpl.php");
				$row = ob_get_clean();
				$content .= $row;
			}
			include("templates/cart/table.tpl.php");

			$cartTax = $grandTotal * 0.08;
			include("templates/cart/bottom.tpl.php");
		}

		private function decode($var){
			return html_entity_decode($var);
		}
	}
?>