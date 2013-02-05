<?php
	define("PAGE", "item");
	class Item extends BaseController{
		public function index(){
			$catalogModel = new CatalogModel();
			$entity = $catalogModel->getItem($_GET['id']);

			$salesModel = new SalesModel();
			return new IndexView($entity, $salesModel->onSale($entity->getID()));
		}
	}
?>