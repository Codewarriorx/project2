<?php
	define("PAGE", "admin");
	class Admin extends BaseController{
		private $expected = array('name', 'description', 'price', 'quantity', 'salePrice', 'image', 'password', 'id', 'onSale');
		private $required = array('name', 'description', 'price', 'quantity', 'salePrice', 'password');
		private $errors = array();
		private $clean = array();

		public function index(){
			$catalogModel = new CatalogModel();
			$entities = $catalogModel->getAll();
			return new IndexView($entities, $this->errors);
		}

		public function save(){
			if(array_key_exists('save', $_POST)){ // Form has been submitted
				foreach ($_POST as $field => $value){
					$temp = trim($value);
					if(empty($temp) && in_array($field, $this->required)){ // Check if field is empty and required
						array_push($this->errors, $field);
					}
					$this->clean[$field] = $value; // sanitize
				}

				if($_POST['password'] != PASSWORD){
					array_push($this->errors, 'password');
				}

				if(empty($this->errors)){ // If true there were no errors
					if(strlen($this->clean['image']) == 0){
						$this->clean['image'] = 'coming_soon.jpg';
					}

					if(isset($_POST['itemID']) && $_POST['itemID'] != -1){
						// editCatalog($clean, $_POST['itemID']);
						echo "edit catalog";
						$catalogModel = new CatalogModel();
						$catalogModel->updateCatalog($this->clean['name'], $this->clean['description'], $this->clean['price'], $this->clean['quantity'], $this->clean['image'], $this->clean['salePrice'], $this->clean['itemID']);
						if(isset($this->clean['onSale'])){
							// $salesModel = new SalesModel();
						}
					}
					else{
						//addToCatalog($clean);
						echo "added to catalog";
						$catalogModel = new CatalogModel();
						$catalogModel->updateCatalog($this->clean['name'], $this->clean['description'], $this->clean['price'], $this->clean['quantity'], $this->clean['image'], $this->clean['salePrice']);
						if(isset($this->clean['onSale'])){
							// $salesModel = new SalesModel();
						}
					}
				}
			}

			return $this->edit($_POST);
		}

		public function edit($postValues = null){
			$itemID = $_POST['itemID'];
			$catalogModel = new CatalogModel();
			$catalogEntities = $catalogModel->getAll();

			$salesModel = new SalesModel();
			$onSale = $salesEntities = $salesModel->onSale($itemID);
			
			return new IndexView($catalogEntities, $this->errors, $itemID, $onSale, $postValues);
		}
	}
?>