<?php
	class CartModel extends dataAccessHandler{

		public function __construct(){
			parent::__construct("cartlist.xml");
		}

		public function __destruct(){
			parent::__destruct();
		}

		public function getAll(){
			$listing = array();
			for ($i=0; $i < $this->getItemCount(); $i++) { 
				$item = $this->read("cart_$i");
				$tempEntity = new CartItem($item['itemID'], $item['quantity'], $item['id']);
				array_push($listing, $tempEntity);
			}
			return $listing;
		}
	}
?>