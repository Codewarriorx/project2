<?php
	class CartModel extends dataAccessHandler{

		public function __construct(){
			parent::__construct("cartlist.xml");
		}

		public function __destruct(){
			parent::__destruct();
		}

		public function getItem($cartID){
			$item = $this->read($cartID);
			return new CartItem($item['itemID'], $item['quantity'], $item['id']);
		}

		public function getAll(){
			$listing = array();
			for ($i=0; $i <= $this->getLastInsertID(); $i++) { 
				$item = $this->read("cart_$i");
				if(is_null($item)){
					continue;
				}
				$tempEntity = new CartItem($item['itemID'], $item['quantity'], $item['id']);
				array_push($listing, $tempEntity);
			}
			return $listing;
		}

		public function addToCart($itemID, $quantity){
			$cartEntity = new CartItem($itemID, $quantity);
			$this->updateXML($cartEntity);
		}

		public function removeFromCart($itemID){
			$this->delete('cart', $itemID);
		}
	}
?>