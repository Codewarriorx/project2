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

				$catalogModel = new CatalogModel();
				$entity = $catalogModel->getItem($itemID);
				$left = $entity->getQuantity() - $quantity;
				$entity->setQuantity($left);

				$catalogModel->updateItem($entity);

				return $this->index();
			}
		}

		public function deleteItem(){
			if(isset($_POST['cartID'])){
				$cartID = $_POST['cartID'];
				$cartModel = new CartModel();
				$cartItem = $cartModel->getItem($cartID);
				$itemID = $cartItem->getItemID();
				$id = str_replace('item_', '', $itemID);
				$quantity = $cartItem->getCount();

				$catalogModel = new CatalogModel();
				$entity = $catalogModel->getItem($id);
				$left = $entity->getQuantity() + $quantity;
				$entity->setQuantity($left);

				$catalogModel->updateItem($entity);

				$cartModel->removeFromCart($itemID);
			}

			return $this->index();
		}

		public function emptyCart(){
			if(isset($_POST['empty'])){
				$cartModel = new CartModel();
				$entities = $cartModel->getAll();
				foreach ($entities as $entity) {
					$itemID = $entity->getItemID();
					$id = str_replace('item_', '', $itemID);
					$quantity = $entity->getCount();

					$catalogModel = new CatalogModel();
					$catalogEntity = $catalogModel->getItem($id);
					$left = $catalogEntity->getQuantity() + $quantity;
					$catalogEntity->setQuantity($left);
					$catalogModel->updateItem($catalogEntity);

					$cartModel->removeFromCart($itemID);
				}
			}

			return $this->index();
		}

		public function purchase(){
			return $this->emptyCart();
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