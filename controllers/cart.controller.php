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
	}
?>