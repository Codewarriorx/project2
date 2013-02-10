<?php
	class IndexView{
		private $catalogEntities, $errors, $editFlag, $onSale, $postValues;
		private $values = array('id' => '-1', 'name' => '', 'description' => '', 'price' => '', 'quantity' => '', 'salePrice' => '', 'image' => '', 'password' => '', 'onSale' => '');

		public function __construct($catalogEntities, $errors, $editFlag = -1, $onSale = false, $postValues = null){
			$this->catalogEntities = $catalogEntities;
			$this->errors = $errors;
			$this->editFlag = $editFlag;
			$this->onSale = $onSale;
			$this->postValues = $postValues;
		}

		public function render(){
			$itemOptions = ""; $values = array(); $selectedEntity = null;
			foreach ($this->catalogEntities as $entity) {
				$itemName = $entity->getName();
				$itemID = $entity->getID();

				if($this->editFlag != -1 && $this->editFlag == $itemID){
					$selectedEntity = $entity;
				}

				ob_start();
				include("templates/admin/options.tpl.php");
				$itemOptions .= ob_get_clean();
			}
			include("templates/admin/top.tpl.php");

			if($this->editFlag != -1){
				if($this->postValues != null){
					$values = $this->postValues;
				}
				else{
					$values = $selectedEntity->toArray();
				}
				
				if($this->onSale){
					$values['onSale'] = "checked";
				}
				else{
					$values['onSale'] = "";
				}
			}
			else{
				if($this->postValues != null){
					$values = $this->postValues;
				}
				else{
					$values = $this->values;
				}
				$values['onSale'] = "";
			}

			include("templates/admin/filledForm.tpl.php");

			// follow classmates bit ---------- rewrite this later
			$options = "";
			$dom = new DomDocument();
			$dom->load("rss_class.xml");
			$students = $dom->getElementsByTagName('student');

			for ($i=0; $i < $students->length; $i++) { 
				$first = $students->item($i)->getElementsByTagName('first')->item(0)->nodeValue;
				$last = $students->item($i)->getElementsByTagName('last')->item(0)->nodeValue;
				$name = $first." ".$last;
				$number = $i;
				$selected = "";
				if($this->followed($i)){
					$selected = "selected";
				}

				ob_start();
				include("templates/admin/followOption.tpl.php");
				$options .= ob_get_clean();
			}
			include("templates/admin/classmateFeeds.tpl.php");


		}

		function followed($number){
			$follow = new DomDocument();
			$follow->load("follow.xml");
			$students = $follow->getElementsByTagName('student');

			foreach ($students as $student) {
				if($student->nodeValue == $number){
					return true;
				}
			}

			return false;
		}

		private function decode($var){
			return html_entity_decode($var);
		}

		function errorCheck($fieldName){
			if(in_array($fieldName, $this->errors)){
				return " error";
			}
			return "";
		}
	}
?>