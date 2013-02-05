<?php
	define("PAGE", "admin");
	class Admin extends BaseController{
		private $expected = array('name', 'description', 'price', 'quantity', 'salePrice', 'image', 'password', 'id', 'onSale');
		private $required = array('name', 'description', 'price', 'quantity', 'salePrice', 'password');
		private $errors = array();
		private $clean = array();
		private $allowed = array("jpg", "jpeg", "gif", "png");

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
					if($_FILES['image']['name'] == ""){
						$this->clean['image'] = 'coming_soon.jpg';
					}
					else{
						echo "start upload";
						$this->clean['image'] = $this->uploadFile();//$_FILES['image']['name'];
					}

					if(isset($_POST['id']) && $_POST['id'] != -1){
						$catalogModel = new CatalogModel();
						$salesModel = new SalesModel();

						$catalogModel->updateCatalog($this->clean['name'], $this->clean['description'], $this->clean['price'], $this->clean['quantity'], $this->clean['image'], $this->clean['salePrice'], $this->clean['id']);
						if(isset($this->clean['onSale'])){ // if on sale make sure its set
							if( !$salesModel->onSale($this->clean['id']) ){
								$salesModel->putOnSale($this->clean['id']);
								$this->updateRSS();
							}
						}
						else{ // check to see if it was on sale and remove it
							if( $salesModel->onSale($this->clean['id']) ){
								$salesModel->takeOffSale($this->clean['id']);
								$this->updateRSS();
							}
						}
					}
					else{
						if($_FILES['image']['name'] == ""){
							$this->clean['image'] = 'coming_soon.jpg';
						}
						else{
							$this->clean['image'] = $this->uploadFile();//$_FILES['image']['name'];
						}

						$catalogModel = new CatalogModel();
						$salesModel = new SalesModel();

						$id = $catalogModel->updateCatalog($this->clean['name'], $this->clean['description'], $this->clean['price'], $this->clean['quantity'], $this->clean['image'], $this->clean['salePrice']);
						if(isset($this->clean['onSale'])){ // if on sale make sure its set
							$id = "item_".$id;
							$salesModel->putOnSale($id);
							$this->updateRSS();
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

		private function updateRSS(){
			$rssFeed = new RssFeed("project2.rss");
			$catalogModel = new CatalogModel();
			$salesModel = new SalesModel();
			$salesEntities = $salesModel->getAll();
			$catalogEntities = $catalogModel->getCatalogItems($salesEntities);
			$rssFeed->replaceRSS($catalogEntities);
		}

		private function uploadFile(){
			$splitstring = explode(".", $_FILES["image"]["name"]);
			$filename = $splitstring[0];
			$filename = str_replace(" ", "_", $filename);
			$filename = str_replace("&", "_", $filename);
			$filename = str_replace("?", "_", $filename);
			$filename = str_replace("#", "_", $filename);
			$filetype = $splitstring[1];
echo $filetype;
			if(($_FILES["image"]["size"] < 500000) && in_array($filetype, $this->allowed)){

				if($_FILES["image"]["error"] > 0){
					// error
					// echo "error";
				}
				else{
					if(file_exists("img/" . $_FILES["image"]["name"])){
						// file exists
						// echo "file exists";
					}
					else{
						// echo "good";
						move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES["image"]["name"]);
						chmod("img/".$_FILES["image"]["name"], 0755);
						return $filename.".".$filetype;
					}
				}
			}
			else{
				// Invalid file
				// echo "bad file";
			}
			return 'coming_soon.jpg';
		}
	}
?>