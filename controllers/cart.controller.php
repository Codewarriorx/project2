<?php
	define("PAGE", "cart");
	class Cart extends BaseController{
		public function index(){
			$cartModel = new CartModel();
			$catalogModel = new CatalogModel();
			$cartEntities = $cartModel->getAll();
			$cartListing = $catalogModel->getCatalogItems($cartEntities);
			return new IndexView($cartEntities, $cartListing);
		}

		public function addItem(){
			if(isset($_POST['add'])){
				$itemID = $_POST['itemID'];
				$itemID = str_replace('item_', '', $itemID);

				if(isset($_POST['quantity'])){
					$quantity = $_POST['quantity'];

					if(is_numeric($quantity)){
						$catalogModel = new CatalogModel();
						$itemStock = $catalogModel->getItem($itemID)->getQuantity();
						if($quantity >= $itemStock){
							$quantity = $itemStock;
						}
						if($quantity < 0){
							$quantity = 0;
						}
					}
					else{
						$quantity = 1;
					}
				}
				else{
					$quantity = 1;
				}
				$cartModel = new CartModel();
				$cartModel->addToCart($itemID, $quantity);

				return $this->index();
			}
		}

		public function deleteItem(){
			if(isset($_POST['cartID'])){
				$cartID = $_POST['cartID'];
				$cartModel = new CartModel();
				$cartModel->removeFromCart($cartID);
			}

			return $this->index();
		}

		public function emptyCart(){
			if(isset($_POST['empty'])){
				$cartModel = new CartModel();
				$entities = $cartModel->getAll();
				foreach ($entities as $entity) {
					$cartModel->removeFromCart($entity->getID());
				}
			}

			return $this->index();
		}

		public function updateCart(){
			// $itemIDs = $_POST['itemID'];
			// $quantities = $_POST['quantity'];

			// $cartModel = new CartModel();
			// $cartModel->updateToCart($itemID, $quantity);

			return $this->index();
		}
	}
?>