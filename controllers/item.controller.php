<?php
	define("PAGE", "item");
	class Item extends BaseController{
		public function index(){
			$catalogModel = new CatalogModel();
			$entity = $catalogModel->getItem($_GET['id']);
			return new IndexView($entity);
		}
	}
?>