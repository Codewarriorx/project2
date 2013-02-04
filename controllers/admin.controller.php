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
			$id = null;
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

					if(isset($_POST['id']) && $_POST['id'] != -1){
						// editCatalog($clean, $_POST['id']);
						$catalogModel = new CatalogModel();
						$salesModel = new SalesModel();

						$catalogModel->updateCatalog($this->clean['name'], $this->clean['description'], $this->clean['price'], $this->clean['quantity'], $this->clean['image'], $this->clean['salePrice'], $this->clean['id']);
						if(isset($this->clean['onSale'])){ // if on sale make sure its set
							if( !$salesModel->onSale($this->clean['id']) ){
								echo "put on sale";
								$salesModel->putOnSale($this->clean['id']);
							}
						}
						else{ // check to see if it was on sale and remove it
							if( $salesModel->onSale($this->clean['id']) ){
								echo "take off sale";
								$salesModel->takeOffSale($this->clean['id']);
							}
						}
					}
					else{
						//addToCatalog($clean);
						$catalogModel = new CatalogModel();
						$salesModel = new SalesModel();

						$id = $catalogModel->updateCatalog($this->clean['name'], $this->clean['description'], $this->clean['price'], $this->clean['quantity'], $this->clean['image'], $this->clean['salePrice']);
						if(isset($this->clean['onSale'])){ // if on sale make sure its set
							$id = "item_".$id;
							$salesModel->putOnSale($id);
						}
					}
				}
			}

			return $this->edit($_POST, $id);
		}

		public function edit($postValues = null, $id = null){
			if($_POST['id'] == -1 && !is_null($id)){
				$itemID = $id;
			}
			else{
				$itemID = $_POST['id'];
			}
			
			$catalogModel = new CatalogModel();
			$catalogEntities = $catalogModel->getAll();

			$salesModel = new SalesModel();
			$onSale = $salesEntities = $salesModel->onSale($itemID);
			
			return new IndexView($catalogEntities, $this->errors, $itemID, $onSale, $postValues);
		}
	}
?>